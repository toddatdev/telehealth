<?php

/**
 * Class SiteManagementSeeder.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class SiteManagementSeeder
 */
class SiteManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_managements')->insert(
            [
                [
                    'meta_key' => 'payment_settings',
                    'meta_value' => 'a:2:{s:8:"currency";s:3:"USD";s:14:"payment_method";a:2:{i:0;s:6:"paypal";i:1;s:6:"stripe";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'general_settings',
                    'meta_value' => 'a:12:{s:9:"site_logo";s:19:"1568873182-logo.png";s:12:"site_favicon";s:22:"1568873182-favicon.png";s:12:"gmap_api_key";N;s:8:"language";s:2:"en";s:15:"body-lang-class";s:7:"lang-en";s:12:"display_chat";s:4:"true";s:20:"enable_primary_color";s:4:"true";s:13:"primary_color";s:7:"#3fabf3";s:22:"enable_secondary_color";s:4:"true";s:15:"secondary_color";s:7:"#ff5851";s:21:"enable_tertiary_color";s:4:"true";s:14:"tertiary_color";s:7:"#3d4461";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'email_data',
                    'meta_value' => 'a:8:{s:10:"from_email";s:19:"info@yourdomain.com";s:13:"from_email_id";s:7:"Doclist";s:11:"sender_name";s:14:"Doclist Sender";s:14:"sender_tagline";s:27:"Doclist a Medical Directory";s:10:"sender_url";N;s:10:"email_logo";s:21:"1568874052-d-logo.png";s:12:"email_banner";s:22:"1568874052-bglight.jpg";s:13:"sender_avatar";s:28:"1568874053-user-logo-def.jpg";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'home_slider',
                    'meta_value' => 'a:3:{i:0;a:8:{s:15:"slide_title_one";s:10:"Emergency?";s:15:"slide_title_two";s:12:"Find Nearest";s:17:"slide_title_three";s:16:"Medical Facility";s:19:"slide_btn_title_one";s:14:"View Hospitals";s:17:"slide_btn_url_one";s:1:"#";s:19:"slide_btn_title_two";s:12:"View Doctors";s:17:"slide_btn_url_two";s:1:"#";s:24:"hidden_slide_inner_image";s:21:"1569052805-img-01.png";}i:4;a:8:{s:15:"slide_title_one";s:10:"Emergency?";s:15:"slide_title_two";s:12:"Find Nearest";s:17:"slide_title_three";s:16:"Medical Facility";s:19:"slide_btn_title_one";s:14:"View Hospitals";s:17:"slide_btn_url_one";s:1:"#";s:19:"slide_btn_title_two";s:12:"View Doctors";s:17:"slide_btn_url_two";s:1:"#";s:24:"hidden_slide_inner_image";s:21:"1569052805-img-02.png";}i:7;a:8:{s:15:"slide_title_one";s:10:"Emergency?";s:15:"slide_title_two";s:12:"Find Nearest";s:17:"slide_title_three";s:16:"Medical Facility";s:19:"slide_btn_title_one";s:14:"View Hospitals";s:17:"slide_btn_url_one";s:1:"#";s:19:"slide_btn_title_two";s:12:"View Doctors";s:17:"slide_btn_url_two";s:1:"#";s:24:"hidden_slide_inner_image";s:21:"1569052805-img-03.png";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'slider_bg_img',
                    'meta_value' => '1569052805-banner-img.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'home_search_banner',
                    'meta_value' => 'a:7:{s:18:"show_search_banner";s:4:"true";s:17:"search_form_title";s:17:"Start Your Search";s:21:"search_banner_heading";s:13:"Join Our Team";s:24:"search_banner_subheading";s:17:"Are You A Doctor?";s:23:"search_banner_btn_title";s:14:"Join as Doctor";s:21:"search_banner_btn_url";s:1:"#";s:24:"hidden_search_banner_img";s:21:"1569052927-img-04.png";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'services_tab_sec',
                    'meta_value' => 'a:7:{i:0;a:5:{s:5:"title";s:7:"Doctors";s:8:"subtitle";s:14:"Live Chat With";s:9:"btn_title";s:16:"Show All Doctors";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#1abc9c";}i:1;a:5:{s:5:"title";s:16:"Nearest Hospital";s:8:"subtitle";s:21:"Fast Appointment With";s:9:"btn_title";s:26:"Show All Nearest Hospitals";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#3fabf3";}i:2;a:5:{s:5:"title";s:19:"Hospitals & Doctors";s:8:"subtitle";s:17:"Articles From Top";s:9:"btn_title";s:17:"Show All Articles";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#f1c40f";}i:3;a:5:{s:5:"title";s:12:"Help Support";s:8:"subtitle";s:15:"Our 24/7 Active";s:9:"btn_title";s:26:"Show All Nearest Hospitals";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#9b59b6";}i:4;a:5:{s:5:"title";s:12:"Download App";s:8:"subtitle";s:14:"Help on The Go";s:9:"btn_title";s:26:"Show All Nearest Hospitals";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#ff5851";}i:5;a:5:{s:5:"title";s:7:"Doctors";s:8:"subtitle";s:14:"Live Chat With";s:9:"btn_title";s:16:"Show All Doctors";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#2eca80";}i:7;a:5:{s:5:"title";s:16:"Nearest Hospital";s:8:"subtitle";s:21:"Fast Appointment With";s:9:"btn_title";s:26:"Show All Nearest Hospitals";s:7:"btn_url";s:1:"#";s:5:"color";s:7:"#7751e5";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'show_services_section',
                    'meta_value' => 'true',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'home_about_us_sec',
                    'meta_value' => 'a:11:{s:14:"show_about_sec";s:4:"true";s:5:"title";s:19:"Home With One Click";s:8:"subtitle";s:18:"Bring Care To Your";s:11:"description";s:126:"Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua.";s:13:"btn_one_title";s:8:"About Us";s:11:"btn_one_url";s:1:"#";s:13:"btn_two_title";s:7:"Contact";s:11:"btn_two_url";s:1:"#";s:19:"hidden_about_us_img";s:21:"1569054117-img-01.png";s:9:"img_title";s:18:"Dr. Tyrone Grindle";s:12:"img_subtitle";s:19:"Greetings & Welcome";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'home_how_works_sec',
                    'meta_value' => 'a:4:{s:17:"show_how_work_sec";s:4:"true";s:5:"title";s:13:"How It Works?";s:8:"subtitle";s:17:"We Made It Simple";s:7:"hw_desc";s:163:"<p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'how_work_tabs',
                    'meta_value' => 'a:3:{i:0;a:4:{s:5:"title";s:12:"Professional";s:8:"subtitle";s:18:"Search Best Online";s:3:"url";s:1:"#";s:7:"tab_img";s:21:"1569054476-img-01.png";}i:1;a:4:{s:5:"title";s:11:"Appointment";s:8:"subtitle";s:11:"Get Instant";s:3:"url";s:1:"#";s:7:"tab_img";s:21:"1569054476-img-02.png";}i:2;a:4:{s:5:"title";s:8:"Feedback";s:8:"subtitle";s:10:"Leave Your";s:3:"url";s:1:"#";s:7:"tab_img";s:21:"1569054476-img-03.png";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'show_how_work_tabs',
                    'meta_value' => 'true',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'download_app_sec',
                    'meta_value' => 'a:9:{s:12:"show_app_sec";s:4:"true";s:5:"title";s:14:"Care On The GO";s:8:"subtitle";s:19:"Download Mobile App";s:11:"description";s:133:"<p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua.</p>";s:11:"app_sec_img";s:21:"1569221891-img-01.png";s:11:"android_url";s:1:"#";s:11:"android_img";s:21:"1569221891-img-03.png";s:7:"ios_url";s:1:"#";s:7:"ios_img";s:21:"1569221891-img-02.png";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'doctors_slider',
                    'meta_value' => 'a:2:{s:19:"show_doctors_slider";s:4:"true";s:10:"speciality";s:1:"1";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'article_section',
                    'meta_value' => 'a:4:{s:16:"show_article_sec";s:4:"true";s:5:"title";s:15:"Latest Articles";s:8:"subtitle";s:26:"Read Professional Articles";s:11:"description";s:156:"Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'topbar_settings',
                    'meta_value' => 'a:4:{s:13:"enable_topbar";s:4:"true";s:5:"title";s:15:"Emergency Help!";s:6:"number";s:15:"+1 234 5678 - 9";s:19:"enable_social_icons";s:4:"true";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'socials',
                    'meta_value' => 'a:6:{i:0;a:2:{s:5:"title";s:8:"facebook";s:3:"url";s:1:"#";}i:1;a:2:{s:5:"title";s:7:"twitter";s:3:"url";s:1:"#";}i:2;a:2:{s:5:"title";s:8:"linkedin";s:3:"url";s:1:"#";}i:3;a:2:{s:5:"title";s:10:"googleplus";s:3:"url";s:1:"#";}i:4;a:2:{s:5:"title";s:3:"rss";s:3:"url";s:1:"#";}i:5;a:2:{s:5:"title";s:7:"youtube";s:3:"url";s:1:"#";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'footer_settings',
                    'meta_value' => 'a:26:{s:21:"show_contact_info_sec";s:4:"true";s:14:"c_info_img_one";s:21:"1569220874-img-01.png";s:16:"c_info_title_one";s:14:"Emergency Call";s:13:"c_info_number";s:15:"+1 234 5678 - 9";s:14:"c_info_img_two";s:21:"1569220874-img-02.png";s:16:"c_info_title_two";s:18:"24/7 Email Support";s:12:"c_info_email";s:15:"Info@Domain.Com";s:11:"footer_logo";s:20:"1569220874-flogo.png";s:13:"about_us_note";s:130:"<p>Consectetur adipisicing elit, sed dot eiusd tempor incididunt ailabor dolore magna dolore magnam aliquam quaerat voluptatem</p>";s:7:"address";s:50:"123 New Street, Melbourne location Australia 54214";s:5:"email";s:18:"info@domainurl.com";s:5:"phone";s:18:"(0800) 1234 567891";s:21:"enable_footer_socials";s:4:"true";s:9:"copyright";s:29:"Copyrights © 2019 by Doctry.";s:17:"twitter_user_name";s:10:"amentotech";s:12:"consumer_key";s:25:"FXWrG3GT8lZISpUQ3cPIGtWGD";s:15:"consumer_secret";s:50:"hBvd6EymRSytId0HdRYKChktkn7z6bROS4tT0W51qPPYmWXLP6";s:12:"access_token";s:50:"741200932092923904-21cx58DU3CizhkEBjyQLOwm6SKzoj4W";s:19:"access_token_secret";s:45:"eevAYEC05SKl2fJAZXKJ3g4eLVdgWubeZ5iP3CGJYIVxg";s:16:"number_of_tweets";s:1:"2";s:14:"menu_one_title";N;s:14:"menu_two_title";N;s:16:"menu_three_title";N;s:15:"menu_four_title";N;s:14:"first_location";s:1:"0";s:15:"second_location";s:1:"0";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'inner_page_data',
                    'meta_value' => 'a:6:{s:22:"doctor_list_meta_title";N;s:21:"doctor_list_meta_desc";N;s:16:"show_search_form";s:4:"true";s:24:"hospital_list_meta_title";N;s:23:"hospital_list_meta_desc";N;s:18:"enable_breadcrumbs";s:4:"true";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'sidebar_settings',
                    'meta_value' => 'a:16:{s:15:"display_sidebar";s:4:"true";s:21:"display_query_section";s:4:"true";s:20:"hidden_ask_query_img";s:21:"1569250115-img-11.jpg";s:11:"query_title";s:16:"Ask Query Online";s:14:"query_subtitle";s:21:"Stop Waiting In Queue";s:15:"query_btn_title";s:23:"Book Audio / Video Call";s:14:"query_btn_link";s:1:"#";s:10:"query_desc";s:25:"50,00 Consultation Served";s:19:"display_get_app_sec";s:4:"true";s:23:"hidden_download_app_img";s:21:"1569250115-img-12.jpg";s:18:"download_app_title";s:14:"Get Mobile App";s:21:"download_app_subtitle";s:14:"Care On The GO";s:17:"download_app_desc";s:58:"A dipisicing sed dotem eiusmou tempor incididunt ut labore";s:17:"download_app_link";s:1:"#";s:18:"display_get_ad_sec";s:4:"true";s:10:"ad_content";s:187:"<div id="doctreat_adds-2" class="dc-sidebaradds dc-searchresultad dc-ads-wgdets"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/08/img-02-4.jpg" alt="" /></div>";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'forum_settings',
                    'meta_value' => 'a:4:{s:25:"hidden_forum_banner_image";s:19:"1570434598-girl.png";s:18:"forum_banner_title";s:20:"To Get Your Solution";s:21:"forum_banner_subtitle";s:30:"Ask Query To Qualified Doctors";s:10:"query_desc";s:71:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'reg_form_settings',
                    'meta_value' => 'a:11:{s:11:"step1_title";s:21:"Join For a Good Start";s:14:"step1_subtitle";s:110:"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina";s:11:"step2_title";s:21:"Join For a Good Start";s:14:"step2_subtitle";s:110:"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina";s:15:"step2_term_note";s:158:"Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat Duis Aute Irure Dolor In Reprehenderit In Voluptate Velit Esse Terms & Conditions";s:13:"term_page_url";s:1:"#";s:11:"step3_title";s:19:"You are Almost There";s:14:"step3_subtitle";s:110:"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina";s:21:"hidden_register_image";s:21:"1570435971-img-04.jpg";s:11:"step4_title";s:16:"Congratulations!";s:14:"step4_subtitle";s:111:"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina!";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
