<?php

/**
 * Class AppointmentInterval
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
 * Class AppointmentInterval
 *
 */
class AppointmentInterval extends Model
{

    protected $table = 'appointment_interval';

    /**
     * Saving AppointmentInterval
     *
     * @param mixed $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAppointmentInterval($request)
    {
        if (!empty($request)) {
            $this->interval = filter_var($request['interval'], FILTER_SANITIZE_STRING);
            return $this->save();
        }
    }

    /**
     * Updating AppointmentInterval
     *
     * @param mixed $request Request attributes
     * @param int   $id      get id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAppointmentInterval($request, $id)
    {
        if (!empty($request)) {
            $appnt_intrv = self::find($id);
            $appnt_intrv->interval = filter_var($request['interval'], FILTER_SANITIZE_STRING);
            return $appnt_intrv->save();
        }
    }
}
