<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Cache clear route
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get(
    'cache-clear',
    function () {
        \Artisan::call('config:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        return redirect()->back();
    }
);
// Authentication|Guest Routes
Auth::routes();
// Home
Route::get(
    '/',
    function () {
        if (Schema::hasTable('users')) {
            if (file_exists(resource_path('views/extend/front-end/index.blade.php'))) {
                return view('extend.front-end.index');
            } else {
                return view('front-end.index');
            }
        } else {
            if (!empty(env('DB_DATABASE'))) {
                return Redirect::to('/install');
            } else {
                return trans('lang.configure_database');
            }
        }
    }
)->name('home');
Route::get(
    '/home',
    function () {
        return Redirect::to('/');
    }
);
Route::post('user/remove-wishlist', 'UserController@removeWishlist');
Route::post('user/add-wishlist', 'UserController@addWishlist');
Route::post('user/add-liked-answer', 'UserController@addLikedAnswer');
Route::post('profile/get-liked-answer', 'UserController@getLikedAnswer');
Route::post('profile/get-wishlist', 'UserController@getUserWishlist');
Route::post('submit-report', 'UserController@storeReport');
//Admin Routes
Route::group(
    ['middleware' => ['role:admin']],
    function () {
	Route::post('admin/update/medical-verify', 'UserController@updateUserMedical');
	Route::post('admin/update/feedback-verify', 'UserController@updateUserFeedback');
        //Specialities
        Route::get('admin/specialities', 'SpecialityController@index')->name('specialities');
        Route::get('admin/specialities/edit/{slug}', 'SpecialityController@edit')->name('editSpeciality');
        Route::post('admin/store-speciality', 'SpecialityController@store');
        Route::get('admin/specialities/search', 'SpecialityController@index')->name('searchSpecialities');
        Route::post('admin/specialities/delete', 'SpecialityController@destroy');
        Route::post('admin/specialities/update/{id}', 'SpecialityController@update');
        Route::post('admin/delete-checked-specialities', 'SpecialityController@deleteSelected');
        // Category Routes
        Route::get('admin/categories', 'CategoryController@index')->name('categories');
        Route::get('admin/categories/edit/{slug}', 'CategoryController@edit')->name('editCategories');
        Route::post('admin/store-category', 'CategoryController@store');
        Route::get('admin/categories/search', 'CategoryController@index')->name('categoriesSearch');
        Route::post('admin/categories/delete', 'CategoryController@destroy');
        Route::post('admin/categories/update/{id}', 'CategoryController@update');
        Route::post('admin/delete-checked-categories', 'CategoryController@deleteSelected');
        // Improvement Options Routes
        Route::get('admin/improvement-options', 'ImprovementOptionController@index')->name('improvement-opts');
        Route::get('admin/improvement-options/edit/{slug}', 'ImprovementOptionController@edit')->name('edit-improvement-opts');
        Route::post('admin/store-improvement-opts', 'ImprovementOptionController@store');
        Route::get('admin/improvement-options/search', 'ImprovementOptionController@index')->name('search-improvement-opts');
        Route::post('admin/improvement-options/delete', 'ImprovementOptionController@destroy');
        Route::post('admin/improvement-options/update/{id}', 'ImprovementOptionController@update');
        Route::post('admin/delete-checked-imprv-opts', 'ImprovementOptionController@deleteSelected');
        // Location Routes
        Route::get('admin/locations', 'LocationController@index')->name('locations');
        Route::get('admin/locations/edit/{slug}', 'LocationController@edit')->name('editLocations');
        Route::post('admin/store-location', 'LocationController@store');
        Route::get('admin/locations/search', 'LocationController@index')->name('searchLocations');
        Route::post('admin/locations/delete', 'LocationController@destroy');
        Route::post('admin/locations/update/{id}', 'LocationController@update');
        Route::post('admin/get-location-flag', 'LocationController@getFlag');
        Route::post('admin/delete-checked-locations', 'LocationController@deleteSelected');
        // Services Routes
        Route::get('admin/services', 'ServiceController@index')->name('services');
        Route::get('admin/services/edit/{slug}', 'ServiceController@edit')->name('editServices');
        Route::post('admin/store-service', 'ServiceController@store');
        Route::get('admin/services/search', 'ServiceController@index')->name('searchServices');
        Route::post('admin/services/delete', 'ServiceController@destroy');
        Route::post('admin/services/update/{id}', 'ServiceController@update');
        Route::post('admin/delete-checked-services', 'ServiceController@deleteSelected');
        //Home Page Settings Route
        Route::get('admin/settings/home-page-settings', 'SiteManagementController@homePageSettings')->name('homePageSettings');
        Route::get('admin/settings/general-settings', 'SiteManagementController@generalSettings')->name('generalSettings');
        Route::post('admin/store/reg-form-settings', 'SiteManagementController@storeRegistrationSettings')->name('storeRegFormSettings');
        Route::post('admin/store/home-slider-settings', 'SiteManagementController@storeHomeSliderSettings')->name('storeHomeSettings');
        Route::post('admin/store/home-search-banner-settings', 'SiteManagementController@storeHomeSearchBannerSettings')->name('storeSearchBannerSettings');
        Route::post('admin/store/home-about-us-settings', 'SiteManagementController@storeHomeAboutUsSettings')->name('storeAboutUsSettings');
        Route::post('admin/store/home-how-works-settings', 'SiteManagementController@storeHowItWorksSettings')->name('storeHowItWorksSettings');
        Route::post('admin/store/home-service-tabs-settings', 'SiteManagementController@storeServiceTabsSettings')->name('storeServiceTabsSettings');
        Route::post('admin/store/home-seo-settings', 'SiteManagementController@storeSeoSettings');
        Route::post('admin/store/home-how-work-tabs-settings', 'SiteManagementController@storeHowWorkTabSettings')->name('storeHowWorkTabSettings');
        Route::post('admin/store/doctor-slider-section-settings', 'SiteManagementController@storeDoctorSliderSettings');
        Route::post('admin/store/home-download-app-settings', 'SiteManagementController@storeDownloadAppSecSettings')->name('storeDownloadAppSecSettings');
        Route::post('admin/store/article-section-settings', 'SiteManagementController@storeArticleSectionSettings')->name('storeArticleSectionSettings');
        Route::get('admin/get-homeslider-slides', 'SiteManagementController@getHomeSliderSlides');
        Route::get('admin/get-home-sections-display-settings', 'SiteManagementController@getHomeSectionsDisplaySettings');
        Route::get('admin/get-home-service-section-color', 'SiteManagementController@getHomeServiceSectionsColorSettings');
        Route::get('admin/settings/home-page-settings/services-section', 'SiteManagementController@homePageSettings')->name('homeServicesSection');
        // General Settings
        Route::post('admin/store/settings', 'SiteManagementController@storeGeneralSettings');
        Route::post('admin/store/sidebar-settings', 'SiteManagementController@storeSidebarSettings');
        Route::post('admin/store/forum-settings', 'SiteManagementController@storeforumSettings');
        Route::post('admin/store/topbar-settings', 'SiteManagementController@storeTopBarSettings');
        Route::post('admin/store/booking-settings', 'SiteManagementController@storeAppointmentBookingSettings');
        Route::get('admin/import-update', 'SiteManagementController@importUpdate');
        Route::post('admin/store/theme-styling-settings', 'SiteManagementController@storeThemeStylingSettings');
        Route::post('admin/store/social-settings', 'SiteManagementController@storeSocialSettings');
        Route::post('admin/store/footer-settings', 'SiteManagementController@storeFooterSettings');
        Route::get('admin/get-theme-color-display-setting', 'SiteManagementController@getThemeColorDisplaySetting');
        Route::get('admin/get-theme-language-setting', 'SiteManagementController@getThemeLanguageSetting');
        Route::get('admin/get-topbar-switch-settings', 'SiteManagementController@getTopbarSwicthSettings');
        Route::get('admin/get-booking-switch-settings', 'SiteManagementController@getBookingSwicthSettings');
        Route::get('admin/get-footer-settings', 'SiteManagementController@getFooterSettings');
        Route::get('admin/get-chat-display-setting', 'SiteManagementController@getchatDisplaySetting');
        Route::get('admin/get-sidebar-display-setting', 'SiteManagementController@getSidebarSetting');
        Route::post('admin/store/upload-icons', 'SiteManagementController@storeDashboardIcons');
        Route::get('admin/get-roles', 'SiteManagementController@getRoles')->name('getRoles');
        Route::post('admin/update-role', 'SiteManagementController@updateRole')->name('updateRole');
        Route::post('admin/clear-cache', 'SiteManagementController@clearCache');
        Route::get('admin/clear-allcache', 'SiteManagementController@clearAllCache');
        Route::get('admin/import-demo', 'SiteManagementController@importDemo');
        Route::get('admin/remove-demo', 'SiteManagementController@removeDemoContent');
        Route::post('admin/store/chat-settings', 'SiteManagementController@storeChatSettings');
        Route::post('admin/store/email-settings', 'SiteManagementController@storeEmailSettings');
        Route::post('admin/store/payment-settings', 'SiteManagementController@storePaymentSettings');
        Route::post('admin/store/paypal-settings', 'SiteManagementController@storePaypalSettings');
        Route::post('admin/store/stripe-settings', 'SiteManagementController@storeStripeSettings');
        //Appointment Interval Routes
        Route::get('admin/appointment-interval', 'AppointmentIntervalController@index')->name('appointment-interval');
        Route::get('admin/appointment-interval/edit/{slug}', 'AppointmentIntervalController@edit')->name('edit-appointment-interval');
        Route::post('admin/store-appointment-interval', 'AppointmentIntervalController@store');
        Route::get('admin/appointment-interval/search', 'AppointmentIntervalController@index')->name('search-appointment-interval');
        Route::post('admin/appointment-interval/delete', 'AppointmentIntervalController@destroy');
        Route::post('admin/appointment-interval/update/{id}', 'AppointmentIntervalController@update');
        Route::post('admin/delete-checked-appnt-intrvl', 'AppointmentIntervalController@deleteSelected');
        // Appointment Duration Routes
        Route::get('admin/appointment-duration', 'AppointmentDurationController@index')->name('appointment-duration');
        Route::get('admin/appointment-duration/edit/{slug}', 'AppointmentDurationController@edit')->name('edit-appointment-duration');
        Route::post('admin/store-appointment-duration', 'AppointmentDurationController@store');
        Route::get('admin/appointment-duration/search', 'AppointmentDurationController@index')->name('search-appointment-duration');
        Route::post('admin/appointment-duration/delete', 'AppointmentDurationController@destroy');
        Route::post('admin/appointment-duration/update/{id}', 'AppointmentDurationController@update');
        Route::post('admin/delete-checked-appnt-dur', 'AppointmentDurationController@deleteSelected');
        // Pages Routes
        Route::get('admin/pages', 'PageController@index')->name('pages');
        Route::get('admin/create/page', 'PageController@create')->name('createPage');
        Route::get('admin/pages/edit-page/{id}', 'PageController@edit')->name('editPage');
        Route::post('admin/store-page', 'PageController@store');
        Route::get('admin/pages/search', 'PageController@index');
        Route::post('admin/pages/delete-page', 'PageController@destroy');
        Route::post('admin/pages/update-page', 'PageController@update');
        Route::post('admin/delete-checked-pages', 'PageController@deleteSelected');
        Route::post('admin/get-page-option', 'SiteManagementController@getPageOption');
        Route::post('admin/get/innerpage-settings', 'SiteManagementController@getInnerPageSettings');
        Route::post('admin/store/innerpage-settings', 'SiteManagementController@storeInnerPageSettings');
        //All packages
        Route::get('admin/packages', 'PackageController@create')->name('createPackage');
        Route::get('admin/packages/search', 'PackageController@create');
        Route::get('admin/packages/edit/{id}', 'PackageController@edit')->name('editPackage');
        Route::post('admin/packages/update', 'PackageController@update');
        Route::post('admin/store/package', 'PackageController@store');
        Route::post('admin/packages/delete-package', 'PackageController@destroy');
        Route::post('package/get-package-options', 'PackageController@getPackageOptions');
        Route::get('admin/payouts', 'UserController@getPayouts')->name('adminPayouts');
        Route::get('admin/payouts/download/{year}/{month}', 'UserController@generatePDF');
        Route::get('admin/get/site-payment-option', 'SiteManagementController@getSitePaymentOption');
        Route::get('admin/email-templates', 'EmailTemplateController@index')->name('emailTemplates');
        Route::get('admin/email-templates/filter-templates', 'EmailTemplateController@index')->name('emailTemplates');
        Route::get('admin/email-templates/{id}', 'EmailTemplateController@edit')->name('editEmailTemplates');
        Route::post('admin/email-templates/update-content', 'EmailTemplateController@updateTemplateContent');
        Route::post('admin/email-templates/update-templates/{id}', 'EmailTemplateController@update');
        // Get user listing
	Route::get('users', 'UserController@userListing')->name('manageUsers');
	Route::get('feedbacks', 'UserController@userFeedbacksListing')->name('manageFeedbacks');
	Route::post('admin/delete-feedback', 'UserController@deleteFeedback')->name('adminDeleteFeedback');
        Route::post('admin/delete-user', 'UserController@deleteUser')->name('adminDeleteUser');
        Route::get('admin/edit-user/{id}', 'UserController@editUser')->name('adminEditUser');
        Route::get('admin/add-user', 'UserController@createUser')->name('adminAddUser');
        Route::post('admin/edit-user-detail', 'UserController@updateUserProfileSettings');
        Route::post('admin/create-user', 'UserController@storeUser');
    }
);
//Doctor Routes
Route::group(
    ['middleware' => ['role:doctor']],
    function () {
        Route::get('doctor/packages', 'PackageController@index')->name('doctorPackages');
        Route::get('doctor/package-checkout/{id}', 'DoctorController@checkout')->name('doctorCheckout');
        // Route::get('doctor/dashboard', 'DoctorController@doctorDashboard')->name('doctorDashboard');
        Route::post('doctor/store-award-downloads', 'DoctorController@storeAwardDownloadSettings')->name('storeAwardDownloadSettings');
        Route::get('doctor/get-awards', 'DoctorController@getDoctorAwards')->name('getDoctorAwards');
        Route::post('doctor/store/experiences', 'DoctorController@storeExperiences')->name('storeExperiences');
        Route::post('doctor/store/educations', 'DoctorController@storeEducations')->name('storeEducations');
        Route::get('doctor/get-experiences', 'UserController@getExperiences');
        Route::get('doctor/get-educations', 'UserController@getEducations');
        Route::get('appointment-settings', 'DoctorController@addLocation')->name('addAppointmentLocation');
        Route::get('appointment-detail/{id}', 'DoctorController@editLocation')->name('editLocation');
        Route::post('doctor/store/appointment-location', 'DoctorController@storeAppointmentLocation');
        Route::post('doctor/update/slots/{id}', 'DoctorController@updateSlots');
        Route::post('doctor/update-day-slots/{id}', 'DoctorController@storeSelectedDaySlots');
        Route::post('doctor/update-location-services/{id}', 'DoctorController@updateLocationServices');
	Route::post('doctor/delete-slots/{slot_id}/{day}/{id}', 'DoctorController@deleteSlots');
	Route::post('doctor/delete-appointset/{id}', 'DoctorController@deleteAppointset');
        Route::post('doctor/delete-all-slots/{day}/{id}', 'DoctorController@deleteAllSlots');
        Route::get('doctor/appointments', 'DoctorController@showAppointments')->name('doctorAppointments');;
	Route::post('doctor/get-appointments', 'DoctorController@getAppointments');
	Route::post('doctor/get-appointments-recent', 'DoctorController@getAppointmentsRecent');
        Route::get('doctor/payout-settings', 'DoctorController@payoutSettings')->name('doctorPayoutsSettings');
        Route::get('doctor/payouts', 'DoctorController@getPayouts')->name('getDoctorPayouts');
        Route::post('doctor/accept-appointment', 'DoctorController@acceptAppointment');
        Route::post('doctor/decline-appointment', 'DoctorController@declineAppointment');
    }
);
Route::group(
    ['middleware' => ['role:admin|doctor|hospital|regular']],
    function () {
        Route::get('user/products/thankyou', 'UserController@thankyou');
        Route::post('user/store-registration-detail', 'UserController@storeRegistrationSettings')->name('storeRegistrationSettings');
        // Account Settings Routes
        Route::get('profile/settings/account-settings', 'UserController@accountSettings')->name('accountSettings');
        Route::get('profile/settings/reset-password', 'UserController@resetPassword')->name('resetPassword');
        Route::post('profile/settings/request-password', 'UserController@requestPassword');
        Route::get('profile/settings/email-notification-settings', 'UserController@emailNotificationSettings')->name('emailNotificationSettings');
        Route::post('profile/settings/save-email-settings', 'UserController@saveEmailNotificationSettings');
        Route::post('profile/settings/save-account-settings', 'UserController@saveAccountSettings');
        Route::get('profile/settings/delete-account', 'UserController@deleteAccount')->name('deleteAccount');
        Route::post('user/settings/delete-account', 'UserController@destroy');
        Route::get('profile/settings/get-user-searchable-settings', 'UserController@getUserSearchableSettings');
        Route::get('checkout/{id}/{booknowoptioncheck}/{selectconferenceitems}', 'UserController@checkout')->name('checkout');
        Route::post('user/update-payout-detail', 'UserController@updatePayoutDetail');
        Route::get('user/get-payout-detail', 'UserController@getPayoutDetail');
        Route::get('{role_type}/profile-settings', 'UserController@userProfileSettings')->name('profileSettings');
        Route::post('{role_type}/store-personal-detail', 'UserController@storeUserProfileSettings')->name('storeUserProfileSettings');
        Route::post('{role_type}/store-gallery', 'UserController@storeUserGallery');
    }
);
Route::group(
    ['middleware' => ['role:admin|doctor']],
    function () {
        Route::get('create-article', 'ArticleController@createArticle')->name('createArticle');
        Route::get('edit-article/{slug}', 'ArticleController@editArticle')->name('editArticle');
        Route::post('get-stored-cats', 'ArticleController@getStoredCategories')->name('getAllCategories');
        Route::post('get-article-cats', 'ArticleController@getArticleCats');
        Route::post('post/article', 'ArticleController@postArticle')->name('postArticle');
        Route::post('update/article', 'ArticleController@updateArticle')->name('updateArticle');
        Route::post('delete/article', 'ArticleController@destroy')->name('deleteArticle');
        Route::post('get/featured-article', 'ArticleController@getFeaturedArticleSetting')->name('getFeaturedArticleSetting');
    }
);
Route::group(
    ['middleware' => ['role:doctor|regular']],
    function () {
        Route::get('user/invoice', 'UserController@getUserInvoices')->name('userInvoice');
        Route::get('show/invoice/{id}', 'UserController@showInvoice')->name('showInvoice');
    }
);
Route::group(
    ['middleware' => ['role:regular']],
    function () {
        Route::get('patient/appoinements/{id?}', 'PatientController@showAppointments')->name('userAppointments');
	Route::post('patient/get-appointments', 'PatientController@getAppointments');
	Route::post('patient/get-appointments-recent', 'PatientController@getAppointmentsRecent');
    }
);
Route::group(
    ['middleware' => ['role:hospital']],
    function () {
        Route::get('hospital/manage-team', 'HospitalController@doctorListing')->name('manageTeams');
        Route::post('hospital/approve-user', 'HospitalController@approveUser')->name('approveUser');
        Route::post('hospital/reject-user', 'HospitalController@rejectUser')->name('rejectUser');
        Route::post('hospital/delete-user', 'HospitalController@deleteUser')->name('deleteUser');
    }
);
Route::fallback(
    function () {
        return View('errors.404 ');
    }
);
Route::post('submit-appointment', 'PublicController@submitAppointment');
Route::get('/getcountryoptstate', 'PublicController@getcountryoptstate');
Route::post('verify-appointment-password', 'PublicController@verifyAppointmentPassword');
Route::post('verify-appointment-code', 'PublicController@verifyAppointmentCode');
Route::post('doctor/get-hospital-services', 'DoctorController@getHospitalServices');
Route::get('paypal/redirect-url', 'PaypalController@getIndex');
Route::get('paypal/ec-checkout', 'PaypalController@getExpressCheckout');
Route::get('paypal/ec-checkout-success', 'PaypalController@getExpressCheckoutSuccess');
Route::get('addmoney/stripe', array('as' => 'addmoney.paywithstripe', 'uses' => 'StripeController@payWithStripe',));
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe', 'uses' => 'StripeController@postPaymentWithStripe',));
Route::post('stripe/generate-order', 'StripeController@generateOrder');
Route::get('search-results', 'PublicController@getSearchResult')->name('searchResults');
Route::get('contactus', 'PublicController@getContactus');
Route::get('contactus-success', 'PublicController@getContactusMessagesent');
Route::post('contactus/sendmessage', 'PublicController@sendcontactMessage');
Route::post('submit-feedback', 'PublicController@submitFeedack');
Route::post('message/send-private-message', 'MessageController@store');
Route::get('message-center', 'MessageController@index')->name('message');
Route::get('message-center/get-users', 'MessageController@getUsers');
Route::post('message-center/get-messages', 'MessageController@getUserMessages');
Route::post('message', 'MessageController@store')->name('message.store');
Route::get('get-user-specialities', 'UserController@getSpecialities');
Route::post('user/speciality_delete/{speciality_index}/{service_index?}', 'UserController@destroySpeciality');
Route::post('get-doctor-education', 'PublicController@getDoctorEducations')->name('getDoctorEducations');
Route::post('get-doctor-experience', 'PublicController@getDoctorExperiences')->name('getDoctorExperiences');
Route::post('store-appointment-data', 'PublicController@storeAppointmentInSession');
Route::get('health-forum', 'ForumController@index')->name('forumQuestions');
Route::get('health-forum/search-query', 'ForumController@index')->name('searchQueryFilter');
Route::get('health-forum/filter-questions', 'ForumController@index')->name('getFilteredQuestions');
Route::post('health-forum/post-question', 'ForumController@store')->name('storeForumQuestions');
Route::get('health-forum/{slug}', 'ForumController@getForumAnswers')->name('getForumAnswers');
Route::post('health-forum/post-answer', 'ForumController@postAnswer')->name('ForumAnswers');
Route::post('user/store/services', 'UserController@storeServices');
Route::post('send/app-link', 'PublicController@sendDownloadAppEmail');
Route::post('register/login-register-user', 'PublicController@loginUser')->name('loginUser');
Route::post('register/verify-user-code', 'PublicController@verifyUserCode');
Route::post('register/form-step1-custom-errors', 'PublicController@RegisterStep1Validation');
Route::post('register/form-step2-custom-errors', 'PublicController@RegisterStep2Validation');
Route::get('profile/{slug}', 'PublicController@showProfile')->name('userProfile');
Route::get('profile/{slug}/{sessionparameter}', 'PublicController@showProfileParameter');
Route::get('get-specialities', 'SpecialityController@getSpecialities');
Route::post('get-speciality-service', 'SpecialityController@getSpecialityService');
Route::post('get-speciality-services', 'SpecialityController@getServices');
Route::get('articles/{category?}', 'ArticleController@articleListing')->name('articleListing');
Route::get('article/{slug}', 'ArticleController@articleDetail')->name('articleDetail');
Route::get('search/get-hospitals', 'UserController@getHospitals');
Route::get('page/{slug}', 'PageController@show')->name('showPage');
Route::get('{role}/saved-items', 'UserController@getSavedItems')->name('getSavedItems');
Route::get('{role}/dashboard', 'UserController@getDashboard')->name('dashboard');
Route::post('media/upload-temp-image/{type}/{file_name}/{img_type?}', 'MediaController@uploadTempImage');
Route::post('doctor/get-appointment-slots', 'DoctorController@getAppointmentSlots');
Route::get('/bulksmswork', 'BulkSmsController@sendSms');
Route::get('/vonagesmswork', 'NexmoSmsController@sendSmsMessage');
Route::get('/beforeAppointmentcheck', 'PublicController@beforeAppointmentcheck');
// attachments
Route::get('get/{type}/{id}/{filename}', 'MediaController@getFile')->name('getfile');
