<?php

/**
 * Class Team
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
use App\User;
use Auth;
use DB;
use Carbon\Carbon;

/**
 * Class Team
 *
 */
class Team extends Model
{
    /**
     * The hospital that belong to the team
     *
     * @return relation
     */
    public function hospital()
    {
        return $this->belongsTo('App\User', 'user_id')->withDefault();
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAppointmentLocation($request, $user_id = '')
    {
        $doctor_id = !empty($user_id) ? $user_id : Auth::user()->id;
        $this->doctor_id = $doctor_id;
	$this->message = 'message';
	$this->immediate_bookings = $request['immediate_bookings'];
        $request_slots = array();
        $services = !empty($request['services']) ? $request['services'] : '';
        $selected_services = array();
        if (!empty($services)) {
            foreach ($services as $key => $service) {
                if (!empty($service['speciality_id'])) {
                    $selected_services['speciality'][$key]['speciality_id'] = $service['speciality_id'];
                    if (!empty($service['service'])) {
                        foreach ($service['service'] as $service_key => $speciality_service) {
                            if (!empty($speciality_service['service'])) {
                                $selected_services['speciality'][$key]['speciality_services'][$service_key]['service'] = $speciality_service['service'];
                                $selected_services['speciality'][$key]['speciality_services'][$service_key]['price'] = $speciality_service['price'];
                            }
                        }
                    }
                }
            }
            $request_slots['services'] = $selected_services;
        }
        if (!empty($request['slots'])) {
            $slot = $request['slots'];
            if (!empty($slot['appointment_days'])) {
                $start_time = $slot['start_time'];
                $spaces = '';
                $selected_slots = array();
                if (!empty($slot['custom_appointment_spaces'])) {
                    $spaces = $slot['custom_appointment_spaces'];
                } elseif (!empty($slot['appointment_spaces'])) {
                    $spaces = $slot['appointment_spaces'];
                }
                for ($i = 0; $i < $slot['number_of_slots']; $i++) {
                    if ($i != 0) {
                        $starting_time = Carbon::parse($start_time);
                        $duration = (int) $slot['intervals'] + (int) $slot['duration'];
                        $next_start_time = $starting_time->addMinutes($duration);
                        // $start_time =  Carbon::createFromFormat('G:i a', $next_start_time->format('G:i a'));
                        $start_time = $next_start_time->format('h:i a');
                        $end_time = $next_start_time->addMinutes($duration);
                        // $ending_time = Carbon::createFromFormat('G:i a', $end_time->format('G:i a'));
                        $ending_time = $end_time->format('h:i a');
                        $selected_slots[$start_time . '-' . $ending_time]['space'] = $spaces;
                    } else {
                        $start_time =  $slot['start_time'];
                        $starting_time = Carbon::parse($start_time);
                        $duration = (int) $slot['intervals'] + (int) $slot['duration'];
                        $end_time = $starting_time->addMinutes($duration);
                        // $ending_time =  Carbon::createFromFormat('G:i a', $end_time->format('G:i a'));
                        $ending_time = $end_time->format('h:i a');
                        $selected_slots[$start_time . '-' . $ending_time]['space'] = $spaces;
                    }
                }
                $request_slots['days'] = $slot['appointment_days'];
                foreach ($slot['appointment_days'] as $key => $day) {
                    $request_slots[$day]['start_time'] = $slot['start_time'];
                    $request_slots[$day]['end_time'] = $slot['end_time'];
                    $request_slots[$day]['intervals'] = !empty($slot['intervals']) ? $slot['intervals'] : '';
                    $request_slots[$day]['duration'] = !empty($slot['duration']) ? $slot['duration'] : '';
                    $request_slots[$day]['number_of_slots'] = $slot['number_of_slots'];
                    $request_slots[$day]['spaces'] = $spaces;
                    $request_slots[$day]['slots'] = $selected_slots;
                    $request_slots[$day]['consultation_fee'] = !empty($slot['consultation_fee']) ? $slot['consultation_fee'] : '';
                }
            }
            $this->slots = serialize($request_slots);
        }
        $this->status = 'approved';
        $user = User::find($request['hospital_id']);
        $this->hospital()->associate($user);
        $this->save();
        $doctor = User::find($doctor_id);
        $profile = UserMeta::find($doctor->profile->id);
        $profile->available_days = serialize($slot['appointment_days']);
        $profile->save();
        return 'success';
    }

    /**
     * Update appointment slots
     *
     * @param int    $id      id
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAppointmentSlots($id, $request)
    {
        if (!empty($id)) {
            $team = Team::find($id);
            if (!empty($team)) {
                $stored_slots = Helper::getUnserializeData($team->slots);
                $request_slots = array();
                $selected_day = !empty($stored_slots[$request['day']]) ? $stored_slots[$request['day']] : '';
                $default_slots = !empty($selected_day['slots']) ? $selected_day['slots'] : ''; 
                $spaces = '';

                $request_slots[$request['day']]['start_time'] = $request['slots']['start_time'];
                $request_slots[$request['day']]['end_time'] = $request['slots']['end_time'];
                $request_slots[$request['day']]['intervals'] = !empty($request['slots']['intervals']) ? $request['slots']['intervals'] : '';
                $request_slots[$request['day']]['duration'] = !empty($request['slots']['duration']) ? $request['slots']['duration'] : '';
                $request_slots[$request['day']]['number_of_slots'] = $request['slots']['number_of_slots'];

                if (!empty($request['slots']['custom_appointment_spaces'])) {
                    $spaces = $request['slots']['custom_appointment_spaces'];
                } elseif (!empty($request['slots']['appointment_spaces'])) {
                    $spaces = $request['slots']['appointment_spaces'];
                }
                $request_slots[$request['day']]['spaces'] = $spaces;
                $request_start_time = Carbon::create($request['slots']['start_time']);
                $request_end_time = Carbon::create($request['slots']['end_time']);

                if (!empty($default_slots)) {
                    $slots_keys    = array_keys($default_slots);
                    foreach ($slots_keys as $slot) {
                        $slot_vals  = explode('-', $slot);
                        $start_slot_val = Carbon::create($slot_vals[0]);
                        $end_slot_val = Carbon::create($slot_vals[1]);
                        if ($start_slot_val->between($request_start_time, $request_end_time)) {
                            unset($default_slots[$slot]);
                        }
                    }
                }
                for ($i = 0; $i < $request['slots']['number_of_slots']; $i++) {
                    if ($i == 0) {
                        $start_time =  $request['slots']['start_time'];
                        $starting_time = Carbon::parse($start_time);
                        $duration = (int) $request['slots']['intervals'] + (int) $request['slots']['duration'];
                        $end_time = $starting_time->addMinutes($duration);
                        // $ending_time =  Carbon::createFromFormat('H:i', $end_time->format('H:i'));
                        $slot_end_time = $end_time->format('h:i a');
                        if (!empty($default_slots)) {
                            $default_slots[$start_time . '-' . $slot_end_time]['space'] = $spaces;
                        } else {
                            $request_slots[$request['day']]['slots'][$start_time . '-' . $slot_end_time]['space'] = $spaces;
                        }
                    } else {
                        $starting_time = Carbon::parse($start_time);
                        $duration = (int) $request['slots']['intervals'] + (int) $request['slots']['duration'];
                        $next_start_time = $starting_time->addMinutes($duration);
                        // $start_time =  Carbon::createFromFormat('G:i a', $next_start_time->format('G:i a'));
                        $start_time = $next_start_time->format('h:i a');
                        $end_time = $next_start_time->addMinutes($duration);
                        // $ending_time = Carbon::createFromFormat('G:i a', $end_time->format('G:i a'));
                        $ending_time = $end_time->format('h:i a');
                        if (!empty($default_slots)) {
                            $default_slots[$start_time . '-' . $ending_time]['space'] = $spaces;
                        } else {
                            $request_slots[$request['day']]['slots'][$start_time . '-' . $ending_time]['space'] = $spaces;
                        }
                    }
                }
                if (!empty($default_slots)) {
                    $request_slots[$request['day']]['slots'] = $default_slots;
                } 
                
                unset($stored_slots[$request['day']]);
                if (!(in_array($request['day'], $stored_slots['days']))) {
                    array_push($stored_slots['days'], $request['day']);
                }
                
                $new_slots = array_merge($request_slots, $stored_slots);
		$team->slots = serialize($new_slots);
		$team->immediate_bookings = $request['immediate_bookings'];
                $team->save();
                return 'success';
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Create selected day new slot
     *
     * @param int    $id      id
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSelectedDaySlots($id, $request)
    {
        if (!empty($id)) {
            $team = Team::find($id);
            if (!empty($team)) {
                $stored_slots = Helper::getUnserializeData($team->slots);
                $request_slots = array();
                $request_slots[$request['day']]['start_time'] = $request['slots']['start_time'];
                $request_slots[$request['day']]['end_time'] = $request['slots']['end_time'];
                $request_slots[$request['day']]['intervals'] = !empty($request['slots']['intervals']) ? $request['slots']['intervals'] : '';
                $request_slots[$request['day']]['duration'] = !empty($request['slots']['duration']) ? $request['slots']['duration'] : '';
                $request_slots[$request['day']]['number_of_slots'] = $request['slots']['number_of_slots'];
                // if (!empty($stored_slots[$request['day']])) {
                //     $selected_day = $stored_slots[$request['day']];
                //     $request_slots[$request['day']]['services'] = $selected_day['services'];
                // }
                $spaces = '';
                if (!empty($request['slots']['custom_appointment_spaces'])) {
                    $spaces = $request['slots']['custom_appointment_spaces'];
                } elseif (!empty($request['slots']['appointment_spaces'])) {
                    $spaces = $request['slots']['appointment_spaces'];
                }
                $request_slots[$request['day']]['spaces'] = $spaces;
                for ($i = 0; $i < $request['slots']['number_of_slots']; $i++) {
                    if ($i == 0) {
                        $start_time =  $request['slots']['start_time'];
                        $starting_time = Carbon::parse($start_time);
                        $duration = (int) $request['slots']['intervals'] + (int) $request['slots']['duration'];
                        $end_time = $starting_time->addMinutes($duration);
                        $ending_time =  Carbon::createFromFormat('h:i a', $end_time->format('h:i a'));
                        $slot_end_time = $ending_time->format('h:i a');
                        $request_slots[$request['day']]['slots'][$start_time . '-' . $slot_end_time]['space'] = $spaces;
                    } else {
                        $starting_time = Carbon::parse($start_time);
                        $duration = (int) $request['slots']['intervals'] + (int) $request['slots']['duration'];
                        $next_start_time = $starting_time->addMinutes($duration);
                        //$start_time =  Carbon::createFromFormat('G:i a', $next_start_time->format('G:i a'));
                        $start_time = $next_start_time->format('h:i a');
                        $end_time = $next_start_time->addMinutes($duration);
                        //$ending_time = Carbon::createFromFormat('G:i a', $end_time->format('G:i a'));
                        $ending_time = $end_time->format('h:i a');
                        $request_slots[$request['day']]['slots'][$start_time . '-' . $ending_time]['space'] = $spaces;
                    }
                }
                if (!empty($stored_slots[$request['day']])) {
                    unset($stored_slots[$request['day']]);
                    $new_slots = array_merge($request_slots, $stored_slots);
                } else {
                    if (!(in_array($request['day'], $stored_slots['days']))) {
                        array_push($stored_slots['days'], $request['day']);
                    }
                    $new_slots = array_merge($request_slots, $stored_slots);
                }
                $team->slots = serialize($new_slots);
                $team->save();
                return 'success';
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Delete appointment time slot
     *
     * @param string $slot slot
     * @param string $day  day
     * @param int    $id   id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAppointmentSlots($slot, $day, $id)
    {
        if (!empty($id) && !empty($slot) && !empty($day)) {
            $team = self::find($id);
            if (!empty($team)) {
                $stored_slots = Helper::getUnserializeData($team->slots);
                $request_slots = array();
                $selected_day = $stored_slots[$day];
                $default_slots = $selected_day['slots'];
                unset($default_slots[$slot]);
                $request_slots[$day]['start_time'] = !empty($selected_day['start_time']) ? $selected_day['start_time'] : '';
                $request_slots[$day]['end_time'] = !empty($selected_day['end_time']) ? $selected_day['end_time'] : '';
                $request_slots[$day]['intervals'] = !empty($selected_day['intervals']) ? $selected_day['intervals'] : '';
                $request_slots[$day]['duration'] = !empty($selected_day['duration']) ? $selected_day['duration'] : '';
                $request_slots[$day]['number_of_slots'] = sizeof($default_slots);
                if (!empty($selected_day['services'])) {
                    $request_slots[$day]['services'] = !empty($selected_day['services']) ? $selected_day['services'] : '';
                }
                $request_slots[$day]['spaces'] = !empty($selected_day['spaces']) ? $selected_day['spaces'] : '';
                $request_slots[$day]['slots'] = $default_slots;
                unset($stored_slots[$day]);
                if (!empty($default_slots)) {
                    $new_slots = array_merge($request_slots, $stored_slots);
                    $team->slots = serialize($new_slots);
                } else {
                    unset($stored_slots[$day]['start_time']);
                    unset($stored_slots[$day]['end_time']);
                    unset($stored_slots[$day]['intervals']);
                    unset($stored_slots[$day]['duration']);
                    unset($stored_slots[$day]['number_of_slots']);
                    unset($stored_slots[$day]['spaces']);
                    unset($stored_slots[$day]['slots']);
                    $team->slots = serialize($stored_slots);
                }
                $team->save();
                return 'success';
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Delete all appointment time slot
     *
     * @param string $day day
     * @param int    $id  id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllAppointmentSlots($day, $id)
    {
        if (!empty($day) && !empty($id)) {
            $team = self::find($id);
            if (!empty($team)) {
                $stored_slots = Helper::getUnserializeData($team->slots);
                unset($stored_slots[$day]);
                $team->slots = serialize($stored_slots);
                $team->save();
                return 'success';
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Update appointment location services
     *
     * @param int    $id      id
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAppointmentLocationServices($id, $request)
    {
        if (!empty($id) && !empty($request)) {
            $team = Team::find($id);
            if (!empty($team)) {
                $stored_slots = Helper::getUnserializeData($team->slots);
                $request_slots = array();
                if (!empty($request['services'])) {
                    $selected_services = array();
                    $services = $request['services'];
                    if (!empty($services)) {
                        foreach ($services as $key => $service) {
                            if (!empty($service['speciality_id'])) {
                                $selected_services['speciality'][$key]['speciality_id'] = $service['speciality_id'];
                            }
                            if (!empty($service['service'])) {
                                foreach ($service['service'] as $service_key => $speciality_service) {
                                    if (!empty($speciality_service['service'])) {
                                        $selected_services['speciality'][$key]['speciality_services'][$service_key]['service'] = $speciality_service['service'];
                                        $selected_services['speciality'][$key]['speciality_services'][$service_key]['price'] = $speciality_service['price'];
                                    }
                                }
                            }
                        }
                    }
                    $request_slots['services'] = $selected_services;
                    unset($stored_slots['services']);
                    $new_slots = array_merge($request_slots, $stored_slots);
                    $team->slots = serialize($new_slots);
                    if ($request->has('immediate_bookings')) {
                        $team->immediate_bookings = $request->input('immediate_bookings', 0);
                    }
                    $team->save();
                    return 'success';
                } else {
                    return 'error';
                }
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Get specific doctor's hospital location
     *
     * @param integer $doctor_id doctor_id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDoctorHospitals($doctor_id)
    {
        if (!empty($doctor_id)) {
            $hospitals = Team::select('user_id')->where('doctor_id', $doctor_id)->where('status', 'approved')->get()->toArray();
            $list = array();
            if (!empty($hospitals)) {
                foreach ($hospitals as $key => $hospital) {
                    $doctor_hospital = User::find($hospital['user_id']);
                    $list[$key]['id'] = $doctor_hospital->id;
                    $list[$key]['name'] = Helper::getUserName($doctor_hospital->id);
                }
                return $list;
            } else {
                return '';
            }
        }
    }

    /**
     * Get specific doctor's Immediate Booking State
     *
     * @param integer $doctor_id doctor_id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDoctorImmediateNow($doctor_id)
    {
        if (!empty($doctor_id)) {
            $immediate_stateval = Team::select('immediate_bookings')->where('doctor_id', $doctor_id)->where('status', 'approved')->get()->first();
            return $immediate_stateval;
        }
    }
}
