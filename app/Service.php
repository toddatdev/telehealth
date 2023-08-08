<?php

/**
 * Class Service
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 *
 */
class Service extends Model
{

    /**
     * Speciality can have multiple service
     *
     * @return relation
     */
    public function speciality()
    {
        return $this->belongsTo('App\Speciality');
    }

    /**
     * The users that belong to the user.
     * 
     * @return relation
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_service')->withPivot('type', 'speciality');
    }

    /**
     * Fillable for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = array(
        'title', 'slug', 'speciality_id', 'description'
    );

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Set slug attribute
     *
     * @param int $value page ID
     *
     * @return array
     */
    public function setSlugAttribute($value)
    {
        $temp = str_slug($value, '-');
        if (!Service::all()->where('slug', $temp)->isEmpty()) {
            $i = 1;
            $new_slug = $temp . '-' . $i;
            while (!Service::all()->where('slug', $new_slug)->isEmpty()) {
                $i++;
                $new_slug = $temp . '-' . $i;
            }
            $temp = $new_slug;
        }
        $this->attributes['slug'] = $temp;
    }

    /**
     * For saving services in Database
     *
     * @param mixed $request get file
     *
     * @return \Illuminate\Http\Response
     */
    public function storeService($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $speciality = Speciality::find($request['speciality']);
            $this->speciality()->associate($speciality);
            $this->save();
        }
    }


    /**
     * Update service in database
     *
     * @param mixed   $request get req attributes
     * @param integer $id      get service ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateService($request, $id)
    {
        if (!empty($request) && !empty($id)) {
            $service = self::find($id);
            $service->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            if ($service->title != $request['title']) {
                $service->slug  =  filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $service->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $speciality = Speciality::find($request['speciality']);
            $service->speciality()->associate($speciality);
            $service->save();
        }
    }
}
