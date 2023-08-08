<?php

/**
 * Class PackageController.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Package;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Spatie\Permission\Models\Role;
use App\Helper;
use Auth;
use DB;
use App\SiteManagement;
use Illuminate\Support\Facades\Input;


/**
 * Class PackageController
 *
 */
class PackageController extends Controller
{

    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $package
     */
    protected $package;

    /**
     * Create a new controller instance.
     *
     * @param instance $package instance
     *
     * @return void
     */
    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
        if (Auth::user() && $role_type != "admin") {
            $package_options = Helper::getPackageOptions();
            $packages = $this->package::all()->where('trial', 0);
            $currency   = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/doctors/package/index.blade.php'))) {
                return View::make('extend.back-end.doctors.package.index', compact('packages', 'package_options', 'symbol', 'role_type'));
            } else {
                return View::make('back-end.doctors.package.index', compact('packages', 'package_options', 'symbol', 'role_type'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $packages = $this->package::where('title', 'like', '%' . $keyword . '%')->orderBy('id', 'desc')->paginate(10)->setPath('');
            $pagination = $packages->appends(
                array(
                    'keyword' => Input::get('keyword')
                )
            );
        } else {
            $packages = $this->package::orderBy('id', 'desc')->paginate(10);
        }
        $doctor_trial = $this->package::select('trial')->where('trial', 1)->get();
        $durations = Helper::getPackageDurationList();
        $delete_title = trans("lang.ph_delete_confirm_title");
        $delete_message = trans("lang.ph_package_delete_message");
        $deleted = trans("lang.ph_delete_title");
        if (file_exists(resource_path('views/extend/back-end/admin/packages/index.blade.php'))) {
            return view(
                'extend.back-end.admin.packages.index',
                compact(
                    'packages',
                    'delete_title',
                    'delete_message',
                    'deleted',
                    'durations',
                    'doctor_trial'
                )
            );
        } else {
            return view(
                'back-end.admin.packages.index',
                compact(
                    'packages',
                    'delete_title',
                    'delete_message',
                    'deleted',
                    'durations',
                    'doctor_trial'
                )
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'package_title' => 'required',
                'package_subtitle' => 'required',
                'package_price' => 'required',
            ]
        );
        $this->package->savePackage($request);
        return response()->json(
            [
                'type' => 'success',
                'message' => trans('lang.package_created')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id package id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $package = $this->package::findOrFail($id);
            $options = !empty($package) ? unserialize($package->options) : array();
            $no_of_services = !empty($options['no_of_services']) ? $options['no_of_services'] : null;
            $no_of_brochures = !empty($options['no_of_brochures']) ? $options['no_of_brochures'] : null;
            $no_of_articles = !empty($options['no_of_articles']) ? $options['no_of_articles'] : null;
            $no_of_awards = !empty($options['no_of_awards']) ? $options['no_of_awards'] : null;
            $no_of_memberships = !empty($options['no_of_memberships']) ? $options['no_of_memberships'] : null;
            $duration = !empty($options['duration']) ? $options['duration'] : null;
            $durations = \App\Helper::getPackageDurationList();
            $doctor_trial = $this->package::select('trial')->where('trial', 1)->get();
            if (!empty($package)) {
                if (file_exists(resource_path('views/extend/back-end/admin/packages/edit.blade.php'))) {
                    return View::make(
                        'extend.back-end.admin.packages.edit',
                        compact(
                            'package',
                            'no_of_services',
                            'no_of_brochures',
                            'no_of_articles',
                            'no_of_awards',
                            'no_of_memberships',
                            'duration',
                            'doctor_trial',
                            'durations'
                        )
                    );
                } else {
                    return View::make(
                        'back-end.admin.packages.edit',
                        compact(
                            'package',
                            'no_of_services',
                            'no_of_brochures',
                            'no_of_articles',
                            'no_of_awards',
                            'no_of_memberships',
                            'duration',
                            'doctor_trial',
                            'durations'
                        )
                    );
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update packages.
     *
     * @param string $request string
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'package_title' => 'required',
                'package_subtitle' => 'required',
                'package_price' => 'required'
            ]
        );
        $update_package = $this->package->updatePackage($request);
        if ($update_package == 'success') {
            $json['type'] = 'success';
            $json['message'] = trans('lang.package_updated');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $package $request $req->attribute
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $this->package::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.package_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get package options.
     *
     * @param integer $request $request->attributes
     *
     * @return settings
     */
    public function getPackageOptions(Request $request)
    {
        $json = array();
        if ($request['id']) {
            $package = $this->package::where('id', $request['id'])->first();
            $options = unserialize($package->options);
            if (!empty($options)) {
                $json['type'] = 'success';
                if ($options['bookings'] == 'true') {
                    $json['bookings'] = 'true';
                }
                if ($options['private_chat'] == 'true') {
                    $json['private_chat'] = 'true';
                }
                if ( !empty($options['featured']) && $options['featured'] == 'true') {
                    $json['featured'] = 'true';
                }
            } else {
                $json['type'] = 'error';
            }
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get user purchase package.
     *
     * @return settings
     */
    public function getPurchasePackage()
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'server_error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        if (Auth::user()) {
            $purchase_packages = DB::table('items')
                ->join('packages', 'packages.id', '=', 'items.product_id')
                ->where('packages.trial', 0)
                ->where('subscriber', Auth::user()->id)->get();
            if ($purchase_packages->count() == 0) {
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.cannot_purchase_more_then_one_pkg');
            }
            return $json;
        } else {
            abort(404);
        }
    }
}
