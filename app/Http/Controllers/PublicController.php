<?php

/**
 * Class PublicController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Http\Requests\CourseValidationRequest;
use App\UserMeta;
use Illuminate\Support\Facades\Log;
use View;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use Auth;
use DB;
use App\Helper;
use Session;
use App\EmailTemplate;
use App\Mail\GeneralEmailMailable;
use App\Mail\AdminEmailMailable;
use App\Mail\DoctorEmailMailable;
use App\Team;
use App\SiteManagement;
use App\Appointment;
use Hash;
use Carbon\Carbon;
use App\ImprovementOption;
use App\Feedback;
use Twilio\Rest\Client;

/**
 * Class PublicController
 *
 */
class PublicController extends Controller
{
    /**
     * User Login Function
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $json = array();
        if (Session::has('user_id')) {
            $id = Session::get('user_id');
            $user = User::find($id);
            Auth::login($user);
            $json['type'] = 'success';
            $json['role'] = Helper::getRoleTypeByUserID($id);
            session()->forget('user_id');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Step1 registration validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStep1Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
            ]
        );
    }

    /**
     * Step2 registration validation
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStep2Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
                'termsconditions' => 'required',
            ]
        );
    }

    /**
     * Set slug before saving in DB
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyUserCode(Request $request)
    {
        $json = array();
        if (Session::has('user_id')) {
            $id = Session::get('user_id');
            $email = Session::get('email');
            $password = Session::get('password');
            $user = User::find($id);
            if (!empty($request['code'])) {
                if ($request['code'] === $user->verification_code) {
                    $user->user_verified = 1;
                    $user->verification_code = null;
                    $user->save();
                    $json['type'] = 'success';
                    //send mail
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template = DB::table('email_types')->select('id')->where('email_type', 'new_user')->get()->first();
                        if (!empty($template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                            $email_params['site'] = env('APP_NAME');
                            $email_params['name'] = Helper::getUserName($id);
                            $email_params['email'] = $email;
                            $email_params['password'] = $password;
                            Mail::to($email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'new_user',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                        $admin_template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_registration')->get()->first();
                        if (!empty($admin_template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($admin_template->id);
                            $email_params['name'] = Helper::getUserName($id);
                            $email_params['email'] = $email;
                            $email_params['link'] = url('profile/' . $user->slug);
                            Mail::to(config('mail.username'))
                                ->send(
                                    new AdminEmailMailable(
                                        'admin_email_registration',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                    }
                    session()->forget('password');
                    session()->forget('email');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.invalid_verified_code');
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.verify_code');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.session_expire');
            return $json;
        }
    }

    /**
     * Show profile detail
     *
     * @param string $slug user-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile($slug)
    {
        if (!empty($slug)) {
            $user_id = User::select('id')->where('slug', $slug)->pluck('id')->first();
            $user = User::findOrFail($user_id);
            $avg_rating = Feedback::where('user_id', $user->id)->pluck('avg_rating')->first();
            $stars = $avg_rating != 0 ? $avg_rating / 5 * 100 : 0;
            $saved_doctors = !empty(auth()->user()->profile->saved_doctors) ? unserialize(auth()->user()->profile->saved_doctors) : array();
            $saved_hospitals = !empty(auth()->user()->profile->saved_hospitals) ? unserialize(auth()->user()->profile->saved_hospitals) : array();
            $saved_articles = !empty(auth()->user()->profile->saved_articles) ? unserialize(auth()->user()->profile->saved_articles) : array();
            $specialities = !empty($user->profile->services) ? Helper::getUnserializeData($user->profile->services) : array();
            $experiences = !empty($user->profile->experiences) ? Helper::getUnserializeData($user->profile->experiences) : array();
            $educations = !empty($user->profile->educations) ? Helper::getUnserializeData($user->profile->educations) : array();
            $awards = !empty($user->profile->awards) ? Helper::getUnserializeData($user->profile->awards) : array();
            $memberships = !empty($user->profile->memberships) ? Helper::getUnserializeData($user->profile->memberships) : array();
            $registration_details = !empty($user->profile->verify_medical) ? Helper::getUnserializeData($user->profile->verify_medical) : array();
            $downloads = !empty($user->profile->downloads) ? Helper::getUnserializeData($user->profile->downloads) : array();
            $gender_title = !empty($user->profile->gender_title) ? $user->profile->gender_title : '';
            $gender = !empty($user->profile->gender) ? $user->profile->gender : '';
            $articles = !empty($user->articles) ? $user->articles : array();
            $teams = Team::where('doctor_id', $user->id)->where('status', 'approved')->paginate(4);
            $doctor_hospitals = Team::getDoctorHospitals($user_id);
            $doctor_immediatestatenow = Team::getDoctorImmediateNow($user_id);
            $feedback_questions = ImprovementOption::get();
            $searchbooknowshow = "";
            $settings = !empty(SiteManagement::getMetaValue('general_settings')) ? SiteManagement::getMetaValue('general_settings') : array();
            $display_chat = !empty($settings['display_chat']) ? $settings['display_chat'] : false;
            $role_type = Helper::getRoleTypeByUserID($user_id);
            $sidebar = SiteManagement::getMetaValue('sidebar_settings');
            $display_sidebar = !empty($sidebar) && !empty($sidebar['display_sidebar']) ? $sidebar['display_sidebar'] : '';
            $display_query_section = !empty($sidebar) && !empty($sidebar['display_query_section']) ? $sidebar['display_query_section'] : '';
            $ask_query_img = !empty($sidebar) && !empty($sidebar['hidden_ask_query_img']) ? $sidebar['hidden_ask_query_img'] : '';
            $query_title = !empty($sidebar) && !empty($sidebar['query_title']) ? $sidebar['query_title'] : '';
            $query_subtitle = !empty($sidebar) && !empty($sidebar['query_subtitle']) ? $sidebar['query_subtitle'] : '';
            $query_btn_title = !empty($sidebar) && !empty($sidebar['query_btn_title']) ? $sidebar['query_btn_title'] : '';
            $query_btn_link = !empty($sidebar) && !empty($sidebar['query_btn_link']) ? $sidebar['query_btn_link'] : '#';
            $query_desc = !empty($sidebar) && !empty($sidebar['query_desc']) ? $sidebar['query_desc'] : '';
            $display_get_app_sec = !empty($sidebar) && !empty($sidebar['display_get_app_sec']) ? $sidebar['display_get_app_sec'] : '';
            $download_app_img = !empty($sidebar) && !empty($sidebar['hidden_download_app_img']) ? $sidebar['hidden_download_app_img'] : '';
            $download_app_title = !empty($sidebar) && !empty($sidebar['download_app_title']) ? $sidebar['download_app_title'] : '';
            $download_app_subtitle = !empty($sidebar) && !empty($sidebar['download_app_subtitle']) ? $sidebar['download_app_subtitle'] : '';
            $download_app_desc = !empty($sidebar) && !empty($sidebar['download_app_desc']) ? $sidebar['download_app_desc'] : '';
            $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '';
            $display_get_ad_sec = !empty($sidebar) && !empty($sidebar['display_get_ad_sec']) ? $sidebar['display_get_ad_sec'] : '';
            $ad_content = !empty($sidebar) && !empty($sidebar['ad_content']) ? $sidebar['ad_content'] : '';
            $currency = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : 'symbol';
            $appointment_settings = SiteManagement::getMetaValue('booking_settings');
            $online_appointment = !empty($appointment_settings) && !empty($appointment_settings['enable_booking']) ? $appointment_settings['enable_booking'] : '';
            $appointment_btn_text = !empty($online_appointment) && $online_appointment == "true" ? trans('lang.continue') : trans('lang.offline_scheduled_btn');
            $appointment_confirm = !empty($online_appointment) && $online_appointment == "true" ? trans('lang.appointment_conf') : '';
            $appointment_detail_text = !empty($online_appointment) && $online_appointment == "true"
                ? trans('lang.scheduled_appoint')
                : trans('lang.offline_scheduled_appoint_text1') . " " . Helper::getUserName($user->id) . " " . trans('lang.offline_scheduled_appoint_text2');
            $gallery_images = !empty($user->profile->gallery) ? Helper::getUnserializeData($user->profile->gallery) : array();
            $gallery_videos = !empty($user->profile->gallery_videos) ? Helper::getUnserializeData($user->profile->gallery_videos) : array();
            if ($role_type === 'doctor') {
                $current_package = Helper::getCurrentPackage($user);
                $featured = !empty($current_package) && !empty($current_package['featured']) ? $current_package['featured'] : 'false';
                return View(
                    'front-end.doctors.newshow',
                    compact(
                        'featured',
                        'gallery_images',
                        'gallery_videos',
                        'appointment_confirm',
                        'appointment_detail_text',
                        'appointment_btn_text',
                        'online_appointment',
                        'saved_articles',
                        'user',
                        'specialities',
                        'experiences',
                        'educations',
                        'awards',
                        'memberships',
                        'registration_details',
                        'gender_title',
                        'gender',
                        'downloads',
                        'articles',
                        'teams',
                        'searchbooknowshow',
                        'saved_doctors',
                        'saved_hospitals',
                        'doctor_hospitals',
                        'doctor_immediatestatenow',
                        'feedback_questions',
                        'display_chat',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content',
                        'stars',
                        'symbol',
                        'role_type'
                    )
                );
            } elseif ($role_type === 'hospital') {
                return View(
                    'front-end.hospitals.show',
                    compact(
                        'gallery_images',
                        'gallery_videos',
                        'appointment_confirm',
                        'appointment_detail_text',
                        'appointment_btn_text',
                        'online_appointment',
                        'saved_articles',
                        'user',
                        'specialities',
                        'experiences',
                        'educations',
                        'awards',
                        'memberships',
                        'registration_details',
                        'gender_title',
                        'gender',
                        'downloads',
                        'articles',
                        'teams',
                        'searchbooknowshow',
                        'saved_doctors',
                        'saved_hospitals',
                        'doctor_hospitals',
                        'doctor_immediatestatenow',
                        'feedback_questions',
                        'display_chat',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content',
                        'stars',
                        'symbol',
                        'role_type'
                    )
                );
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show profile detail
     *
     * @param string $slug user-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfileParameter($slug, $sessionparameter)
    {
        if (!empty($slug)) {
            $user_id = User::select('id')->where('slug', $slug)->pluck('id')->first();
            session()->put(['sessionparametercheck' => $sessionparameter]);
            $user = User::findOrFail($user_id);
            $avg_rating = Feedback::where('user_id', $user->id)->pluck('avg_rating')->first();
            $stars = $avg_rating != 0 ? $avg_rating / 5 * 100 : 0;
            $saved_doctors = !empty(auth()->user()->profile->saved_doctors) ? unserialize(auth()->user()->profile->saved_doctors) : array();
            $saved_hospitals = !empty(auth()->user()->profile->saved_hospitals) ? unserialize(auth()->user()->profile->saved_hospitals) : array();
            $saved_articles = !empty(auth()->user()->profile->saved_articles) ? unserialize(auth()->user()->profile->saved_articles) : array();
            $specialities = !empty($user->profile->services) ? Helper::getUnserializeData($user->profile->services) : array();
            $experiences = !empty($user->profile->experiences) ? Helper::getUnserializeData($user->profile->experiences) : array();
            $educations = !empty($user->profile->educations) ? Helper::getUnserializeData($user->profile->educations) : array();
            $awards = !empty($user->profile->awards) ? Helper::getUnserializeData($user->profile->awards) : array();
            $memberships = !empty($user->profile->memberships) ? Helper::getUnserializeData($user->profile->memberships) : array();
            $registration_details = !empty($user->profile->verify_medical) ? Helper::getUnserializeData($user->profile->verify_medical) : array();
            $downloads = !empty($user->profile->downloads) ? Helper::getUnserializeData($user->profile->downloads) : array();
            $gender_title = !empty($user->profile->gender_title) ? $user->profile->gender_title : '';
            $gender = !empty($user->profile->gender) ? $user->profile->gender : '';
            $articles = !empty($user->articles) ? $user->articles : array();
            $teams = Team::where('doctor_id', $user->id)->where('status', 'approved')->paginate(4);
            $doctor_hospitals = Team::getDoctorHospitals($user_id);
            $feedback_questions = ImprovementOption::get();
            $searchbooknowshow = "";
            $settings = !empty(SiteManagement::getMetaValue('general_settings')) ? SiteManagement::getMetaValue('general_settings') : array();
            $display_chat = !empty($settings['display_chat']) ? $settings['display_chat'] : false;
            $role_type = Helper::getRoleTypeByUserID($user_id);
            $sidebar = SiteManagement::getMetaValue('sidebar_settings');
            $display_sidebar = !empty($sidebar) && !empty($sidebar['display_sidebar']) ? $sidebar['display_sidebar'] : '';
            $display_query_section = !empty($sidebar) && !empty($sidebar['display_query_section']) ? $sidebar['display_query_section'] : '';
            $ask_query_img = !empty($sidebar) && !empty($sidebar['hidden_ask_query_img']) ? $sidebar['hidden_ask_query_img'] : '';
            $query_title = !empty($sidebar) && !empty($sidebar['query_title']) ? $sidebar['query_title'] : '';
            $query_subtitle = !empty($sidebar) && !empty($sidebar['query_subtitle']) ? $sidebar['query_subtitle'] : '';
            $query_btn_title = !empty($sidebar) && !empty($sidebar['query_btn_title']) ? $sidebar['query_btn_title'] : '';
            $query_btn_link = !empty($sidebar) && !empty($sidebar['query_btn_link']) ? $sidebar['query_btn_link'] : '#';
            $query_desc = !empty($sidebar) && !empty($sidebar['query_desc']) ? $sidebar['query_desc'] : '';
            $display_get_app_sec = !empty($sidebar) && !empty($sidebar['display_get_app_sec']) ? $sidebar['display_get_app_sec'] : '';
            $download_app_img = !empty($sidebar) && !empty($sidebar['hidden_download_app_img']) ? $sidebar['hidden_download_app_img'] : '';
            $download_app_title = !empty($sidebar) && !empty($sidebar['download_app_title']) ? $sidebar['download_app_title'] : '';
            $download_app_subtitle = !empty($sidebar) && !empty($sidebar['download_app_subtitle']) ? $sidebar['download_app_subtitle'] : '';
            $download_app_desc = !empty($sidebar) && !empty($sidebar['download_app_desc']) ? $sidebar['download_app_desc'] : '';
            $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '';
            $display_get_ad_sec = !empty($sidebar) && !empty($sidebar['display_get_ad_sec']) ? $sidebar['display_get_ad_sec'] : '';
            $ad_content = !empty($sidebar) && !empty($sidebar['ad_content']) ? $sidebar['ad_content'] : '';
            $currency = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : 'symbol';
            $appointment_settings = SiteManagement::getMetaValue('booking_settings');
            $online_appointment = !empty($appointment_settings) && !empty($appointment_settings['enable_booking']) ? $appointment_settings['enable_booking'] : '';
            $appointment_btn_text = !empty($online_appointment) && $online_appointment == "true" ? trans('lang.continue') : trans('lang.offline_scheduled_btn');
            $appointment_confirm = !empty($online_appointment) && $online_appointment == "true" ? trans('lang.appointment_conf') : '';
            $appointment_detail_text = !empty($online_appointment) && $online_appointment == "true"
                ? trans('lang.scheduled_appoint')
                : trans('lang.offline_scheduled_appoint_text1') . " " . Helper::getUserName($user->id) . " " . trans('lang.offline_scheduled_appoint_text2');
            $gallery_images = !empty($user->profile->gallery) ? Helper::getUnserializeData($user->profile->gallery) : array();
            $gallery_videos = !empty($user->profile->gallery_videos) ? Helper::getUnserializeData($user->profile->gallery_videos) : array();
            if ($role_type === 'doctor') {
                $current_package = Helper::getCurrentPackage($user);
                $featured = !empty($current_package) && !empty($current_package['featured']) ? $current_package['featured'] : 'false';
                return View(
                    'front-end.doctors.newshowdialog',
                    compact(
                        'featured',
                        'gallery_images',
                        'gallery_videos',
                        'appointment_confirm',
                        'appointment_detail_text',
                        'appointment_btn_text',
                        'online_appointment',
                        'saved_articles',
                        'user',
                        'specialities',
                        'experiences',
                        'educations',
                        'awards',
                        'memberships',
                        'registration_details',
                        'gender_title',
                        'gender',
                        'downloads',
                        'articles',
                        'teams',
                        'searchbooknowshow',
                        'saved_doctors',
                        'saved_hospitals',
                        'doctor_hospitals',
                        'feedback_questions',
                        'display_chat',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content',
                        'stars',
                        'symbol',
                        'role_type'
                    )
                );
            } elseif ($role_type === 'hospital') {
                return View(
                    'front-end.hospitals.show',
                    compact(
                        'gallery_images',
                        'gallery_videos',
                        'appointment_confirm',
                        'appointment_detail_text',
                        'appointment_btn_text',
                        'online_appointment',
                        'saved_articles',
                        'user',
                        'specialities',
                        'experiences',
                        'educations',
                        'awards',
                        'memberships',
                        'registration_details',
                        'gender_title',
                        'gender',
                        'downloads',
                        'articles',
                        'teams',
                        'searchbooknowshow',
                        'saved_doctors',
                        'saved_hospitals',
                        'doctor_hospitals',
                        'feedback_questions',
                        'display_chat',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content',
                        'stars',
                        'symbol',
                        'role_type'
                    )
                );
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Educations
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctorEducations(Request $request)
    {
        $json = array();
        $user = User::findOrFail($request['doctor_id']);
        if (!empty($user)) {
            $educations = !empty($user->profile->educations) ? Helper::getUnserializeData($user->profile->educations) : array();
            if (!empty($educations)) {
                $json['type'] = 'success';
                $json['item'] = $educations;
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
     * Store data in session
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAppointmentInSession(Request $request)
    {
        $json = array();
        $json['patient'] = !empty($request['patient']) ? $request['patient'] : '';
        $json['patient_name'] = !empty($request['patient_name']) ? $request['patient_name'] : '';
        $json['relation'] = !empty($request['relation']) ? $request['relation'] : '';
        $json['hospital'] = !empty($request['hospital']) ? $request['hospital'] : '';
        $json['speciality'] = !empty($request['speciality']) ? $request['speciality'] : '';
        $json['total_charges'] = !empty($request['total_charges']) ? $request['total_charges'] : '';
        $json['comments'] = !empty($request['comments']) ? $request['comments'] : '';
        $json['day'] = !empty($request['appointment']['day']) ? $request['appointment']['day'] : '';
        $json['date'] = !empty($request['appointment']['date']) ? $request['appointment']['date'] : '';
        $json['time'] = !empty($request['appointment']['time']) ? $request['appointment']['time'] : '';
        Log::info('Appointment Time: ', $json);
        return $json;
    }

    /**
     * Get Experiences
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctorExperiences(Request $request)
    {
        $json = array();
        $user = User::findOrFail($request['doctor_id']);
        if (!empty($user)) {
            $experiences = !empty($user->profile->experiences) ? Helper::getUnserializeData($user->profile->experiences) : array();
            if (!empty($experiences)) {
                $json['type'] = 'success';
                $json['item'] = $experiences;
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
     * Verify Password
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyAppointmentPassword(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $user = User::find($request['user_id']);
        if (Hash::check($request->password, $user->password)) {
            /*  $random_number = Helper::generateRandomCode(4);
              $verification_code = strtoupper($random_number);
              $user->verification_code = $verification_code;
              $user->save();
              if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                  $email_params = array();
                  $template = DB::table('email_types')->select('id')
                      ->where('email_type', 'user_email_appointment_booking_verification_code')->get()->first();
                  if (!empty($template->id)) {
                      $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                      $email_params['verification_code'] = $user->verification_code;
                      $email_params['name']  = Helper::getUserName($user->id);
                      Mail::to($user->email)
                          ->send(
                              new GeneralEmailMailable(
                                  'user_email_appointment_booking_verification_code',
                                  $template_data,
                                  $email_params
                              )
                          );
                  }
          } */
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.pass_mismatched');
            return $json;
        }
    }

    /**
     * Verify Code
     *
     * @param mixed $request $request->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyAppointmentCode(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if (!empty($request['code'])) {
            if ($request['code'] === $user->verification_code) {
                $user->verification_code = null;
                $user->save();
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.verify_code_mismatched');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_code');
            return $json;
        }
    }

    /**
     * Store patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function submitAppointment(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            $appointment = new Appointment();
            $patient_appointment = $appointment->submitAppointment($request);
            if ($patient_appointment['type'] == 'success') {
                $json['appointment_id'] = $patient_appointment['last_id'];
                $json['type'] = 'success';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Store patient appointment List checker
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeAppointmentcheck(Request $request)
    {
        date_default_timezone_set("Australia/Sydney");
        $nowtimevalue = date("h:i a");
        $todaydate = date("Y-n-j");
        $currentitemvalue = strtotime($nowtimevalue);
        $before10Time = strtotime("+12 minutes", strtotime($nowtimevalue));
        $appointment10time = date('h:i a', $before10Time);

        //$appointmentlist = DB::table('appointments')->select('*')->where('state', 'later')->get()->first();
        $appointmentlist = DB::table('appointments')->select('*')->where('state', 'later')->where('appointment_date', $todaydate)->where('appointment_time', '<', $appointment10time)->where('appointment_time', '>', $nowtimevalue)->get()->first();

        if (!empty($appointmentlist)) {
            $booked_doctor_id = $appointmentlist->user_id;
            $booking_doctoritem = DB::table('users')->select('*')->where('id', $booked_doctor_id)->get()->first();
            $booked_patient_id = $appointmentlist->patient_id;
            $booking_patientitem = DB::table('users')->select('*')->where('id', $booked_patient_id)->get()->first();
            $appointmentlist_idparam = $appointmentlist->id;
            $appointmentlist_patientname = $booking_patientitem->slug;

            $selectconferencevideoitem = $appointmentlist->video_conference;
            if ($selectconferencevideoitem == "zoom")
                $videomeetinglinkurl = $booking_doctoritem->zoomlink;
            // $videomeetinglinkurl = $booking_doctoritem->zoomlink."&dn=".$appointmentlist_patientname."&track_id=".$appointmentlist_idparam;
            else
                $videomeetinglinkurl = $booking_doctoritem->gotomeetinglink;

// SMS config Start	 
            $laterappointementid = $appointmentlist->id;
            DB::table('appointments')->where('id', $laterappointementid)->update(['state' => 'now']);

            $booked_doctor_phonenumber = $booking_doctoritem->phonenumber;
            $booked_patient_phonenumber = $booking_patientitem->phonenumber;
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $client = new Client($sid, $token);
            $meetingtime_message = $appointmentlist->appointment_time;
            $message = "Hello Your meeting time is " . $meetingtime_message . " and this is video conference link: " . $videomeetinglinkurl;
            $patientcommentmessage = $appointmentlist->comments;
// SMS config End
// Patient reminder
            $email_params1 = array();
            $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_approved')->get()->first();
            if (!empty($template->id)) {
                $template_data1 = EmailTemplate::getEmailTemplateByID($template->id);
                $email_params1['user_name'] = Helper::getUserName($appointmentlist->patient_id);
                $email_params1['hospital_name'] = trans('lang.goto_link');
                $email_params1['hospital_link'] = $videomeetinglinkurl;
                $email_params1['doctor_name'] = Helper::getUserName($appointmentlist->user_id);
                $email_params1['doctor_link'] = url('profile/' . $booking_doctoritem->slug);
                $email_params1['appointment_date_time'] = Carbon::parse($appointmentlist->appointment_date)->format('d M, Y') . ' ' . $appointmentlist->appointment_time;
                $email_params1['description'] = $appointmentlist->comments;
                Mail::to($booking_patientitem->email)
                    ->send(
                        new GeneralEmailMailable(
                            'user_email_appointment_request_approved',
                            $template_data1,
                            $email_params1
                        )
                    );
            }


            $doctorname = Helper::getUserName($appointmentlist->user_id);
            $meetingtime_message_patient = $appointmentlist->appointment_time;

            $patientsms_message = "Hello Reminder Appointment time: " . $meetingtime_message_patient . " Meeting Link: " . $videomeetinglinkurl . "  Doctor: " . $doctorname . " Message: " . $patientcommentmessage . "  Thank you  From Telehealth Plus  http://telehealthplus.com.au";

            $postdata = http_build_query(
                array(
                    'phonenumber' => $booked_patient_phonenumber,
                    'message' => $patientsms_message
                )
            );
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );
            $context = stream_context_create($opts);
            $SMScall_patient = file_get_contents('https://txmarketvalue.com/Clicksend/smsrequest.php', false, $context);

            // $client->messages->create(
            //             $booked_patient_phonenumber,
            //             [
            //                 'from' => env( 'TWILIO_FROM' ),
            //                 'body' => $patientsms_message,
            //             ]
            //         );

            sleep(3);
// Doctor Reminder            
            $email_params2 = array();
            $doctor_appt_req_template = DB::table('email_types')->select('id')->where('email_type', 'doctor_email_appointment_request_approved')->get()->first();
            if (!empty($doctor_appt_req_template->id)) {
                $template_data2 = EmailTemplate::getEmailTemplateByID($doctor_appt_req_template->id);
                $email_params2['user_name'] = Helper::getUserName($appointmentlist->user_id);
                $email_params2['hospital_name'] = trans('lang.goto_link');
                $email_params2['hospital_link'] = $videomeetinglinkurl;
                $email_params2['doctor_name'] = Helper::getUserName($appointmentlist->patient_id);
                $email_params2['appointment_date_time'] = Carbon::parse($appointmentlist->appointment_date)->format('d M, Y') . ' ' . $appointmentlist->appointment_time;
                $email_params2['description'] = $appointmentlist->comments;
                Mail::to($booking_doctoritem->email)
                    ->send(
                        new DoctorEmailMailable(
                            'doctor_email_appointment_request_approved',
                            $template_data2,
                            $email_params2
                        )
                    );
            }

            $patient_name = Helper::getUserName($appointmentlist->patient_id);
            $meetingtime_message_patient = $appointmentlist->appointment_time;
            $doctorsms_message = "Hello Reminder Appointment time: " . $meetingtime_message_patient . "  Meeting Link: " . $videomeetinglinkurl . " Patient Name: " . $patient_name . " Message: " . $patientcommentmessage . "  Thank you  From Telehealth Plus  http://telehealthplus.com.au";

            $postdata = http_build_query(
                array(
                    'phonenumber' => $booked_doctor_phonenumber,
                    'message' => $doctorsms_message
                )
            );
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );
            $context = stream_context_create($opts);
            $SMScall_doctor = file_get_contents('https://txmarketvalue.com/Clicksend/smsrequest.php', false, $context);

            // $client->messages->create(
            //     $booked_doctor_phonenumber,
            //     [
            //         'from' => env( 'TWILIO_FROM' ),
            //         'body' => $doctorsms_message,
            //     ]
            // );   

            //Doctor side

            // sleep(400);


//             $email_params2 = array();
//             $doctor_appt_req_template = DB::table('email_types')->select('id')->where('email_type', 'doctor_email_appointment_request_received')->get()->first();
//             if (!empty($doctor_appt_req_template->id)) {
//                 $template_data2 = EmailTemplate::getEmailTemplateByID($doctor_appt_req_template->id);
//                 $email_params2['doctor_name'] = Helper::getUserName($appointmentlist->user_id);
//                 $email_params2['hospital_name']  = "Appointment Settings";
//                 $email_params2['appointment_date']  = Carbon::parse($appointmentlist->appointment_date)->format('d M, Y') . ' ' . $appointmentlist->appointment_time;
//                 $email_params2['description']  = $appointmentlist->comments;
// 		$email_params2['video_link']  = $videomeetinglinkurl;
// 		$email_params2['video_link_title']  = trans('lang.goto_link');
//                 Mail::to($booking_doctoritem->email)
//                     ->send(
//                         new DoctorEmailMailable(
//                             'doctor_email_appointment_request_received',
//                             $template_data2,
//                             $email_params2
//                         )
//                     );
// 	    } 

//  	    sleep(1);  

// 		$patient_name = Helper::getUserName($appointmentlist->patient_id);
// 		$meetingtime_message_patient = $appointmentlist->appointment_time;
//         $doctorsms_message_later = "Hello A patient has just entered your waiting room and is now ready for their appointment. Appointment details below. Meeting time: ".$meetingtime_message_patient."  Meeting Link: ".$videomeetinglinkurl." Patient Name: ".$patient_name." Message: ".$patientcommentmessage."  Thank you  From Telehealth Plus  http://telehealthplus.com.au";

//         $postdata = http_build_query(
//             array(
//                 'phonenumber' => $booked_doctor_phonenumber,
//                 'message' => $doctorsms_message_later
//             )
//         );
//         $opts = array('http' =>
//             array(
//                 'method'  => 'POST',
//                 'header'  => 'Content-Type: application/x-www-form-urlencoded',
//                 'content' => $postdata
//             )
//         );
//         $context  = stream_context_create($opts);
//         $SMScall_doctor = file_get_contents('https://txmarketvalue.com/Clicksend/smsrequest.php', false, $context);

//             // $client->messages->create(
//             //     $booked_doctor_phonenumber,
//             //     [
//             //         'from' => env( 'TWILIO_FROM' ),
//             //         'body' => $doctorsms_message,
//             //     ]
//             // );  

        }
    }

    /**
     * Get search result.
     *
     * @access public
     *
     * @return view
     */
    public function getSearchResult()
    {
        $keyword = !empty($_GET['search']) ? $_GET['search'] : '';
        $type = !empty($_GET['type']) ? $_GET['type'] : '';
        $location = !empty($_GET['locations']) ? $_GET['locations'] : '';
        $service = !empty($_GET['service']) ? $_GET['service'] : '';
        $speciality = !empty($_GET['speciality']) ? $_GET['speciality'] : '';
        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : '';
        $sort_by = !empty($_GET['sort_by']) ? $_GET['sort_by'] : '';
        $sidebar = SiteManagement::getMetaValue('sidebar_settings');
        $display_sidebar = !empty($sidebar) && !empty($sidebar['display_sidebar']) ? $sidebar['display_sidebar'] : '';
        $display_query_section = !empty($sidebar) && !empty($sidebar['display_query_section']) ? $sidebar['display_query_section'] : '';
        $ask_query_img = !empty($sidebar) && !empty($sidebar['hidden_ask_query_img']) ? $sidebar['hidden_ask_query_img'] : '';
        $query_title = !empty($sidebar) && !empty($sidebar['query_title']) ? $sidebar['query_title'] : '';
        $query_subtitle = !empty($sidebar) && !empty($sidebar['query_subtitle']) ? $sidebar['query_subtitle'] : '';
        $query_btn_title = !empty($sidebar) && !empty($sidebar['query_btn_title']) ? $sidebar['query_btn_title'] : '';
        $query_btn_link = !empty($sidebar) && !empty($sidebar['query_btn_link']) ? $sidebar['query_btn_link'] : '';
        $query_desc = !empty($sidebar) && !empty($sidebar['query_desc']) ? $sidebar['query_desc'] : '';
        $display_get_app_sec = !empty($sidebar) && !empty($sidebar['display_get_app_sec']) ? $sidebar['display_get_app_sec'] : '';
        $download_app_img = !empty($sidebar) && !empty($sidebar['hidden_download_app_img']) ? $sidebar['hidden_download_app_img'] : '';
        $download_app_title = !empty($sidebar) && !empty($sidebar['download_app_title']) ? $sidebar['download_app_title'] : '';
        $download_app_subtitle = !empty($sidebar) && !empty($sidebar['download_app_subtitle']) ? $sidebar['download_app_subtitle'] : '';
        $download_app_desc = !empty($sidebar) && !empty($sidebar['download_app_desc']) ? $sidebar['download_app_desc'] : '';
        $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '';
        $display_get_ad_sec = !empty($sidebar) && !empty($sidebar['display_get_ad_sec']) ? $sidebar['display_get_ad_sec'] : '';
        $ad_content = !empty($sidebar) && !empty($sidebar['ad_content']) ? $sidebar['ad_content'] : '';
        $search = User::getSearchResult($type, $keyword, $location, $service, $speciality, $order_by, $sort_by);
        $inner_page = SiteManagement::getMetaValue('inner_page_data');
        $search_list_meta_title = !empty($inner_page) && !empty($inner_page['search_list_meta_title']) ? $inner_page['search_list_meta_title'] : trans('lang.search_results');
        $search_list_meta_desc = !empty($inner_page) && !empty($inner_page['search_list_meta_desc']) ? $inner_page['search_list_meta_desc'] : trans('lang.search_results');
        $users = $search['users'];
        $total_records = $search['total'];
        $userMetas = UserMeta::all();
        $currency = SiteManagement::getMetaValue('payment_settings');
        $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : 'symbol';
        if (!empty($users)) {
            if (file_exists(resource_path('views/extend/front-end/search-results/index.blade.php'))) {
                return view(
                    'extend.front-end.search-results.index',
                    compact(
                        'symbol',
                        'users',
                        'type',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content',
                        'total_records',
                        'search_list_meta_title',
                        'search_list_meta_desc',
                        'userMetas'
                    )
                );
            } else {
                return view(
                    'front-end.search-results.newdesign',
                    compact(
                        'symbol',
                        'users',
                        'type',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content',
                        'total_records',
                        'search_list_meta_title',
                        'search_list_meta_desc',
                        'userMetas'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get search result.
     *
     * @access public
     *
     * @return view
     */
    public function getContactus()
    {
        return view('front-end.contactus.index');
    }

    /**
     * Get search result.
     *
     * @access public
     *
     * @return view
     */
    public function getContactusMessagesent()
    {
        return view('front-end.contactus.show');
    }

    /**
     * Get search result.
     *
     * @access public
     *
     * @return view
     */
    public function sendcontactMessage(CourseValidationRequest $request)
    {


        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
            $email_params = array();
            $template = DB::table('email_types')->select('id')->where('email_type', 'doctor_email_package_subscribed')->get()->first();
            if (!empty($template->id)) {
                $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                $email_params['user_name'] = $request->contact_fullname;
                $email_params['user_email'] = $request->contact_email;
                $email_params['user_phone'] = $request->contact_phone;
                $email_params['user_message'] = $request->contact_question;
                $sender_emailaddress = "support@telehealthplus.com.au";
                Mail::to($sender_emailaddress)
                    ->send(
                        new GeneralEmailMailable(
                            'doctor_email_package_subscribed',
                            $template_data,
                            $email_params
                        )
                    );
            }
        }
        return Redirect::to('contactus-success');
    }

    /**
     * Submit feedback.
     *
     * @param mixed $request request->attr
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function submitFeedack(Request $request)
    {
        $feedback_submission = Feedback::submitFeedback($request);
        if ($feedback_submission == 'success') {
            return response()->json(
                [
                    'type' => 'success',
                    'message' => trans('lang.feedback_submitted'),

                ]
            );
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'message' => trans('lang.something_went_wrong'),

                ]
            );
        }
    }

    /**
     * Get State List.
     *
     * @param mixed $request request->attr
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getcountryoptstate(Request $request)
    {
        $country_id = $request['country_id'];
        $country_state = DB::table('stateitems')->select('*')->where('country_id', $country_id)->get();
        $output_result = "";

        if (!empty($country_state)) {
            foreach ($country_state as $key => $country_stateitems) {
                $selectstatename = $country_stateitems->state_name;
                $output_result .= "<option value='$selectstatename'>$selectstatename</option>";
            }
        } else {
            $output_result = '<option value="">State not available</option>';
        }

        return $output_result;
    }

    /**
     * Send Download Application Email
     *
     * @return response
     */
    public function sendDownloadAppEmail(Request $request)
    {
        if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
            $sidebar = SiteManagement::getMetaValue('sidebar_settings');
            $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '#';
            $email_params = array();
            $email_params['download_link'] = $download_app_link;
            $template_data = Helper::getDownloadAppEmailContent();
            Mail::to($request['email'])
                ->send(
                    new GeneralEmailMailable(
                        'general_email_download_application',
                        $template_data,
                        $email_params
                    )
                );
            return response()->json(
                [
                    'type' => 'success',
                    'message' => trans('lang.app_link_sent')
                ]
            );
        } else {
            return response()->json(
                [
                    'type' => 'success',
                    'message' => trans('lang.something_went_wrong')
                ]
            );
        }
    }
}
