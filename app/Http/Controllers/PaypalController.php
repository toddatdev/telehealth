<?php

/**
 * Class PaypalController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use App\Package;
use App\Order;
use App\User;
use App\EmailTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\OrderMeta;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\SiteManagement;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Helper;
use Auth;
use DB;
use App\Mail\DoctorEmailMailable;
use App\Mail\GeneralEmailMailable;
use Carbon\Carbon;
use function Opis\Closure\serialize;
use Twilio\Rest\Client;

/**
 * Class PaypalController
 *
 */
class PaypalController extends Controller
{

    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $provider
     */
    protected $provider;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    /**
     * Get index.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        if (Auth::user()) {
            $response = [];
            if (session()->has('code')) {
                $response['code'] = session()->get('code');
                session()->forget('code');
            }
            if (session()->has('message')) {
                $response['message'] = session()->get('message');
                session()->forget('message');
            }
            $error_code = session()->get('code');
            Session::flash('payment_message', $response);
            $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
            return Redirect::to('patient/appoinements');
        } else {
            abort(404);
        }
    }

    /**
     * Get express checkout.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function getExpressCheckout(Request $request)
    {
        if (Auth::user()) {
            $id = session()->get('product_id');
            $type = session()->get('type');
            $order = new Order();
            $order->status = 'pending';
            $order->payment_gateway = 'paypal';
            if ($type == 'appointment') {
                $appointment = Appointment::find($id);
                $order->appointment_date = $appointment->appointment_date;
            }
            $order->user()->associate(Auth::user()->id);
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();
            $latest_order = Order::find($order_id);
            session()->put(['order_id' => $order_id]);
            $order_type = new OrderMeta();
            $order_type->meta_key = 'type';
            $order_type->meta_value = $type;
            $latest_order->orderMeta()->save($order_type);
            if ($type == 'appointment') {
                $appointment_data = array();
                $appointment = Appointment::find($id);
                if (!empty($appointment->toArray())) {
                    foreach ($appointment->toArray() as $appointment_key => $appointment_value) {
                        $appointment_data[$appointment_key] = $appointment_value;
                    }
                    $appointment_meta = new OrderMeta();
                    $appointment_meta->meta_key = 'appointment';
                    $appointment_meta->meta_value = serialize($appointment_data);
                    $latest_order->orderMeta()->save($appointment_meta);
                }
            } else if ($type == 'package') {
                $package_data = array();
                $package = Package::find($id)->toArray();
                if (!empty($package)) {
                    foreach ($package as $package_key => $package_value) {
                        $package_data[$package_key] = $package_value;
                    }
                    $package_meta = new OrderMeta();
                    $package_meta->meta_key = 'package';
                    $package_meta->meta_value = serialize($package_data);
                    $latest_order->orderMeta()->save($package_meta);
                }
            }

            $settings = SiteManagement::getMetaValue('paypal_settings');
            $payment_mode = !empty($settings) && !empty($settings['enable_sandbox']) ? $settings['enable_sandbox'] : 'false';
            if ($payment_mode == 'true') {
                if (
                    empty(env('PAYPAL_SANDBOX_API_USERNAME'))
                    && empty(env('PAYPAL_SANDBOX_API_PASSWORD'))
                    && empty(env('PAYPAL_SANDBOX_API_SECRET'))
                ) {
                    Session::flash('error', trans('lang.paypal_empty_credentials'));
                    return Redirect::back();
                }
            } elseif ($payment_mode == 'false') {
                if (
                    empty(env('PAYPAL_LIVE_API_USERNAME'))
                    && empty(env('PAYPAL_LIVE_API_PASSWORD'))
                    && empty(env('PAYPAL_LIVE_API_SECRET'))
                ) {
                    Session::flash('error', trans('lang.paypal_empty_credentials'));
                    return Redirect::back();
                }
	    }
            $settings = SiteManagement::getMetaValue('payment_settings');
            $currency = !empty($settings['currency']) ? $settings['currency'] : 'USD';
            if (Auth::user()) {
                //$recurring = ($request->get('mode') === 'recurring') ? true : false;
                $recurring = false;
                $success = true;
                $cart = $this->getCheckoutData($recurring, $success);
                $payment_detail = array();
                try {
                    $response = $this->provider->setCurrency($currency)->setExpressCheckout($cart, $recurring);
                    if ($response['ACK'] == 'Failure') {
                        Session::flash('error', $response['L_LONGMESSAGE0']);
                        return Redirect::back();
                    }
                    return redirect($response['paypal_link']);
                } catch (\Exception $e) {
                    $invoice = $this->createInvoice($cart, 'Invalid', $payment_detail);
                    session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Express Checkout Success.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        if (Auth::user()) {
            
            $recurring = false;
            $token = $request->get('token');
	    $PayerID = $request->get('PayerID');
            $success = true;
            $cart = $this->getCheckoutData($recurring, $success);
            
            $response = $this->provider->getExpressCheckoutDetails($token);
            if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                if ($recurring === true) {
                    $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
                    if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                        $status = 'Processed';
                    } else {
                        $status = 'Invalid';
                    }
                } else {
                    
                    $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                    $status = !empty($payment_status['PAYMENTINFO_0_PAYMENTSTATUS']) ? $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'] : 'Processed';
                }
                $payment_detail = array();
                $payment_detail['payer_name'] = $response['FIRSTNAME'] . " " . $response['LASTNAME'];
                $payment_detail['payer_email'] = $response['EMAIL'];
                $payment_detail['seller_email'] = !empty($response['PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID']) ? $response['PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID'] : '';
                $payment_detail['currency_code'] = $response['CURRENCYCODE'];
                $payment_detail['payer_status'] = $response['PAYERSTATUS'];
                $payment_detail['transaction_id'] = !empty($payment_status['PAYMENTINFO_0_TRANSACTIONID']) ? $payment_status['PAYMENTINFO_0_TRANSACTIONID'] : '';
                $payment_detail['sales_tax'] = $response['TAXAMT'];
                $payment_detail['invoice_id'] = $response['INVNUM'];
                $payment_detail['shipping_amount'] = $response['SHIPPINGAMT'];
                $payment_detail['handling_amount'] = $response['HANDLINGAMT'];
                $payment_detail['insurance_amount'] = $response['INSURANCEAMT'];
                $payment_detail['paypal_fee'] = !empty($payment_status['PAYMENTINFO_0_FEEAMT']) ? $payment_status['PAYMENTINFO_0_FEEAMT'] : '';
                $payment_detail['payment_date'] = $payment_status['TIMESTAMP'];
                $payment_detail['product_qty'] = $cart['items'][0]['qty'];
                $invoice = $this->createInvoice($cart, $status, $payment_detail);
                if ($invoice->paid) {
                    session()->put(['code' => 'success', 'message' => "Thank you for your subscription"]);
                } else {
                    session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
		}
       
		$zoomvideolink = session()->get('zoomlink');
		$gotomeetingvideolink = session()->get('gotomeetinglink');
		$doctorid = session()->get('doctorid');
		$patientid = session()->get('patientid');
		$paycomments = session()->get('paycomments');
		$doctorgotemail = session()->get('doctorgotemail');
		$booknowoptioncheck = session()->get('booknowoptioncheck');
		$selectconferenceitems = session()->get('selectconferenceitems');
		$videoconflinkitemval = "";
		$appointment_id = session()->get('product_id');
		$appointment_timevalues = Appointment::find($appointment_id);

		if($selectconferenceitems == "zoom")
			$videoconflinkitemval = $zoomvideolink;
		else
			$videoconflinkitemval = $gotomeetingvideolink;
		//print_r("--".$booknowoptioncheck."--");

	//	if($videoconflinkitemval != "") {
		if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
		if($booknowoptioncheck == "true"){
                    	$email_params = array();
                    	$doctor_appt_req_template = DB::table('email_types')->select('id')
                        ->where('email_type', 'doctor_email_appointment_request_received_visitnow')->get()->first();
                    	if (!empty($doctor_appt_req_template->id)) {
                        $appointment_id = session()->get('product_id');
			$selectappointment = Appointment::find($appointment_id);
			$doctor = User::findOrFail($doctorid);

                        $template_data = EmailTemplate::getEmailTemplateByID($doctor_appt_req_template->id);
                        $email_params['doctor_name'] = Helper::getUserName($doctorid);
                        $email_params['hospital_name']  = Helper::getUserName($patientid);
                        //$email_params['appointment_date']  = Carbon::parse($payment_status['TIMESTAMP'])->format('d M, Y');                        
			$email_params['video_link']  = $videoconflinkitemval;
			$email_params['video_link_title']  = trans('lang.goto_link');
			$email_params['description'] = $paycomments;
                        Mail::to($doctorgotemail)
                            ->send(
                                new DoctorEmailMailable(
                                    'doctor_email_appointment_request_received_visitnow',
                                    $template_data,
                                    $email_params
                                )
                            );
			}
			$patientsms_name = Helper::getUserName($patientid);
	            $doctorsms_message = "Hello A Patient has just requested an immediate appointment and is currently in your virtual waiting room. Appointment details below. Patient Name: ".$patientsms_name." Meeting Link: ".$videoconflinkitemval."  Message: ".$paycomments."  Thank you  From Telehealth Plus  http://telehealthplus.com.au";

		} else {
			$email_params = array();
                        $doctor_appt_req_template = DB::table('email_types')->select('id')
                        ->where('email_type', 'doctor_email_appointment_request_received_scheduled')->get()->first();
                        if (!empty($doctor_appt_req_template->id)) {
                        $appointment_id = session()->get('product_id');
                        $selectappointment = Appointment::find($appointment_id);
                        $doctor = User::findOrFail($doctorid);

                        $template_data = EmailTemplate::getEmailTemplateByID($doctor_appt_req_template->id);
                        $email_params['doctor_name'] = Helper::getUserName($doctorid);
                        $email_params['hospital_name']  = Helper::getUserName($patientid);
                        $email_params['appointment_date']  = Carbon::parse($appointment_timevalues->appointment_date)->format('d M, Y') . ' ' . $appointment_timevalues->appointment_time;
                        $email_params['description']  = $paycomments;
                        $email_params['video_link']  = $videoconflinkitemval;
                        $email_params['video_link_title']  = trans('lang.goto_link');
                        Mail::to($doctorgotemail)
                            ->send(
                                new DoctorEmailMailable(
                                    'doctor_email_appointment_request_received_scheduled',
                                    $template_data,
                                    $email_params
                                )
                            );
			}
			$patientsms_name = Helper::getUserName($patientid);
			$patient_meetingtime = Carbon::parse($appointment_timevalues->appointment_date)->format('d M, Y') . ' ' . $appointment_timevalues->appointment_time;
	                $doctorsms_message = "Hello You have received a new booking with the details below. Patient Name: ".$patientsms_name." Meeting Link: ".$videoconflinkitemval." Appointment Time: ".$patient_meetingtime." Message: ".$paycomments." Thank you  From Telehealth Plus http://telehealthplus.com.au";

		}
		}

// 		$sid    = env( 'TWILIO_SID' );
//             	$token  = env( 'TWILIO_TOKEN' );
// 		$client = new Client( $sid, $token );
// 		//$message = "Hello This is video conference link".$videoconflinkitemval;

//         if($booked_doctor_phonenumber) {
//     		$client->messages->create(
//                     $booked_doctor_phonenumber,
//                     [
//                         'from' => env( 'TWILIO_FROM' ),
//                         'body' => $doctorsms_message,
//                     ]
//     	    );
//         }

        $booking_doctoritem = DB::table('users')->select('*')->where('id', $doctorid)->get()->first();
        $booked_doctor_phonenumber = $booking_doctoritem->phonenumber;
        if($booked_doctor_phonenumber) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://rest.clicksend.com/v3/sms/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    "messages" => [
                        [
                            "body" =>  $doctorsms_message,
                            "to" => $booked_doctor_phonenumber,
                            "from" => "+61400279944"
                        ]
                    ]
                ]),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic aGVsbG9Acmlja3NoZW1wb2lsLmNvbTowRTAzQ0M1My05RjJFLUQyQ0ItREZDQi1FNEY5RDUwNTY0RTM='
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            Log::info('SMS Response', [$response]);
        }

		if($booknowoptioncheck == "true"){
				if($selectconferenceitems == "zoom")
					return redirect($zoomvideolink);
				else
					return redirect($gotomeetingvideolink);
			} else {
				return redirect('paypal/redirect-url');
			}
		//} else {
		//	return redirect('paypal/ec-checkout');
	//	}
            } else {
                abort(404);
	    }
        } else {
            abort(404);
	}
    }

    /**
     * Get Express Checkout Success.
     *
     * @param mixed $recurring $recurring
     * @param mixed $success   $recurring
     *
     * @return \Illuminate\Http\Response
     */
    protected function getCheckoutData($recurring, $success)
    {
        if (Auth::user()) {
            if (session()->has('product_id')) {
                $id = session()->get('product_id');
                $name = session()->get('name');
                $price = session()->get('price');
                $user_id = Auth::user()->id;
                $random_number = Helper::generateRandomCode(4);
                $unique_code = strtoupper($random_number);
                $data = [];
                $order_id = Order::all()->count() + 1;
                if ($recurring === true) {
                    // $data['items'] = [
                    //     [
                    //         'name' => 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $order_id,
                    //         'price' => 0,
                    //         'qty' => 1,
                    //     ],
                    // ];
                    // $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring');
                    // $data['subscription_desc'] = 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $order_id;
                } else {
                    $data['items'] = [
                        [
                            'product_id' => $id,
                            'name' => $name,
                            'price' => $price,
                            'subscriber_id' => $user_id,
                            'qty' => 1,
                        ],

                    ];
                    $data['return_url'] = url('/paypal/ec-checkout-success');
                }
                $data['invoice_id'] = config('paypal.invoice_prefix') . '_' . $unique_code . '_' . $order_id;
                $data['invoice_description'] = "Order #$order_id Invoice";
                $data['cancel_url'] = url('/');
                $total = 0;
                $data['total'] = $price;
                return $data;
            } else {
                abort(404);
            }
        } else {
            Session::flash('message', trans('lang.product_id_not_found'));
            return Redirect::to('/');
        }
    }

