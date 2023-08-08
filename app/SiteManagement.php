<?php

/**
 * Class SiteManagement
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use DB;
use File;
use Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SiteManagement
 *
 */
class SiteManagement extends Model
{
    /**
     * Get Meta Values form meta keys.
     *
     * @param string $meta_key meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function getMetaValue($meta_key)
    {
        if (!empty($meta_key)) {
            $data = DB::table('site_managements')->select('meta_value')->where('meta_key', $meta_key)->get()->first();
            if (!empty($data)) {
                $fixed_data = preg_replace_callback(
                    '!s:(\d+):"(.*?)";!',
                    function ($match) {
                        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                    },
                    $data->meta_value
                );
                return unserialize($fixed_data);
            }
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHomeSliderSettings($request)
    {
        if (!empty($request)) {
            $slides = $request['slide'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            $slider_bg_img_data = DB::table('site_managements')->where('meta_key', '=', 'slider_bg_img')->select('meta_value')->first();
            $existing_data = SiteManagement::getMetaValue('home_slider');
            if (!empty($slides)) {
                foreach ($slides as $key => $home) {
                    $slides[$key]['slide_title_one'] = $home['slide_title_one'];
                    $slides[$key]['slide_title_two'] = $home['slide_title_two'];
                    $slides[$key]['slide_title_three'] = $home['slide_title_three'];
                    $slides[$key]['slide_btn_title_one'] = $home['slide_btn_title_one'];
                    $slides[$key]['slide_btn_url_one'] = $home['slide_btn_url_one'];
                    $slides[$key]['slide_btn_title_two'] = $home['slide_btn_title_two'];
                    $slides[$key]['slide_btn_url_two'] = $home['slide_btn_url_two'];
                    if (empty($home['hidden_slide_inner_image'])) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.slider_inner_image_required');
                        return $json;
                    } else {
                        if (file_exists($old_path . '/' . $home['hidden_slide_inner_image'])) {
                            if (!file_exists($new_path)) {
                                File::makeDirectory($new_path, 0755, true, true);
                            }
                            $filename = time() . '-' . $home['hidden_slide_inner_image'];
                            rename($old_path . '/' . $home['hidden_slide_inner_image'], $new_path . '/' . $filename);
                            $slides[$key]['hidden_slide_inner_image'] = $filename;
                        }
                    }
                }
                //Saving slides
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', '=', 'home_slider')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'home_slider', 'meta_value' => serialize($slides),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            } else {
                DB::table('site_managements')->where('meta_key', '=', 'home_slider')->delete();
            }
            if (!empty($request['slider_bg_img'])) {
                if (file_exists($old_path . '/' . $request['slider_bg_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['slider_bg_img'];
                    rename($old_path . '/' . $request['slider_bg_img'], $new_path . '/' . $filename);
                    $request['slider_bg_img'] = $filename;
                }
                if (!empty($slider_bg_img_data->meta_value)) {
                    DB::table('site_managements')->where('meta_key', '=', 'slider_bg_img')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'slider_bg_img', 'meta_value' => $request['slider_bg_img'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            } else {
                DB::table('site_managements')->where('meta_key', '=', 'slider_bg_img')->delete();
            }
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request    req->attr
     * @param array  $image_size image_size
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHomeSearchBannerSettings($request, $image_size = array())
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_search_banner_img'])) {
                if (file_exists($old_path . '/' . $request['hidden_search_banner_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_search_banner_img'];
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $request['hidden_search_banner_img'], $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['hidden_search_banner_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['hidden_search_banner_img'], $new_path . '/' . $filename);
                    }
                    $request['hidden_search_banner_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('home_search_banner');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'home_search_banner')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'home_search_banner', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHomeAboutUsSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_about_us_img'])) {
                if (file_exists($old_path . '/' . $request['hidden_about_us_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_about_us_img'];
                    rename($old_path . '/' . $request['hidden_about_us_img'], $new_path . '/' . $filename);
                    $request['hidden_about_us_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('home_about_us_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'home_about_us_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'home_about_us_sec', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store registration settings
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveRegistrationSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/registration-form';
            if (!empty($request['hidden_register_image'])) {
                if (file_exists($old_path . '/' . $request['hidden_register_image'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_register_image'];
                    rename($old_path . '/' . $request['hidden_register_image'], $new_path . '/' . $filename);
                    $request['hidden_register_image'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('reg_form_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'reg_form_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'reg_form_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHowItWorksSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('home_how_works_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'home_how_works_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'home_how_works_sec', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveServiceTabsSettings($request)
    {
        $json = array();
        if (!empty($request)) {
            $service_tabs = $request['service_tab'];
            foreach ($service_tabs as $key => $tab) {
                if (empty($tab['title']) || empty($tab['subtitle']) || empty($tab['btn_title']) || empty($tab['btn_url']) || empty($tab['color'])) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.empty_fields_not_allowed');
                    return $json;
                }
                $service_tabs[$key]['title'] = $tab['title'];
                $service_tabs[$key]['subtitle'] = $tab['subtitle'];
                $service_tabs[$key]['btn_title'] = $tab['btn_title'];
                $service_tabs[$key]['btn_url'] = $tab['btn_url'];
                $service_tabs[$key]['color'] = $tab['color'];
            }

            $existing_data = SiteManagement::getMetaValue('services_tab_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'services_tab_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'services_tab_sec', 'meta_value' => serialize($service_tabs),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            $existing_tab_setting = self::where('meta_key', 'show_services_section')->select('meta_value')->pluck('meta_value')->first();
            if (!empty($existing_tab_setting)) {
                DB::table('site_managements')->where('meta_key', '=', 'show_services_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'show_services_section', 'meta_value' => $request['show_services_section'],
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHowWorksTabSettings($request)
    {
        if (!empty($request)) {
            $how_works_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($how_works_tabs)) {
                foreach ($how_works_tabs as $key => $hw_tab) {
                    $how_works_tabs[$key]['title'] = $hw_tab['title'];
                    $how_works_tabs[$key]['subtitle'] = $hw_tab['subtitle'];
                    if (!empty($hw_tab['tab_img'])) {
                        if (file_exists($old_path . '/' . $hw_tab['tab_img'])) {
                            if (!file_exists($new_path)) {
                                File::makeDirectory($new_path, 0755, true, true);
                            }
                            $filename = time() . '-' . $hw_tab['tab_img'];
                            rename($old_path . '/' . $hw_tab['tab_img'], $new_path . '/' . $filename);
                            $how_works_tabs[$key]['tab_img'] = $filename;
                        }
                    } else {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.tab_image_required');
                        return $json;
                    }
                }
                $existing_data = SiteManagement::getMetaValue('how_work_tabs');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'how_work_tabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'how_work_tabs', 'meta_value' => serialize($how_works_tabs),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_how_work_tabs')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_how_work_tabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_how_work_tabs', 'meta_value' => $request['show_hwtabs'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request    req->attr
     * @param array  $image_size image_size
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveDownloadAppSecSettings($request, $image_size = array())
    {
        $old_path = Helper::PublicPath() . '/uploads/settings/temp';
        $new_path = Helper::PublicPath() . '/uploads/settings/home';
        if (!empty($request)) {
            if (!empty($request['app_sec_img'])) {
                if (file_exists($old_path . '/' . $request['app_sec_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['app_sec_img'];
                    rename($old_path . '/' . $request['app_sec_img'], $new_path . '/' . $filename);
                    $request['app_sec_img'] = $filename;
                }
            }
            if (!empty($request['android_img'])) {
                if (file_exists($old_path . '/' . $request['android_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['android_img'];
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $request['android_img'], $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['android_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['android_img'], $new_path . '/' . $filename);
                    }
                    $request['android_img'] = $filename;
                }
            }
            if (!empty($request['ios_img'])) {
                if (file_exists($old_path . '/' . $request['ios_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['ios_img'];
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $request['ios_img'], $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['ios_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['ios_img'], $new_path . '/' . $filename);
                    }
                    $request['ios_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('download_app_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'download_app_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'download_app_sec', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveGeneralSettings($request)
    {
        $json = array();
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general';
            if (!empty($request['site_logo'])) {
                if (file_exists($old_path . '/' . $request['site_logo'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['site_logo'];
                    rename($old_path . '/' . $request['site_logo'], $new_path . '/' . $filename);
                    $request['site_logo'] = $filename;
                }
            }
            if (!empty($request['site_favicon'])) {
                if (file_exists($old_path . '/' . $request['site_favicon'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['site_favicon'];
                    rename($old_path . '/' . $request['site_favicon'], $new_path . '/' . $filename);
                    $request['site_favicon'] = $filename;
                }
            }
            if (!empty($request['language'])) {
                if (
                    File::exists(resource_path('lang/' . $request['language'] . '/lang.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/auth.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/pagination.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/passwords.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/validation.php'))
                ) {
                    Helper::changeEnv(
                        [
                            'APP_LANG' => $request['language'],
                        ]
                    );
                } else {
                    return 'lang_not_found';
                }
            } else {
                return 'lang_not_found';
            }
            $existing_data = SiteManagement::getMetaValue('general_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'general_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'general_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            \Artisan::call('config:cache');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            \Artisan::call('view:clear');
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Save settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveSidebarSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general';
            if (!empty($request['hidden_ask_query_img'])) {
                if (file_exists($old_path . '/' . $request['hidden_ask_query_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_ask_query_img'];
                    rename($old_path . '/' . $request['hidden_ask_query_img'], $new_path . '/' . $filename);
                    $request['hidden_ask_query_img'] = $filename;
                }
            }
            if (!empty($request['hidden_download_app_img'])) {
                if (file_exists($old_path . '/' . $request['hidden_download_app_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_download_app_img'];
                    rename($old_path . '/' . $request['hidden_download_app_img'], $new_path . '/' . $filename);
                    $request['hidden_download_app_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('sidebar_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'sidebar_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'sidebar_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveforumSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general';
            if (!empty($request['hidden_forum_banner_image'])) {
                if (file_exists($old_path . '/' . $request['hidden_forum_banner_image'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_forum_banner_image'];
                    rename($old_path . '/' . $request['hidden_forum_banner_image'], $new_path . '/' . $filename);
                    $request['hidden_forum_banner_image'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('forum_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'forum_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'forum_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save topbar settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveTopBarSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('topbar_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'topbar_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'topbar_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save seo settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveSeoSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('seo_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'seo_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'seo_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save appointment booking settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveBookingSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('booking_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'booking_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'booking_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save social settings
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveSocialSettings($request)
    {
        $socials = $request;
        if (!empty($socials)) {
            foreach ($socials as $socail) {
                if (($socail['title'] == 'Select Social Icons' || $socail['url'] == null)) {
                    return 'error';
                }
            }
            $existing_social = SiteManagement::getMetaValue('socials');
            if (!empty($existing_social)) {
                DB::table('site_managements')->where('meta_key', '=', 'socials')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'socials', 'meta_value' => serialize($socials),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save footer settings
     *
     * @param string $request    meta_key
     * @param array  $image_size image_size
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveFooterSettings($request, $image_size = array())
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general/footer';
            if (!empty($request['c_info_img_one'])) {
                if (file_exists($old_path . '/' . $request['c_info_img_one'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['c_info_img_one'];
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $request['c_info_img_one'], $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['c_info_img_one'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['c_info_img_one'], $new_path . '/' . $filename);
                    }
                    $request['c_info_img_one'] = $filename;
                }
            }
            if (!empty($request['c_info_img_two'])) {
                if (file_exists($old_path . '/' . $request['c_info_img_two'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['c_info_img_two'];
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $request['c_info_img_two'], $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['c_info_img_two'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['c_info_img_two'], $new_path . '/' . $filename);
                    }
                    $request['c_info_img_two'] = $filename;
                }
            }
            if (!empty($request['footer_logo'])) {
                if (file_exists($old_path . '/' . $request['footer_logo'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['footer_logo'];
                    rename($old_path . '/' . $request['footer_logo'], $new_path . '/' . $filename);
                    $request['footer_logo'] = $filename;
                }
            }
            $customer_key = !empty($request['consumer_key']) ? $request['consumer_key'] : '';
            $customer_secret = !empty($request['consumer_secret']) ? $request['consumer_secret'] : '';
            $access_token = !empty($request['access_token']) ? $request['access_token'] : '';
            $access_token_secret = !empty($request['access_token_secret']) ? $request['access_token_secret'] : '';
            $existing_data = SiteManagement::getMetaValue('footer_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'footer_settings')->delete();
                Helper::changeEnv(
                    [
                        'TWITTER_CONSUMER_KEY' => "",
                        'TWITTER_CONSUMER_SECRET' => "",
                        'TWITTER_ACCESS_TOKEN' => "",
                        'TWITTER_ACCESS_TOKEN_SECRET' => "",
                    ]
                );
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'footer_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            
            Helper::changeEnv(
                [
                    'TWITTER_CONSUMER_KEY' => $customer_key,
                    'TWITTER_CONSUMER_SECRET' => $customer_secret,
                    'TWITTER_ACCESS_TOKEN' => $access_token,
                    'TWITTER_ACCESS_TOKEN_SECRET' => $access_token_secret,
                ]
            );
            \Artisan::call('config:cache');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store article section settings in storage
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveArticleSectionSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('article_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'article_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'article_section', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store doctor slider section settings in storage
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveDoctorsSliderSectionSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('doctors_slider');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'doctors_slider')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'doctors_slider', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save dashboard icons in storage
     *
     * @param string $request request
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveIcons($request)
    {
        $icon_array = array();
        if (!empty($request['icons'])) {
            $icons = $request['icons'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/icon';
            foreach ($icons as $key => $icon) {
                if (!empty($icon[$key])) {
                    if (file_exists($old_path . '/' . $icon[$key])) {
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = $icon[$key];
                        rename($old_path . '/' . $icon[$key], $new_path . '/' . time() . '-' . $filename);
                        $icon_array[$key] = time() . '-' . $filename;
                    } else {
                        $icon_array[$key] = $icon[$key];
                    }
                }
            }
            $existing_data = SiteManagement::getMetaValue('icons');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'icons')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'icons', 'meta_value' => serialize($icon_array),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save chat settings
     *
     * @param string $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveChatSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('chat_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'chat_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'chat_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save email settings
     *
     * @param string $request Email data
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveEmailSettings($request)
    {
        $email_data_array = array();
        $email_data = $request['email_data'];
        $old_path = Helper::PublicPath() . '/uploads/settings/temp';
        $new_path = Helper::PublicPath() . '/uploads/settings/email-settings';
        if (!empty($request)) {
            $email_data_array['from_email'] = $email_data['from_email'];
            $email_data_array['from_email_id'] = $email_data['from_email_id'];
            $email_data_array['sender_name'] = $email_data['sender_name'];
            $email_data_array['sender_tagline'] = $email_data['sender_tagline'];
            $email_data_array['sender_url'] = $email_data['sender_url'];
            if (!empty($request['email_logo'])) {
                if (file_exists($old_path . '/' . $request['email_logo'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['email_logo'];
                    rename($old_path . '/' . $request['email_logo'], $new_path . '/' . $filename);
                    $email_data_array['email_logo'] = $filename;
                } else {
                    $email_data_array['email_logo'] = $request['email_logo'];
                }
            }
            if (!empty($request['email_banner'])) {
                if (file_exists($old_path . '/' . $request['email_banner'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['email_banner'];
                    rename($old_path . '/' . $request['email_banner'], $new_path . '/' . $filename);
                    $email_data_array['email_banner'] = $filename;
                } else {
                    $email_data_array['email_banner'] = $request['email_banner'];
                }
            }
            if (!empty($request['sender_avatar'])) {
                if (file_exists($old_path . '/' . $request['sender_avatar'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['sender_avatar'];
                    rename($old_path . '/' . $request['sender_avatar'], $new_path . '/' . $filename);
                    $email_data_array['sender_avatar'] = $filename;
                } else {
                    $email_data_array['sender_avatar'] = $request['sender_avatar'];
                }
            }
            $existing_data = SiteManagement::getMetaValue('email_data');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'email_data')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'email_data', 'meta_value' => serialize($email_data_array),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
    /**
     * Save payment settings
     *
     * @param mixed $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function savePaymentSettings($request)
    {
        if (!empty($request)) {
            $currency = !empty($request) && !empty($request['currency']) ? $request['currency'] : '';
            $existing_data = SiteManagement::getMetaValue('payment_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'payment_settings')->delete();
                Helper::changeEnv(
                    [
                        'PAYMENT_SYMBOL' => '',
                    ]
                );
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'payment_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            Helper::changeEnv(
                [
                    'PAYMENT_SYMBOL' => $currency,
                ]
            );
            \Artisan::call('config:cache');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public function savePaypalSettings($request)
    {
        if (!empty($request)) {
            $enable_sandbox = $request['enable_sandbox'];
            $client_id = $request['client_id'];
            $paypal_password = $request['paypal_password'];
            $paypal_secret = $request['paypal_secret'];
            $paypal_settings = array();
            $paypal_settings['client_id'] = !empty($client_id) ? $client_id : '';
            $paypal_settings['paypal_password'] = !empty($paypal_password) ? $paypal_password : '';
            $paypal_settings['paypal_secret'] = !empty($paypal_secret) ? $paypal_secret : '';
            $paypal_settings['enable_sandbox'] = !empty($enable_sandbox) ? $enable_sandbox : '';
            if (!empty($paypal_settings)) {
                $existing_paypal_settings = SiteManagement::getMetaValue('paypal_settings');
                if (!empty($existing_paypal_settings)) {
                    DB::table('site_managements')->where('meta_key', '=', 'paypal_settings')->delete();
                    Helper::changeEnv(
                        [
                            'PAYPAL_LIVE_API_USERNAME' => "",
                            'PAYPAL_LIVE_API_PASSWORD' => "",
                            'PAYPAL_LIVE_API_SECRET' => "",
                            'PAYPAL_SANDBOX_API_USERNAME' => "",
                            'PAYPAL_SANDBOX_API_PASSWORD' => "",
                            'PAYPAL_SANDBOX_API_SECRET' => "",
                        ]
                    );
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'paypal_settings', 'meta_value' => serialize($paypal_settings),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $new_paypal_settings = SiteManagement::getMetaValue('paypal_settings');
                if ($new_paypal_settings['enable_sandbox'] === 'true') {
                    Helper::changeEnv(
                        [
                            'PAYPAL_LIVE_API_USERNAME' => "",
                            'PAYPAL_LIVE_API_PASSWORD' => "",
                            'PAYPAL_LIVE_API_SECRET' => "",
                            'PAYPAL_SANDBOX_API_USERNAME' => $client_id,
                            'PAYPAL_SANDBOX_API_PASSWORD' => $paypal_password,
                            'PAYPAL_SANDBOX_API_SECRET' => $paypal_secret,
                            'PAYPAL_MODE' => 'sandbox',
                        ]
                    );
                } else {
                    Helper::changeEnv(
                        [
                            'PAYPAL_LIVE_API_USERNAME' => $client_id,
                            'PAYPAL_LIVE_API_PASSWORD' => $paypal_password,
                            'PAYPAL_LIVE_API_SECRET' => $paypal_secret,
                            'PAYPAL_SANDBOX_API_USERNAME' => "",
                            'PAYPAL_SANDBOX_API_PASSWORD' => "",
                            'PAYPAL_SANDBOX_API_SECRET' => "",
                            'PAYPAL_MODE' => 'live',
                        ]
                    );
                }
                \Artisan::call('config:cache');
                \Artisan::call('config:clear');
                \Artisan::call('cache:clear');
                return 'success';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Store stripe settings in storage.
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public function saveStripeSettings($request)
    {
        if (!empty($request)) {
            $stripe_key = $request['stripe_key'];
            $stripe_secret = $request['stripe_secret'];
            $payment_settings = array();
            $payment_settings['stripe_key'] = !empty($stripe_key) ? $stripe_key : '';
            $payment_settings['stripe_secret'] = !empty($stripe_secret) ? $stripe_secret : '';

            if (!empty($payment_settings)) {
                $existing_payment_settings = SiteManagement::getMetaValue('stripe_settings');
                if (!empty($existing_payment_settings)) {
                    DB::table('site_managements')->where('meta_key', '=', 'stripe_settings')->delete();
                    Helper::changeEnv(
                        [
                            'STRIPE_KEY' => "",
                            'STRIPE_SECRET' => "",
                        ]
                    );
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'stripe_settings', 'meta_value' => serialize($payment_settings),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                Helper::changeEnv(
                    [
                        'STRIPE_KEY' => $stripe_key,
                        'STRIPE_SECRET' => $stripe_secret,
                    ]
                );
                return 'success';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Save inner page settings
     *
     * @param string $request request
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveInnerPageSettings($request)
    {
        $inner_page_data_array = array();
        if (!empty($request)) {
            $inner_page = $request['inner_page'];
            $inner_page_data_array['search_list_meta_title'] = $inner_page['search_list_meta_title'];
            $inner_page_data_array['search_list_meta_desc'] = $inner_page['search_list_meta_desc'];
            $inner_page_data_array['show_search_form'] = $inner_page['show_search_form'];
            $inner_page_data_array['enable_breadcrumbs'] = $inner_page['enable_breadcrumbs'];
            $existing_data = SiteManagement::getMetaValue('inner_page_data');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'inner_page_data')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'inner_page_data', 'meta_value' => serialize($inner_page_data_array),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
}
