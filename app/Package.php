<?php

/**
 * Class Package
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
 * Class Package
 *
 */
class Package extends Model
{

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
            if (!Package::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Package::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Save package
     *
     * @param mixed $request get req attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function savePackage($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['package_title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['package_title'], FILTER_SANITIZE_STRING);
            $this->subtitle = filter_var($request['package_subtitle'], FILTER_SANITIZE_STRING);
            $this->cost = filter_var($request['package_price'], FILTER_SANITIZE_STRING);
            $this->options = serialize($request['options']);
            if (!empty($request->trial)) {
                $this->trial = 1;
            } else {
                $this->trial = 0;
            }
            return $this->save();
        }
    }

    /**
     * Update Packages
     *
     * @param mixed $request get req attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePackage($request)
    {
        if (!empty($request)) {
            $package = self::find($request['pkg_id']);
            if ($package->title != $request['package_title']) {
                $package->slug = filter_var($request['package_title'], FILTER_SANITIZE_STRING);
            }
            $package->title = filter_var($request['package_title'], FILTER_SANITIZE_STRING);
            $package->subtitle = filter_var($request['package_subtitle'], FILTER_SANITIZE_STRING);
            $package->cost = filter_var($request['package_price'], FILTER_SANITIZE_STRING);
            $package->options = serialize($request['options']);
            $package->save();
        }
        return 'success';
    }
}
