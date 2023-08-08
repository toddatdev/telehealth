<?php

/**
 * Class User.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use App\Helper;
use App\Location;
use App\UserMeta;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Carbon\Carbon;

/**
 * Class User
 *
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'slug', 'email', 'password',
        'avatar', 'banner', 'tagline', 'description',
        'location_id', 'verification_code', 'address',
        'longitude', 'latitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the location that owns the user.
     *
     * @return relation
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function profile()
    {
        return $this->hasOne('App\UserMeta')->withDefault();
    }

    /**
     * Get the article associated with the user.
     *
     * @return relation
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'author_id');
    }

    /**
     * The team that belong to the user
     *
     * @return relation
     */
    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    /**
     * Approved teams that belong to the hopsital
     *
     * @return relation
     */
    public function approvedTeams()
    {
        return $this->hasMany('App\Team')->where('status', 'approved');
    }

    /**
     * The appointment that belong to the user
     *
     * @return relation
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }

    /**
     * The users that belong to the service.
     *
     * @return relation
     */
    public function forums()
    {
        return $this->belongsToMany('App\Forum', 'user_forum')->withPivot('type', 'answer');
    }

    /**
     * Get service seller
     *
     * @return relation
     */
    public function question()
    {
        return $this->belongsToMany('App\Forum', 'user_forum')->wherePivot('type', 'question');
    }

    /**
     * Get service seller
     *
     * @return relation
     */
    public function answers()
    {
        return $this->belongsToMany('App\Forum', 'user_forum')->withPivot('type', 'answer', 'user_id')->wherePivot('type', 'answer', 'user_id');
    }

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * The services that belong to the user.
     *
     * @return relation
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'user_service')->withPivot('type', 'speciality');
    }

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }

    /**
     * Set slug before saving in DB
     *
     * @param string $value value
     *
     * @access public
     *
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = str_slug($value, '-');
            if (!User::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!User::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Store user
     *
     * @param \Illuminate\Http\Request $request code
     * @param string $verification_code verification code
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUser($request, $verification_code = '')
    {
        if (!empty($request)) {
            $this->first_name = filter_var($request['first_name'], FILTER_SANITIZE_STRING);
            $this->last_name = filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' .
                filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            $this->email = filter_var($request['email'], FILTER_VALIDATE_EMAIL);
            $this->password = Hash::make($request['password']);
            $this->verification_code = !empty($verification_code) ? $verification_code : null;
            $this->user_verified = 0;
            $role = DB::table('roles')->select('name')->where('role_type', $request['role'])->first();
            $this->assignRole($role->name);
            if (!empty($request['locations'])) {
                $location = Location::find($request['locations']);
                $this->location()->associate($location);
            }
            $this->package_expiry = null;
            $this->save();
            $user_id = $this->id;
            $profile = new UserMeta();
            $profile->user()->associate($user_id);
            $profile->save();
            $role_id = Helper::getRoleByUserID($user_id);
            return $user_id;
        }
    }

    /**
     * Update user data
     *
     * @param \Illuminate\Http\Request $request code
     * @param string $verification_code verification code
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser($request, $edit_user_id = '')
    {
        $json = array();
        if (!empty($request)) {
            if (!empty($edit_user_id)) {
                $user = $this::find($edit_user_id);
            } else {
                $user = $this;
            }
            $user->first_name = filter_var($request['first_name'], FILTER_SANITIZE_STRING);
            $user->last_name = filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            $slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' .
                filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            if ($user->slug != str_slug($slug, '-')) {
                $user->slug = $slug;
            }
            if (empty($user->email) && !empty($request['email'])) {
                $user->email = filter_var($request['email'], FILTER_VALIDATE_EMAIL);
            }
            if (!empty($request['password'])) {
                $user->password = Hash::make($request['password']);
            }
            $role_type = Helper::getRoleTypeByUserID($edit_user_id);
            if (!empty($request['role']) && $request['role'] != $role_type) {
                $role = DB::table('roles')->select('name')->where('role_type', $request['role'])->first();
                DB::table('model_has_roles')->where('model_id', $edit_user_id)->delete();
                $user->assignRole($role->name);
                $role_type = Helper::getRoleTypeByUserID($edit_user_id);
                if ($role_type == 'doctor') {
                    if ($user->orders->count() > 0) {
                        foreach ($user->orders as $user_orders) {
                            DB::table('order_metas')->where('metable_id', $user_orders->id)->delete();
                        }
                        $user->orders()->delete();
                    }
                    $order = new Order();
                    $order->status = 'pending';
                    $order->payment_gateway = 'paypal';
                    $order->user()->associate($edit_user_id);
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
                        $user = User::find($edit_user_id);
                        $user->package_expiry = $expiry_date;
                        $user->save();
                    }
                }
            }
            if (!empty($request['locations'])) {
                $location = Location::find($request['locations']);
                $user->location()->associate($location);
            }
            // $user->package_expiry = null;
            $user->save();
            $user_id = $user->id;

            // // $profile = new UserMeta();
            // // $profile->user()->associate($user_id);
            // // $profile->save();
            // $role_id = Helper::getRoleByUserID($user_id);
            $json['user_id'] = $user_id;
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Get search results
     *
     * @param integer $type type
     * @param integer $keyword keyword
     * @param integer $search_locations search_locations
     * @param integer $search_service search_service
     * @param integer $search_speciality search_speciality
     * @param integer $order_by order_by
     * @param integer $sort_by sort_by
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getSearchResult($type, $keyword, $search_locations, $search_service, $search_speciality, $order_by, $sort_by)
    {

        $json = array();
        $user_id = array();
        $filters = array();
        $user_by_role = !empty($type) && $type != 'both' ? Helper::getUsersByRoleType($type) : Helper::getSearchableUsers();
        $users = DB::table('users')->where('id', '!=', '15')->whereIn('id', $user_by_role);
        if (!empty($users)) {
            $filters['type'] = $type;
            if (!empty($keyword)) {
                $filters['keyword'] = $keyword;
                $users->where('first_name', 'like', '%' . $keyword . '%');
                $users->orWhere('last_name', 'like', '%' . $keyword . '%');
                $users->orWhere('zipcode', 'like', '%' . $keyword . '%');
                $users->orWhere('city', 'like', '%' . $keyword . '%');
                $users->orWhere('slug', 'like', '%' . $keyword . '%');
                $users->whereIn('id', $user_by_role);
            }

            $postcodes = collect(json_decode(file_get_contents(public_path('extra/js/postcodes.json')), true));
            $postcode = $postcodes->whereIn('locality', explode(' ', $keyword))->first();

            if ($postcode) {
                $users->orWhere('zipcode', 'like', '%' . $postcode['postcode'] . '%');
            }

            if (!empty($search_locations)) {
                $filters['locations'] = $search_locations;
                //$locations = Location::select('id')->where('slug', $search_locations)
                //    ->get()->pluck('id')->toArray();
                //$location_user = User::select('id')->whereIn('location_id', $locations)->get()->pluck('id')->toArray();
                //$users->whereIn('id', $location_user)->whereIn('id', $user_by_role);
                $users->where('languagelist', 'like', '%' . $search_locations . '%')->whereIn('id', $user_by_role);
            }
            if (!empty($search_service)) {
                $filters['service'] = $search_service;
                $selected_service = Service::select('id')->where('slug', $search_service)
                    ->first();
                $service = Service::find($selected_service->id);
                if ($service->users->count() > 0) {
                    foreach ($service->users as $key => $user_service) {
                        $user_id[] = $user_service->id;
                    }
                }
                $users->whereIn('id', $user_id)->whereIn('id', $user_by_role);
            }
            if (!empty($search_speciality)) {
                $filters['speciality'] = $search_speciality;
                $selected_speciality = Speciality::select('id')->where('slug', $search_speciality)
                    ->first();
                $speciality_users = DB::table('user_service')->select('user_id')
                    ->where('speciality', $selected_speciality->id)
                    ->groupBy('user_id')
                    ->get()->pluck('user_id')->toArray();
                $users->whereIn('id', $speciality_users)->whereIn('id', $user_by_role);
            }
            $order = !empty($order_by) ? $order_by : 'asc';
            if (!empty($sort_by)) {
                $users = DB::table('users')
                    ->join('user_metas', 'user_metas.user_id', '=', 'users.id')
                    ->select('user_metas.*', 'users.*');
                $users = $users->where('users.id', '!=', '15')->whereIn('users.id', $user_by_role);
                if ($sort_by == 'rating') {
                    $users = $users->orderBy('user_metas.votes', 'desc');
                } elseif ($sort_by == 'lowprice') {
                    $users = $users->orderBy('user_metas.starting_price', $order);
                } elseif ($sort_by == 'highprice') {
                    $users = $users->orderBy('user_metas.starting_price', 'desc');
                } elseif ($sort_by == 'availablenow') {
                    //$users = $users->orderBy('user_metas.working_time', 'desc');
                    $onlinenow_users = Helper::getDoctorAvailableNowList();
                    $users = $users->orderBy(DB::raw('FIELD(users.id, ' . $onlinenow_users . ')'), 'desc');
                } elseif ($sort_by == 'date') {
                    $users = $users->orderBy('users.created_at', $order);
                } else {
                    $users = $users->orderBy($sort_by, $order);
                }
            }
            $usersearch_count = $users->count();
            if ($usersearch_count > 0) {
                $json['total'] = $users->count();
                $users = $users->paginate(8);
            } else {
                //  $users = DB::select("SELECT * FROM users WHERE zipcode !='' ORDER BY ABS( zipcode - $keyword )");
                if (is_numeric($keyword)) {
                    $users = DB::table('users')->whereIn('id', $user_by_role);
                    $users->where('zipcode', '!=', '');
                    $users = $users->orderBy(DB::raw('ABS(zipcode - ' . $keyword . ')'), 'asc');
                    $json['total'] = $users->count();
                    $users = $users->paginate(8);
                } else {
                    $json['total'] = $users->count();
                    $users = $users->paginate(8);
                }
            }
        }
        // dd($filters);
        foreach ($filters as $key => $filter) {
            $pagination = $users->appends(
                array(
                    $key => $filter
                )
            );
        }
        $json['users'] = $users;
        return $json;
    }

    /**
     * Update doctor payout table
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatePayouts()
    {
        // $payout_settings = SiteManagement::getMetaValue('commision');
        // $min_payount = !empty($payout_settings) && !empty($payout_settings[0]['min_payout']) ? $payout_settings[0]['min_payout'] : '';
        // // $payment_gateway = !empty($payout_settings) && !empty($payout_settings[0]['payment_method']) ? $payout_settings[0]['payment_method'] : 'paypal';
        // $payment_settings = SiteManagement::getMetaValue('commision');
        // $currency  = !empty($payment_settings) && !empty($payment_settings[0]['currency']) ? $payment_settings[0]['currency'] : 'USD';


    }
}
