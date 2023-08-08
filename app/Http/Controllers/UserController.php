<?php

/**
 * Class UserController
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

use App\EmailTemplate;
use App\Helper;
use App\Location;
use App\Mail\AdminEmailMailable;
use App\Mail\GeneralEmailMailable;
use App\UserMeta;
use App\User;
use App\Feedback;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Session;
use Spatie\Permission\Traits\HasRoles;
use View;
use App\Report;
use App\SiteManagement;
use App\Appointment;
use App\Payout;
use PDF;
use App\Invoice;
use App\Order;
use App\Article;
use App\Package;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use App\OrderMeta;

/**
 * Class UserController
 *
 */
class UserController extends Controller
{
    /**
     * Defining public scope of variable
     *
     * @access public
     *
     * @var array $user
     */
    use HasRoles;

    protected $user;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @param instance $user make instance
     * @param instance $user_meta make user_meta instance
     *
     * @return void
     */
    public function __construct(User $user, UserMeta $user_meta, Report $report)
    {
        $this->user = $user;
        $this->user_meta = $user_meta;
        $this->report = $report;
    }

    /**
     * UserMeta Manage Account/ UserMeta Settings
     *
     * @access public
     *
     * @return View
     */
    public function accountSettings()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/index.blade.php'))) {
            return view(
                'extend.back-end.account-settings.index'
            );
        } else {
            return view(
                'back-end.account-settings.index'
            );
        }
    }

    /**
     * Save user account settings.
     *
     * @param mixed $request request attribute
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAccountSettings(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $user_meta = new UserMeta();
        $user_id = Auth::user()->id;
        $user_meta->storeAccountSettings($request, $user_id);
        Session::flash('message', trans('lang.account_settings_saved'));
        return Redirect::back();
    }

    /**
     * Reset password form.
     *
     * @access public
     *
     * @return View
     */
    public function resetPassword()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/reset-password.index.blade.php'))) {
            return view('extend.back-end.account-settings.reset-password.index');
        } else {
            return view('back-end.account-settings.reset-password.index');
        }
    }

    /**
     * Update user password.
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function requestPassword(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        if (!empty($request)) {
            Validator::extend(
                'old_password',
                function ($attribute, $value, $parameters) {
                    return Hash::check($value, Auth::user()->password);
                }
            );
            $this->validate(
                $request,
                [
                    'old_password' => 'required',
                    'confirm_password' => 'required',
                    'confirm_new_password' => 'required',
                ]
            );
            $user_id = $request['user_id'];
            $user = User::find($user_id);

            if (Hash::check($request->old_password, $user->password)) {

                if ($request->confirm_password === $request->confirm_new_password) {

//                    dd($request->old_password." ".$request->confirm_password. " ".$request->confirm_new_password);

                    $user->password = Hash::make($request->confirm_password);
                    // Send email

                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'reset_password_email')->get()->first();
                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['name'] = Helper::getUserName($user_id);
                        $email_params['email'] = $user->email;
                        $email_params['password'] = $request->confirm_password;
                        try {
                            Mail::to($user->email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'reset_password_email',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        } catch (\Exception $e) {
                            dd($e->getMessage());
                            Session::flash('error', trans('lang.ph_email_warning'));
                            return Redirect::back();
                        }
                    }

                    $user->save();
                    Session::flash('message', trans('passwords.reset'));
                    // Auth::logout();
                    // return Redirect::to('/');
                    return Redirect::back();
                } else {
                    Session::flash('error', trans('lang.confirmation'));
                    return Redirect::back();
                }
            } else {

                Session::flash('error', trans('lang.pass_not_match'));
                return Redirect::back();
            }
        } else {
            Session::flash('error', trans('lang.something_wrong'));
            return Redirect::back();
        }
    }

    /**
     * Email Notification Settings Form.
     *
     * @access public
     *
     * @return View
     */
    public function emailNotificationSettings()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/index.blade.php'))) {
            return view('extend.back-end.account-settings.index');
        } else {
            return view('back-end.account-settings.index');
        }
    }

    /**
     * Save Email Notification Settings.
     *
     * @param mixed $request request attribute
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function saveEmailNotificationSettings(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $user_meta = new UserMeta();
        $user_id = Auth::user()->id;
        $user_meta->storeEmailNotification($request, $user_id);
        Session::flash('message', trans('lang.email_settings_saved'));
        return Redirect::back();
    }

    /**
     * Delete Account form.
     *
     * @access public
     *
     * @return View
     */
    public function deleteAccount()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/delete-account/index.blade.php'))) {
            return view('extend.back-end.account-settings.delete-account.index');
        } else {
            return view('back-end.account-settings.delete-account.index');
        }
    }

    /**
     * Delete record from storage
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return View
     */
    public function destroy(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $this->validate(
            $request,
            [
                'old_password' => 'required',
                'retype_password' => 'required',
            ]
        );
        $json = array();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if ($request->old_password === $request->retype_password) {
            if (Hash::check($request->old_password, $user->password)) {


                if (!empty($user_id)) {
                    $user->profile()->delete();
                    $user->roles()->detach();
                    DB::table('appointments')->where('user_id', $user_id)
                        ->orWhere('hospital_id', $user_id)->orWhere('patient_id', $user_id)->delete();
                    if ($user->articles->count() > 0) {
                        foreach ($user->articles as $user_article) {
                            $article = Article::find($user_article->id);
                            if ($article->categories->count() > 0) {
                                $article->categories()->detach();
                            }
                        }
                        $user->articles()->delete();
                    }
                    DB::table('feedbacks')->where('user_id', $user_id)
                        ->orWhere('patient_id', $user_id)->delete();
                    $user->forums()->detach();
                    DB::table('messages')->where('user_id', $user_id)
                        ->orWhere('receiver_id', $user_id)->delete();
                    if ($user->orders->count() > 0) {
                        foreach ($user->orders as $user_orders) {
                            DB::table('order_metas')->where('metable_id', $user_orders->id)->delete();
                        }
                        $user->orders()->delete();
                    }
                    DB::table('payouts')->where('user_id', $user_id)->delete();
                    DB::table('teams')->where('user_id', $user_id)
                        ->orWhere('doctor_id', $user_id)->delete();
                    $user->services()->detach();
                    if ($user->question->count() > 0) {
                        foreach ($user->question as $form) {
                            DB::table('forums')->where('id', $form->id)->delete();
                            DB::table('user_forum')->where('forum_id', $form->id)->delete();
                        }
                    }
                    DB::table('user_forum')->where('user_id', $user_id)->where('type', 'answer')->delete();
                    $user->delete();
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $delete_reason = Helper::getDeleteAccReason($request['delete_reason']);
                        $email_params = array();
                        $template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_delete_account')->get()->first();
                        if (!empty($template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                            $email_params['reason'] = $delete_reason;
                            Mail::to(config('mail.username'))
                                ->send(
                                    new AdminEmailMailable(
                                        'admin_email_delete_account',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                    }
                    Auth::logout();
                    $json['acc_del'] = trans('lang.acc_deleted');
                    return $json;
                } else {
                    $json['type'] = 'warning';
                    $json['msg'] = trans('lang.something_wrong');
                    return $json;
                }

            }


        } else {
            $json['type'] = 'warning';
            $json['msg'] = trans('lang.pass_mismatched');
            return $json;
        }
    }

    /**
     * Get Manage Account Data
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getManageAccountData()
    {
        if (Auth::user()) {
            $json = array();
            $user_id = Auth::user()->id;
            $user_meta = User::find($user_id)->profile->first();
            if (!empty($user_meta)) {
                $json['type'] = 'success';
                if ($user_meta->profile_searchable == 'true') {
                    $json['profile_searchable'] = 'true';
                }
                if ($user_meta->profile_blocked == 'true') {
                    $json['profile_blocked'] = 'true';
                }
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Get User Notification Settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserEmailNotificationSettings()
    {
        $json = array();
        $user_meta = new UserMeta();
        $notifications = $user_meta::select('weekly_alerts', 'message_alerts')
            ->where('user_id', Auth::user()->id)->get()->first();
        if (!empty($notifications)) {
            $json['type'] = 'success';
            if ($notifications->weekly_alerts == 'true') {
                $json['weekly_alerts'] = 'true';
            }
            if ($notifications->message_alerts == 'true') {
                $json['message_alerts'] = 'true';
            }
        } else {
            $json['type'] = 'error';
        }
        return $json;
    }

    /**
     * Get User Searchable Settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserSearchableSettings()
    {
        $json = array();
        $user_meta = new UserMeta();
        $user_data = $user_meta::select('profile_searchable', 'disable_account')
            ->where('user_id', Auth::user()->id)->get()->first();
        if (!empty($user_data)) {
            $json['type'] = 'success';
            if ($user_data->profile_searchable == 'true') {
                $json['profile_searchable'] = 'true';
            }
            if ($user_data->disable_account == 'true') {
                $json['disable_account'] = 'true';
            }
        } else {
            $json['type'] = 'error';
        }
        return $json;
    }

    /**
     * Get dashboard
     *
     * @return View
     */
    public function getDashboard()
    {
        if (Auth::user()) {
            $icons = SiteManagement::getMetaValue('icons');
            $latest_appointment_icon = !empty($icons['hidden_appointment']) ? $icons['hidden_appointment'] : '';
            $latest_package_expiry_icon = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : '';
            $latest_new_message_icon = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : '';
            $payment_settings = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($payment_settings) && !empty($payment_settings['currency']) ? Helper::currencyList($payment_settings['currency']) : array();
            $hidden_package_expiry = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : '';
            $hidden_available_balance = !empty($icons['hidden_available_balance']) ? $icons['hidden_available_balance'] : '';
            $hidden_pending_balance = !empty($icons['hidden_pending_balance']) ? $icons['hidden_pending_balance'] : '';
            $hidden_total_posted_articles = !empty($icons['hidden_total_posted_articles']) ? $icons['hidden_total_posted_articles'] : '';
            $hidden_check_invoices = !empty($icons['hidden_check_invoices']) ? $icons['hidden_check_invoices'] : '';
            $hidden_latest_recieved_booking = !empty($icons['hidden_latest_recieved_booking']) ? $icons['hidden_latest_recieved_booking'] : '';
            $hidden_submit_articles = !empty($icons['hidden_submit_articles']) ? $icons['hidden_submit_articles'] : '';
            $hidden_saved_item = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : '';
            $hidden_manage_teams = !empty($icons['hidden_manage_teams']) ? $icons['hidden_manage_teams'] : '';
            $hidden_manage_specialities_services = !empty($icons['hidden_manage_specialities_services']) ? $icons['hidden_manage_specialities_services'] : '';
            $hidden_new_message = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : '';
            if (Helper::getAuthRoleType() == 'admin') {
                return View(
                    'back-end.admin.dashboard',
                    compact(
                        'latest_appointment_icon',
                        'latest_package_expiry_icon',
                        'latest_new_message_icon',
                        'hidden_saved_item',
                        'hidden_new_message'
                    )
                );
            } elseif (Helper::getAuthRoleType() == 'regular') {
                return View(
                    'back-end.regulars.dashboard',
                    compact(
                        'latest_appointment_icon',
                        'latest_new_message_icon',
                        'hidden_saved_item',
                        'hidden_new_message'
                    )
                );
            } elseif (Helper::getAuthRoleType() == 'doctor') {
                $order = Auth::user()->orders()->where('status', 'completed')->first();
                $order_obj = !empty($order) ? Order::findOrFail($order->id) : '';
                $package_item = !empty($order_obj) ? unserialize($order_obj->metaValue('package')) : array();
                $package = !empty($package_item) ? Package::findOrFail($package_item['id']) : '';
                $option = !empty($package_item) && !empty($package_item['options']) ? unserialize($package_item['options']) : '';
                $expiry = !empty($option) ? $package->updated_at->addDays($option['duration']) : '';
                $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
                $trail = !empty($package) && $package->trial == 1 ? 'true' : 'false';
                return View(
                    'back-end.doctors.dashboard',
                    compact(
                        'hidden_package_expiry',
                        'hidden_available_balance',
                        'hidden_pending_balance',
                        'hidden_total_posted_articles',
                        'hidden_check_invoices',
                        'hidden_latest_recieved_booking',
                        'hidden_submit_articles',
                        'hidden_saved_item',
                        'hidden_new_message',
                        'package',
                        'option',
                        'expiry',
                        'expiry_date',
                        'latest_package_expiry_icon',
                        'trail',
                        'latest_appointment_icon',
                        'latest_new_message_icon',
                        'hidden_saved_item'

                    )
                );
            } else {
                return View(
                    'back-end.hospitals.dashboard',
                    compact(
                        'hidden_saved_item',
                        'hidden_manage_teams'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show User Profile Settings Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfileSettings($role_type)
    {
        if (Auth::user()) {
            $user_role = $role_type == 'admin' ? 'admin' : $role_type . 's';
            $user_meta = Auth::user()->profile;
            $gender_title = !empty($user_meta->gender_title) ? $user_meta->gender_title : '';
            $gender = !empty($user_meta->gender) ? $user_meta->gender : '';
            $sub_heading = !empty($user_meta->sub_heading) ? $user_meta->sub_heading : '';
            $description = !empty($user_meta->description) ? $user_meta->description : '';
            $working_time = !empty($user_meta->working_time) ? $user_meta->working_time : '';
            $available_days = !empty($user_meta->available_days) ? Helper::getUnserializeData($user_meta->available_days) : array();
            $starting_price = !empty($user_meta->starting_price) ? $user_meta->starting_price : '';
            $memberships = !empty($user_meta->memberships) ? Helper::getUnserializeData($user_meta->memberships) : array();
            $registration = !empty($user_meta->verify_medical) ? Helper::getUnserializeData($user_meta->verify_medical) : array();
            $registration_number = !empty($registration) ? $registration['registration_number'] : '';
            $registration_document = !empty($registration) && $registration['registration_document'] ? $registration['registration_document'] : '';
            $downloads = !empty($user_meta->downloads) ? Helper::getUnserializeData($user_meta->downloads) : '';
            $locations = Location::pluck('title', 'id');
            $address = !empty($user_meta->address) ? $user_meta->address : '';
            $longitude = !empty($user_meta->longitude) ? $user_meta->longitude : '';
            $latitude = !empty($user_meta->latitude) ? $user_meta->latitude : '';
            $avatar = !empty($user_meta->avatar) ? $user_meta->avatar : '';
            $banner = !empty($user_meta->banner) ? $user_meta->banner : '';
            $galleries = !empty($user_meta->gallery) ? Helper::getUnserializeData($user_meta->gallery) : '';
            $gallery_videos = !empty($user_meta->gallery_videos) ? Helper::getUnserializeData($user_meta->gallery_videos) : '';
            if (file_exists(resource_path('views/extend/back-end/' . $user_role . '/profile-settings/index.blade.php'))) {
                return view(
                    'extend.back-end.' . $user_role . '/profile-settings.index',
                    compact(
                        'gallery_videos',
                        'galleries',
                        'working_time',
                        'available_days',
                        'gender_title',
                        'gender',
                        'sub_heading',
                        'description',
                        'starting_price',
                        'memberships',
                        'avatar',
                        'banner',
                        'registration_number',
                        'registration_document',
                        'downloads',
                        'user_role',
                        'address',
                        'longitude',
                        'latitude',
                        'locations'
                    )
                );
            } else {
                return view(
                    'back-end.' . $user_role . '/profile-settings.index',
                    compact(
                        'gallery_videos',
                        'galleries',
                        'working_time',
                        'available_days',
                        'gender_title',
                        'gender',
                        'sub_heading',
                        'description',
                        'starting_price',
                        'memberships',
                        'avatar',
                        'banner',
                        'registration_number',
                        'registration_document',
                        'downloads',
                        'user_role',
                        'address',
                        'longitude',
                        'latitude',
                        'locations'
                    )
                );
            }
        }
    }

    /**
     * Store User profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     * @param string $role_type role_type
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUserProfileSettings(Request $request, $role_type)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if ($role_type == 'admin') {
            if ($request['email'] != Auth::user()->email) {
                $this->validate(
                    $request,
                    [
                        'email' => 'unique:users|email',
                    ]
                );
            }
            $this->validate(
                $request,
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]
            );
        }
        if (!empty($request['latitude']) || !empty($request['longitude'])) {
            $this->validate(
                $request,
                [
                    'latitude' => ['regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/'],
                    'longitude' => ['regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/'],
                ]
            );
        }
        if (Auth::user()) {
            $profile = $this->user_meta->storeProfile($request, Auth::user()->id);
            if ($profile == 'success') {
                $json['type'] = 'success';
                $json['role'] = Helper::getAuthRoleType();
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Store User profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     * @param string $role_type role_type
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUserGallery(Request $request, $role_type)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $profile = $this->user_meta->storeGallery($request, Auth::user()->id);
            if ($profile == 'success') {
                $json['type'] = 'success';
                $json['role'] = Helper::getAuthRoleType();
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Get experiences
     *
     * @return \Illuminate\Http\Response
     */
    public function getExperiences()
    {
        $json = array();
        if (Auth::user()) {
            $stored_experiences = array();
            $data = $this->user_meta::select('experiences')->where('user_id', Auth::user()->id)->pluck('experiences')->first();
            $experiences = !empty($data) ? Helper::getUnserializeData($data) : array();
            if (!empty($experiences)) {
                foreach ($experiences as $key => $value) {
                    $stored_experiences[] = $value;
                }
                $json['type'] = 'success';
                $json['experiences'] = $stored_experiences;
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
     * Get educations
     *
     * @return \Illuminate\Http\Response
     */
    public function getEducations()
    {
        $json = array();
        if (Auth::user()) {
            $stored_educations = array();
            $data = $this->user_meta::select('educations')->where('user_id', Auth::user()->id)->pluck('educations')->first();
            $educations = !empty($data) ? Helper::getUnserializeData($data) : array();
            if (!empty($educations)) {
                foreach ($educations as $key => $value) {
                    $stored_educations[] = $value;
                }
                $json['type'] = 'success';
                $json['educations'] = $stored_educations;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.no_record');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get hospitals
     *
     * @return \Illuminate\Http\Response
     */
    public function getHospitals()
    {
        $json = array();
        $hospitals = User::role('hospital')->select(
            DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"),
            "id"
        )->get()->toArray();
        if (!empty($hospitals)) {
            $json['type'] = 'success';
            $json['hospitals'] = $hospitals;
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Add item in wishlist.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function addWishlist(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $json['authentication'] = true;
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                if (!empty($request['column'])) {
                    if ($request['column'] === 'saved_hospitals' || $request['column'] === 'saved_doctors') {
                        if ($user_id == $id) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.login_from_different_user');
                            return $json;
                        }
                    } elseif ($request['column'] === 'saved_articles') {
                        $article = Article::find($id);
                        if ($user_id == $article->author->id) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.login_from_different_user');
                            return $json;
                        }
                    }
                }
                $add_wishlist = $this->user_meta->addWishlist($request['column'], $id, $user_id);
                $article_likes = '';
                if ($add_wishlist == "success") {
                    if ($request['column'] == 'saved_articles') {
                        $article = Article::find($id);
                        if (!empty($article->likes)) {
                            $article->likes = $article->likes + 1;
                        } else {
                            $article->likes = 1;
                        }
                        $article_likes = $article->likes;
                        $article->save();
                        $json['likes'] = $article_likes;
                    }
                    $json['type'] = 'success';

                    $json['message'] = trans('lang.added_to_wishlist');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['authentication'] = false;
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }

    /**
     * Remove item in wishlist.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function removeWishlist(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $json['authentication'] = true;
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                if (!empty($request['column'])) {
                    if ($user_id == $id) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.login_from_different_user');
                        return $json;
                    }
                }
                $remove_wishlist = $this->user_meta->removeWishlist($request['column'], $id, $user_id);
                if ($remove_wishlist == "success") {
                    $json['type'] = 'success';
                    $json['message'] = trans('lang.added_to_wishlist');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['authentication'] = false;
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }

    /**
     * Get User Saved Item
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserWishlist(Request $request)
    {
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $profile = $user->profile;
            if (!empty($request['slug'])) {
                $json = array();
                $selected_user = DB::table('users')->select('id')
                    ->where('slug', $request['slug'])->get()->first();
                $role = $this->user::getRoleTypeByUserID($selected_user->id);
                if ($role->role_type == 'doctor') {
                    $json['user_type'] = 'doctor';
                    if (in_array($selected_user->id, unserialize($profile->saved_doctors))) {
                        $json['current_doctor'] = 'true';
                    }
                    return $json;
                }
                if ($role->role_type == 'hospital') {
                    $json['user_type'] = 'hospital';
                    if (in_array($selected_user->id, unserialize($profile->saved_hospitals))) {
                        $json['current_hospital'] = 'true';
                    }
                    return $json;
                }
            }
        }
    }

    /**
     * Submit Report
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeReport(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required',
                'description' => 'required',
            ]
        );
        $report = $this->report->submitReport($request);
        if ($report['type'] == 'success') {
            $json['type'] = 'success';
            //send email
            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                $user = $this->user::find($report['user_id']);
                $email_params = array();
                $report_user_admin_email = DB::table('email_types')->select('id')->where('email_type', 'admin_email_report_user')->get()->first();
                if (!empty($report_user_admin_email->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($report_user_admin_email->id);
                    $email_params['user_name'] = Helper::getUserName($user->id);
                    $email_params['user_role'] = $user->GetRoleNames()->first();
                    $email_params['user_profile'] = url('profile/' . $user->slug);
                    $email_params['name'] = $request['name'];
                    $email_params['email'] = $request['email'];
                    $email_params['description'] = $request['description'];
                    Mail::to(config('mail.username'))
                        ->send(
                            new AdminEmailMailable(
                                'admin_email_report_user',
                                $template_data,
                                $email_params
                            )
                        );
                }
                $report_user_email = DB::table('email_types')->select('id')->where('email_type', 'user_email_report_user')->get()->first();
                if (!empty($report_user_email->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($report_user_email->id);
                    $email_params['user_name'] = Helper::getUserName($user->id);
                    $email_params['user_role'] = $user->GetRoleNames()->first();
                    $email_params['user_profile'] = url('profile/' . $user->slug);
                    $email_params['description'] = $request['description'];
                    Mail::to($request['email'])
                        ->send(
                            new GeneralEmailMailable(
                                'user_email_report_user',
                                $template_data,
                                $email_params
                            )
                        );
                }
            }
            $json['message'] = trans('lang.report_submitted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
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
    public function checkout($id, $booknowoptioncheck, $selectconferenceitems)
    {
        if (!empty($id)) {
            $appointment = Appointment::findOrFail($id);
            //$booknowoptioncheck = $_GET['booknow'];
            $payment_settings = SiteManagement::getMetaValue('payment_settings');
            $payment_gateway = !empty($payment_settings) && !empty($payment_settings['payment_method']) ? $payment_settings['payment_method'] : array();
            $symbol = !empty($payment_settings) && !empty($payment_settings['currency']) ? Helper::currencyList($payment_settings['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/package/checkout.blade.php'))) {
                return view::make('extend.back-end.package.checkout', compact('payment_gateway', 'symbol', 'appointment'));
            } else {
                //  return view::make('back-end.package.checkout', compact('payment_gateway', 'symbol', 'appointment'));
                session()->put(['product_id' => e($appointment->id)]);
                session()->put(['price' => e($appointment->charges)]);
                session()->put(['doctorid' => e($appointment->user_id)]);
                session()->put(['patientid' => e($appointment->patient_id)]);
                session()->put(['paycomments' => e($appointment->comments)]);
                session()->put(['name' => e('appointment:' . $appointment->appointment_date . '-' . $appointment->appointment_time)]);
                session()->put(['type' => 'appointment']);
                session()->put(['booknowoptioncheck' => $booknowoptioncheck]);
                session()->put(['selectconferenceitems' => $selectconferenceitems]);
                $doctoritems = User::findOrFail($appointment->user_id);
                $authuserslug = Auth::user()->slug;
                $doctorzoomlink = $doctoritems->zoomlink;
// 		$doctorzoomlink = $doctoritems->zoomlink."&dn=".$authuserslug."&track_id=".$appointment->id;
                $doctorgotomeetinglink = $doctoritems->gotomeetinglink;
                $doctorgotemail = $doctoritems->email;
                session()->put(['zoomlink' => e($doctorzoomlink)]);
                session()->put(['doctorgotemail' => e($doctorgotemail)]);
                session()->put(['gotomeetinglink' => e($doctorgotomeetinglink)]);
                return Redirect::to('paypal/ec-checkout');
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
     * Store registration settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRegistrationSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $this->validate(
            $request,
            [
                'registration_number' => 'required',
                'registration_document' => 'required',
            ]
        );
        if (Auth::user()) {
            $registration = $this->user_meta->storeRegistration($request, Auth::user()->id);
            if ($registration == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.registration_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Add Liked Answers.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function addLikedAnswer(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $json['authentication'] = true;
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                $liked_answer = $this->user_meta->likeAnswer($request['column'], $id, $user_id);
                if ($liked_answer == "success") {
                    $json['type'] = 'success';
                    $json['message'] = clean(trans('lang.answer_liked'));
                    $json['liked_text'] = clean(trans('lang.liked_answer'));
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['authentication'] = false;
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }

    /**
     * Get User Saved Item
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getLikedAnswer(Request $request)
    {
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $profile = $user->profile;
            if (!empty($request['id'])) {
                $json = array();
                $selected_answers = DB::table('user_forum')->select('id')
                    ->where('forum_id', $request['id'])->where('type', 'answer')->get()->first();
                if (!empty($selected_answers->id)) {
                    if (in_array($selected_answers->id, unserialize($profile->liked_answers))) {
                        $json['answer'] = 'true';
                    }
                }
                return $json;
            }
        }
    }

    /**
     * Get user specialities
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecialities()
    {
        $json = array();
        $list = array();
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $specialities = $user->profile->services;
            if (!empty($specialities)) {
                $user_specialities = Helper::getUnserializeData($specialities);
                foreach ($user_specialities as $key => $user_speciality) {
                    $speciality = Helper::getSpecialityByID($user_speciality['speciality_id']);
                    if (!empty($speciality)) {
                        $list[$key]['speciality']['id'] = $speciality->id;
                        $list[$key]['speciality']['title'] = $speciality->title;
                        $list[$key]['speciality']['image'] = url(Helper::getImage('/uploads/specialities/', $speciality->image, 'extra-small-', 'default-speciality.png'));
                        if (!empty($user_speciality['services'])) {
                            $list[$key]['speciality']['services'] = $user_speciality['services'];
                            foreach ($user_speciality['services'] as $spaciality_key => $user_service) {
                                $service = Helper::getServiceByID($user_service['service']);
                                if (!empty($service)) {
                                    $list[$key]['speciality']['services'][$spaciality_key]['id'] = $service->id;
                                    $list[$key]['speciality']['services'][$spaciality_key]['title'] = $service->title;
                                    $list[$key]['speciality']['services'][$spaciality_key]['price'] = $user_service['price'];
                                    $list[$key]['speciality']['services'][$spaciality_key]['description'] = $user_service['description'];
                                }
                            }
                        }
                    }
                }
                $json['type'] = 'success';
                $json['user_specialities'] = $list;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get specific user record
     *
     * @param mixed $request request attributes
     * @param int $index index
     * @param int $service_index service_index
     *
     * @access public
     *
     * @return View
     */
    public function destroySpeciality(Request $request, $index, $service_index = "")
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $profile = $user->profile;
            if (!empty($profile) && !empty($profile->services)) {
                $specialities = Helper::getUnserializeData($profile->services);
                if (!empty($service_index) || $service_index == 0) {
                    $services = $specialities[$index]['services'];
                    unset($services[$service_index]);
                    $specialities[$index]['services'] = $services;
                } else {
                    unset($specialities[$index]);
                }
                $user_profile = UserMeta::find($profile->id);
                $user_profile->services = serialize($specialities);
                $user_profile->save();
                $json['type'] = 'success';
                $json['message'] = trans('lang.speciality_deleted');
                return $json;
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get user saved item list
     *
     * @param mixed $request request attributes
     * @param int $role role
     *
     * @access public
     *
     * @return View
     */
    public function getSavedItems(Request $request, $role = '')
    {
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $icons = SiteManagement::getMetaValue('icons');
            $hidden_doctor_image = !empty($icons['hidden_doctor_image']) ? $icons['hidden_doctor_image'] : '';
            $hidden_hospital_image = !empty($icons['hidden_hospital_image']) ? $icons['hidden_hospital_image'] : '';
            $saved_doctors = !empty($user->profile->saved_doctors) ? unserialize($user->profile->saved_doctors) : array();
            $saved_hospitals = !empty($user->profile->saved_hospitals) ? unserialize($user->profile->saved_hospitals) : array();
            $saved_articles = !empty($user->profile->saved_articles) ? unserialize($user->profile->saved_articles) : array();
            $currency = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : array();
            if ($request->path() === 'regular/saved-items') {
                if (file_exists(resource_path('views/extend/back-end/regular/saved-items.blade.php'))) {
                    return view(
                        'extend.back-end.regulars.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                } else {
                    return view(
                        'back-end.regulars.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                }
            } elseif ($request->path() === 'doctor/saved-items') {
                if (file_exists(resource_path('views/extend/back-end/doctors/saved-items.blade.php'))) {
                    return view(
                        'extend.back-end.doctors.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                } else {
                    return view(
                        'back-end.doctors.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                }
            } elseif ($request->path() === 'hospital/saved-items') {
                if (file_exists(resource_path('views/extend/back-end/hospitals/saved-items.blade.php'))) {
                    return view(
                        'extend.back-end.hospitals.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                } else {
                    return view(
                        'back-end.hospitals.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Payouts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayouts()
    {
        if (!empty($_GET['year']) && !empty($_GET['month'])) {
            $year = $_GET['year'];
            $month = $_GET['month'];
            $payouts = DB::table('payouts')
                ->select('*')
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->paginate(10)->setPath('');
            $pagination = $payouts->appends(
                array(
                    'year' => Input::get('year')
                )
            );
        } else {
            $payouts = Payout::paginate(10);
        }
        $selected_year = !empty($_GET['year']) ? $_GET['year'] : '';
        $selected_month = !empty($_GET['month']) ? $_GET['month'] : '';
        $months = Helper::getMonthList();
        $years = array_combine(range(date("Y"), 1970), range(date("Y"), 1970));
        if (file_exists(resource_path('views/extend/back-end/admin/payouts.blade.php'))) {
            return view(
                'extend.back-end.admin.payouts',
                compact('payouts', 'years', 'selected_year', 'months', 'selected_month')
            );
        } else {
            return view(
                'back-end.admin.payouts',
                compact('payouts', 'years', 'selected_year', 'months', 'selected_month')
            );
        }
    }

    /**
     * Generate PDF.
     *
     * @param date $year year
     * @param date $month month
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($year, $month)
    {
        $payouts = DB::table('payouts')
            ->select('*')
            ->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->get();
        $pdf = PDF::loadView('back-end.admin.payouts-pdf', compact('payouts', 'year', 'month'));
        return $pdf->download('payout-' . $month . '-' . $year . '.pdf');
    }

    /**
     * Get payout detail
     *
     * @return JSON Response
     */
    public function getPayoutDetail()
    {
        $json = array();
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $payout_detail = !empty($user->profile) ? Helper::getUnserializeData($user->profile->payout_settings) : array();
            $json['type'] = 'success';
            $json['payouts'] = $payout_detail;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_code');
            return $json;
        }
    }

    /**
     * Update Payout detail
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePayoutDetail(Request $request)
    {
        $user_id = $request['id'];
        if (!empty($user_id)) {
            $payout_setting = $this->user_meta->savePayoutDetail($request, $user_id);
            if ($payout_setting == 'success') {
                $json['type'] = 'success';
                $json['message'] = trans('lang.payout_saved_success');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_code');
            return $json;
        }
    }

    /**
     * Update user medical status
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserMedical(Request $request)
    {
        if (!empty($request['user_id'])) {
            if ($request['type'] == 'not_verify') {
                DB::table('user_metas')
                    ->where('user_id', $request['user_id'])
                    ->update(['verify_registration' => 0]);
                $json['status_text'] = trans('lang.not_verified');
            } else {
                DB::table('user_metas')
                    ->where('user_id', $request['user_id'])
                    ->update(['verify_registration' => 1]);
                $json['status_text'] = trans('lang.verified');
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.medical_status');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Update user Feedback status
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserFeedback(Request $request)
    {
        if (!empty($request['feedback_id'])) {
            if ($request['type'] == 'off') {
                DB::table('feedbacks')
                    ->where('id', $request['feedback_id'])
                    ->update(['keep_anonymous' => 'off']);
                $json['status_text'] = "Not Publish";
            } else {
                DB::table('feedbacks')
                    ->where('id', $request['feedback_id'])
                    ->update(['keep_anonymous' => 'on']);
                $json['status_text'] = "Publish";
            }
            $json['type'] = 'success';
            $json['message'] = 'The feedback status updated';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Get Doctor Invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserInvoices()
    {
        if (Helper::getAuthRoleType() != 'admin' && Helper::getAuthRoleType() == 'doctor' || Helper::getAuthRoleType() == 'regular') {
            $invoices = Auth::user()->orders()->get();
            $currency = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : array();
            if (Helper::getAuthRoleType() == 'doctor') {
                if (file_exists(resource_path('views/extend/back-end/doctors/invoices/package.blade.php'))) {
                    return view('extend.back-end.doctors.invoices.package', compact('invoices', 'symbol'));
                } else {
                    return view('back-end.doctors.invoices.package', compact('invoices', 'symbol'));
                }
            } else if (Helper::getAuthRoleType() == 'regular') {
                if (file_exists(resource_path('views/extend/back-end/regulars/invoices/appointment.blade.php'))) {
                    return view('extend.back-end.regulars.invoices.appointment', compact('invoices', 'symbol'));
                } else {
                    return view('back-end.regulars.invoices.appointment', compact('invoices', 'symbol'));
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Invoices.
     *
     * @param integer $id roletype
     *
     * @return \Illuminate\Http\Response
     */
    public function showInvoice($id)
    {
        if (!empty($id)) {
            $order = Order::findOrFail($id);
            $currency_code = !empty($order->metaValue('currency_code')) ? strtoupper($order->metaValue('currency_code')) : 'USD';
            $code = Helper::currencyList($currency_code);
            $symbol = !empty($code) ? $code['symbol'] : '$';
            if (Helper::getAuthRoleType() === 'doctor') {
                $options = unserialize($order->metaValue('appointment'));
//                $package_options = unserialize($options['options']);
                if (file_exists(resource_path('views/extend/back-end/doctors/invoices/show.blade.php'))) {
                    return view::make('extend.back-end.doctors.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
                } else {
                    return view::make('back-end.doctors.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
                }
            } else if (Helper::getAuthRoleType() === 'regular') {
                $options = unserialize($order->metaValue('appointment'));
                if (file_exists(resource_path('views/extend/back-end/regulars/invoices/show.blade.php'))) {
                    return view::make('extend.back-end.regulars.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
                } else {
                    return view::make('back-end.regulars.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Store service data in storage
     *
     * @param string $request user-slug
     *
     * @access public
     *
     * @return View
     */
    public function storeServices(Request $request)
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            if (!empty($request['services'])) {
                $specialities = array_pluck($request['services'], 'speciality');
                $temp_array = array_unique($specialities);
                $duplicates = sizeof($temp_array) != sizeof($specialities);
                if ($duplicates == true) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.duplicate_speciality');
                    return $json;
                }
            }
            $services = $this->user_meta->saveServices($request, Auth::user()->id);
            if ($services['type'] == 'speciality_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.speciality_required');
                return $json;
            } elseif ($services['type'] == 'service_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.service_required');
                return $json;
            } elseif ($services['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.speciality_updated');
                return $json;
            } elseif ($services['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $services['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * User listing
     *
     * @access public
     *
     * @return View
     */
    public function userListing()
    {
        $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
        if (Auth::user() && $role_type === 'admin') {
            if (!empty($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $users = $this->user::where('first_name', 'like', '%' . $keyword . '%')->orWhere('last_name', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
                $pagination = $users->appends(
                    array(
                        'keyword' => Input::get('keyword')
                    )
                );
            } else {
                $users = User::select('*')->latest()->paginate(10);
            }
            if (file_exists(resource_path('views/extend/back-end/admin/users/index.blade.php'))) {
                return view('extend.back-end.admin.users.index', compact('users'));
            } else {
                return view('back-end.admin.users.index', compact('users'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Feedback listing
     *
     * @access public
     *
     * @return View
     */
    public function userFeedbacksListing()
    {
        $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
        if ($role_type === 'admin') {

            $feedbacks = Feedback::select('*')->latest()->paginate(10);
            return view('back-end.admin.users.feedback', compact('feedbacks'));

        } else {
            abort(404);
        }
    }

    /**
     * Delete User
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request)
    {
        $user = $this->user::findOrFail($request['id']);
        $user->profile()->delete();
        $user->roles()->detach();
        DB::table('appointments')->where('user_id', $request['id'])
            ->orWhere('hospital_id', $request['id'])->orWhere('patient_id', $request['id'])->delete();
        if ($user->articles->count() > 0) {
            foreach ($user->articles as $user_article) {
                $article = Article::find($user_article->id);
                if ($article->categories->count() > 0) {
                    $article->categories()->detach();
                }
            }
            $user->articles()->delete();
        }
        DB::table('feedbacks')->where('user_id', $request['id'])
            ->orWhere('patient_id', $request['id'])->delete();
        if ($user->question->count() > 0) {
            foreach ($user->question as $form) {
                DB::table('forums')->where('id', $form->id)->delete();
                DB::table('user_forum')->where('forum_id', $form->id)->delete();
            }
        }
        DB::table('user_forum')->where('user_id', $request['id'])->where('type', 'answer')->delete();
        DB::table('messages')->where('user_id', $request['id'])
            ->orWhere('receiver_id', $request['id'])->delete();
        if ($user->orders->count() > 0) {
            foreach ($user->orders as $user_orders) {
                DB::table('order_metas')->where('metable_id', $user_orders->id)->delete();
            }
            $user->orders()->delete();
        }
        DB::table('payouts')->where('user_id', $request['id'])->delete();
        DB::table('teams')->where('user_id', $request['id'])
            ->orWhere('doctor_id', $request['id'])->delete();
        $user->services()->detach();
        $user->delete();
        return response()->json(
            [
                'type' => 'success',
                'message' => trans('lang.success')
            ]
        );
    }

    /**
     * Delete Feedback
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFeedback(Request $request)
    {
        DB::table('feedbacks')->where('id', $request['id'])->delete();
        return response()->json(
            [
                'type' => 'success',
                'message' => trans('lang.success')
            ]
        );
    }

    /**
     * Edit user profile
     *
     * @param intger $id user id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        if (!empty($id)) {
            $user = User::find($id);
            $user_meta = $user->profile;
            $gender_title = !empty($user_meta->gender_title) ? $user_meta->gender_title : '';
            $gender = !empty($user_meta->gender) ? $user_meta->gender : '';
            $sub_heading = !empty($user_meta->sub_heading) ? $user_meta->sub_heading : '';
            $description = !empty($user_meta->description) ? $user_meta->description : '';
            $avatar = !empty($user_meta->avatar) ? $user_meta->avatar : '';
            $banner = !empty($user_meta->banner) ? $user_meta->banner : '';
            $user_role = Helper::getRoleTypeByUserID($id);
            $roles = Role::all()->toArray();
            if (file_exists(resource_path('views/extend/back-end/admin/users/edit/index.blade.php'))) {
                return View(
                    'extend.back-end.admin.users.edit/index',
                    compact(
                        'gender_title',
                        'gender',
                        'sub_heading',
                        'description',
                        'avatar',
                        'banner',
                        'id',
                        'user',
                        'user_role',
                        'roles'
                    )
                );
            } else {
                return view(
                    'back-end.admin.users.edit/index',
                    compact(
                        'gender_title',
                        'gender',
                        'sub_heading',
                        'description',
                        'avatar',
                        'banner',
                        'id',
                        'user',
                        'user_role',
                        'roles'
                    )
                );
            }
        }
    }

    /**
     * Update user profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserProfileSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $user = User::find($request['id']);
        $old_email = '';
        if ($request['email'] != $user->email) {
            $old_email = $user->email;
            $this->validate(
                $request,
                [
                    'email' => 'unique:users|email',
                ]
            );
        }
        $this->validate(
            $request,
            [
                'role' => 'required',
            ]
        );
        if (!empty($request['id'])) {
            $user_update = $this->user->updateUser($request, $request['id']);
            if ($user_update['type'] == 'success') {
                $user->profile()->delete();
                $this->user_meta->storeProfile($request, $request['id']);
                DB::table('appointments')->where('user_id', $request['id'])
                    ->orWhere('hospital_id', $request['id'])->orWhere('patient_id', $request['id'])->delete();
                if ($user->articles->count() > 0) {
                    foreach ($user->articles as $user_article) {
                        $article = Article::find($user_article->id);
                        $article->author_id = 1;
                        $article->save();
                    }
                }
                DB::table('feedbacks')->where('user_id', $request['id'])
                    ->orWhere('patient_id', $request['id'])->delete();
                if ($user->question->count() > 0) {
                    foreach ($user->question as $form) {
                        DB::table('forums')->where('id', $form->id)->delete();
                        DB::table('user_forum')->where('forum_id', $form->id)->delete();
                    }
                }
                DB::table('user_forum')->where('user_id', $request['id'])->where('type', 'answer')->delete();
                DB::table('messages')->where('user_id', $request['id'])
                    ->orWhere('receiver_id', $request['id'])->delete();
                DB::table('payouts')->where('user_id', $request['id'])->delete();
                DB::table('teams')->where('user_id', $request['id'])
                    ->orWhere('doctor_id', $request['id'])->delete();
                $user->services()->detach();
                if (!empty($old_email)) {
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template_data = Helper::getUserUpdateEmailByAdminContent();
                        $email_params['name'] = Helper::getUserName($request['id']);
                        $email_params['email'] = $request['email'];
                        try {
                            Mail::to($user->email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'email_change_by_admin',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        } catch (\Exception $e) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.something_went_wrong');
                            return $json;
                            // Session::flash('error', trans('lang.ph_email_warning'));
                            // return Redirect::back();
                        }
                    }
                }
                if (!empty($request['password'])) {
                    $updated_user = User::find($request['id']);
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template_data = Helper::getUserUpdatePasswordByAdminContent();
                        $email_params['name'] = Helper::getUserName($request['id']);
                        $email_params['password'] = $request['password'];
                        try {
                            Mail::to($updated_user->email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'password_change_by_admin',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        } catch (\Exception $e) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.something_went_wrong');
                            return $json;
                        }
                    }
                }
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Edit user profile
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        $roles = Role::all()->toArray();
        if (file_exists(resource_path('views/extend/back-end/admin/users/create/index.blade.php'))) {
            return View(
                'extend.back-end.admin.users.create/index',
                compact(
                    'roles'
                )
            );
        } else {
            return view(
                'back-end.admin.users.create/index',
                compact(
                    'roles'
                )
            );
        }
    }

    /**
     * Update user profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
                'role' => 'required',
            ]
        );
        $json = array();
        if (!empty($request)) {
            $user_id = $this->user->storeUser($request);
            if ($request['role'] == 'doctor') {
                $order = new Order();
                $order->status = 'pending';
                $order->payment_gateway = 'paypal';
                $order->user()->associate($user_id);
                $order->save();
                $order_id = DB::getPdo()->lastInsertId();
                $latest_order = Order::find($order_id);
                $order_type = new OrderMeta();
                $order_type->meta_key = 'type';
                $order_type->meta_value = 'package';
                $latest_order->orderMeta()->save($order_type);
                $package_data = array();
                $package = Package::where('trial', 1)->first()->toArray();
                if (!empty($package)) {
                    $option = !empty($package['options']) ? Helper::getUnserializeData($package['options']) : '';
                    foreach ($package as $package_key => $package_value) {
                        $package_data[$package_key] = $package_value;
                    }
                    $package_meta = new OrderMeta();
                    $package_meta->meta_key = 'package';
                    $package_meta->meta_value = serialize($package_data);
                    $latest_order->orderMeta()->save($package_meta);
                    $expiry = !empty($order) ? $order->created_at->addDays($option['duration']) : '';
                    $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
                    $user = User::find($user_id);
                    $user->package_expiry = $expiry_date;
                    $user->save();
                }
            }
            $json['type'] = 'success';
            $json['progressing'] = trans('lang.saving');
            $json['message'] = trans('lang.user_created');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }
}