    /**
     * Create invoice
     *
     * @param mixed $cart           cart
     * @param mixed $status         status
     * @param mixed $payment_detail payment_detail
     *
     * @return \Illuminate\Http\Response
     */
    protected function createInvoice($cart, $status, $payment_detail)
    {
        if (session()->has('product_id') && session()->has('type')) {
            $type = session()->get('type');
            $id = session()->get('product_id');
	    $order_id = session()->get('order_id');	
	    $selectconferenceitems = session()->get('selectconferenceitems');
            $new_order = Order::find($order_id);
            $new_order->status = 'completed';
            $new_order->save();
            if (!empty($payment_detail)) {
                foreach ($payment_detail as $key => $value) {
                    $meta = new OrderMeta();
                    $meta->meta_key = $key;
                    $meta->meta_value = $value;
                    $new_order->orderMeta()->save($meta);
                }
            }
            if ($type == 'appointment') {
                $appointment = Appointment::find($id);
                $appointment->status = 'accepted';
                $appointment->save();
                // appointment mail
                $hospital = User::findOrFail($appointment->hospital_id);
		$doctor = User::findOrFail($appointment->user_id);
		//sleep(2);
		$booknowoptioncheck = session()->get('booknowoptioncheck');		          

		if($booknowoptioncheck == "true"){
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_approved_visitnow')->get()->first();
                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['user_name'] = Helper::getUserName(Auth::user()->id);                        		
			if($selectconferenceitems == "zoom") {
				$email_params['hospital_link'] = $doctor->zoomlink;
				$videoconflinkitemvalinvoice = $doctor->zoomlink;
			} else {
				$email_params['hospital_link'] = $doctor->gotomeetinglink;
				$videoconflinkitemvalinvoice = $doctor->gotomeetinglink;
			}
			$email_params['hospital_name'] = trans('lang.goto_link');
                        $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                        $email_params['doctor_link'] = url('profile/' . $doctor->slug);
                       // $email_params['appointment_date_time'] = Carbon::parse($appointment->appointment_date)->format('d M, Y') . ' ' . $appointment->appointment_time;
                        $email_params['description'] = $appointment->comments;
                        Mail::to(Auth::user()->email)
                            ->send(
                                new GeneralEmailMailable(
                                    'user_email_appointment_request_approved_visitnow',
                                    $template_data,
                                    $email_params
                                )
                            );
		    }
		    $doctorname = Helper::getUserName($doctor->id);
                    $doctormeetingmessage = $appointment->comments;
		    $patientsms_message = "Hello Your immediate booking request has been approved. Please click on the meeting link below to commence your appointment. Meeting Link: ".$videoconflinkitemvalinvoice." Doctor: ".$doctorname." Message: ".$doctormeetingmessage." Thank you  From Telehealth Plus http://telehealthplus.com.au";

		}		
		} else {
			if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                  	    $email_params = array();
	                    $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_approved_scheduled')->get()->first();
	                    if (!empty($template->id)) {
        	                $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                	        $email_params['user_name'] = Helper::getUserName(Auth::user()->id);
	                        if($selectconferenceitems == "zoom") {
        	                        $email_params['hospital_link'] = $doctor->zoomlink;
                	                $videoconflinkitemvalinvoice = $doctor->zoomlink;
	                        } else {
        	                        $email_params['hospital_link'] = $doctor->gotomeetinglink;
                	                $videoconflinkitemvalinvoice = $doctor->gotomeetinglink;
	                        }
        	                $email_params['hospital_name'] = trans('lang.goto_link');
                	        $email_params['doctor_name'] = Helper::getUserName($doctor->id);
	                        $email_params['doctor_link'] = url('profile/' . $doctor->slug);
	                        $email_params['appointment_date_time'] = Carbon::parse($appointment->appointment_date)->format('d M, Y') . ' ' . $appointment->appointment_time;
	                        $email_params['description'] = $appointment->comments;
	                        Mail::to(Auth::user()->email)
        	                    ->send(
                	                new GeneralEmailMailable(
                        	            'user_email_appointment_request_approved_scheduled',
	                                    $template_data,
	                                    $email_params
        	                        )
                	            );
			    }
			    $doctormeetingtime = Carbon::parse($appointment->appointment_date)->format('d M, Y') . ' ' . $appointment->appointment_time;
                        $doctornameitem = Helper::getUserName($doctor->id);
                        $doctorcomponetmessage = $appointment->comments;
// 		$patientsms_message = "Hello Your Booking has been confirmed. Please use the Meeting link below to access your appointment. You will also receive a reminder on the day of your appointment 10 minutes prior to the scheduled start time below. Meeting Link: ".$videoconflinkitemvalinvoice." Doctor: ".$doctornameitem." Appointment Time: ".$doctormeetingtime." Message: ".$doctorcomponetmessage."  Thank you  From Telehealth Plus http://telehealthplus.com.au";
		$patientsms_message = "Hello Your Booking has been confirmed. Meeting Link: ".$videoconflinkitemvalinvoice." Doctor: ".$doctornameitem." Appointment Time: ".$doctormeetingtime." Message: ".$doctorcomponetmessage."  Thank you  From Telehealth Plus http://telehealthplus.com.au";
		
                	}
		}

