<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('v1/listing/get_doctor', 'RestAPIController@getDoctor');
Route::get('v1/listing/get_hospital', 'RestAPIController@getHospital');
Route::get('v1/listing/get_hospital_team', 'RestAPIController@getHospitalTeam');
Route::get('v1/listing/get_consultation', 'RestAPIController@getDoctorConsulation');
Route::get('v1/listing/get_feedback', 'RestAPIController@getDoctorFeedback');
Route::get('v1/listing/get_location', 'RestAPIController@getDoctorLocation');
Route::get('v1/listing/get_articles', 'RestAPIController@getDoctorArticles');
Route::get('v1/listing/get_sinle_article', 'RestAPIController@getArticleDetail');
Route::get('v1/listing/get_doctors', 'RestAPIController@getUsers');
Route::post('v1/user/do-login', 'RestAPIController@userLogin');
Route::post('v1/user/do-logout', 'RestAPIController@userLogout');
Route::post('v1/user/signup', 'RestAPIController@createUser');
Route::post('v1/user/add_wishlist', 'RestAPIController@addWishlist');
Route::get('v1/user/get_wishlist', 'RestAPIController@getSavedItems');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('v1/profile/setting', 'RestAPIController@getUserProfileSettings');
Route::post('v1/profile/store_profile_setting', 'RestAPIController@storeProfileSettings');
Route::get('v1/taxonomies/get_list', 'RestAPIController@getTaxonomies');
Route::get('v1/profile/get_remove_reasons', 'RestAPIController@getRemoveReasons');
Route::get('v1/taxonomies/get-specilities', 'RestAPIController@getSpecilities');
Route::get('v1/forums/basic', 'RestAPIController@getForumSettings');
Route::get('v1/forums/get_listing', 'RestAPIController@getForumListing');
Route::post('v1/profile/get_remove_reasons', 'RestAPIController@removeAccount');
Route::post('v1/forums/add_question', 'RestAPIController@submitQuestion');
Route::get('v1/team/get_listing', 'RestAPIController@getTeam');
Route::get('v1/appointments/get_listing', 'RestAPIController@getDoctorAppointments');
Route::get('v1/appointments/get_patient_listing', 'RestAPIController@getPatientAppointments');
Route::get('v1/appointments/get_single', 'RestAPIController@getDoctorAppointmentSingle');
Route::get('v1/appointments/get_patient_single', 'RestAPIController@getPatientAppointmentSingle');
Route::post('v1/appointments/update_status', 'RestAPIController@updateAppointmentStatus');
Route::post('v1/appointmentBooking', 'RestAPIController@bookAppointment');
Route::get('v1/appointment/get_hospital', 'RestAPIController@getAppointmentHospitals');
Route::get('v1/appointment/get_hospital_services', 'RestAPIController@getHospitalServices');
Route::get('v1/appointment/get_appointment_slots', 'RestAPIController@getAppointmentSlots');
Route::post('v1/appointment/store_location', 'RestAPIController@storeAppointmentLocation');
Route::get('v1/appointment/get_locations', 'RestAPIController@getAppointmentLocation');
Route::get('v1/appointment/get_location_detail', 'RestAPIController@getLocationDetail');
Route::get('v1/appointment/get_location_services', 'RestAPIController@getLocationServices');
Route::post('v1/appointment/delete_all_slots', 'RestAPIController@deleteAllSlots');
Route::post('v1/appointment/delete_slot', 'RestAPIController@deleteSlot');
Route::post('v1/appointment/update_slots', 'RestAPIController@updateSlots');
Route::post('v1/appointment/update_selected_day_slots', 'RestAPIController@storeSelectedDaySlots');
Route::post('v1/submit_feedback', 'RestAPIController@submitFeedack');
Route::post('/doctor/notify-patient-waiting', 'DoctorController@notifyPatientWaiting');