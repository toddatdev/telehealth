<?php

/**
 * Class ServiceController.
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

use View;
use Helper;
use Session;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Speciality;

/**
 * Class ServiceController
 *
 */
class ServiceController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $service
     */
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @param mixed $service service instance
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $services = $this->service::where('title', 'like', '%' . $keyword . '%')->paginate(10)->setPath('');
            $specialities = array_pluck(Speciality::all(), 'title', 'id');
            $pagination = $services->appends(
                array(
                    'keyword' => Input::get('keyword')
                )
            );
        } else {
            $services = $this->service->paginate(10);
            $specialities = array_pluck(Speciality::all(), 'title', 'id');
        }
        if (file_exists(resource_path('views/extend/back-end/admin/services/index.blade.php'))) {
            return View::make(
                'extend.back-end.admin.services.index',
                compact('services', 'specialities')
            );
        } else {
            return View::make(
                'back-end.admin.services.index',
                compact('services', 'specialities')
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request attributes
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
                'title' => 'required',
                'speciality' => 'required'
            ]
        );
        $this->service->storeService($request);
        Session::flash('message', trans('lang.save_service'));
        return Redirect::back();
    }

    /**
     * Edit Services.
     *
     * @param int $slug string
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $service = $this->service::where('slug', $slug)->first();
            $specialities = array_pluck(Speciality::all(), 'title', 'id');
            if (!empty($service)) {
                $speciality = $this->service::where('slug', $slug)->select('speciality_id')->pluck('speciality_id')->first();
                if (file_exists(resource_path('views/extend/back-end/admin/services/edit.blade.php'))) {
                    return View::make(
                        'extend.back-end.admin.services.edit',
                        compact(
                            'service',
                            'speciality',
                            'specialities'
                        )
                    );
                } else {
                    return View::make(
                        'back-end.admin.services.edit',
                        compact(
                            'service',
                            'speciality',
                            'specialities'
                        )
                    );
                }
                Session::flash('message', trans('lang.service_updated'));
                return Redirect::to('admin/services');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update services.
     *
     * @param string $request string
     * @param int    $id      integer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $this->service->updateService($request, $id);
        Session::flash('message', trans('lang.service_updated'));
        return Redirect::to('admin/services');
    }

    /**
     * Remove service from database.
     *
     * @param mixed $request request attributes
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
            $this->service::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.service_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $server = Helper::DoctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = $request['ids'];
        if (!empty($checked)) {
            foreach ($checked as $id) {
                $this->service::where("id", $id)->delete();
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.service_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
}
