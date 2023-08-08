<?php

/**
 * Class AppointmentIntervalController
 *
 * @AppointmentInterval Doctie
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\AppointmentInterval;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;

/**
 * Class HospitalController
 *
 */
class AppointmentIntervalController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access protected
     * @var    array $appointment_interval
     */
    protected $appointment_interval;

    /**
     * Create a new controller instance.
     *
     * @param mixed $appointment_interval get AppointmentInterval model
     *
     * @return void
     */
    public function __construct(AppointmentInterval $appointment_interval)
    {
        $this->AppointmentInterval = $appointment_interval;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\View
     */
    public function index()
    {
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $appnt_intrv = $this->AppointmentInterval::where('interval', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            $pagination = $appnt_intrv->appends(
                array(
                    'keyword' => Input::get('keyword'),
                )
            );
        } else {
            $appnt_intrv = $this->AppointmentInterval->paginate(10);
        }
        return View::make(
            'back-end.admin.appointment-interval.index', compact('appnt_intrv')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request $req->attr
     *
     * @return \Illuminate\Http\Redirect
     */
    public function store(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request, [
                'interval' => 'required',
            ]
        );
        $this->AppointmentInterval->saveAppointmentInterval($request);
        Session::flash('message', trans('lang.save_appointment_interval'));
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id ID
     *
     * @return \Illuminate\Http\Redirect
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $appnt_intrv = $this->AppointmentInterval::where('id', $id)->first();
            if (!empty($appnt_intrv)) {
                return View::make(
                    'back-end.admin.appointment-interval.edit', compact('id', 'appnt_intrv')
                );
                return Redirect::to('appointment-interval');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     * @param int                      $id      id
     *
     * @return \Illuminate\Http\Redirect
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request, [
                'interval' => 'required',
            ]
        );
        $this->AppointmentInterval->updateAppointmentInterval($request, $id);
        Session::flash('message', trans('lang.appointment_interval_updated'));
        return Redirect::to('admin/appointment-interval');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request request
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
            $Appointment_interval = $this->AppointmentInterval::find($id);
            $Appointment_interval->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_deleted');
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
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = $request['ids'];
        foreach ($checked as $id) {
            $this->AppointmentInterval::where("id", $id)->delete();
        }
        if (!empty($checked)) {
            $json['type'] = 'success';
            $json['message'] = trans('lang.imprv_opts_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
}