		sleep(1);
                 
// 		$sid    = env( 'TWILIO_SID' );
//                 $token  = env( 'TWILIO_TOKEN' );
//                 $client = new Client( $sid, $token );
//                 $message = "Hello This is video conference link".$videoconflinkitemvalinvoice;
//                 if($booked_patient_phonenumber) {
//                     $client->messages->create(
//                         $booked_patient_phonenumber,
//                         [
//                             'from' => env( 'TWILIO_FROM' ),
//                             'body' => $patientsms_message,
//                         ]
//     	            );
//                 }

                $booked_patient_phonenumber = Auth::user()->phonenumber;
                if($booked_patient_phonenumber) {

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://rest.clicksend.com/v3/sms/send',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode([
                            "messages" => [
                                [
                                    "body" =>  $patientsms_message,
                                    "to" => $booked_patient_phonenumber,
                                    "from" => "+61400279944"
                                ]
                            ]
                        ]),
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Basic aGVsbG9Acmlja3NoZW1wb2lsLmNvbTowRTAzQ0M1My05RjJFLUQyQ0ItREZDQi1FNEY5RDUwNTY0RTM='
                        ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);

                    Log::info('SMS Response', [$response]);
                }
            } else if ($type == 'package') {
                $package = Package::find($id)->toArray();
                // Package Mail
                $package = Package::find($id);
                $option = !empty($package->options) ? unserialize($package->options) : '';
                $expiry = !empty($new_order) ? $new_order->created_at->addDays($option['duration']) : '';
                $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
                $user = User::find(Auth::user()->id);
                $user->package_expiry = $expiry_date;
                $user->save();
                // send mail
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'doctor_email_package_subscribed')->get()->first();

                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['doctor_name'] = Helper::getUserName(Auth::user()->id);
                        $email_params['pkg_title'] = $package->title;
                        $email_params['amount'] = $package->cost;
                        $email_params['date'] = Carbon::parse($new_order->created_at)->format('M d, Y');
                        $email_params['expiry_date'] = !empty($expiry) ? Carbon::parse($expiry)->format('M d, Y') : '';
                        Mail::to(Auth::user()->email)
                            ->send(
                                new DoctorEmailMailable(
                                    'doctor_email_package_subscribed',
                                    $template_data,
                                    $email_params
                                )
                            );
                    }
                }
            }
        }
        //session()->forget('product_id');
        session()->forget('price');
	session()->forget('name');
	//session()->forget('selectconferenceitems');
	//session()->forget('booknowoptioncheck');
	//session()->forget('gotomeetinglink');
	//session()->forget('zoomlink');
	//session()->forget('paycomments');
        return $new_order;
    }
}
