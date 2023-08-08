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

use Illuminate\Database\Eloquent\Model;
use Serializable;
use Auth;

/**
 * Class Appointment
 *
 */
class Appointment extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
//        'appointment_date' => 'date:Y-m-d',
    ];

    /**
     * Get the doctor that owns the appointment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Store patient appointment data
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function submitAppointment($request)
    {
        $json = array();
        if (!empty($request)) {
            $user_id = Auth::user()->id;
            $user = User::findOrFail($request['user_id']);
            $this->user()->associate($user);
            $this->hospital_id = intval($request['hospital']);
            $this->patient_id = intval($user_id);
            if ($request['patient'] == 'someone') {
                $this->patient_name = filter_var($request['patient_name'], FILTER_SANITIZE_STRING);
                $this->relation = filter_var($request['relation'], FILTER_SANITIZE_STRING);
            }
            $this->services = !empty($request['speciality']) ? serialize($request['speciality']) : null;
            $this->comments = !empty($request['comments']) ? filter_var($request['comments'], FILTER_SANITIZE_STRING) : null;
            $this->appointment_time = $request['time'];
            $this->appointment_date = $request['date'];
	    $this->charges = intval($request['total_charges']);
	    $this->state = $request['meetingtime'];
            $this->video_conference = $request['videoplatform'];
            $this->status = 'pending';
            $this->save();
            $json['last_id'] = $this->id;
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Store patient appointment data
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function submitAppointmentAPI($request)
    {
        $json = array();
        if (!empty($request)) {
            $patient_id = $request['patient_id'];
            $doctor_id = $request['doctor_id'];
            $user = User::findOrFail($doctor_id);
            $this->user()->associate($user);
            $this->hospital_id = intval($request['hospital']);
            $this->patient_id = intval($patient_id);
            if ($request['patient'] == 'someone') {
                $this->patient_name = filter_var($request['patient_name'], FILTER_SANITIZE_STRING);
                $this->relation = filter_var($request['relation'], FILTER_SANITIZE_STRING);
            }
            $this->services = !empty($request['speciality']) ? serialize($request['speciality']) : null;
            $this->comments = !empty($request['comments']) ? filter_var($request['comments'], FILTER_SANITIZE_STRING) : null;
            $this->appointment_time = $request['time'];
            $this->appointment_date = $request['date'];
            $this->charges = intval($request['total_charges']);
	    $this->status = 'pending';
	    $this->state = $request['meetingtime'];
            $this->video_conference = $request['videoplatform'];
            $this->save();
            $json['last_id'] = $this->id;
            $json['type'] = 'success';
            return $json;
        }
    }
}
