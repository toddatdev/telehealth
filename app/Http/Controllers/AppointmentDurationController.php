<?php

/**
 * Class AppointmentDurationController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\AppointmentDuration;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;

/**
 * Class AppointmentDurationController
 * 
 */
class AppointmentDurationController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access protected
     * @var    array $appointment_duration
     */
    protected $appointment_duration;

    /**
     * Create a new controller instance.
     *
     * @param mixed $appointment_duration get AppointmentDuration model
     *
     * @return void
     */
    public function __construct(AppointmentDuration $appointment_duration)
    {
        $this->AppointmentDuration = $appointment_duration;
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
            $appnt_dur = $this->AppointmentDuration::where('duration', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            $pagination = $appnt_dur->appends(
                array(
                    'keyword' => Input::get('keyword'),
                )
            );
        } else {
            $appnt_dur = $this->AppointmentDuration->paginate(10);
        }
        if (file_exists(resource_path('views/extend/back-end/admin/appointment-duration/index.blade.php'))) {
            return View::make(
                'extend. back-end.admin.appointment-duration.index', compact('appnt_dur')
            );
        } else {
            return View::make(
                'back-end.admin.appointment-duration.index', compact('appnt_dur')
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
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
            $request, [
                'duration' => 'required',
            ]
        );
        $this->AppointmentDuration->saveAppointmentDuration($request);
        Session::flash('message', trans('lang.save_appointment_duration'));
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug slug
     *
     * @return \Illuminate\Http\Redirect
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $appnt_dur = $this->AppointmentDuration::where('slug', $slug)->first();
            if (!empty($appnt_dur)) {
                return View::make(
                    'back-end.admin.appointment-duration.edit', compact('slug', 'appnt_dur')
                );
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
                'duration' => 'required',
            ]
        );
        $this->AppointmentDuration->updateAppointmentDuration($request, $id);
        Session::flash('message', trans('lang.appointment_duration_updated'));
        return Redirect::to('admin/appointment-duration');
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
            $Appointment_duration = $this->AppointmentDuration::find($id);
            $Appointment_duration->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
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
        if (!empty($checked)) {
            foreach ($checked as $id) {
                $this->AppointmentDuration::where("id", $id)->delete();
            }
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
