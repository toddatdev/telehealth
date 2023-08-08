<?php
/**
 * Class ImprovementOption
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
 * Class ImprovementOption
 *
 */
class ImprovementOption extends Model
{
    /**
     * Fillables for the database
     *
     * @access protected
     *
     * @var array $fillable
     */
    protected $fillable = array(
        'title', 'slug', 'abstract',
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
            if (!ImprovementOption::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!ImprovementOption::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Saving Improvement Option
     *
     * @param mixed $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveImprovementOption($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->save();
        }
    }

    /**
     * Updating Improvement Option
     *
     * @param mixed $request Request attributes
     * @param int   $id      get department id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateImprovementOption($request, $id)
    {
        if (!empty($request)) {
            $impr_opt = self::find($id);
            if ($impr_opt->title != $request['title']) {
                $impr_opt->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $impr_opt->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $impr_opt->save();
        }
    }
}
