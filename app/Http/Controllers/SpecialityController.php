<?php

/**
 * Class SpecialityController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use View;
use Session;
use App\Helper;
use App\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Service;

/**
 * Class SpecialityController
 *
 */
class SpecialityController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $speciality
     */
    protected $speciality;

    /**
     * Create a new controller instance.
     *
     * @param instance $speciality instance
     *
     * @return void
     */
    public function __construct(Speciality $speciality)
    {
        $this->speciality = $speciality;
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
            $specialities = $this->speciality::where('title', 'like', '%' . $keyword . '%')->paginate(10)->setPath('');
            $pagination = $specialities->appends(
                array(
                    'keyword' => Input::get('keyword')
                )
            );
        } else {
            $specialities = $this->speciality->paginate(10);
        }
        if (file_exists(resource_path('views/extend/back-end/admin/specialities/edit.blade.php'))) {
            return View::make(
                'extend.back-end.admin.specialities.index',
                compact('specialities')
            );
        } else {
            return View::make(
                'back-end.admin.specialities.index',
                compact('specialities')
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request $req->attr
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
        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'title' => 'required|string',
                ]
            );
            $this->speciality->saveSpeciality($request);
            Session::flash('message', trans('lang.speciality_saved_success'));
            return Redirect::back();
        }
    }

    /**
     * Edit resource.
     *
     * @param int $slug integer
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $speciality = $this->speciality::where('slug', $slug)->first();
            if (!empty($speciality)) {
                if (file_exists(resource_path('views/extend/back-end/admin/specialities/edit.blade.php'))) {
                    return View::make('extend.back-end.admin.specialities.edit', compact('speciality'));
                } else {
                    return View::make(
                        'back-end.admin.specialities.edit',
                        compact('speciality')
                    );
                }
                return Redirect::to('admin/specialities');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }


    /**
     * Update resource.
     *
     * @param string $request string
     * @param int    $id      int
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
        $this->speciality->updateSpeciality($request, $id);
        Session::flash('message', trans('lang.speciality_updated'));
        return Redirect::to('admin/specialities');
    }

    /**
     * Remove the specified resource from storage.
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
            $speciality = $this->speciality::find($id);
            if ($speciality->services->count() > 0) {
                foreach ($speciality->services as $key => $speciality_service) {
                    $service = Service::find($speciality_service->id);
                    if ($service->users->count() > 0) {
                        $service->users()->detach();
                    }
                    $service->delete();
                }
                
            }
            $this->speciality::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.speciality_deleted');
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
        foreach ($checked as $id) {
            $this->speciality::where("id", $id)->delete();
        }
        if (!empty($checked)) {
            $json['type'] = 'success';
            $json['message'] = trans('lang.specialities_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get specialities
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecialities()
    {
        $json = array();
        $specialities = $this->speciality::all();
        if (!empty($specialities)) {
            $json['type'] = 'success';
            $json['specialities'] = $specialities;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get selected speciality service
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSpecialityService(Request $request)
    {
        $json = array();
        $speciality = $this->speciality::find($request['id']);
        $speciality->services->toArray();
        if (!empty($speciality)) {
            $json['type'] = 'success';
            $json['speciality'] = $speciality;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get selected speciality service
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getServices(Request $request)
    {
        $json = array();
        $type = !empty($request['type']) && $request['type'] == 'slug' ? 'slug' : 'id';
        if ($type == 'slug') {
            $selected_speciality = speciality::select('id')->where('slug', $request['id'])
                ->first();
            $speciality = $this->speciality::find($selected_speciality->id);
        } else {
            $speciality = $this->speciality::find($request['id']);
        }
        if (!empty($speciality) && $speciality->services->count() > 0) {
            $services = $speciality->services->toArray();
            if (!empty($speciality)) {
                if (!empty($speciality)) {
                    $json['type'] = 'success';
                    $json['services'] = $services;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
}
