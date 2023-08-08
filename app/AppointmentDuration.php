<?php

/**
 * Class AppointmentDuration
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

/**
 * Class AppointmentDuration
 *
 */
class AppointmentDuration extends Model
{
    protected $table = 'appointment_duration';

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
            if (!AppointmentDuration::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!AppointmentDuration::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Saving AppointmentDuration
     *
     * @param mixed $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAppointmentDuration($request)
    {
        if (!empty($request)) {
            $this->duration = filter_var($request['duration'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['duration'], FILTER_SANITIZE_STRING);
            return $this->save();
        }
    }

    /**
     * Updating AppointmentDuration
     *
     * @param mixed $request Request attributes
     * @param int   $id      get id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAppointmentDuration($request, $id)
    {
        if (!empty($request)) {
            $appnt_dur = self::find($id);
            if ($appnt_dur->duration != $request['duration']) {
                $appnt_dur->slug = filter_var($request['duration'], FILTER_SANITIZE_STRING);
            }
            $appnt_dur->duration = filter_var($request['duration'], FILTER_SANITIZE_STRING);
            return $appnt_dur->save();
        }
    }
}
