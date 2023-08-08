<?php
/**
 * Class HospitalController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\User;
use App\Team;
use Auth;
use Helper;
use Illuminate\Http\Request;
use DB;
use App\EmailTemplate;
use App\Mail\DoctorEmailMailable;
use Illuminate\Support\Facades\Mail;

/**
 * Class HospitalController
 *
 */
class HospitalController extends Controller
{

    /**
     * Show hospital team listing
     *
     * @access public
     *
     * @return View
     */
    public function doctorListing()
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $hospital = User::findOrFail(Auth::user()->id);
            $teams = !empty($hospital) ? $hospital->teams()->paginate(8) : array();
            if (file_exists(resource_path('views/extend/back-end/hospitals/team/index.blade.php'))) {
                return view('back-end.hospitals.team.index', compact('teams'));
            } else {
                return view('back-end.hospitals.team.index', compact('teams'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show hospital team listing
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return View
     */
    public function approveUser(Request $request)
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $team = Team::findOrFail($request['id']);
            $team->status = 'approved';
            $team->save();
            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                $email_params = array();
                $doctor_approve_req_template = DB::table('email_types')->select('id')
                    ->where('email_type', 'doctor_email_doctor_request_approved')->get()->first();
                if (!empty($doctor_approve_req_template->id)) {
                    $hospital = User::findOrFail($team->user_id);
                    $doctor = User::findOrFail($team->doctor_id);
                    $template_data = EmailTemplate::getEmailTemplateByID($doctor_approve_req_template->id);
                    $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                    $email_params['hospital_name']  = Helper::getUserName($hospital->id);
                    $email_params['hospital_link']  = url('profile/'.$hospital->slug);
                    Mail::to($doctor->email)
                        ->send(
                            new DoctorEmailMailable(
                                'doctor_email_doctor_request_approved',
                                $template_data,
                                $email_params
                            )
                        );
                }
            }  
            return response()->json(
                [
                'type' => 'success',
                'message' => trans('lang.success')
                ]
            );
        } else {
            return response()->json(
                [
                'type' => 'error',
                'message' => trans('lang.error')
                ]
            );
        }
    }

    /**
     * Show hospital team listing
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return View
     */
    public function rejectUser(Request $request)
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $team = Team::findOrFail($request['id']);
            $team->status = 'cancelled';
            $team->save();
            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                $email_params = array();
                $doctor_cancelled_req_template = DB::table('email_types')->select('id')
                    ->where('email_type', 'doctor_email_doctor_request_cancelled')->get()->first();
                if (!empty($doctor_cancelled_req_template->id)) {
                    $hospital = User::findOrFail($team->user_id);
                    $doctor = User::findOrFail($team->doctor_id);
                    $template_data = EmailTemplate::getEmailTemplateByID($doctor_cancelled_req_template->id);
                    $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                    $email_params['hospital_name']  = Helper::getUserName($hospital->id);
                    $email_params['hospital_link']  = url('profile/'.$hospital->slug);
                    Mail::to($doctor->email)
                        ->send(
                            new DoctorEmailMailable(
                                'doctor_email_doctor_request_cancelled',
                                $template_data,
                                $email_params
                            )
                        );
                }
            }  
            return response()->json(
                [
                'type' => 'success',
                'message' => trans('lang.success')
                ]
            );
        } else {
            return response()->json(
                [
                'type' => 'error',
                'message' => trans('lang.error')
                ]
            );
        }
    }

    /**
     * Delete hospital doctor
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request)
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $team = Team::findOrFail($request['id']);
            $team->delete();
            return response()->json(
                [
                'type' => 'success',
                'message' => trans('lang.success')
                ]
            );
        } else {
            return response()->json(
                [
                'type' => 'error',
                'message' => trans('lang.error')
                ]
            );
        }
    }
}
