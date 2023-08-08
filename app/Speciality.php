<?php

/**
 * Class Speciality.
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
use File;

/**
 * Class Speciality
 *
 */
class Speciality extends Model
{

    /**
     * Get the services associated with the speciality.
     *
     * @return relation
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    /**
     * Fillables for the database
     *
     * @access protected
     *
     * @var array $fillable
     */
    protected $fillable = array('title', 'slug', 'body');

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
        if (!Speciality::all()->where('slug', $temp)->isEmpty()) {
            $i = 1;
            $new_slug = $temp . '-' . $i;
            while (!Speciality::all()->where('slug', $new_slug)->isEmpty()) {
                $i++;
                $new_slug = $temp . '-' . $i;
            }
            $temp = $new_slug;
        }
        $this->attributes['slug'] = $temp;
    }

    /**
     * Get Parent Pages
     *
     * @param mixed $request $req->attribute
     *
     * @return array
     */
    public function saveSpeciality($request)
    {
        if (!empty($request)) {
            $this->title =  filter_var($request->title, FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request->title, FILTER_SANITIZE_STRING);
            $this->description = $request->desc;
            $old_path = Helper::PublicPath() . '/uploads/specialities/temp';
            $new_path = Helper::PublicPath() . '/uploads/specialities/';
            if (!empty($request['speciality_image'])) {
                $filename = $request['speciality_image'];
                if (file_exists($old_path . '/' . $request['speciality_image'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['speciality_image'];
                    if (!empty(Helper::getImageSizes('speciality'))) {
                        foreach (Helper::getImageSizes('speciality') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $request['speciality_image'])) {
                                rename($old_path . '/' . $key . '-' . $request['speciality_image'], $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $request['speciality_image'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['speciality_image'], $new_path . '/' . $filename);
                    }
                }
                $this->image = $filename;
            } else {
                $this->image = null;
            }
            $this->save();
            return 'success';
        }
    }

    /**
     * Update speciality
     *
     * @param mixed $request $req->attribute
     * @param int   $id      id
     *
     * @return array
     */
    public function updateSpeciality($request, $id)
    {
        if (!empty($id) && !empty($request)) {
            $speciality = self::find($id);
            if ($speciality->title != $request['title']) {
                $speciality->slug  =  filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $speciality->title = filter_var($request->title, FILTER_SANITIZE_STRING);
            $speciality->description = $request->desc;
            $old_path = Helper::PublicPath() . '/uploads/specialities/temp';
            $new_path = Helper::PublicPath() . '/uploads/specialities/';
            if (!empty($request['speciality_image'])) {
                $filename = $request['speciality_image'];
                if (file_exists($old_path . '/' . $request['speciality_image'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['speciality_image'];
                    if (!empty(Helper::getImageSizes('speciality'))) {
                        foreach (Helper::getImageSizes('speciality') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $request['speciality_image'])) {
                                rename($old_path . '/' . $key . '-' . $request['speciality_image'], $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $request['speciality_image'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['speciality_image'], $new_path . '/' . $filename);
                    }
                }
                $speciality->image = $filename;
            } else {
                $speciality->image = null;
            }
            $speciality->save();
        }
    }

    /**
     * For updating skills
     *
     * @param int $user_id get user ID
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDoctorSpeciality($user_id)
    {
        if (!empty($user_id)) {
            return DB::table('skill_user')->select('skill_id')
                ->where('user_id', $user_id)
                ->get()->pluck('skill_id')->toArray();
        } else {
            return '';
        }
    }
}
