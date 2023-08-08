<?php

/**
 * Class StripeController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use Auth;
use DB;
use App\Package;
use Illuminate\Support\Facades\Mail;
use App\EmailTemplate;
use App\Helper;
use Carbon\Carbon;
use App\SiteManagement;
use App\Appointment;
use App\Order;
use App\OrderMeta;
use App\Mail\DoctorEmailMailable;
use App\Mail\GeneralEmailMailable;




/**
 * Class StripeController
 *
 */
class StripeController extends Controller
{
    /**
     * Show the application paywith stripe.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithStripe()
    {
        if (file_exists(resource_path('views/extend/back-end/paymentstripe.blade.php'))) {
            return view('extend.back-end.paymentstripe');
        } elseif (file_exists(resource_path('views/back-end/paymentstripe.blade.php'))) {
            return view('back-end.paymentstripe');
        } else {
            abort(404);
        }
    }

    /**
     * Genarate new order 
     *
     * @return \Illuminate\Http\Response
     */
    public function generateOrder()
    {
        $id = Session::has('product_id') ? session()->get('product_id') : '';
        $type = Session::has('type') ? session()->get('type') : '';
        $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
        if (!empty($id)) {
            // generate order 
            $order = new Order();
            $order->status = 'pending';
            $order->payment_gateway = 'stripe';
            if ($type == 'appointment') {
                $appointment = Appointment::find($id);
                $order->appointment_date = $appointment->appointment_date;
            }
            $order->user()->associate(Auth::user()->id);
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();
            $latest_order = Order::find($order_id);
            session()->put(['order_id' => $order_id]);
            // order meta type
            $order_type = new OrderMeta();
            $order_type->meta_key = 'type';
            $order_type->meta_value = $type;
            $latest_order->orderMeta()->save($order_type);
            // store product order meta
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
                    $package_meta->meta_value =  serialize($package_data);
                    $latest_order->orderMeta()->save($package_meta);
                }
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.freelancer_successfully_hired');
            $json['url'] = $role_type . '/dashboard';
            return $json;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithStripe(Request $request)
    {
        $id = Session::has('product_id') ? session()->get('product_id') : '';
        $name = Session::has('name') ? session()->get('name') : '';
        $price = Session::has('price') ? session()->get('price') : 0;
        $type = Session::has('type') ? session()->get('type') : '';
        $payment_gateway = session()->get('gateway');
        $user_id = Auth::user() ? Auth::user()->id : '';
        // payment process
        $settings = SiteManagement::getMetaValue('payment_settings');
        $currency = !empty($settings['currency']) ? $settings['currency'] : 'USD';
        $current_year = Carbon::now()->format('Y');
        $validator = Validator::make(
            $request->all(),
            [
                'card_no' => 'required',
                'ccExpiryMonth' => 'required',
                'ccExpiryYear' => 'required',
                'cvvNumber' => 'required',
            ]
        );
        if ($request['ccExpiryYear'] < $current_year) {
            // Session::flash('error', trans('lang.valid_year'));
            // return Redirect::back()->withInput();
            $json['type'] = 'error';
            $json['message'] = trans('lang.valid_year');
            return $json;
        }
        $input = $request->all();
        if ($validator->passes()) {
            $input = array_except($input, array('_token'));
            if (!empty(env('STRIPE_SECRET'))) {
                \Artisan::call('optimize:clear');
                $stripe = Stripe::make(env('STRIPE_SECRET'));
            } else {
                // Session::flash('error', trans('lang.empty_stripe_key'));
                // return Redirect::back();
                $json['type'] = 'error';
                $json['message'] = trans('lang.empty_stripe_key');
                return $json;
            }
            try {
                $token = $stripe->tokens()->create(
                    [
                        'card' => [
                            'number'    => $request->get('card_no'),
                            'exp_month' => $request->get('ccExpiryMonth'),
                            'exp_year'  => $request->get('ccExpiryYear'),
                            'cvc'       => $request->get('cvvNumber'),
                        ],
                    ]
                );
                if (!isset($token['id'])) {
                    // Session::flash('error', 'The Stripe Token was not generated correctly');
                    // return Redirect::back();
                    $json['type'] = 'error';
                    $json['message'] = 'The Stripe Token was not generated correctly';
                    return $json;
                }
                $payment_detail = $stripe->charges()->create(
                    [
                        'card' => $token['id'],
                        'currency' => $currency,
                        'amount'   => $price,
                        'description' => trans('lang.add_in_wallet'),
                    ]
                );

                $customer = $stripe->customers()->create(
                    [
                        'email' => Auth::user()->email,
                    ]
                );

                if ($payment_detail['status'] == 'succeeded') {
                    $order_id = session()->get('order_id');
                    $new_order = Order::find($order_id);
                    $new_order->status = 'completed';
                    $new_order->save();
                    $fee = !empty($payment_detail['application_fee_amount']) ? $payment_detail['application_fee_amount'] : 0;
                    $invoice = array();
                    $invoice['payer_name'] = filter_var($customer['name'], FILTER_SANITIZE_STRING);
                    $invoice['payer_email'] = filter_var($customer['email'], FILTER_SANITIZE_EMAIL);
                    $invoice['currency_code'] = filter_var($payment_detail['currency'], FILTER_SANITIZE_STRING);
                    $invoice['transaction_id'] = filter_var($payment_detail['id'], FILTER_SANITIZE_STRING);
                    $invoice['invoice_id'] = filter_var($payment_detail['source']['id'], FILTER_SANITIZE_STRING);
                    $invoice['customer_id'] = filter_var($customer['id'], FILTER_SANITIZE_STRING);
                    $invoice['shipping_amount'] = 0;
                    $invoice['handling_amount'] = 0;
                    $invoice['insurance_amount'] = 0;
                    $invoice['sales_tax'] = 0;
                    $invoice['payment_mode'] = $payment_detail['payment_method'];
                    $invoice['fee'] = $fee;
                    $invoice['paid'] = $payment_detail['paid'];
                    foreach ($invoice as $key => $value) {
                        $meta = new OrderMeta();
                        $meta->meta_key = $key;
                        $meta->meta_value = $value;
                        $new_order->orderMeta()->save($meta);
                    }
                    if ($type == 'appointment') {
                        $appointment = Appointment::find($id);
                        $appointment->status = 'accepted';
                        $appointment->save();
                        $hospital = User::findOrFail($appointment->hospital_id);
                        $doctor = User::findOrFail($appointment->user_id);
                        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                            $email_params = array();
                            $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_approved')->get()->first();
                            if (!empty($template->id)) {
                                $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                                $email_params['user_name'] = Helper::getUserName(Auth::user()->id);
                                $email_params['hospital_name'] = Helper::getUserName($hospital->id);
                                $email_params['hospital_link'] = url('profile/'.$hospital->slug);
                                $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                                $email_params['doctor_link'] = url('profile/'.$doctor->slug);
                                $email_params['appointment_date_time'] = Carbon::parse($appointment->appointment_date)->format('d M, Y').' '.$appointment->appointment_time;
                                $email_params['description'] = $appointment->comments;
                                Mail::to(Auth::user()->email)
                                    ->send(
                                        new GeneralEmailMailable(
                                            'user_email_appointment_request_approved',
                                            $template_data,
                                            $email_params
                                        )
                                    );
                            }
                        }
                    } else if ($type == 'package') {
                        if (!empty($id)) {
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
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.money_not_add');
                    return $json;
                }
            } catch (Exception $e) {
                $json['type'] = 'error';
                $json['message'] = $e->getMessage();
                return $json;
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                $json['type'] = 'error';
                $json['message'] = $e->getMessage();
                return $json;
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                $json['type'] = 'error';
                $json['message'] = $e->getMessage();
                return $json;
            }
        }
        session()->forget('product_id');
        session()->forget('name');
        session()->forget('price');
        $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
        if ($role_type == "regular") {
            $json['type'] = 'success';
            $json['message'] = trans('lang.appointment_booking_confirmed');
            $json['url'] = url($role_type . '/dashboard');
            session()->forget('type');
            return $json;
        } else if ($role_type == "doctor") {
            $json['type'] = 'success';
            $json['message'] = trans('lang.thanks_subscription');
            $json['url'] = url($role_type . '/dashboard');
            session()->forget('type');
            return $json;
        }
    }
}
