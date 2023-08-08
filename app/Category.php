<?php
/**
 * Class Category
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use DB;
use File;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 */
class Category extends Model
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
     * Categoy can have multiple articles.
     *
     * @return relation
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article')->withPivot('article_id');
    }

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
            if (!Category::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Category::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Saving categories
     *
     * @param string $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCategories($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->abstract = filter_var($request['abstract'], FILTER_SANITIZE_STRING);
            $old_path = Helper::PublicPath() . '/uploads/categories/temp';
            if (!empty($request['hidden_category_image'])) {
                $filename = $request['hidden_category_image'];
                if (file_exists($old_path . '/' . $request['hidden_category_image'])) {
                    $new_path = Helper::PublicPath() . '/uploads/categories/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_category_image'];
                    if (!empty(Helper::getImageSizes('category'))) {
                        foreach (Helper::getImageSizes('category') as $key => $size) {
                            rename($old_path . '/'.$key.'-'.$request['hidden_category_image'], $new_path . '/' . $key.'-'.$filename);
                        }
                        rename($old_path . '/' . $request['hidden_category_image'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['hidden_category_image'], $new_path . '/' . $filename);
                    }
                }
                $this->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $this->image = null;
            }
            $this->save();
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_created');
            return $json;
        }
    }

    /**
     * Updating Categories
     *
     * @param string $request Request attributes
     * @param int    $id      get department id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCategories($request, $id)
    {
        if (!empty($request)) {
            $cats = self::find($id);
            if ($cats->title != $request['title']) {
                $cats->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $cats->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $cats->abstract = filter_var($request['abstract'], FILTER_SANITIZE_STRING);
            $old_path = Helper::PublicPath() . '/uploads/categories/temp';
            if (!empty($request['hidden_category_image'])) {
                $filename = $request['hidden_category_image'];
                if (file_exists($old_path . '/' . $request['hidden_category_image'])) {
                    $new_path = Helper::PublicPath() . '/uploads/categories/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_category_image'];
                    if (!empty(Helper::getImageSizes('category'))) {
                        foreach (Helper::getImageSizes('category') as $key => $size) {
                            rename($old_path . '/'.$key.'-'.$request['hidden_category_image'], $new_path . '/' . $key.'-'.$filename);
                        }
                        rename($old_path . '/' . $request['hidden_category_image'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['hidden_category_image'], $new_path . '/' . $filename);
                    }
                }
                $cats->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $cats->image = null;
            }
            return $cats->save();
        }
    }

    /**
     * For updating articles
     *
     * @param int $article_id article_id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getArticleCat($article_id)
    {
        return DB::table('article_category')->select('category_id')
            ->where('article_id', $article_id)
            ->get()->pluck('category_id')->toArray();
    }
}
