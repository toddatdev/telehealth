<?php

/**
 * Class Helper
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
use Auth;
use File;
use App\User;
use Storage;
use App\Location;
use App\Service;
use App\Payout;
use App\SiteManagement;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Speciality;
use Illuminate\Pagination\LengthAwarePaginator;
use Breadcrumbs;
use App\Appointment;
use Twitter;

// require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


/**
 * Class Helper
 *
 */
class Helper extends Model
{
    /**
     * Demo site refresh page
     *
     * @param string $message message text
     *
     * @access public
     *
     * @return string
     */
    public static function doctieIsDemoSite($message = '')
    {
        $message = !empty($message) ? $message : trans('lang.restricted_text');
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com') {
            return $message;
        }
    }

    /**
     * Demo site ajax request
     *
     * @param string $message message text
     *
     * @access public
     *
     * @return string
     */
    public static function doctieIsDemoSiteAjax($message = '')
    {
        $message = !empty($message) ? $message : trans('lang.restricted_text');
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com') {
            return response()->json(['message' => $message]);
        }
    }

    /**
     * Get Image Sizes Define your images sizes here
     *
     * @return string
     */
    public static function getImageSizes($type = '')
    {
        $image_sizes = array(
            'category' => array(
                'small' => array(
                    'width' => 50,
                    'height' => 50,
                ),
            ),
            'profile_gallery' => array(
                'small' => array(
                    'width' => 235,
                    'height' => 167,
                ),
            ),
            'location' => array(
                'extra-small' => array(
                    'width' => 18,
                    'height' => 11,
                ),
            ),
            'speciality' => array(
                'extra-small' => array(
                    'width' => 40,
                    'height' => 40,
                ),
                'small' => array(
                    'width' => 65,
                    'height' => 45,
                ),
            ),
            'banner_icon_img' => array(
                'small' => array(
                    'width' => 14,
                    'height' => 14,
                ),
            ),
            'banner_img' => array(
                'small' => array(
                    'width' => 200,
                    'height' => 250,
                ),
            ),
            'c_info_img' => array(
                'small' => array(
                    'width' => 45,
                    'height' => 40,
                ),
            ),
            'mobile_app' => array(
                'small' => array(
                    'width' => 110,
                    'height' => 36,
                ),
            ),
            'profile_banner' => array(
                'small' => array(
                    'width' => 270,
                    'height' => 150,
                ),
            ),
            'profile_img' => array(
                'small' => array(
                    'width' => 100,
                    'height' => 100,
                ),
                'extra-small' => array(
                    'width' => 48,
                    'height' => 48,
                ),
                'medium' => array(
                    'width' => 255,
                    'height' => 255,
                ),
                'saved_items' => array(
                    'width' => 217,
                    'height' => 217,
                ),
            ),
            'articles' => array(
                'list' => array(
                    'width' => 271,
                    'height' => 194,
                ),
                'listing' => array(
                    'width' => 308,
                    'height' => 220,
                ),
                'blog-single' => array(
                    'width' => 825,
                    'height' => 360,
                ),
                'extra-small' => array(
                    'width' => 40,
                    'height' => 40,
                ),
                'featured' => array(
                    'width' => 350,
                    'height' => 250,
                ),
            ),
        );
        if (!empty($type) && array_key_exists($type, $image_sizes)) {
            return $image_sizes[$type];
        } else {
            return '';
        }
    }

    /**
     * Store Temporary images
     *
     * @param mixed $temp_path Temporary Path.
     * @param object $file file.
     * @param string $type type
     * @param array $image_size Image Size.
     * @param string $img_type Image type.
     *
     * @return json response
     */
    public static function uploadTempImage($temp_path, $file, $type = "", $image_size = array(), $img_type = '')
    {
        $json = array();
        if (!empty($file)) {
            // create directory if not exist.
            if (!file_exists($temp_path)) {
                File::makeDirectory($temp_path, 0755, true, true);
            }
            $file_original_name = $file->getClientOriginalName();
            $parts = explode('.', $file_original_name);
            $extension = end($parts);
            $extension = $file->getClientOriginalExtension();
            if ($img_type == 'multiple_types') {
                Storage::disk('local_public')->putFileAs(
                    $type . '/temp/',
                    $file,
                    $file_original_name
                );
                $json['message'] = trans('lang.img_uploaded');
                $json['type'] = 'success';
                return $json;
            }
            if ($extension === "jpg" || $extension === "png" || $extension === 'gif') {
                if (!empty($image_size)) {
                    foreach ($image_size as $key => $size) {
                        $small_img = Image::make($file);
                        $small_img->fit(
                            $size['width'],
                            $size['height'],
                            function ($constraint) {
                                $constraint->upsize();
                            }
                        );
                        $small_img->save($temp_path . $key . '-' . $file_original_name);
                    }
                }
                // save original image size
                $img = Image::make($file);
                $img->save($temp_path . '/' . $file_original_name);
                $json['message'] = trans('lang.img_uploaded');
                $json['type'] = 'success';
                return $json;
            } elseif ($extension === 'ico') {
                Storage::disk('local_public')->putFileAs(
                    $type . '/temp/',
                    $file,
                    $file_original_name
                );
                $json['message'] = trans('lang.img_uploaded');
                $json['type'] = 'success';
                return $json;
            } else {
                $json['message'] = trans('lang.img_jpg_png');
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['message'] = trans('lang.image not found');
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * List category in tree format
     *
     * @param string $model Model Name should be in uppercase form
     * @param integer $parent_id Image
     * @param string $cat_indent Category Indentation Symbol
     *
     * @access public
     *
     * @return array
     */
    public static function listTreeCategories($model, $parent_id = 0, $cat_indent = '')
    {
        $parent_cat = array();
        if ($model === 'location') {
            $parent_cat = Location::select('title', 'id', 'parent')->where('parent', $parent_id)->get()->toArray();
        } elseif ($model === 'service') {
            $parent_cat = Service::select('title', 'id', 'parent')->where('parent', $parent_id)->get()->toArray();
        }
        foreach ($parent_cat as $key => $value) {
            echo '<option value="' . $value['id'] . '">' . $cat_indent . $value['title'] . '</option>';
            self::listTreeCategories('', $value['id'], $cat_indent . '—');
        }
    }

    /**
     * Get public path
     *
     * @return \Illuminate\Http\Response
     */
    public static function publicPath()
    {
        $path = public_path();
//        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] != '127.0.0.1') {
//            $path = getcwd();
//        }
        return $path;
    }

    /**
     * Get storage public disk
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPublicStorageDisk()
    {
        $disk = 'local_public';
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] != '127.0.0.1') {
            $disk = 'live_public';
        }
        return $disk;
    }

    /**
     * Get image
     *
     * @param string $path image path
     * @param string $image image
     * @param string $size size
     * @param string $default default image
     *
     * @access public
     *
     * @return string
     */
    public static function getImage($path, $image, $size = '', $default = '')
    {
        $image_output = '';
        if (!empty($path) && !empty($image)) {
            $file = $path . '/' . $size . $image;
            if (file_exists($file)) {
                if (!empty($size)) {
                    $image_output = $path . '/' . $size . $image;
                } else {
                    $image_output = $path . '/' . $image;
                }
            } else {
                $image_output = 'images/' . $default;
            }
        } else {
            $image_output = 'images/' . $default;
        }
        return html_entity_decode(clean($image_output));
    }

    /**
     * Generate random code
     *
     * @param integer $limit Limit of numbers
     *
     * @access public
     *
     * @return array
     */
    public static function generateRandomCode($limit)
    {
        if (!empty($limit) && is_numeric($limit)) {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        }
    }

    /**
     * Get role by userID
     *
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleByUserID($user_id)
    {
        $role = DB::table('model_has_roles')->select('role_id')->where('model_id', $user_id)
            ->first();
        return $role->role_id;
    }

    /**
     * Get role by userID
     *
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleTypeByUserID($user_id)
    {
        $role = DB::table('model_has_roles')->select('role_id')->where('model_id', $user_id)
            ->first();
        if (!empty($role)) {
            $role_type = Role::select('role_type')->where('id', $role->role_id)->pluck('role_type')->first();
        }
        return !empty($role_type) ? $role_type : '';
    }

    /**
     * Get auth role type
     *
     * @access public
     *
     * @return array
     */
    public static function getAuthRoleType()
    {
        if (Auth::user()) {
            $role = DB::table('model_has_roles')->select('role_id')->where('model_id', Auth::user()->id)
                ->first();
            if (!empty($role)) {
                $role_type = Role::select('role_type')->where('id', $role->role_id)->pluck('role_type')->first();
            }
            return !empty($role_type) ? $role_type : '';
        }
    }

    /**
     * Get role by roleID
     *
     * @param integer $role_id RoleID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleNameByRoleID($role_id)
    {
        $role = \Spatie\Permission\Models\Role::where('id', $role_id)
            ->first();
        if (!empty($role)) {
            return $role->name;
        } else {
            return '-';
        }
    }

    /**
     * Get users by role type
     *
     * @param string $role_type role_type
     *
     * @access public
     *
     * @return array
     */
    public static function getUsersByRoleType($role_type)
    {
        if (!empty($role_type)) {
            return DB::table('users')
                ->join('user_metas', 'user_metas.user_id', '=', 'users.id')
                ->select('users.id')
                ->where('user_metas.gender', $role_type)
                ->get()->pluck('id')->toArray();
        }
    }

    /**
     * Get searchable users.
     *
     * @access public
     *
     * @return array
     */
    public static function getSearchableUsers()
    {
        return DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.id')
            ->where('roles.role_type', '!=', 'regular')
            ->where('roles.role_type', '!=', 'admin')
            ->get()->pluck('id')->toArray();
    }

    /**
     * Get dashboard menu
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDashboardList()
    {
        $auth_role = Auth::user() ? self::getAuthRoleType() : '';
        $menu_items = array(
            'dashboard' => array(
                'role' => array('doctor', 'hospital', 'regular'),
                'title' => trans('lang.dashboard'),
                'link' => url($auth_role . '/dashboard'),
                'icon' => 'ti-desktop',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'profile_settings' => array(
                'role' => array('doctor', 'hospital', 'regular', 'admin'),
                'title' => trans('lang.profile_settings'),
                'link' => route('profileSettings', ['role_type' => $auth_role]),
                'icon' => 'ti-settings',
                'route' => 'profileSettings',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'user_appointment_list' => array(
                'role' => array('regular'),
                'title' => trans('lang.appointment_list'),
                'link' => route('userAppointments'),
                'icon' => 'ti-align-justify',
                'parent_class' => '',
                'route' => 'userAppointments',
                'parent_active' => '',
                'child_active' => '',
            ),
            'manage_teams' => array(
                'role' => array('hospital'),
                'title' => trans('lang.manage_teams'),
                'link' => route('manageTeams'),
                'icon' => 'ti-user',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'appointment_list' => array(
                'role' => array('doctor'),
                'title' => trans('lang.appointment_list'),
                'link' => route('doctorAppointments'),
                'icon' => 'ti-layers-alt',
                'parent_class' => '',
                'route' => 'doctorAppointments',
                'parent_active' => '',
                'child_active' => '',
            ),
            'appointment_settings' => array(
                'role' => array('doctor'),
                'title' => trans('lang.appointment_settings'),
                'link' => route('addAppointmentLocation'),
                'icon' => 'ti-calendar',
                'parent_class' => '',
                'route' => 'addAppointmentLocation',
                'parent_active' => '',
                'child_active' => '',
            ),
//            'articles' => array(
//                'role' => array('doctor', 'admin'),
//                'title' => trans('lang.manage_articles'),
//                'link' => 'javascript:;',
//                'icon' => 'ti-pencil-alt',
//                'parent_class' => 'menu-item-has-children',
//                'parent_active' => '',
//                'child_active' => '',
//                'childern' => array(
//                    array(
//                        'title' => trans('lang.create_article'),
//                        'link' => route('createArticle'),
//                        'route' => 'createArticle',
//                    ),
//                ),
//            ),
            'payouts' => array(
                'role' => array('doctor'),
                'title' => trans('lang.payouts_settings'),
                'link' => route('doctorPayoutsSettings'),
                'icon' => 'ti-money',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'saved_items' => array(
                'role' => array('hospital', 'doctor', 'regular'),
                'title' => trans('lang.my_saved_items'),
                'link' => url($auth_role . '/saved-items'),
                'icon' => 'ti-heart',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'invoices' => array(
                'role' => array('doctor', 'regular'),
                'title' => trans('lang.invoices'),
                'link' => route('userInvoice'),
                'icon' => 'ti-file',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            //'msgs' => array(
            //  'role' => array('doctor', 'regular'),
            //  'title' => trans('lang.inbox'),
            //  'link' => route('message'),
            //  'icon' => 'ti-comments',
            //  'route' => 'message',
            //  'parent_class' => '',
            //  'parent_active' => '',
            //  'child_active' => '',
            //),
            'account_settings' => array(
                'role' => array('doctor', 'hospital', 'regular', 'admin'),
                'title' => trans('lang.account_settings'),
                'link' => route('accountSettings'),
                'icon' => 'ti-key',
                'route' => 'accountSettings',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'email_templates' => array(
                'role' => array('admin'),
                'title' => trans('lang.email_templates'),
                'link' => route('emailTemplates'),
                'icon' => 'ti-email',
                'route' => 'emailTemplates',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'manage_users' => array(
                'role' => array('admin'),
                'title' => trans('lang.manage_users'),
                'link' => route('manageUsers'),
                'icon' => 'ti-user',
                'route' => 'manageUsers',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'manage_feedback' => array(
                'role' => array('admin'),
                'title' => "Manage Feedbacks",
                'link' => route('manageFeedbacks'),
                'icon' => 'ti-direction',
                'route' => 'manageFeedbacks',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'packages' => array(
                'role' => array('admin'),
                'title' => trans('lang.packages'),
                'link' => route('createPackage'),
                'icon' => 'ti-package',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'admin_payouts' => array(
                'role' => array('admin'),
                'title' => trans('lang.payouts'),
                'link' => route('adminPayouts'),
                'icon' => 'ti-money',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'settings' => array(
                'role' => array('admin'),
                'title' => trans('lang.settings'),
                'link' => 'javascript:;',
                'icon' => 'ti-home',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.home_page_settings'),
                        'link' => route('homePageSettings'),
                        'route' => 'homePageSettings',
                    ),
                    array(
                        'title' => trans('lang.general_settings'),
                        'link' => route('generalSettings'),
                        'route' => 'generalSettings',
                    ),
                ),
            ),
            'pages' => array(
                'role' => array('admin'),
                'title' => trans('lang.pages'),
                'link' => 'javascript:;',
                'icon' => 'ti-menu-alt',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.create_page'),
                        'link' => route('createPage'),
                        'route' => 'createPage',
                    ),
                    array(
                        'title' => trans('lang.page_listing'),
                        'link' => route('pages'),
                        'route' => 'pages',
                    ),
                ),
            ),
            'categories' => array(
                'role' => array('admin'),
                'title' => trans('lang.taxonomies'),
                'link' => 'javascript:;',
                'icon' => 'ti-layout-grid2',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.locations'),
                        'link' => route('locations'),
                        'route' => 'locations',
                    ),
                    array(
                        'title' => trans('lang.article_categories'),
                        'link' => route('categories'),
                        'route' => 'categories',
                    ),
                    array(
                        'title' => trans('lang.specialities'),
                        'link' => route('specialities'),
                        'route' => 'specialities',
                    ),
                    array(
                        'title' => trans('lang.services'),
                        'link' => route('services'),
                        'route' => 'services',
                    ),
                    array(
                        'title' => trans('lang.imprv_opts'),
                        'link' => route('improvement-opts'),
                        'route' => 'improvement-opts',
                    ),
                ),
            ),
        );
        return $menu_items;
    }

    /**
     * Get dashboard menu
     *
     * @param string $type menu type
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function displayDashboardMenu($type = '')
    {
        $auth_role = self::getAuthRoleType();
        $items = self::getDashboardList();
        $output = '';
        $hr = $type == 'dashboard' ? '<hr>' : '';
        if (!empty($items)) {
            foreach ($items as $key => $item) {
                if (!empty(Request::route()->getName()) && !empty($item['route']) && $item['route'] == Request::route()->getName()) {
                    $item['parent_active'] = $type == 'dashboard' ? 'dc-open' : '';
                    $item['child_active'] = $type == 'dashboard' ? 'style="display: block;"' : '';
                } elseif (!empty(Request::route()->getName()) && !empty($item['childern'])) {
                    foreach ($item['childern'] as $childkey => $childitem) {
                        if (!empty($childitem['route']) && Request::route()->getName() == $childitem['route']) {
                            $item['parent_active'] = $type == 'dashboard' ? 'dc-open' : '';
                            $item['child_active'] = $type == 'dashboard' ? 'style="display: block;"' : '';
                        }
                    }
                }
                if (!empty($item['role'])) {
                    if (is_array($item['role']) && in_array($auth_role, $item['role'])) {
                        $output .= "<li class='$item[parent_class] $item[parent_active]'>";
                        if (!empty($item['childern'])) {
                            $output .= "<span class='dc-dropdowarrow'><i class='lnr lnr-chevron-right'></i></span>";
                        }
                        $output .= "<a href='$item[link]'>";
                        $output .= "<i class='$item[icon]'></i><span>$item[title]</span>";
                        $output .= "</a>";
                        if (!empty($item['childern'])) {
                            $output .= "<ul class='sub-menu' $item[child_active]>";
                            foreach ($item['childern'] as $child_key => $child_item) {
                                $output .= "<li>$hr<a href='$child_item[link]'>$child_item[title]</a></li>";
                            }
                            $output .= "</ul>";
                        }
                        $output .= "</li>";
                    }
                } else {
                    $output .= "<li class='$item[parent_class] $item[parent_active]'>";
                    if (!empty($item['childern'])) {
                        $output .= "<span class='dc-dropdowarrow'><i class='lnr lnr-chevron-right'></i></span>";
                    }
                    $output .= "<a href='$item[link]'>";
                    $output .= "<i class='$item[icon]'></i><span>$item[title]</span>";
                    $output .= "</a>";
                    if (!empty($item['childern'])) {
                        $output .= "<ul class='sub-menu' $item[child_active]>";
                        foreach ($item['childern'] as $child_key => $child_item) {
                            $output .= "<li>$hr<a href='$child_item[link]'>$child_item[title]</a></li>";
                        }
                        $output .= "</ul>";
                    }
                    $output .= "</li>";
                }
            }
        }
        echo $output;
    }

    /**
     * Get genders array
     *
     * @access public
     *
     * @return array()
     */
    public static function getGenderArray()
    {
        $gender_array = array(
            'male' => trans('lang.male'),
            'female' => trans('lang.female'),
        );

        return $gender_array;
    }

    /**
     * Get doctors array
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array()
     */
    public static function getDoctorArray($key = "")
    {
        $list = array(
            'mr' => trans('lang.mr'),
            'ms' => 'Ms',
            'mrs' => trans('lang.mrs'),
            'dr' => trans('lang.dr'),
            'prof' => trans('lang.prof'),
            'phd' => trans('lang.phd'),
            'mbbs' => trans('lang.mbbs'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get location intervals array
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array()
     */
    public static function getAppointmentIntervals($key = "")
    {
        $list = array(
            '5' => trans('lang.5_minutes'),
            '15' => '15 minutes',
            '30' => trans('lang.30_minutes'),
            '60' => trans('lang.1_hours'),
            '90' => trans('lang.1_30_hours'),
            '120' => trans('lang.2_hours'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get location intervals array
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array()
     */
    public static function getAppointmentDuration($key = "")
    {
        $list = array(
            // '5'  => '5 minutes',
            '15' => '15 minutes',
            '30' => '30 minutes',
            '45' => '45 minutes',
            '60' => '60 minutes',
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get reasons array
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getReasonsArray()
    {
        $reason_array = array(
            'select' => trans('lang.select_reason_to_leave'),
            'reason1' => trans('lang.reason_1'),
            'reason2' => trans('lang.reason_2'),
        );

        return $reason_array;
    }

    /**
     * Get username
     *
     * @param integer $user_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getUserName($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find(intVal(clean($user_id)));
            return html_entity_decode(clean($user->first_name . ' ' . $user->last_name));
        } else {
            return '';
        }
    }

    /**
     * Get user language
     *
     * @param integer $user_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getUserLanguage($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find(intVal(clean($user_id)));
            return html_entity_decode(clean($user->languagelist));
        } else {
            return '';
        }
    }

    /**
     * Get home slider
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getHomeSlider($type)
    {
        if (!empty($type)) {
            $home_slides = SiteManagement::getMetaValue('home_slider');
            $slider_bg_image = SiteManagement::where('meta_key', 'slider_bg_img')->select('meta_value')->pluck('meta_value')->first();
            if ($type == 'home_slides') {
                return !empty($home_slides) ? $home_slides : array();
            }
            if ($type == 'slider_bg_image') {
                return !empty($slider_bg_image) ? $slider_bg_image : '';
            }
        } else {
            return '';
        }
    }

    /**
     * Get home search banner
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getSearchBanner($type)
    {
        if (!empty($type)) {
            $home_search_banner = SiteManagement::getMetaValue('home_search_banner');
            $search_form_title = !empty($home_search_banner['search_form_title']) ? $home_search_banner['search_form_title'] : '';
            $search_banner_heading = !empty($home_search_banner['search_banner_heading']) ? $home_search_banner['search_banner_heading'] : '';
            $search_banner_subheading = !empty($home_search_banner['search_banner_subheading']) ? $home_search_banner['search_banner_subheading'] : '';
            $search_banner_btn_title = !empty($home_search_banner['search_banner_btn_title']) ? $home_search_banner['search_banner_btn_title'] : '';
            $search_banner_btn_url = !empty($home_search_banner['search_banner_btn_url']) ? $home_search_banner['search_banner_btn_url'] : '';
            $search_banner_img = !empty($home_search_banner['hidden_search_banner_img']) ? $home_search_banner['hidden_search_banner_img'] : '';
            $show_search_banner = !empty($home_search_banner['show_search_banner']) ? $home_search_banner['show_search_banner'] : '';
            if ($type == 'show_banner') {
                return $show_search_banner;
            }
            if ($type == 'form_title') {
                return $search_form_title;
            }
            if ($type == 'banner_heading') {
                return $search_banner_heading;
            }
            if ($type == 'banner_subheading') {
                return $search_banner_subheading;
            }
            if ($type == 'btn_title') {
                return $search_banner_btn_title;
            }
            if ($type == 'btn_url') {
                return $search_banner_btn_url;
            }
            if ($type == 'banner_img') {
                if (!empty($search_banner_img)) {
                    return $search_banner_img;
                }
            }
        } else {
            return '';
        }
    }

    /**
     * Get home services tabs
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getServicesSection($type)
    {
        if (!empty($type)) {
            $services_tabs = SiteManagement::getMetaValue('services_tab_sec');
            $show_services_section = SiteManagement::where('meta_key', 'show_services_section')->select('meta_value')->pluck('meta_value')->first();
            if ($type == 'services_tabs') {
                return $services_tabs;
            }
            if ($type == 'show_services_section') {
                return $show_services_section;
            }
        } else {
            return '';
        }
    }

    /**
     * Get home about us section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getAboutUsSection($type)
    {
        if (!empty($type)) {
            $about_us_sec = SiteManagement::getMetaValue('home_about_us_sec');
            $show_about_sec = !empty($about_us_sec['show_about_sec']) ? $about_us_sec['show_about_sec'] : '';
            $title = !empty($about_us_sec['title']) ? $about_us_sec['title'] : '';
            $subtitle = !empty($about_us_sec['subtitle']) ? $about_us_sec['subtitle'] : '';
            $description = !empty($about_us_sec['description']) ? $about_us_sec['description'] : '';
            $btn_one_title = !empty($about_us_sec['btn_one_title']) ? $about_us_sec['btn_one_title'] : '';
            $btn_one_url = !empty($about_us_sec['btn_one_url']) ? $about_us_sec['btn_one_url'] : '';
            $btn_two_title = !empty($about_us_sec['btn_two_title']) ? $about_us_sec['btn_two_title'] : '';
            $btn_two_url = !empty($about_us_sec['btn_two_url']) ? $about_us_sec['btn_two_url'] : '';
            $about_us_img = !empty($about_us_sec['hidden_about_us_img']) ? $about_us_sec['hidden_about_us_img'] : '';
            $img_title = !empty($about_us_sec['img_title']) ? $about_us_sec['img_title'] : '';
            $img_subtitle = !empty($about_us_sec['img_subtitle']) ? $about_us_sec['img_subtitle'] : '';
            if ($type == 'show_about_sec') {
                return $show_about_sec;
            }
            if ($type == 'title') {
                return $title;
            }
            if ($type == 'subtitle') {
                return $subtitle;
            }
            if ($type == 'description') {
                return $description;
            }
            if ($type == 'btn_one_title') {
                return $btn_one_title;
            }
            if ($type == 'btn_one_url') {
                return $btn_one_url;
            }
            if ($type == 'btn_two_title') {
                return $btn_two_title;
            }
            if ($type == 'btn_two_url') {
                return $btn_two_url;
            }
            if ($type == 'about_us_img') {
                return $about_us_img;
            }
            if ($type == 'img_title') {
                return $img_title;
            }
            if ($type == 'img_subtitle') {
                return $img_subtitle;
            }
        } else {
            return '';
        }
    }

    /**
     * Get home how it works section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getHowItWorksSection($type)
    {
        if (!empty($type)) {
            $how_works_sec = SiteManagement::getMetaValue('home_how_works_sec');
            $how_works_tabs = SiteManagement::getMetaValue('how_work_tabs');
            $show_how_work_sec = !empty($how_works_sec['show_how_work_sec']) ? $how_works_sec['show_how_work_sec'] : '';
            $show_how_work_tabs = SiteManagement::where('meta_key', 'show_how_work_tabs')->select('meta_value')->pluck('meta_value')->first();
            $title = !empty($how_works_sec['title']) ? $how_works_sec['title'] : '';
            $subtitle = !empty($how_works_sec['subtitle']) ? $how_works_sec['subtitle'] : '';
            $description = !empty($how_works_sec['hw_desc']) ? $how_works_sec['hw_desc'] : '';
            if ($type == 'show_how_work_sec') {
                return $show_how_work_sec;
            }
            if ($type == 'title') {
                return $title;
            }
            if ($type == 'subtitle') {
                return $subtitle;
            }
            if ($type == 'description') {
                return $description;
            }
            if ($type == 'how_works_tabs') {
                return $how_works_tabs;
            }
            if ($type == 'show_how_work_tabs') {
                return $show_how_work_tabs;
            }
        } else {
            return '';
        }
    }

    /**
     * Get download app section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getDownloadAppSection($type)
    {
        if (!empty($type)) {
            $dwnld_app_sec = SiteManagement::getMetaValue('download_app_sec');
            $show_app_sec = !empty($dwnld_app_sec['show_app_sec']) ? $dwnld_app_sec['show_app_sec'] : '';
            $title = !empty($dwnld_app_sec['title']) ? $dwnld_app_sec['title'] : '';
            $subtitle = !empty($dwnld_app_sec['subtitle']) ? $dwnld_app_sec['subtitle'] : '';
            $description = !empty($dwnld_app_sec['description']) ? $dwnld_app_sec['description'] : '';
            $app_sec_img = !empty($dwnld_app_sec['app_sec_img']) ? $dwnld_app_sec['app_sec_img'] : '';
            $android_url = !empty($dwnld_app_sec['android_url']) ? $dwnld_app_sec['android_url'] : '';
            $android_img = !empty($dwnld_app_sec['android_img']) ? $dwnld_app_sec['android_img'] : '';
            $ios_url = !empty($dwnld_app_sec['ios_url']) ? $dwnld_app_sec['ios_url'] : '';
            $ios_img = !empty($dwnld_app_sec['ios_img']) ? $dwnld_app_sec['ios_img'] : '';
            if ($type == 'show_app_sec') {
                return $show_app_sec;
            }
            if ($type == 'title') {
                return $title;
            }
            if ($type == 'subtitle') {
                return $subtitle;
            }
            if ($type == 'description') {
                return $description;
            }
            if ($type == 'app_sec_img') {
                return $app_sec_img;
            }
            if ($type == 'android_url') {
                return $android_url;
            }
            if ($type == 'android_img') {
                return $android_img;
            }
            if ($type == 'ios_url') {
                return $ios_url;
            }
            if ($type == 'ios_img') {
                return $ios_img;
            }
        } else {
            return '';
        }
    }

    /**
     * Get general settings
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getGeneralSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('general_settings');
            $site_logo = self::getImage('uploads/settings/general', $settings['site_logo'], '', 'd-logo.png');
            $site_favicon = self::getImage('uploads/settings/general', $settings['site_favicon'], '', 'favicon.png');
            if ($type === 'site_logo') {
                return $site_logo;
            }
            if ($type === 'site_favicon') {
                return $site_favicon;
            }
        } else {
            return '';
        }
    }

    /**
     * Get topbar settings
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getTopBarSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('topbar_settings');
            $enable_socials = !empty($settings) ? $settings['enable_social_icons'] : '';
            $enable_topbar = !empty($settings) ? $settings['enable_topbar'] : '';
            $title = !empty($settings) ? $settings['title'] : '';
            $number = !empty($settings) ? $settings['number'] : '';
            if ($type === 'enable_socials') {
                return $enable_socials;
            }
            if ($type === 'enable_topbar') {
                return $enable_topbar;
            }
            if ($type === 'title') {
                return $title;
            }
            if ($type === 'number') {
                return $number;
            }
        } else {
            return '';
        }
    }

    /**
     * Get social media data
     *
     * @access public
     *
     * @return array
     */
    public static function getSocialData()
    {
        $social = array(
            'facebook' => array(
                'title' => trans('lang.socials.fb'),
                'color' => '#3b5999',
                'icon' => 'fab fa-facebook-f',
            ),
            'twitter' => array(
                'title' => trans('lang.socials.twitter'),
                'color' => '#55acee',
                'icon' => 'fab fa-twitter',
            ),
            'linkedin' => array(
                'title' => trans('lang.socials.linkedin'),
                'color' => '#0077B5',
                'icon' => 'fab fa-linkedin-in',
            ),
            'rss' => array(
                'title' => trans('lang.socials.rss'),
                'color' => '#ff6600',
                'icon' => 'fas fa-rss',
            ),
            'youtube' => array(
                'title' => trans('lang.socials.youtube'),
                'color' => '#0077B5',
                'icon' => 'fab fa-youtube',
            ),

        );
        return $social;
    }

    /**
     * Display socials
     *
     * @param string $type type
     *
     * @access public
     *
     * @return array
     */
    public static function displaySocials($type)
    {
        $output = "";
        $social_array = SiteManagement::getMetaValue('socials');
        $social_list = self::getSocialData();
        $class = '';
        if ($type === 'topbar') {
            $class = 'dc-socialiconsborder';
        } else {
            $class = '';
        }
        if (!empty($social_array)) {
            $output .= "<ul class='dc-simplesocialicons " . $class . "'>";
            foreach ($social_array as $social) {
                if (array_key_exists($social['title'], $social_list)) {
                    $socialList = $social_list[$social['title']];
                    $output .= "<li class='dc-{$social['title']}'><a href = '" . $social["url"] . "'><i class='{$socialList["icon"]}' ></i></a></li>";
                }
            }
            $output .= "</ul>";
        }
        echo $output;
    }

    /**
     * Get footer settings
     *
     * @param string $type footer setting type
     *
     * @access public
     *
     * @return string
     */
    public static function getFooterSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('footer_settings');
            $show_contact_info_sec = !empty($settings) ? $settings['show_contact_info_sec'] : '';
            $c_info_img_one = !empty($settings) ? $settings['c_info_img_one'] : '';
            $c_info_title_one = !empty($settings) ? $settings['c_info_title_one'] : '';
            $c_info_number = !empty($settings) ? $settings['c_info_number'] : '';
            $c_info_img_two = !empty($settings) ? $settings['c_info_img_two'] : '';
            $c_info_title_two = !empty($settings) ? $settings['c_info_title_two'] : '';
            $c_info_email = !empty($settings) ? $settings['c_info_email'] : '';
            $footer_logo = self::getImage('uploads/settings/general/footer', $settings['footer_logo'], '', 'flogo.png');
            $footer_about_us_note = !empty($settings) ? $settings['about_us_note'] : '';
            $footer_address = !empty($settings) ? $settings['address'] : '';
            $footer_email = !empty($settings) ? $settings['email'] : '';
            $footer_phone = !empty($settings) ? $settings['phone'] : '';
            $show_footer_socials = !empty($settings) ? $settings['enable_footer_socials'] : '';
            $footer_copyright = !empty($settings) ? $settings['copyright'] : '';
            $menu_one_title = !empty($settings) && !empty($settings['menu_one_title']) ? $settings['menu_one_title'] : trans('lang.by_specialty');
            $menu_two_title = !empty($settings) && !empty($settings['menu_two_title']) ? $settings['menu_two_title'] : trans('lang.by_us');
            $menu_three_title = !empty($settings) && !empty($settings['menu_three_title']) ? $settings['menu_three_title'] : trans('lang.by_india');
            $menu_four_title = !empty($settings) && !empty($settings['menu_four_title']) ? $settings['menu_four_title'] : trans('lang.by_location');
            $footer_first_location = !empty($settings) && !empty($settings['first_location']) ? $settings['first_location'] : 'united-states';
            $footer_second_location = !empty($settings) && !empty($settings['second_location']) ? $settings['second_location'] : 'india';
            if ($type === 'first_menu_title') {
                return $menu_one_title;
            }
            if ($type === 'second_menu_title') {
                return $menu_two_title;
            }
            if ($type === 'third_menu_title') {
                return $menu_three_title;
            }
            if ($type === 'fourth_menu_title') {
                return $menu_four_title;
            }
            if ($type === 'second_menu_location') {
                return $footer_first_location;
            }
            if ($type === 'third_menu_location') {
                return $footer_second_location;
            }
            if ($type === 'show_contact_info_sec') {
                return $show_contact_info_sec;
            }
            if ($type === 'contact_info_img_one') {
                return $c_info_img_one;
            }
            if ($type === 'contact_info_title_one') {
                return $c_info_title_one;
            }
            if ($type === 'contact_info_number') {
                return $c_info_number;
            }
            if ($type === 'contact_info_img_two') {
                return $c_info_img_two;
            }
            if ($type === 'contact_info_title_two') {
                return $c_info_title_two;
            }
            if ($type === 'contact_info_email') {
                return $c_info_email;
            }
            if ($type === 'footer_logo') {
                return $footer_logo;
            }
            if ($type === 'footer_about_us_note') {
                return $footer_about_us_note;
            }
            if ($type === 'footer_address') {
                return $footer_address;
            }
            if ($type === 'footer_phone') {
                return $footer_phone;
            }
            if ($type === 'footer_email') {
                return $footer_email;
            }
            if ($type === 'show_footer_socials') {
                return $show_footer_socials;
            }
            if ($type === 'footer_copyright') {
                return $footer_copyright;
            }
        } else {
            return '';
        }
    }

    /**
     * Get unserialize data
     *
     * @param array $data data
     *
     * @access public
     *
     * @return array
     */
    public static function getUnserializeData($data)
    {
        if (!empty($data)) {
            $fixed_data = preg_replace_callback(
                '!s:(\d+):"(.*?)";!',
                function ($match) {
                    return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                },
                $data
            );
            return unserialize($fixed_data);
        } else {
            return '';
        }
    }

    /**
     * Format file name
     *
     * @param string $file_name filename
     *
     * @return \Illuminate\Http\Response
     */
    public static function formateFileName($file_name)
    {
        if (!empty($file_name)) {
            $file = strstr($file_name, '-');
            if ($file == true) {
                return substr($file, 1);
            } else {
                return $file_name;
            }
        } else {
            return '';
        }
    }

    /**
     * Format file size
     *
     * @param integer $bytes bytes
     *
     * @return \Illuminate\Http\Response
     */
    public static function formateFileSize($bytes)
    {
        if (!empty($bytes)) {
            $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }
            return round($bytes, 2) . ' ' . $units[$i];
        } else {
            return '';
        }
    }

    /**
     * Get file size and name
     *
     * @param string $file file
     * @param string $type type
     * @param string $path path
     *
     * @return \Illuminate\Http\Response
     */
    public static function getImageDetail($file, $type, $path = '')
    {
        if (!empty($file) && !empty($path)) {
            if ($type === 'size') {
                if (file_exists(self::publicPath() . '/' . $path . '/' . $file)) {
                    return self::formateFileSize(File::size(self::publicPath() . '/' . $path . '/' . $file));
                } else {
                    return 0;
                }
            } elseif ($type === 'name') {
                return self::formateFileName($file);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    /**
     * Get Delete Acc Reasons
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getDeleteAccReason($key = "")
    {
        $list = array(
            'not_satisfied' => trans('lang.del_acc_reason.not_satisfied'),
            'not_good_support' => trans('lang.del_acc_reason.no_good_supp'),
            'Others' => trans('lang.del_acc_reason.others'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get general settings
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getArticleSectionSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('article_section');
            $article_sec_title = !empty($settings['title']) ? $settings['title'] : '';
            $article_sec_subtitle = !empty($settings['subtitle']) ? $settings['subtitle'] : '';
            $article_sec_desc = !empty($settings['description']) ? $settings['description'] : '';
            $show_article_sec = !empty($settings['show_article_sec']) ? $settings['show_article_sec'] : '';
            if ($type === 'section_title') {
                return $article_sec_title;
            }
            if ($type === 'section_subtitle') {
                return $article_sec_subtitle;
            }
            if ($type === 'section_description') {
                return $article_sec_desc;
            }
            if ($type === 'show_article_sec') {
                return $show_article_sec;
            }
        } else {
            return '';
        }
    }

    /**
     * Get specific speciality
     *
     * @param int $speciality_id speciality_id
     *
     * @access public
     *
     * @return array
     */
    public static function getSpecialityByID($speciality_id)
    {
        if (!empty($speciality_id)) {
            $speciality = Speciality::find($speciality_id);
            return !empty($speciality) ? $speciality : '';
        } else {
            return '';
        }
    }

    /**
     * Get specific service
     *
     * @param int $service_id service_id
     *
     * @access public
     *
     * @return array
     */
    public static function getServiceByID($service_id)
    {
        if (!empty($service_id)) {
            $service = Service::find($service_id);
            return !empty($service) ? $service : '';
        } else {
            return '';
        }
    }

    /**
     * Get location intervals array
     *
     * @param string $key key
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getAppointmentSpaces($key = "")
    {
        $list = array(
            '1' => array(
                'value' => 1,
            ),
            '2' => array(
                'value' => 2,
            ),
            '3' => array(
                'value' => 3,
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get appointment days list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getAppointmentDays($key = "")
    {
        $list = array(
            'mon' => array(
                'title' => 'Mon',
                'name' => trans('lang.monday'),
            ),
            'tue' => array(
                'title' => 'Tue',
                'name' => trans('lang.tuesday'),
            ),
            'wed' => array(
                'title' => 'Wed',
                'name' => trans('lang.wednesday'),
            ),

            'thu' => array(
                'title' => 'Thu',
                'name' => trans('lang.thursday'),
            ),
            'fri' => array(
                'title' => 'Fri',
                'name' => trans('lang.friday')
            ),
            'sat' => array(
                'title' => 'Sat',
                'name' => trans('lang.saturday'),
            ),
            'sun' => array(
                'title' => 'Sun',
                'name' => trans('lang.sunday'),
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get each doctors information
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDoctorsServicesList($doctorid, $hospitalid)
    {
        /*
        $json =  array();
        //if (Auth::user()) {
        $team_info = Team::where('user_id', $hospitalid)->where('doctor_id', $doctorid)->first();
            if (!empty($team_info)) {
                $slots = self::getUnserializeData($team_info['slots']);
                $list = array();
                if (!empty($slots['services'])) {
                    foreach ($slots['services']['speciality'] as $key => $specialities) {
                        $speciality = Speciality::find($specialities['speciality_id']);
                        if (!empty($speciality)) {
                            $list[$key]['speciality_id'] = $speciality->id;
                            $list[$key]['speciality_title'] = $speciality->title;

                if (!empty($specialities['speciality_services'])) {
                                foreach ($specialities['speciality_services'] as $service_key => $services) {
                    $service = self::getServiceByID($services['service']);
                                    if (!empty($service)) {
                                        $list[$key]['service_id'] = $service->id;
                                        $list[$key]['service_price'] = $services['price'];
                                    }
                                }
                            } else {
                                $json = '';
                                return $json;
                            }
                        }
                    }
                    $json = !empty($list) ? $list : '';
                    //$json['type'] = 'success';
                    return $json;
                } else {
                    $json = '';
                    return $json;
                }
            } else {
                $json = '';
                return $json;
        } */
        // } else {
        //    $json = '';            
        //   return $json;
        // }
        $json = array();
        $user = User::findOrFail($doctorid);
        if (!empty($user->profile->services)) {
            $list = array();
            $profile_specialities = Helper::getUnserializeData($user->profile->services);
            foreach ($profile_specialities as $key => $specialities) {
                $speciality = Speciality::find($specialities['speciality_id']);
                if (!empty($speciality)) {
                    $list[$key]['speciality_id'] = $speciality->id;
                    $list[$key]['speciality_title'] = $speciality->title;

                    if (!empty($specialities['services'])) {
                        foreach ($specialities['services'] as $service_key => $services) {
                            $service = self::getServiceByID($services['service']);
                            if (!empty($service)) {
                                $list[$key]['service_id'] = $service->id;
                                $list[$key]['service_price'] = $services['price'];
                            }
                        }
                    } else {
                        $json = '';
                        return $json;
                    }
                }
            }
            $json = !empty($list) ? $list : '';
            return $json;
        } else {
            $json = '';
            return $json;
        }
    }

    /**
     * Get each doctors Available State
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return string
     */
    public static function getDoctorsAvailabelStateNow($doctorid)
    {
        date_default_timezone_set("Australia/Sydney");
        $todaydate = date("Y-n-j");

        $nowtimevalue = date("h:i a");
        $after20timevalue = date("h:i a", strtotime(date("h:i a") . " +5 minutes"));
        $before20timevalue = date("h:i a", strtotime(date("h:i a") . " -3 minutes"));
        $doctor_appointment = DB::table('appointments')->select('*')
            ->where('user_id', $doctorid)
            ->where('status', 'accepted')
            ->where(function ($query) use ($nowtimevalue) {
                $query
                    ->where('appointment_time', '<=', $nowtimevalue)
                    ->whereRaw('addtime(STR_TO_DATE(appointment_time, "%l:%i %p"), 15 * 100) >= "' . date("H:i:s") . '"');
            })
            ->where('appointment_date', $todaydate)
            ->first();

        if ($doctor_appointment) {
            return "1";
        } else {
            return "0";
        }
    }

    /**
     * Get each doctors available days
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDoctorsAvailableList($doctorid, $hospitalid)
    {
        $team_info = Team::where('user_id', $hospitalid)->where('doctor_id', $doctorid)->first();
        if (!empty($team_info)) {
            $slots = self::getUnserializeData($team_info['slots']);
            $list = array();
            if (!empty($slots['mon'])) {
                array_push($list, 'mon');
            }
            if (!empty($slots['tue'])) {
                array_push($list, 'tue');
            }
            if (!empty($slots['wed'])) {
                array_push($list, 'wed');
            }
            if (!empty($slots['thu'])) {
                array_push($list, 'thu');
            }
            if (!empty($slots['fri'])) {
                array_push($list, 'fri');
            }
            if (!empty($slots['sat'])) {
                array_push($list, 'sat');
            }
            if (!empty($slots['sun'])) {
                array_push($list, 'sun');
            }

            return $list;
        } else {
            $listresult = "";
            return $listresult;
        }
    }

    /**
     * Custom paginator
     *
     * @param mixed $request $request        attributes
     * @param array $values $values         array values to be paginated
     * @param mixed $posts_per_page $posts_per_page posts to show per page
     *
     * @return $items
     */
    public static function customPaginator($request, $values = array(), $posts_per_page = '5')
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($values);
        $perPage = intval($posts_per_page);
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $items = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $items->setPath($request->url());
        return $items;
    }

    /**
     * Email Content
     *
     * @access public
     *
     * @return array
     */
    public static function getEmailContent()
    {
        $output = "";
        $output .= "Hello!<br/>";
        $output .= "A new appointment location has been added.<br/>";
        $output .= '<ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">';
        $output .= '<li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Start Time"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><strong>%starttime%</strong></span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"End Time"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><strong>%endtime%</strong></span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Appointment Intervals"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appt_intervals%</span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Appointment Duration"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appt_duration%</span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Appointment Days"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appt_days%</span></li>
        </ul>';
        $output .= "%signature%";
        return $output;
    }

    /**
     * Check User Verification
     *
     * @param int $user_id user_id
     * @param boolean $tooltip tooltip
     * @param string $text text
     *
     * @access public
     *
     * @return array
     */
    public static function verifyUser($user_id, $tooltip = true, $text = '')
    {
        $text = trans('lang.verified_user');
        if (!empty($user_id)) {
            $tooltip_text = '';
            $class = '';
            if ($tooltip == true) {
                $tooltip_text = '<em>' . clean($text) . '</em>';
                $class = 'dc-awardtooltip';
            }
            $verified_user = User::select('user_verified')->where('id', intval($user_id))->pluck('user_verified')->first();
            if (!empty($verified_user) && $verified_user == 1) {
                echo '<span class="dc-tipso" data-tipso="<em>Verified User</em>"><img src="/uploads/resources/img/green_check.png" style="width: 14px;"></span>';
            } else {
                return;
            }
        } else {
            return '';
        }
    }

    /**
     * Check Medical Verification
     *
     * @param int $user_id user_id
     * @param boolean $tooltip tooltip
     * @param string $text text
     *
     * @access public
     *
     * @return array
     */
    public static function verifyMedical($user_id, $tooltip = true, $text = 'Medical Registration Verified')
    {
        if (!empty($user_id)) {
            $tooltip_text = '';
            $class = '';
            if ($tooltip == true) {
                $tooltip_text = '<em>' . $text . '</em>';
                $class = 'dc-awardtooltip';
            }
            $user = User::findOrFail($user_id);
            $verified_medical = !empty($user->profile) && !empty($user->profile->verify_registration) ? $user->profile->verify_registration : '';
            if (!empty($verified_medical) && $verified_medical == 1) {
                echo '<span class="dc-tipso" data-tipso="<em>Medical Registration Verified</em>"><img src="/uploads/resources/img/yellow_shield.png" style="width: 14px;"></span>';
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    /**
     * Language list
     *
     * @param string $lang lang
     *
     * @access public
     *
     * @return array
     */
    public static function getTranslatedLang($lang = "")
    {
        $languages = array(
            'en' => array(
                'code' => 'en',
                'title' => 'English',
            ),
            'de' => array(
                'code' => 'de',
                'title' => 'German',
            ),
            'tr' => array(
                'code' => 'tr',
                'title' => 'Turkish',
            ),
            'es' => array(
                'code' => 'es',
                'title' => 'Spanish',
            ),
            'pt' => array(
                'code' => 'pt',
                'title' => 'Portuguese',
            ),
            'zh' => array(
                'code' => 'zh',
                'title' => 'Chinese',
            ),
            'bn' => array(
                'code' => 'bn',
                'title' => 'Bengali',
            ),
            'fr' => array(
                'code' => 'fr',
                'title' => 'French',
            ),
            'ru' => array(
                'code' => 'ru',
                'title' => 'Russian',
            ),
            'UK' => array(
                'code' => 'UK',
                'title' => 'Ukrainian',
            ),
            'ja' => array(
                'code' => 'ja',
                'title' => 'Japanese',
            ),
            'ur' => array(
                'code' => 'ur',
                'title' => 'Urdu',
            ),
        );

        if (!empty($lang) && array_key_exists($lang, $languages)) {
            return $languages[$lang];
        } else {
            return $languages;
        }
    }

    /**
     * Get google map api key
     *
     * @access public
     *
     * @return array
     */
    public static function getGoogleMapApiKey()
    {
        $settings = SiteManagement::getMetaValue('general_settings');
        if (!empty($settings) && !empty($settings['gmap_api_key'])) {
            return $settings['gmap_api_key'];
        } else {
            return '';
        }
    }

    /**
     * Get dashboard icon list
     *
     * @param string $icon icon
     *
     * @access public
     *
     * @return array
     */
    public static function getIconList($icon = "")
    {
        $icons = array(
            'latest_appointments' => array(
                'value' => 'latest_appointments',
                'title' => trans('lang.latest_appointments'),
            ),
            'package_expiry' => array(
                'value' => 'package_expiry',
                'title' => trans('lang.pkg_expiry'),
            ),
            'new_message' => array(
                'value' => 'new_message',
                'title' => trans('lang.new_msgs'),
            ),
            'saved_item' => array(
                'value' => 'saved_item',
                'title' => trans('lang.save_items'),
            ),
            'available_balance' => array(
                'value' => 'available_balance',
                'title' => trans('lang.available_balance'),
            ),
            'total_posted_articles' => array(
                'value' => 'total_posted_articles',
                'title' => trans('lang.total_posted_articles'),
            ),
            'check_invoices' => array(
                'value' => 'check_invoices',
                'title' => trans('lang.check_invoices'),
            ),
            'latest_recieved_booking' => array(
                'value' => 'latest_recieved_booking',
                'title' => trans('lang.latest_recieved_booking'),
            ),
            'submit_articles' => array(
                'value' => 'submit_articles',
                'title' => trans('lang.submit_articles'),
            ),
            'manage_teams' => array(
                'value' => 'manage_teams',
                'title' => trans('lang.manage_teams'),
            ),
            'manage_specialities_services' => array(
                'value' => 'manage_specialities_services',
                'title' => trans('lang.manage_specialities_services'),
            ),
            'doctor_image' => array(
                'value' => 'doctor_image',
                'title' => trans('lang.saved_doctor_image'),
            ),
            'hospital_image' => array(
                'value' => 'hospital_image',
                'title' => trans('lang.saved_hospital_image'),
            ),
        );
        if (!empty($icon) && array_key_exists($icon, $icons)) {
            return $icons[$icon];
        } else {
            return $icons;
        }
    }

    /**
     * Currency list
     *
     * @param string $code code
     *
     * @access public
     *
     * @return array
     */
    public static function currencyList($code = "")
    {
        $currency_array = array(
            'USD' => array(
                'numeric_code' => 840,
                'code' => 'USD',
                'name' => 'United States dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent[D]',
                'decimals' => 2
            ),
            'AUD' => array(
                'numeric_code' => 36,
                'code' => 'AUD',
                'name' => 'Australian dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'BRL' => array(
                'numeric_code' => 986,
                'code' => 'BRL',
                'name' => 'Brazilian real',
                'symbol' => 'R$',
                'fraction_name' => 'Centavo',
                'decimals' => 2
            ),
            'CAD' => array(
                'numeric_code' => 124,
                'code' => 'CAD',
                'name' => 'Canadian dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'CZK' => array(
                'numeric_code' => 203,
                'code' => 'CZK',
                'name' => 'Czech koruna',
                'symbol' => 'Kc',
                'fraction_name' => 'Haléř',
                'decimals' => 2
            ),
            'DKK' => array(
                'numeric_code' => 208,
                'code' => 'DKK',
                'name' => 'Danish krone',
                'symbol' => 'kr',
                'fraction_name' => 'Øre',
                'decimals' => 2
            ),
            'EUR' => array(
                'numeric_code' => 978,
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'HKD' => array(
                'numeric_code' => 344,
                'code' => 'HKD',
                'name' => 'Hong Kong dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'HUF' => array(
                'numeric_code' => 348,
                'code' => 'HUF',
                'name' => 'Hungarian forint',
                'symbol' => 'Ft',
                'fraction_name' => 'Fillér',
                'decimals' => 2
            ),
            'ILS' => array(
                'numeric_code' => 376,
                'code' => 'ILS',
                'name' => 'Israeli new sheqel',
                'symbol' => '₪',
                'fraction_name' => 'Agora',
                'decimals' => 2
            ),
            'INR' => array(
                'numeric_code' => 356,
                'code' => 'INR',
                'name' => 'Indian rupee',
                'symbol' => 'INR',
                'fraction_name' => 'Paisa',
                'decimals' => 2
            ),
            'JPY' => array(
                'numeric_code' => 392,
                'code' => 'JPY',
                'name' => 'Japanese yen',
                'symbol' => '¥',
                'fraction_name' => 'Sen[G]',
                'decimals' => 2
            ),
            'MYR' => array(
                'numeric_code' => 458,
                'code' => 'MYR',
                'name' => 'Malaysian ringgit',
                'symbol' => 'RM',
                'fraction_name' => 'Sen',
                'decimals' => 2
            ),
            'MXN' => array(
                'numeric_code' => 484,
                'code' => 'MXN',
                'name' => 'Mexican peso',
                'symbol' => '$',
                'fraction_name' => 'Centavo',
                'decimals' => 2
            ),
            'NOK' => array(
                'numeric_code' => 578,
                'code' => 'NOK',
                'name' => 'Norwegian krone',
                'symbol' => 'kr',
                'fraction_name' => 'Øre',
                'decimals' => 2
            ),
            'NZD' => array(
                'numeric_code' => 554,
                'code' => 'NZD',
                'name' => 'New Zealand dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'PHP' => array(
                'numeric_code' => 608,
                'code' => 'PHP',
                'name' => 'Philippine peso',
                'symbol' => 'PHP',
                'fraction_name' => 'Centavo',
                'decimals' => 2
            ),
            'PLN' => array(
                'numeric_code' => 985,
                'code' => 'PLN',
                'name' => 'Polish złoty',
                'symbol' => 'zł',
                'fraction_name' => 'Grosz',
                'decimals' => 2
            ),
            'GBP' => array(
                'numeric_code' => 826,
                'code' => 'GBP',
                'name' => 'British pound[C]',
                'symbol' => '£',
                'fraction_name' => 'Penny',
                'decimals' => 2
            ),
            'SGD' => array(
                'numeric_code' => 702,
                'code' => 'SGD',
                'name' => 'Singapore dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'SEK' => array(
                'numeric_code' => 752,
                'code' => 'SEK',
                'name' => 'Swedish krona',
                'symbol' => 'kr',
                'fraction_name' => 'Öre',
                'decimals' => 2
            ),
            'CHF' => array(
                'numeric_code' => 756,
                'code' => 'CHF',
                'name' => 'Swiss franc',
                'symbol' => 'Fr',
                'fraction_name' => 'Rappen[I]',
                'decimals' => 2
            ),
            'TWD' => array(
                'numeric_code' => 901,
                'code' => 'TWD',
                'name' => 'New Taiwan dollar',
                'symbol' => '$',
                'fraction_name' => 'Cent',
                'decimals' => 2
            ),
            'THB' => array(
                'numeric_code' => 764,
                'code' => 'THB',
                'name' => 'Thai baht',
                'symbol' => '฿',
                'fraction_name' => 'Satang',
                'decimals' => 2
            ),
            'RUB' => array(
                'numeric_code' => 643,
                'code' => 'RUB',
                'name' => 'Russian ruble',
                'symbol' => 'руб.',
                'fraction_name' => 'Kopek',
                'decimals' => 2
            ),
        );

        if (!empty($code) && array_key_exists($code, $currency_array)) {
            return $currency_array[$code];
        } else {
            return $currency_array;
        }
    }

    /**
     * Get payment method list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getPaymentMethodList($key = "")
    {
        $list = array(
            'paypal' => array(
                'title' => trans('lang.paypal'),
                'value' => 'paypal',
            ),
            'stripe' => array(
                'title' => trans('lang.stripe'),
                'value' => 'stripe',
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Change the .env file Data.
     *
     * @param array $data array
     *
     * @return array
     */
    public static function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach ((array)$data as $key => $value) {

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get home services tabs
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getSpecialitySlider($type)
    {
        if (!empty($type)) {
            $list = array();
            $selected_speciality = SiteManagement::getMetaValue('doctors_slider');
            if ($type == 'display') {
                return $selected_speciality['show_doctors_slider'];
            }
            if ($type == 'speciality') {
                if (!empty($selected_speciality['speciality'])) {
                    $speciality = Speciality::find($selected_speciality['speciality']);
                    $doctors = DB::table('user_service')->select('user_id')
                        ->where('type', 'doctor')->groupBy('user_id')->get()->pluck('user_id')->toArray();
                    $list['title'] = !empty($speciality) && !empty($speciality->title) ? $speciality->title : '';
                    $list['slug'] = !empty($speciality) && !empty($speciality->slug) ? ($speciality->slug) : '';
                    $list['image'] = !empty($speciality) ? self::getImage('uploads/specialities', $speciality->image, 'small-', 'default-speciality.png') : '';
                    $list['description'] = !empty($speciality) && !empty($speciality->description) ? ($speciality->description) : '';
                    $list['doctors'] = !empty($doctors) ? $doctors : array();
                    return $list;
                }
            }
        } else {
            return '';
        }
    }

    /**
     * Get package expiry image
     *
     * @param string $path path
     * @param string $image image
     *
     * @access public
     *
     * @return string
     */
    public static function getDashExpiryImages($path, $image)
    {
        if (!empty($image) && file_exists($path . '/' . $image)) {
            return url($path . '/' . $image);
        } else {
            return '';
        }
    }

    /**
     * Get Package Duration List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getPackageDurationList($key = "")
    {
        $list = array(
            '10' => trans('lang.pckge_quarter'),
            '30' => trans('lang.pckge_monthly'),
            '360' => trans('lang.pckge_yearly'),
            // 'other' => trans('lang.pckge_duration_other'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get package options
     *
     * @access public
     * @return array
     */
    public static function getPackageOptions()
    {
        $list = array(
            '0' => trans('lang.pkg_price'),
            '1' => trans('lang.pkg_no_of_services'),
            '2' => trans('lang.pkg_no_of_brochures'),
            '3' => trans('lang.pkg_no_of_articles'),
            '4' => trans('lang.pkg_no_of_awards'),
            '5' => trans('lang.pkg_no_of_memberships'),
            '6' => trans('lang.pkg_duration'),
            '7' => trans('lang.pkg_bookings'),
            '9' => trans('lang.pkg_private_chat'),
            '10' => trans('lang.featured'),
        );
        return $list;
    }

    /**
     * Get package options
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getWaitingTime($key = "")
    {
        $list = array(
            '1' => '0 to 15 min',
            '2' => '15 to 30 min',
            '3' => '30 to 1 hr',
            '4' => 'More then hr'
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Sort by array
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function sortByArray($key = "")
    {
        $list = array(
            'id' => trans('lang.id'),
            'name' => trans('lang.name'),
            'date' => trans('lang.date'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return clean($list[$key]);
        } else {
            return clean($list);
        }
    }

    /**
     * Get text direction
     *
     * @access public
     *
     * @return string
     */
    public static function getTextDirection()
    {
        $language = \App::getLocale();
        $lang_array = ['ur'];
        $textdir = 'ltr';
        if (in_array($language, $lang_array)) {
            $textdir = 'rtl';
        }
        return $textdir;
    }

    /**
     * Get body lang Class
     *
     * @access public
     *
     * @return array
     */
    public static function getBodyLangClass()
    {
        $settings = SiteManagement::getMetaValue('general_settings');
        if (!empty($settings) && !empty($settings['body-lang-class'])) {
            return $settings['body-lang-class'];
        } else {
            return '';
        }
    }

    /**
     * Get body lang Class
     *
     * @param string $breadcrumb_name breadcrumb_name
     * @param string $variable variable
     *
     * @access public
     *
     * @return array
     */
    public static function displayBreadcrumbs($breadcrumb_name = '', $variable = '')
    {
        $settings = SiteManagement::getMetaValue('inner_page_data');
        $output = '';
        if (!empty($settings) && $settings['enable_breadcrumbs'] == 'true') {
            $breadcrumbs = Breadcrumbs::generate($breadcrumb_name, $variable);
            $output .= "
                <div class='dc-breadcrumbarea'>
                <div class='container'>
                <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <ol class='dc-breadcrumb'>";
            foreach ($breadcrumbs as $breadcrumb) {
                if ($breadcrumb->url && !$breadcrumbs->last()) {
                    $output .= "<li><a href='$breadcrumb->url'>" . html_entity_decode(clean($breadcrumb->title)) . "</a></li>";
                } else {
                    $output .= "<li class='active'>" . html_entity_decode(clean($breadcrumb->title)) . "</li>";
                }
            }
            $output .= "</ol>";
            $output .= "</div></div></div></div>";
        } else {
            $output = '';
        }
        return $output;
    }

    /**
     * Get dashboard images
     *
     * @param string $path path
     * @param string $image image
     * @param string $default default
     *
     * @access public
     *
     * @return string
     */
    public static function getDashboardImages($path, $image, $default)
    {
        if (!empty($image) && file_exists($path . '/' . $image)) {
            echo '<img src="' . url($path . '/' . $image) . '" alt="' . trans('lang.img') . '">';
        } else {
            echo '<i class="fa fa-' . $default . '"></i>';
        }
    }

    /**
     * Get Payouts list
     *
     * @access public
     *
     * @return array
     */
    public static function getPayoutsList()
    {
        $list = array(
            'paypal' => array(
                'id' => 'paypal',
                'title' => trans('lang.paypal'),
                'img_url' => url('/images/payouts/paypal.png'),
                'status' => 'enable',
                'fields' => array(
                    'paypal_email' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => true,
                        'placeholder' => trans('lang.add_paypal_email_address'),
                        'message' => trans('lang.paypal_email_address_is_required'),
                    )
                )
            ),
            'bacs' => array(
                'id' => 'bacs',
                'title' => trans('lang.direct_bank_transfer'),
                'img_url' => url('/images/payouts/bank.png'),
                'status' => 'enable',
                'fields' => array(
                    'bank_account_name' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => true,
                        'placeholder' => trans('lang.bank_account_name'),
                        'message' => trans('lang.bank_account_name_is_required'),
                    ),
                    'bank_account_number' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => true,
                        'placeholder' => trans('lang.bank_account_number'),
                        'message' => trans('lang.bank_account_number_is_required'),
                    ),
                    'bank_name' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => true,
                        'placeholder' => trans('lang.bank_name'),
                        'message' => trans('lang.bank_name_is_required'),
                    ),
                    'bank_routing_number' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => false,
                        'placeholder' => trans('lang.bank_routing_number'),
                        'message' => trans('lang.bank_routing_number_is_required'),
                    ),
                    'bank_iban' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => false,
                        'placeholder' => trans('lang.bank_iban'),
                        'message' => trans('lang.bank_iban_is_required'),
                    ),
                    'bank_bic_swift' => array(
                        'type' => 'text',
                        'classes' => '',
                        'required' => false,
                        'placeholder' => trans('lang.bank_bic_swift'),
                        'message' => trans('lang.bank_bic_swift_is_required'),
                    )
                )
            ),
        );
        return $list;
    }

    /**
     * Get month list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getMonthList($key = "")
    {
        $list = array(
            '01' => "January",
            '02' => "February",
            '03' => "March",
            '04' => "April",
            '05' => "May",
            '06' => "June",
            '07' => "July",
            '08' => "August",
            '09' => "September",
            '10' => "October",
            '11' => "November",
            '12' => "December",
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get order meta value
     *
     * @param string $meta_key meta_key
     *
     * @access public
     *
     * @return array
     */
    public static function getOrderMeta($meta_key)
    {
        if (!empty($meta_key)) {
            $data = DB::table('order_metas')->select('meta_value')->where('meta_key', $meta_key)->get()->first();
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
     * Get current package
     *
     * @param Collection $user user
     *
     * @access public
     *
     * @return array
     */
    public static function getCurrentPackage(User $user)
    {
        $user_order = $user->orders->where('appointment_date', null)->first();
        if (!empty($user_order)) {
            $order = DB::table('order_metas')->select('meta_value')->where('metable_id', $user_order['id'])->where('meta_key', 'package')->first();
            $package_detail = Unserialize($order->meta_value);
            return !empty($package_detail) ? Helper::getUnserializeData($package_detail['options']) : '';
        }
    }

    /**
     * Get current package
     *
     * @access public
     *
     * @return array
     */
    public static function getFeaturedUsers()
    {
        return DB::table('users')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->join('order_metas', 'order_metas.metable_id', '=', 'orders.id')
            ->select('users.id')
            ->where('order_metas.meta_key', 'package')
            ->get()->pluck('id')->toArray();
    }

    /**
     * Update payouts
     *
     * @access public
     *
     * @return array
     */
    public static function updatePayouts()
    {
        $payout_settings = SiteManagement::getMetaValue('payment_settings');
        $min_payount = !empty($payout_settings) && !empty($payout_settings['min_payout']) ? $payout_settings['min_payout'] : '';
        $currency = !empty($payout_settings) && !empty($payout_settings['currency']) ? $payout_settings['currency'] : 'USD';
        $appointments = Appointment::select('user_id', DB::raw('sum(charges) total_charges'))
            ->groupBy('user_id')
            ->get();
        if (!empty($appointments)) {
            foreach ($appointments as $key => $appointment) {
                if ($appointment->total_charges >= $min_payount) {
                    $user = User::find($appointment->user_id);
                    $user_payout = !empty($user->profile) && !empty($user->profile->payout_settings) ? Helper::getUnserializeData($user->profile->payout_settings) : '';
                    if (!empty($user_payout)) {
                        if ($user->orders->count() > 0) {
                            foreach ($user->orders as $user_order) {
                                $order = Order::find($user_order->id);
                                if (empty($order->payout)) {
                                    $payout = new Payout();
                                    $payout->user()->associate($appointment->user_id);
                                    $payout->amount = $appointment->total_charges;
                                    $payout->currency = $currency;
                                    $payout->payout_detail = $user->profile->payout_settings;
                                    $payout->user_id = $appointment->user_id;
                                    $payout->order_id = $user_order->id;
                                    $payout->payment_method = self::getPayoutsList()[$user_payout['type']]['title'];
                                    $payout->status = 'pending';
                                    $payout->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Email Content
     *
     * @access public
     *
     * @return array
     */
    public static function getDownloadAppEmailContent()
    {
        $output = "";
        $output .= 'Hello!<br/>
            You can download application by clicking the link below 
            <div style="width: 100%; float: left; padding: 15px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <div style="width: 100%; float: left; padding: 15px; background: #f7f7f7; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <div style="width: 100%; float: left; padding: 30px 15px; border: 2px solid #fff; text-align: center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <h3 style="font-size: 26px; margin-bottom: 15px; font-weight: normal; line-height: 26px; margin: 0; color: #333; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: "Work Sans", Arial, Helvetica, sans-serif;">Application download link is</h3>
            <a href="%download_link%">Download Application</a>
            </div>
            </div>
            </div>
            %signature%';
        $output .= "%signature%";
        return $output;
    }

    /**
     * Create a new controller instance.
     *
     * @param string $screen_name tweeter username
     * @param integer $number_of_tweets number of tweets to show
     *
     * @return array
     */
    public static function twitterUserTimeLine($screen_name, $number_of_tweets = '')
    {
        if (!empty($screen_name)) {
            $tweets_to_show = !empty($number_of_tweets) ? $number_of_tweets : 2;
            return Twitter::getUserTimeline(
                [
                    'count' => $tweets_to_show, 'format' => 'array',
                    'tweet_mode' => 'extended', 'screen_name' => $screen_name
                ]
            );
        } else {
            return '';
        }
    }

    /**
     * Get size
     *
     * @param integer $bytes bytes
     *
     * @return \Illuminate\Http\Response
     */
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getUserUpdateEmailByAdminContent()
    {
        $output = "";
        $output .= "Hello %user_name%";
        $output .= " ";
        $output .= "Your Email is change by Admin. Your can now login with new email address %email%";
        $output .= "%signature%";
        return $output;
    }

    /**
     * Get specific doctor's Immediate Booking State
     *
     * @param integer $doctor_id doctor_id
     *
     * @return int
     */
    public static function getDoctorStartEndTime($doctor_id)
    {
        if (!empty($doctor_id)) {
            $selected_doctoritem = Team::select('*')->where('doctor_id', $doctor_id)->where('status', 'approved')->get()->first();
            if ($selected_doctoritem) {
                $selected_doctoritem_slots = Helper::getUnserializeData($selected_doctoritem->slots);

                date_default_timezone_set("Australia/Sydney");

                $nameOfDay = date('D');
                $nameOfDay = strtolower($nameOfDay);
                if (in_array($nameOfDay, $selected_doctoritem_slots['days'])) {
                    if (array_key_exists($nameOfDay, $selected_doctoritem_slots)) {
                        $start_time = $selected_doctoritem_slots[$nameOfDay]['start_time'];
                        $end_time = $selected_doctoritem_slots[$nameOfDay]['end_time'];

                        $end_time_split = explode(":", $end_time);
                        $end_time_split_min = explode(" ", $end_time_split[1]);

                        if (strlen($end_time_split_min[0]) < 2)
                            $endtime_itemvalue = $end_time_split[0] . ":0" . $end_time_split[1];
                        else
                            $endtime_itemvalue = $end_time;

                        $start_time_strtotime = strtotime($start_time);
                        $end_time_strtotime =  strtotime($endtime_itemvalue);

                        if ($start_time_strtotime <= time() && time() <= $end_time_strtotime) {

                            $nowavailableworkingtime = 1;
                        } else {
                            $nowavailableworkingtime = 0;
                        }

                    } else {
                        return 0;
                    }

                } else {
                    return 0;
                }
                return $nowavailableworkingtime;
            }
        }
    }

    /**
     * Get specific doctor's list
     *
     * @param integer
     *
     * @return string
     */
    public static function getDoctorAvailableNowList()
    {
        date_default_timezone_set("Australia/Sydney");
        $date = date("Y-m-d");
        $nameOfDay = date('D', strtotime($date));
        $nameOfDay = strtolower($nameOfDay);
        $nowavailablelistreturn = "";

        $selected_doctoritem = Team::select('doctor_id', 'id', 'slots')->where('status', 'approved')->get()->toArray();
        foreach ($selected_doctoritem as $key => $selected_doctoritem_value) {

            $selected_doctoritem_slots = Helper::getUnserializeData($selected_doctoritem_value['slots']);
            if (in_array($nameOfDay, $selected_doctoritem_slots['days'])) {
                if (array_key_exists($nameOfDay, $selected_doctoritem_slots)) {
                    $start_time = $selected_doctoritem_slots[$nameOfDay]['start_time'];
                    $end_time = $selected_doctoritem_slots[$nameOfDay]['end_time'];
                    $end_time_split = explode(":", $end_time);
                    $end_time_split_min = explode(" ", $end_time_split[1]);
                    if (strlen($end_time_split_min[0]) < 2)
                        $endtime_itemvalue = $end_time_split[0] . ":0" . $end_time_split[1];
                    else
                        $endtime_itemvalue = $end_time;
                    $start_time_strtotime = strtotime($start_time);
                    $end_time_strtotime = strtotime($endtime_itemvalue);


                    if (($start_time_strtotime < time()) && (time() < $end_time_strtotime)) {
                        $nowavailablelistreturn .= $selected_doctoritem_value['doctor_id'] . ",";
                    }

                }
            }
        }

        if (strpos($nowavailablelistreturn, ',') !== false) {
            $nowavailablelistreturn = rtrim($nowavailablelistreturn, ",");
        } else {
            $nowavailablelistreturn = "1";
        }
        return $nowavailablelistreturn;
    }

    /**
     * Get specific doctor's Immediate Booking State
     *
     * @param integer $doctor_id doctor_id
     *
     * @return int
     */
    public static function getDoctorAvailableTodayEnd($doctor_id)
    {
        if (!empty($doctor_id)) {
            $selected_doctoritem = Team::select('*')->where('doctor_id', $doctor_id)->where('status', 'approved')->get()->first();
            if ($selected_doctoritem) {
                $selected_doctoritem_slots = Helper::getUnserializeData($selected_doctoritem->slots);

                date_default_timezone_set("Australia/Sydney");

                $nameOfDay = strtolower(date('D'));

                if (in_array($nameOfDay, $selected_doctoritem_slots['days'])) {
                    if (array_key_exists($nameOfDay, $selected_doctoritem_slots)) {
                        $start_time = $selected_doctoritem_slots[$nameOfDay]['start_time'];
                        $end_time = $selected_doctoritem_slots[$nameOfDay]['end_time'];

                        $start_time_split = explode(":", $start_time);
                        $start_time_split_min = explode(" ", $start_time_split[1]);

                        if (strlen($start_time_split_min[0]) < 2)
                            $starttime_itemvalue = $start_time_split[0] . ":0" . $start_time_split[1];
                        else
                            $starttime_itemvalue = $start_time;

                        $end_time_split = explode(":", $end_time);
                        $end_time_split_min = explode(" ", $end_time_split[1]);

                        if (strlen($end_time_split_min[0]) < 2)
                            $endtime_itemvalue = $end_time_split[0] . ":0" . $end_time_split[1];
                        else
                            $endtime_itemvalue = $end_time;

                        $start_time_strtotime = strtotime($starttime_itemvalue);
                        $end_time_strtotime = strtotime($endtime_itemvalue);
//                        if ($doctor_id == 77) dd($selected_doctoritem_slots);

                        if ($start_time_strtotime <= time() && time() <= $end_time_strtotime) {
                            $nowavailableworkingtime = 1;
                        } else {
                            $nowavailableworkingtime = 0;
                        }
                    } else {
                        return 0;
                    }

                } else {
                    return 0;
                }
                return $nowavailableworkingtime;
            }
        }
    }

    /**
     * Get Slots Resort data
     *
     * @param array $array data
     *
     * @access public
     *
     * @return array
     */
    public static function getSlotResortUpdate($array)
    {
        usort($array, function ($a, $b) {
            return strtotime($a['start_time']) - strtotime($b['start_time']) > 0;
        });
        return $array;
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getUserUpdatePasswordByAdminContent()
    {
        $output = "";
        $output .= "Hello %user_name%!";
        $output .= " ";
        $output .= "Your Password is change by Admin. Your can now login with new password <strong>%password%</strong>";
        $output .= "%signature%";
        return $output;
    }
}
