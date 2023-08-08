<?php

/**
 * Class ArticleController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use App\User;
use App\Helper;
use App\Category;
use App\Article;
use Illuminate\Http\Request;
use App\SiteManagement;

/**
 * Class ArticleController
 *
 */
class ArticleController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access public
     * @var    array $category
     */
    protected $article;

    /**
     * Create a new controller instance.
     *
     * @param mixed $article get site-management model
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Create Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function createArticle()
    {
        $articles = $this->article::where('author_id', Auth::user()->id)->paginate(8);
        $categories = array_pluck(Category::all()->toArray(), 'title', 'id');
        return View(
            'back-end.articles.index',
            compact('categories', 'articles')
        );
    }

    /**
     * Edit Article.
     *
     * @param string $slug post slug
     * 
     * @return \Illuminate\Http\Response
     */
    public function editArticle($slug)
    {
        if (!empty($slug)) {
            $article = $this->article::where('slug', $slug)->first();
            $categories = array_pluck(Category::all()->toArray(), 'title', 'id');
            return View(
                'back-end.articles.edit',
                compact('article', 'categories')
            );
        } else {
            abort(404);
        }
    }

    /**
     * Post Article.
     *
     * @param \Illuminate\Http\Request $request request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postArticle(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required'
            ]
        );
        if (empty($request['categories'])) {
            $response['type'] = 'cat-required';
            $response['message'] = trans('lang.cat_required');
            return $response;
        }
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $post_article = $this->article->createArticle($request);
            if ($post_article == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.article_created');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Post Article.
     *
     * @param \Illuminate\Http\Request $request request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateArticle(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required'
            ]
        );
        if (empty($request['categories'])) {
            $response['type'] = 'cat-required';
            $response['message'] = trans('lang.cat_required');
            return $response;
        }
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request) && Auth::user()) {
            $article_id = $request['article_id'];
            $update_article = $this->article->updateArticle($request, $article_id, Auth::user()->id);
            if ($update_article == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.article_created');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Remove article from database.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $article = $this->article::find($id);
            if ($article->categories->count() > 0) {
                $article->categories()->detach();
            }
            $this->article::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.article_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get all categories
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStoredCategories(Request $request)
    {
        $json = array();
        if (!empty($request['slug'])) {
            $article = $this->article::where('slug', $request['slug'])->select('id')->first();
            if (!empty($article)) {
                $articles = $this->article::find($article->id);
                $cats = $articles->categories->toArray();
                if (!empty($cats)) {
                    $json['type'] = 'success';
                    $json['cats'] = $cats;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get Article Categories.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function getArticleCats(Request $request)
    {
        $json = array();
        if (!empty($request['slug']) && $request['slug'] != 'create-article') {
            $article = $this->article::where('slug', $request['slug'])->select('id')->first();
            $db_cats = Category::select('id')->get()->pluck('id')->toArray();
            $article_cats = Category::getArticleCat($article->id);
            if (!empty($article_cats)) {
                $result = array_diff($db_cats, $article_cats);
                if (!empty($result)) {
                    $cats = DB::table('categories')
                        ->whereIn('id', $result)
                        ->orderBy('title')->get()->toArray();
                } else {
                    $cats = array();
                }
                $json['type'] = 'success';
                $json['cats'] = $cats;
                $json['message'] = trans('lang.cats_already_selected');
                return $json;
            } else {
                $cats = Category::select('title', 'id')->get()->toArray();
                if (!empty($cats)) {
                    $json['type'] = 'success';
                    $json['cats'] = $cats;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $cats = Category::select('title', 'id')->get()->toArray();
            if (!empty($cats)) {
                $json['type'] = 'success';
                $json['cats'] = $cats;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Show article listing.
     *
     * @param string $category category
     * 
     * @return \Illuminate\Http\Response
     */
    public function articleListing($category = '')
    {
        $categories = Category::all();
        $featured_articles = $this->article::where('is_featured', 1)->get();
        $saved_articles = !empty(auth()->user()->profile->saved_articles) ? unserialize(auth()->user()->profile->saved_articles) : array();
        $id = array();
        if (!empty($category)) {
            $selected_category = Category::where('slug', $category)->first();
            if (!empty($selected_category->articles) && $selected_category->articles->count() > 0) {
                foreach ($selected_category->articles as $category_article) {
                    $id[] = $category_article->id;
                }
                $articles = $this->article::whereIn('id', $id)->paginate(7);
            } else {
                $articles = '';
            }
        } else {
            $articles = $this->article::paginate(7);
        }
        $sidebar  = SiteManagement::getMetaValue('sidebar_settings');
        $download_app_img = !empty($sidebar) && !empty($sidebar['hidden_download_app_img']) ? $sidebar['hidden_download_app_img'] : '';
        $download_app_title = !empty($sidebar) && !empty($sidebar['download_app_title']) ? $sidebar['download_app_title'] : '';
        $download_app_subtitle = !empty($sidebar) && !empty($sidebar['download_app_subtitle']) ? $sidebar['download_app_subtitle'] : '';
        $download_app_desc = !empty($sidebar) && !empty($sidebar['download_app_desc']) ? $sidebar['download_app_desc'] : '';
        $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '';
        $ad_content = !empty($sidebar) && !empty($sidebar['ad_content']) ? $sidebar['ad_content'] : '';
        return View(
            'front-end.articles.index',
            compact(
                'categories',
                'featured_articles',
                'saved_articles',
                'download_app_img',
                'download_app_title',
                'download_app_subtitle',
                'download_app_desc',
                'download_app_link',
                'ad_content',
                'articles',
                'category'
            )
        );
    }

    /**
     * Show article detail.
     *
     * @param string $slug slug
     * 
     * @return \Illuminate\Http\Response
     */
    public function articleDetail($slug)
    {
        if (!empty($slug)) {
            $categories = Category::paginate(7);
            $featured_articles = $this->article::where('is_featured', 1)->get();
            $article = $this->article::where('slug', $slug)->first();
            $key = 'set_service_view';
            $sidebar  = SiteManagement::getMetaValue('sidebar_settings');
            $download_app_img = !empty($sidebar) && !empty($sidebar['hidden_download_app_img']) ? $sidebar['hidden_download_app_img'] : '';
            $download_app_title = !empty($sidebar) && !empty($sidebar['download_app_title']) ? $sidebar['download_app_title'] : '';
            $download_app_subtitle = !empty($sidebar) && !empty($sidebar['download_app_subtitle']) ? $sidebar['download_app_subtitle'] : '';
            $download_app_desc = !empty($sidebar) && !empty($sidebar['download_app_desc']) ? $sidebar['download_app_desc'] : '';
            $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '';
            $ad_content = !empty($sidebar) && !empty($sidebar['ad_content']) ? $sidebar['ad_content'] : '';
            if (!isset($_COOKIE[$key . $article->id])) {
                setcookie($key . $article->id, $key, time() + 3600);
                $view_key = $key;
                $count = $article->views;
                if ($count == '') {
                    $count = 1;
                } else {
                    $count++;
                }
                $article->views = $count;
                $article->save();
            }
            return View(
                'front-end.articles.show',
                compact(
                    'article',
                    'categories',
                    'featured_articles',
                    'download_app_img',
                    'download_app_title',
                    'download_app_subtitle',
                    'download_app_desc',
                    'download_app_link',
                    'ad_content'
                )
            );
        } else {
            abort(404);
        }
    }

    /**
     * Get home page section display settings
     *
     * @access public
     *
     * @return View
     */
    public function getFeaturedArticleSetting(Request $request)
    {
        $json = array();
        $slug =  $request['article_slug'];
        $is_featured = Article::select('is_featured')->where('slug', $slug)->pluck('is_featured')->first();
        if (!empty($is_featured)) {
            if ($is_featured ==  0) {
                $json['is_featured'] = false;
            } else {
                $json['is_featured'] = true;
            }
        }
        return $json;
    }
}
