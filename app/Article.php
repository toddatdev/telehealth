<?php
/**
 * Class Article.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App;

use Auth;
use File;
use App\User;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 *
 */
class Article extends Model
{
    /**
     * Fillable for the database
     *
     * @return fillable
     */
    protected $fillable = array(
        'author_id', 'categories', 'tags', 'views', 'title', 'description', 'image',
        'excerpt', 'is_featured'
    );

    /**
     * Dates
     *
     * @return protected dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Articles can have multiple authors
     *
     * @return relation
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Articles can have multiple categories.
     *
     * @return relation
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withPivot('article_id');
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
            if (!Article::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Article::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Create article
     *
     * @param mixed $request $req->attr
     *
     * @return relation
     */
    public function createArticle(Request $request)
    {
        if (!empty($request)) {
            $article = new Article();
            $article->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $article->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $article->description = $request['description'];
            $article->excerpt = filter_var(Str::limit($request['description'], 100), FILTER_SANITIZE_STRING);
            if ($request['is_featured'] === 'true') {
                $article->is_featured = 1;
            } else {
                $article->is_featured = 0;
            }
            $user_id = User::find(Auth::user()->id);
            $article->author()->associate($user_id);
            if (!empty($request['hidden_feature_img'])) {
                $old_path = Helper::PublicPath() . '/uploads/users/temp';
                $new_path = Helper::PublicPath() . '/uploads/users/'.Auth::user()->id.'/articles';
                if (file_exists($old_path . '/' . $request['hidden_feature_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_feature_img'];
                    $article_img_sizes = Helper::getImageSizes('articles');
                    if (!empty($article_img_sizes)) {
                        foreach ($article_img_sizes as $key => $size) {
                            rename($old_path . '/'.$key.'-'.$request['hidden_feature_img'], $new_path . '/' . $key.'-'.$filename);
                        }
                        rename($old_path . '/' . $request['hidden_feature_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['hidden_feature_img'], $new_path . '/' . $filename);
                    }
                    $request['hidden_feature_img'] = $filename;
                }
                $article->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $article->image = null;
            }
            $article->save();
            $cats = $request['categories'];
            $this->categories()->detach();
            if (!empty($cats)) {
                foreach ($cats as $cat) {
                    $this->categories()->attach($cat['id'], ['article_id' => $article->id]);
                }
            }
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Articles
     *
     * @param integer $paginate paginate
     * @param boolean $featured featured
     * 
     * @access public
     *
     * @return array
     */
    public static function getArticles($paginate = 7, $featured = '')
    {
        $articles = array();
        $articles = Article::latest();
        if (!empty($featured)) {
            $articles->where('is_featured', $featured);
        }
        return $articles->paginate(intval($paginate));
        
    }
    

    /**
     * Update Article
     *
     * @param integer $request    $req->attr
     * @param integer $article_id article_id
     * @param integer $user_id    user ID
     *
     * @return relation
     */
    public function updateArticle($request, $article_id, $user_id)
    {
        if (!empty($request)) {
            $article = $this->findOrFail($article_id);
            $article->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            if ($article->title != $request['title']) {
                $article->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $article->description = $request['description'];
            $article->excerpt = filter_var(Str::limit($request['description'], 100), FILTER_SANITIZE_STRING);
            if ($request['is_featured'] === 'true') {
                $article->is_featured = 1;
            } else {
                $article->is_featured = 0;
            }
            if (!empty($request['hidden_feature_img'])) {
                $old_path = Helper::PublicPath() . '/uploads/users/temp';
                $new_path = Helper::PublicPath() . '/uploads/users/'.Auth::user()->id.'/articles';
                if (file_exists($old_path . '/' . $request['hidden_feature_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_feature_img'];
                    $article_img_sizes = Helper::getImageSizes('articles');
                    if (!empty($article_img_sizes)) {
                        foreach ($article_img_sizes as $key => $size) {
                            rename($old_path . '/'.$key.'-'.$request['hidden_feature_img'], $new_path . '/' . $key.'-'.$filename);
                        }
                        rename($old_path . '/' . $request['hidden_feature_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['hidden_feature_img'], $new_path . '/' . $filename);
                    }
                } else {
                    $filename = $request['hidden_feature_img'];
                }
                $article->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $article->image = null;
            }
            $article->save();
            $cats = $request['categories'];
            $article->categories()->detach();
            if (!empty($cats)) {
                foreach ($cats as $cat) {
                    $article->categories()->attach($cat['id']);
                }
            }
            return 'success';
        } else {
            return 'error';
        }
    }


}
