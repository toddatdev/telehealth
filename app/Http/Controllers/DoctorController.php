<?php

/**
 * Class DoctorController
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
use App\Helper;
use App\Notifications\PatientHasEnteredTheirWaitingRoom;
use App\UserMeta;
use App\User;
use Illuminate\Http\Request;
use App\EmailTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use View;
use App\Team;
use App\Mail\HospitalEmailMailable;
use Illuminate\Support\Facades\Mail;
use function Opis\Closure\unserialize;
use App\Speciality;
use DB;
use App\Package;
use App\Payout;
use App\SiteManagement;
use Carbon\Carbon;
use App\Mail\GeneralEmailMailable;

/**
 * Class DoctorController
 *
 */
class DoctorController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $doctor
     */
    protected $doctor;

    /**
     * Create a new controller instance.
     *
     * @param instance $doctor instance
     *
     * @return void
     */
    public function __construct(UserMeta $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Show Doctor Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function doctorDashboard()
    {
        if (Auth::user()) {
            if (file_exists(resource_path('views/extend/back-end/doctors/dashboard.blade.php'))) {
                return view(
                    'extend.back-end.doctor.dashboard'
                );
            } else {
                return view(
                    'back-end.doctors.dashboard'
                );
            }
        }
    }


    /**
     * Store awards downloads settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAwardDownloadSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $awards_downloads = $this->doctor->storeAwardsDownloads($request, Auth::user()->id);
            if ($awards_downloads == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.awards_downloads_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Get doctor awards.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctorAwards()
    {
        $json = array();
        if (Auth::user()) {
            $awards = User::find(Auth::user()->id)->Profile->awards;
            $awards_list = !empty($awards) ? Helper::getUnserializeData($awards) : array();
            if (!empty($awards)) {
                $json['type'] = 'success';
                $json['awards'] = $awards_list;
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Store experiences in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeExperiences(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $experiences = $this->doctor->saveExperiences($request, Auth::user()->id);
            if ($experiences['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.experience_updated');
                return $json;
            } elseif ($experiences == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store educations in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeEducations(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $experiences = $this->doctor->saveEducations($request, Auth::user()->id);
            if ($experiences['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.education_updated');
                return $json;
            } elseif ($experiences == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store appointment location form
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function addLocation(Request $request)
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $doctor_specialities = !empty($user->profile->services) ? Helper::getUnserializeData($user->profile->services) : array();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $days = Helper::getAppointmentDays();
            $doctor_info = Team::where('doctor_id', $user->id)->paginate(4);
            if (file_exists(resource_path('views/extend/back-end/doctors/appointment_locations/create/index.blade.php'))) {
                return View::make(
                    'extend.back-end.doctors.appointment_locations.create.index',
                    compact('intervals', 'durations', 'doctor_specialities', 'spaces', 'days', 'doctor_info')
                );
            } else {
                return View::make(
                    'back-end.doctors.appointment_locations.create.index',
                    compact('intervals', 'durations', 'doctor_specialities', 'spaces', 'days', 'doctor_info')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Stote appointment location data in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAppointmentLocation(Request $request)
    {
        if (Auth::user()) {
            $server = Helper::doctieIsDemoSiteAjax();
            if (!empty($server)) {
                $response['type'] = 'error';
                $response['message'] = $server->getData()->message;
                return $response;
            }
            if (!empty($request)) {
                $hospital_location = Team::where('user_id', $request['hospital_id'])->where('doctor_id', Auth::user()->id)->count();
                if ($hospital_location > 0) {
                    $response['type'] = 'error';
                    $response['message'] = trans('lang.hospital_already_selected');
                    return $response;
                }
                $location = new Team();
                $services = $location->saveAppointmentLocation($request);
                if ($services == "success") {
                    //send email to hospital
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $hospital = User::findOrFail($request['hospital_id']);
                        $slots = $request['slots'];
                        $days = $slots['appointment_days'];
                        $email_params = array();
                        $email_params['starttime'] = $slots['start_time'];
                        $email_params['endtime'] = $slots['end_time'];
                        $email_params['appt_intervals'] = $slots['intervals'];
                        $email_params['appt_duration'] = $slots['duration'];
                        $email_params['appt_days'] = implode(',', $days);
                        $template_data = Helper::getEmailContent();
                        Mail::to($hospital->email)
                            ->send(
                                new HospitalEmailMailable(
                                    'hospital_appointment_locations_added',
                                    $template_data,
                                    $email_params
                                )
                            );
                        Mail::to(config('mail.username'))
                            ->send(
                                new HospitalEmailMailable(
                                    'hospital_appointment_locations_added',
                                    $template_data,
                                    $email_params
                                )
                            );
                        $req_template = DB::table('email_types')->select('id')
                            ->where('email_type', 'hospital_email_doctor_request_to_hospital')->get()->first();
                        if (!empty($req_template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($req_template->id);
                            $email_params['doctor_name'] = Helper::getUserName(Auth::user()->id);
                            $email_params['hospital_name'] = Helper::getUserName($hospital->id);
                            $email_params['doctor_link'] = url('profile/' . Auth::user()->slug);
                            Mail::to($hospital->email)
                                ->send(
                                    new HospitalEmailMailable(
                                        'hospital_email_doctor_request_to_hospital',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                    }
                    $json['type'] = 'success';
                    $json['progressing'] = trans('lang.saving');
                    $json['message'] = trans('lang.apt_location_saved');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorise');
            return $json;
        }
    }

    /**
     * Edit doctor appoinement location.
     *
     * @param string $id id
     *
     * @access public
     *
     * @return View
     */
    public function editLocation($id)
    {
        if (Auth::user() && !empty($id)) {
            $user = User::find(Auth::user()->id);
            $location = Team::find($id);
            $slots = unserialize($location->slots);
            $immediate_bookings = $location->immediate_bookings;
            $days = Helper::getAppointmentDays();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
            $doctor_specialities = !empty($user->profile->services) ? Helper::getUnserializeData($user->profile->services) : array();
            $service_price = !empty($slots['services']['price']) ? $slots['services']['price'] : '';
            if (file_exists(resource_path('views/extend/back-end/doctors/appointment_locations/edit/index.blade.php'))) {
                return View::make(
                    'extend.back-end.doctors.appointment_locations.edit.index',
                    compact(
                        'id',
                        'location',
                        'slots',
                        'days',
                        'intervals',
                        'durations',
                        'spaces',
                        'immediate_bookings',
                        'doctor_specialities',
                        'service_price',
                        'appointment_days'
                    )
                );
            } else {
                return View::make(
                    'back-end.doctors.appointment_locations.edit.index',
                    compact(
                        'id',
                        'location',
                        'slots',
                        'days',
                        'intervals',
                        'durations',
                        'spaces',
                        'immediate_bookings',
                        'doctor_specialities',
                        'service_price',
                        'appointment_days'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update doctor appointment slots
     *
     * @param string $id id
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSlots($id, Request $request)
    {
        if (Auth::user()) {
            $location = new Team();
            $update_slots = $location->updateAppointmentSlots($id, $request);
            if ($update_slots == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_updated');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Update appointment location services
     *
     * @param string $id id
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateLocationServices($id, Request $request)
    {
        if (Auth::user()) {
            $location = new Team();
            $update_slots = $location->updateAppointmentLocationServices($id, $request);
            if ($update_slots == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.save_service');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Store appointment selected day slots
     *
     * @param string $id id
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSelectedDaySlots($id, Request $request)
    {
        if (Auth::user()) {
            $location = new Team();
            $update_slots = $location->saveSelectedDaySlots($id, $request);
            if ($update_slots == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_updated');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Delete appointment location selected time slot
     *
     * @param string $slot slot
     * @param string $day day
     * @param int $id id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSlots($slot, $day, $id)
    {
        if (Auth::user()) {
            $team = new Team();
            $team_location = $team->deleteAppointmentSlots($slot, $day, $id);
            if ($team_location == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_deleted');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Delete appointment location selected time slot
     *
     * @param int $id id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAppointset($id)
    {
        if (Auth::user()) {
            $team = Team::findOrFail($id);
            $team->delete();

            $json['type'] = 'success';
            $json['progressing'] = trans('lang.saving');
            $json['message'] = trans('lang.slot_deleted');
            return $json;
        }
    }

    /**
     * Delete appointment location time slot
     *
     * @param string $day day
     * @param int $id id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllSlots($day, $id)
    {
        if (Auth::user()) {
            $team = new Team();
            $team_location = $team->deleteAllAppointmentSlots($day, $id);
            if ($team_location == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_deleted');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Get doctor's appointment slots
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return array
     */
    public function getAppointmentSlots(Request $request)
    {
        $json = array();
        $list = array();
        date_default_timezone_set("Australia/Sydney");
        $nowtimevalue = date("g:i A");
        $nowdateitemvalue = date("Y-n-j");
        $currentitemvalue = strtotime($nowtimevalue);
        if (Auth::user()) {
            $hospital = Team::select('slots')->where('doctor_id', $request['doctor_id'])->where('user_id', $request['hospital_id'])->first();
            if (!empty($hospital)) {
                $requested_date = Carbon::create($request['date']);
                $date = new Carbon();
                $today = date("Y-m-d h:i:s", strtotime("-1 days"));
                $todayslotcheck = $date->now();
                $slots = Helper::getUnserializeData($hospital->slots);
                $requested_day_slots = !empty($slots[$request['day']]) ? $slots[$request['day']]['slots'] : array();
                $starttimevalue = "";
                $endtimevalue = "";

                if (!empty($requested_day_slots)) {
                    $counter = 0;
                    foreach ($requested_day_slots as $key => $slot) {
                        $time = explode('-', $key);
                        
                        if ($counter == 0) {
                            $starttimevalue = $time[0];
                        }
                        $endtimevalue = $time[0];
                        $list[$counter]['start_time'] = $time[0];

                        $bocked_appointments = DB::table('appointments')->where('appointment_date', $request['date'])->where('user_id', $request['doctor_id'])->where('appointment_time', $time[0])->count();
                        $databaseitemtimevalue = strtotime($time[0]);
                        $list[$counter]['currentitemvalue'] = $currentitemvalue;
                        $list[$counter]['databaseitemvalue'] = $databaseitemtimevalue;

                        if ($databaseitemtimevalue < $currentitemvalue) {
                            /* if ($requested_date->lessThan($today)) {
                                 $list[$counter]['space'] = 0;
                 } else if ($bocked_appointments > 0) { */
                            if ($requested_date->lessThan($today)) {
                                $list[$counter]['space'] = 0;
                            } else {
//                                if (($request['doctor_id'] == 90) || ($request['doctor_id'] == 91)) {
//                                    if ($requested_date->lessThan($todayslotcheck)) {
//                                        if (($time[0] < strtotime("05:00 am") || $time[0] < strtotime("12:50 pm")) && $time[0] > strtotime("11:59 am"))
//                                            $list[$counter]['space'] = 1;
//                                        else
//                                            $list[$counter]['space'] = 0;
//                                    } else {
//                                        $list[$counter]['space'] = 1;
//                                    }
//                                } else {
                                    if ($requested_date->lessThan($todayslotcheck)) {
                                        $list[$counter]['space'] = 0;
                                    } else {
                                        $list[$counter]['space'] = $slot['space'] - $bocked_appointments;
                                    }
//                                }
                            }
                        } else if ($bocked_appointments > 0) {
                            if ($requested_date->lessThan($today)) {
                                $list[$counter]['space'] = 0;
                            } else {
                                //$list[$counter]['space'] = 10;
                                $list[$counter]['space'] = $slot['space'] - $bocked_appointments;
                            }
                        } else {
                            if ($requested_date->lessThan($today)) {
                                $list[$counter]['space'] = 0;
                            } else {
                                $list[$counter]['space'] = (int)($slot['space']);
                            }
                        }
                        $counter++;
                    }
                }
                $list = Helper::getSlotResortUpdate($list);
                if (!empty($list)) {
                    $starttimeitemsarray = $list[0]['start_time'];
                    $endtimeitemsarray = $list[count($list) - 1]['start_time'];
                    $json['startendtime'] = 'from ' . $starttimeitemsarray . ' to ' . $endtimeitemsarray;
                } else {
                    $json['startendtime'] = '';
                }
                $json['type'] = 'success';
                $json['slots'] = $list;
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Get doctor hospital services
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getHospitalServices(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            //$team_info = Team::where('user_id', $request['hospital'])->first();
            $team_info = Team::where('user_id', $request['hospital'])->where('doctor_id', $request['doctor'])->first();
            if (!empty($team_info)) {
                $slots = Helper::getUnserializeData($team_info['slots']);
                $list = array();
                $list['fee'] = !empty($slots['consultation_fee']) ? $slots['consultation_fee'] : 0;
                if (!empty($slots['services'])) {
                    foreach ($slots['services']['speciality'] as $key => $specialities) {
                        $speciality = Speciality::find($specialities['speciality_id']);
                        if (!empty($speciality)) {
                            $list['specialities'][$key]['speciality_id'] = $speciality->id;
                            $list['specialities'][$key]['speciality_title'] = $speciality->title;
                            $list['specialities'][$key]['speciality_image'] = asset(Helper::getImage('uploads/specialities', $speciality->image, '', 'default-speciality.png'));
                            //return $specialities;
                            if (!empty($speciality)) {
                                foreach ($specialities['speciality_services'] as $service_key => $services) {
                                    $service = Helper::getServiceByID($services['service']);
                                    if (!empty($service)) {
                                        $list['specialities'][$key]['services'][$service_key]['service_id'] = $service->id;
                                        $list['specialities'][$key]['services'][$service_key]['service_title'] = $service->title;
                                        $list['specialities'][$key]['services'][$service_key]['service_price'] = $services['price'];
                                    }
                                }
                            } else {
                                $json['type'] = 'error1';
                                $json['message'] = trans('lang.service_not_found');
                                return $json;
                            }
                        }
                    }
                    $json['services'] = !empty($list) ? $list : '';
                    $json['type'] = 'success';
                    return $json;
                } else {
                    $json['type'] = 'error2';
                    $json['message'] = trans('lang.service_not_found');
                    return $json;
                }
            } else {
                $json['type'] = 'error3';
                $json['message'] = trans('lang.something');
                return $json;
            }
        } else {
            $json['type'] = 'error4';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Show Doctor appoinement listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAppointments()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $appointments = $user->appointments;
            if (file_exists(resource_path('views/extend/back-end/doctors/appointments/index.blade.php'))) {
                return view(
                    'extend.back-end.doctor.appointments.index',
                    compact('appointments')
                );
            } else {
                return view(
                    'back-end.doctors.appointments.index',
                    compact('appointments')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get doctor appoinetments for specific date
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */

    public function getAppointments(Request $request)
    {
        $json = array();
        $list = array();
        $booking_settings = SiteManagement::getMetaValue('booking_settings');
        $online_payment = !empty($booking_settings['enable_booking']) ? $booking_settings['enable_booking'] : '';


        if (Auth::user()) {
            date_default_timezone_set("Australia/Sydney");
            $nowdate = date("Y-n-j");
            $minaftertime = date('h:i a', time() - 300);
            $user = User::find(Auth::user()->id);

            $appointments = DB::table('appointments')->where('user_id', Auth::user()->id)
                ->orderBy(\DB::raw("str_to_date(appointment_time, '%h:%i %p')"), 'asc')
                ->orderBy('appointment_date', 'asc');

            //$appointments = $user->appointments;
            if ($online_payment == 'true') {
                $appointments = $appointments->where('status', 'accepted');
            }


            if (!empty($request['date']) && $request['date'] == $nowdate) {
                $appointments = $appointments
                    ->where(function($query) use ($request, $minaftertime) {
                        $query->whereDate('appointment_date', '=', $request['date'])
                            ->whereRaw(\DB::raw("str_to_date(appointment_time, '%h:%i %p') >  str_to_date('$minaftertime', '%h:%i %p')"));
                    })->orWhereDate('appointment_date', '>', $request['date']);
            } else {
                $appointments = $appointments
                    ->whereDate('appointment_date', '>=', $request['date']);

            }
            //$appointments = $appointments->sortByDesc('id');


            //$appointments = $appointments->where('state', 'now');
            $appointments = $appointments
                ->orderBy('id', 'desc')
                ->get();


            $counter = 0;
            if ($appointments->count() > 0) {
                $list['count'] = $appointments->count();
                foreach ($appointments as $key => $appointment) {
                    $patient = !empty($appointment->patient_id) ? User::find($appointment->patient_id) : '';
                    $services = !empty($appointment->services) ? Helper::getUnserializeData($appointment->services) : '';
                    $list['appointment'][$counter]['user_id'] = !empty($patient) ? $appointment->patient_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['id'] = $appointment->id;
                    $list['appointment'][$counter][$appointment->patient_id]['zoomlink'] = $user->zoomlink;
                    //  $list['appointment'][$counter][$appointment->patient_id]['zoomlink'] = $user->zoomlink."&dn=".$patient->slug."&track_id=".$appointment->id;
                    $list['appointment'][$counter][$appointment->patient_id]['gotomeetinglink'] = $user->gotomeetinglink;
                    $list['appointment'][$counter][$appointment->patient_id]['video_conference'] = $appointment->video_conference;
                    $list['appointment'][$counter][$appointment->patient_id]['status'] = $appointment->status;
                    $list['appointment'][$counter][$appointment->patient_id]['user_name'] = !empty($patient) && !empty($appointment->patient_id)
                        ? Helper::getUserName($appointment->patient_id) : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_name'] = !empty($appointment->patient_name)
                        ? $appointment->patient_name : '';
                    $list['appointment'][$counter][$appointment->patient_id]['relation'] = !empty($appointment->relation)
                        ? $appointment->relation : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_image'] = !empty($patient)
                        ? asset(Helper::getImage('uploads/users/' . $appointment->patient_id, $patient->profile->avatar, 'small-', 'user.jpg'))
                        : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_verify'] = !empty($patient) ? $patient->user_verified : 0;
                    $list['appointment'][$counter][$appointment->patient_id]['user_location'] = !empty($patient->location) && $patient->location->count() > 0 ? $patient->location->title : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_type'] = !empty($patient) ? $patient->getRoleNames()->first() : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital'] = !empty($appointment->hospital_id) ? Helper::getUserName($appointment->hospital_id) : '';
                    $date = $appointment->appointment_date;
                    $patient_date = new Carbon($appointment->appointment_date);
                    $patient_appointment_date = explode("-", $date);
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_date'] = !empty($patient_appointment_date) ? $patient_appointment_date[2] : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_month'] = !empty($patient_date) ? $patient_date->format('F') : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_date'] = !empty($date) ? $date : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_time'] = !empty($appointment->appointment_time) ? $appointment->appointment_time : '';
                    $list['appointment'][$counter][$appointment->patient_id]['comments'] = !empty($appointment->comments) ? $appointment->comments : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital_id'] = !empty($appointment->hospital_id) ? $appointment->hospital_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_id'] = !empty($appointment->user_id) ? $appointment->user_id : '';
                    if (!empty($services)) {
                        foreach ($services as $service_key => $service) {
                            if (!empty($service['service'])) {
                                $speciality = Helper::getSpecialityByID($service['speciality']);
                                $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['speciality'] = !empty($speciality) ? $speciality->title : '';
                                foreach ($service['service'] as $speciality_service_key => $speciality_service) {
                                    $service = Helper::getServiceByID($speciality_service);
                                    $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['services'][$speciality_service_key]['title'] = !empty($service) ? $service->title : '';
                                }
                            }
                        }
                    }
                    $counter++;
                }
                $json['appointments'] = $list;
                $json['type'] = 'success';
                return $json;
            } else {
                $list['count'] = $appointments->count();
                $list['appointment'] = array();
                $json['appointments'] = $list;
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Get appoinetments for specific date
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    /*  public function getAppointmentsRecent()
      {
          $json =  array();
          $list = array();
          $booking_settings = SiteManagement::getMetaValue('booking_settings');
          $online_payment = !empty($booking_settings['enable_booking']) ? $booking_settings['enable_booking'] : '';
          if (Auth::user()) {
              $user = User::find(Auth::user()->id);
              $counter = 0;
              $orders = DB::table('appointments')->where('patient_id', Auth::user()->id);
              if ($online_payment == 'true') {
                  $orders = $orders->where('status', 'accepted');
              }
              $today_date = date("Y-n-j");
              $orders = $orders->where('appointment_date', $today_date);
              $orders = $orders->get();
              $list['count'] = $orders->count();
              if (!empty($orders)) {
                  foreach ($orders as $key => $appointment) {
                      if (!empty($appointment)) {
                          $doctor = !empty($appointment->user_id) ? User::find($appointment->user_id) : '';
                          $services = !empty($appointment->services) ? Helper::getUnserializeData($appointment->services) : '';
                          $list['appointment'][$counter]['user_id'] = !empty($appointment->patient_id) ? $appointment->patient_id : '';
                          $list['appointment'][$counter][$appointment->patient_id]['id'] = $appointment->id;
                          $list['appointment'][$counter][$appointment->patient_id]['status'] = $appointment->status;
                          $list['appointment'][$counter][$appointment->patient_id]['user_name'] = !empty($doctor) && !empty($appointment->user_id)
                              ? Helper::getUserName($appointment->user_id) : '';
                          $list['appointment'][$counter][$appointment->patient_id]['patient_name'] = !empty($appointment->patient_name)
                              ? $appointment->patient_name : '';
                          $list['appointment'][$counter][$appointment->patient_id]['relation'] = !empty($appointment->relation)
                              ? $appointment->relation : '';
                          $list['appointment'][$counter][$appointment->patient_id]['user_image'] = !empty($doctor)
                              ? asset(Helper::getImage('uploads/users/' . $doctor->id, $doctor->profile->avatar, 'small-', 'user.jpg'))
                              : '';
                          $list['appointment'][$counter][$appointment->patient_id]['user_verify'] = !empty($doctor) ? $doctor->user_verified : 0;
                          $list['appointment'][$counter][$appointment->patient_id]['user_location'] = !empty($doctor->location) && $doctor->location->count() > 0 ? $doctor->location->title : '';
                          $list['appointment'][$counter][$appointment->patient_id]['user_type'] = !empty($doctor) ? $doctor->getRoleNames()->first() : '';
                          $list['appointment'][$counter][$appointment->patient_id]['hospital'] = !empty($appointment->hospital_id) ? Helper::getUserName($appointment->hospital_id) : '';
                          $date = $appointment->appointment_date;
                          $patient_date = new Carbon($appointment->appointment_date);
                          $patient_appointment_date = explode("-", $date);
                          $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_date'] = !empty($patient_appointment_date) ? $patient_appointment_date[2] : '';
                          $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_month'] = !empty($patient_date) ? $patient_date->format('F') : '';
                          $list['appointment'][$counter][$appointment->patient_id]['appointment_date'] = !empty($appointment->appointment_date) ? $appointment->appointment_date : '';
                          $list['appointment'][$counter][$appointment->patient_id]['appointment_time'] = !empty($appointment->appointment_time) ? $appointment->appointment_time : '';
                          $list['appointment'][$counter][$appointment->patient_id]['comments'] = !empty($appointment->comments) ? $appointment->comments : '';
                          if (!empty($services)) {
                              foreach ($services as $service_key => $service) {
                                  if (!empty($service['service'])) {
                                      $speciality = Helper::getSpecialityByID($service['speciality']);
                                      $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['speciality'] = !empty($speciality) ? $speciality->title : '';
                                      foreach ($service['service'] as $speciality_service_key => $speciality_service) {
                                          $service = Helper::getServiceByID($speciality_service);
                                          if (!empty($service)) {
                                              $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['services'][$speciality_service_key]['title'] = !empty($service) ? $service->title : '';
                                          }
                                      }
                                  }
                              }
                          }
                      }
                      $counter++;
                  }
                  $json['appointments'] = $list;
                  $json['type'] = 'success';
                  return $json;
              } else {
                  $json['type'] = 'error';
                  $json['message'] = trans('lang.something');
                  return $json;
              }
          } else {
              $json['type'] = 'error';
              $json['message'] = trans('lang.something');
              return $json;
          }
    } */

    public function getAppointmentsRecent(Request $request)
    {
        $json = array();
        $list = array();
        $booking_settings = SiteManagement::getMetaValue('booking_settings');
        $online_payment = !empty($booking_settings['enable_booking']) ? $booking_settings['enable_booking'] : '';

        if (Auth::user()) {
            $user = User::find(Auth::user()->id);

            $appointments = Appointment::where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->orderBy(\DB::raw("str_to_date(appointment_time, '%h:%i %p')"), 'desc');


            //$appointments = $user->appointments;
            if ($online_payment == 'true') {
                $appointments = $appointments->where('status', 'accepted');
            }


            //$today_date = date("Y-n-j");
            date_default_timezone_set("Australia/Sydney");
            $nowdate = date("Y-n-j");

            $minaftertime = date('h:i a', time());

            //$appointments = $appointments->where('state', 'later');
            $appointments = $appointments
                ->whereDate('appointment_date', '<=', $nowdate)
                ->whereRaw(\DB::raw("str_to_date(appointment_time, '%h:%i %p') <=  str_to_date('$minaftertime', '%h:%i %p')"))
                ->get();

            $counter = 0;
            if ($appointments->count() > 0) {
                $list['count'] = $appointments->count();
                foreach ($appointments as $key => $appointment) {
                    $patient = !empty($appointment->patient_id) ? User::find($appointment->patient_id) : '';
                    $services = !empty($appointment->services) ? Helper::getUnserializeData($appointment->services) : '';
                    $list['appointment'][$counter]['user_id'] = !empty($patient) ? $appointment->patient_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['id'] = $appointment->id;
                    $list['appointment'][$counter][$appointment->patient_id]['status'] = $appointment->status;
                    $list['appointment'][$counter][$appointment->patient_id]['zoomlink'] = $user->zoomlink;
                    //  $list['appointment'][$counter][$appointment->patient_id]['zoomlink'] = $user->zoomlink."&dn=".$patient->slug."&track_id=".$appointment->id;
                    $list['appointment'][$counter][$appointment->patient_id]['gotomeetinglink'] = $user->gotomeetinglink;
                    $list['appointment'][$counter][$appointment->patient_id]['video_conference'] = $appointment->video_conference;
                    $list['appointment'][$counter][$appointment->patient_id]['user_name'] = !empty($patient) && !empty($appointment->patient_id)
                        ? Helper::getUserName($appointment->patient_id) : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_name'] = !empty($appointment->patient_name)
                        ? $appointment->patient_name : '';
                    $list['appointment'][$counter][$appointment->patient_id]['relation'] = !empty($appointment->relation)
                        ? $appointment->relation : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_image'] = !empty($patient)
                        ? asset(Helper::getImage('uploads/users/' . $appointment->patient_id, $patient->profile->avatar, 'small-', 'user.jpg'))
                        : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_verify'] = !empty($patient) ? $patient->user_verified : 0;
                    $list['appointment'][$counter][$appointment->patient_id]['user_location'] = !empty($patient->location) && $patient->location->count() > 0 ? $patient->location->title : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_type'] = !empty($patient) ? $patient->getRoleNames()->first() : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital'] = !empty($appointment->hospital_id) ? Helper::getUserName($appointment->hospital_id) : '';
                    $date = $appointment->appointment_date;
                    $patient_date = new Carbon($appointment->appointment_date);
                    $patient_appointment_date = explode("-", $date);
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_date'] = !empty($patient_appointment_date) ? $patient_appointment_date[2] : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_month'] = !empty($patient_date) ? $patient_date->format('F') : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_date'] = !empty($date) ? $date : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_time'] = !empty($appointment->appointment_time) ? $appointment->appointment_time : '';
                    $list['appointment'][$counter][$appointment->patient_id]['comments'] = !empty($appointment->comments) ? $appointment->comments : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital_id'] = !empty($appointment->hospital_id) ? $appointment->hospital_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_id'] = !empty($appointment->user_id) ? $appointment->user_id : '';
                    if (!empty($services)) {
                        foreach ($services as $service_key => $service) {
                            if (!empty($service['service'])) {
                                $speciality = Helper::getSpecialityByID($service['speciality']);
                                $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['speciality'] = !empty($speciality) ? $speciality->title : '';
                                foreach ($service['service'] as $speciality_service_key => $speciality_service) {
                                    $service = Helper::getServiceByID($speciality_service);
                                    $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['services'][$speciality_service_key]['title'] = !empty($service) ? $service->title : '';
                                }
                            }
                        }
                    }
                    $counter++;
                }
                $json['appointments'] = $list;
                $json['type'] = 'success';
                return $json;
            } else {
                $list['count'] = $appointments->count();
                $list['appointment'] = array();
                $json['appointments'] = $list;
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Checkout Page.
     *
     * @param \Illuminate\Http\Request $id ID
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout($id)
    {
        if (!empty($id) && Auth::user()) {
            $package = Package::find($id);
            $package_options = Helper::getPackageOptions(Auth::user()->getRoleNames());
            $payment_settings = SiteManagement::getMetaValue('payment_settings');
            $payment_gateway = !empty($payment_settings) && !empty($payment_settings['payment_method']) ? $payment_settings['payment_method'] : array();
            $symbol = !empty($payment_settings) && !empty($payment_settings['currency']) ? Helper::currencyList($payment_settings['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/doctors/package/checkout.blade.php'))) {
                return view::make('extend.back-end.doctors.package.checkout', compact('package', 'package_options', 'payment_gateway', 'symbol'));
            } else {
                return view::make('back-end.doctors.package.checkout', compact('package', 'package_options', 'payment_gateway', 'symbol'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Print Thankyou.
     *
     * @return \Illuminate\Http\Response
     */
    public function thankyou()
    {
        if (Auth::user()) {
            echo trans('lang.thankyou');
        } else {
            abort(404);
        }
    }

    /**
     * Get freelancer payouts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayouts()
    {
        if (Auth::user()) {
            $payouts = Payout::where('user_id', Auth::user()->id)->paginate(10);
            if (file_exists(resource_path('views/extend/back-end/doctors/payouts.blade.php'))) {
                return view(
                    'extend.back-end.doctors.payouts.payouts',
                    compact('payouts')
                );
            } else {
                return view(
                    'back-end.doctors.payouts.payouts',
                    compact('payouts')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payoutSettings()
    {
        if (Auth::user()) {
            $payrols = Helper::getPayoutsList();
            $user = User::find(Auth::user()->id);
            $payout_settings = $user->profile->count() > 0 ? Helper::getUnserializeData($user->profile->payout_settings) : '';
            if (file_exists(resource_path('views/extend/back-end/doctors/payouts/payout_settings.blade.php'))) {
                return view(
                    'extend.back-end.doctors.payouts.payout_settings',
                    compact('payrols', 'payout_settings')
                );
            } else {
                return view(
                    'back-end.doctors.payouts.payout_settings',
                    compact('payrols', 'payout_settings')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Accept patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptAppointment(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            if (!empty($request['appointment']) && !empty($request['patient_id'])) {
                $appointment = $request['appointment'];
                $patient = User::find($request['patient_id']);
                $hospital = User::findOrFail($appointment['hospital_id']);
                $doctor = User::findOrFail($appointment['user_id']);
                DB::table('appointments')->where('id', $appointment['id'])->update(['status' => 'accepted']);
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_approved')->get()->first();
                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['user_name'] = Helper::getUserName($patient->id);
                        $email_params['hospital_name'] = Helper::getUserName($hospital->id);
                        //$email_params['hospital_link'] = url('profile/' . $hospital->slug);
                        $email_params['hospital_link'] = "#";
                        $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                        $email_params['doctor_link'] = url('profile/' . $doctor->slug);
                        $email_params['appointment_date_time'] = Carbon::parse($appointment['appointment_date'])->format('d M, Y') . ' ' . $appointment['appointment_time'];
                        $email_params['description'] = $appointment['comments'];
                        Mail::to($patient->email)
                            ->send(
                                new GeneralEmailMailable(
                                    'user_email_appointment_request_approved',
                                    $template_data,
                                    $email_params
                                )
                            );
                    }
                }
                $json['type'] = 'success';
                $json['message'] = trans('lang.appointment_updated');
                $json['status'] = trans('lang.accepted');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Reject patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function declineAppointment(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            if (!empty($request['appointment']) && !empty($request['patient_id'])) {
                $appointment = $request['appointment'];
                $patient = User::find($request['patient_id']);
                $doctor = User::findOrFail($appointment['user_id']);
                DB::table('appointments')->where('id', $appointment['id'])->update(['status' => 'rejected']);
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_rejected')->get()->first();
                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['user_name'] = Helper::getUserName($patient->id);
                        $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                        Mail::to($patient->email)
                            ->send(
                                new GeneralEmailMailable(
                                    'user_email_appointment_request_rejected',
                                    $template_data,
                                    $email_params
                                )
                            );
                    }
                }
                $json['type'] = 'success';
                $json['message'] = trans('lang.appointment_updated');
                $json['status'] = trans('lang.rejected');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    public function notifyPatientWaiting(Request $request)
    {
        $appointment = Appointment::find($request->appointment['id']);
        if ($appointment) {
            $user = User::find($appointment->user_id);
            if ($user) {
                $user->notify(new PatientHasEnteredTheirWaitingRoom($appointment->toArray(), $request->meeting_link));
            }
        }

    }
}
