<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Search Banner
        $home_search_banner = $this->settings::getMetaValue('home_search_banner');
        $search_form_title = !empty($home_search_banner['search_form_title']) ? $home_search_banner['search_form_title'] : '';
        $search_banner_heading = !empty($home_search_banner['search_banner_heading']) ? $home_search_banner['search_banner_heading'] : '';
        $search_banner_subheading = !empty($home_search_banner['search_banner_subheading']) ? $home_search_banner['search_banner_subheading'] : '';
        $search_banner_btn_title = !empty($home_search_banner['search_banner_btn_title']) ? $home_search_banner['search_banner_btn_title'] : '';
        $search_banner_btn_url = !empty($home_search_banner['search_banner_btn_url']) ? $home_search_banner['search_banner_btn_url'] : '';
        $search_banner_img = !empty($home_search_banner['hidden_search_banner_img']) ? $home_search_banner['hidden_search_banner_img'] : '';
        $search_banner_icon = !empty($home_search_banner['hidden_search_banner_icon']) ? $home_search_banner['hidden_search_banner_icon'] : '';
        $show_search_banner = !empty($home_search_banner['show_search_banner']) ? $home_search_banner['show_search_banner'] : '';
        // About us section
        $home_about_us_sec = $this->settings::getMetaValue('home_about_us_sec');
        $about_title = !empty($home_about_us_sec['title']) ? $home_about_us_sec['title'] : '';
        $about_subtitle = !empty($home_about_us_sec['subtitle']) ? $home_about_us_sec['subtitle'] : '';
        $about_desc = !empty($home_about_us_sec['description']) ? $home_about_us_sec['description'] : '';
        $about_btn_one_title = !empty($home_about_us_sec['btn_one_title']) ? $home_about_us_sec['btn_one_title'] : '';
        $about_btn_one_url = !empty($home_about_us_sec['btn_one_url']) ? $home_about_us_sec['btn_one_url'] : '';
        $about_btn_two_title = !empty($home_about_us_sec['btn_two_title']) ? $home_about_us_sec['btn_two_title'] : '';
        $about_btn_two_url = !empty($home_about_us_sec['btn_two_url']) ? $home_about_us_sec['btn_two_url'] : '';
        $about_img = !empty($home_about_us_sec['about_us_img']) ? $home_about_us_sec['about_us_img'] : '';
        $about_img_title = !empty($home_about_us_sec['img_title']) ? $home_about_us_sec['img_title'] : '';
        $about_img_subtitle = !empty($home_about_us_sec['img_subtitle']) ? $home_about_us_sec['img_subtitle'] : '';
        if (file_exists(resource_path('views/extend/front-end/index.blade.php'))) {
            return view(
                'extend.front-end.index',
                compact(
                    'search_form_title', 'search_banner_heading', 'search_banner_subheading',
                    'search_banner_btn_title', 'search_banner_btn_url', 'search_banner_img',
                    'search_banner_icon', 'about_title', 'about_subtitle', 'about_desc',
                    'about_btn_one_title', 'about_btn_one_url', 'about_btn_two_title',
                    'about_btn_two_url', 'about_img', 'about_img_title', 'about_img_subtitle',
                    'show_search_banner'
                )
            );
        } else {
            return view(
                'front-end.index',
                compact(
                    'search_form_title', 'search_banner_heading', 'search_banner_subheading',
                    'search_banner_btn_title', 'search_banner_btn_url', 'search_banner_img',
                    'search_banner_icon', 'about_title', 'about_subtitle', 'about_desc',
                    'about_btn_one_title', 'about_btn_one_url', 'about_btn_two_title',
                    'about_btn_two_url', 'about_img', 'about_img_title', 'about_img_subtitle',
                    'show_search_banner'
                )
            );
        }
    }
}
