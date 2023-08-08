@extends('front-end.masternew', ['body_class' => 'dc-home dc-userlogin'])
@if (Schema::hasTable('site_managements')) 
    @php 
        $seo_settings = App\SiteManagement::getMetaValue('seo_settings'); //Article Section
        $meta_title = !empty($seo_settings['meta_title']) ? $seo_settings['meta_title'] : 'Doctory - Doctors & Hospitals Directory Laravel Theme';
        $meta_desc = !empty($seo_settings['meta_desc']) ? $seo_settings['meta_desc'] : '';
    @endphp
    @section('title'){{ $meta_title }} @stop
    @section('description', "$meta_desc")
@endif
@section('banner')
    @if (!empty(Helper::getHomeSlider('home_slides')))
        @include('front-end.slidernew')
    @endif
@endsection
@push('front_end_stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    <div id="home">
        @if (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time='10' :message="'{{{ Session::get('error') }}}'" v-cloak>
                </flash_messages>
            </div>
	    @endif
	    <!--
        <section class="dc-searchholder dc-haslayout">
            @if (Helper::getSearchBanner('show_banner') === 'true')
                @php 
                    $locations = App\Location::all(); 
                    $roles     = Spatie\Permission\Models\Role::all()->toArray();
                @endphp
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="dc-searchform-holder">
                                <div class="dc-advancedsearch">                          
                                    {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => 'dc-formtheme dc-form-advancedsearch']) !!}
                                        <fieldset>
                                            <div class="form-group">
                                                <input type="text" name="search" value="" class="form-control" placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
                                            </div>                                                            
                                            <div class="dc-formbtn">
                                                {{ Form::button('<i class="ti-arrow-right"></i>', ['type' => 'submit', 'class' => 'btn-sm'] )  }}
                                            </div>
                                        </fieldset>                                                      
                                    {!! form::close(); !!}
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section> -->

        <!-- Bring Care Start -->

        <section class="dc-haslayout dc-main-section anywheresection">
            <div class="homecontainer">
                <h1 class="homepagesectiontitles">Anywhere You Go, We’re Just a <span>Click Away</span></h1>
                <p class="home-intro-desc">Speak to a qualified doctor or healthcare practitioner wherever you are, whenever you need
                    to. At home, work, 
                    on the go, or on holiday, we serve patients all over Australia. </p>

                <div class="row home-feature-grid">

                    <div class="anywhereitemsdiv">
                        
                            <img src="/uploads/settings/home/icon1.png" alt="1thanywhereicon">
                            <h4>For Patient</h4>
                            <p>Fast, convenient access to registered doctors and healthcare practitioners,
                                no matter where you are.</p>
                        
                    </div>

                    <div class="anywhereitemsdiv">
                        
                            <img src="/uploads/settings/home/icon2.png" alt="2thanywhereicon">
                            <h4>For the Provider</h4>
                            <p>Offer online services to patients. Do the job you love, choose your working
                                hours.</p>
                        
                    </div>

                    <div class="anywhereitemsdiv">
                        
                            <img src="/uploads/settings/home/icon3.png" alt="3thanywhereicon">
                            <h4>Avoid the Waiting Room</h4>
                            <p>It’s not always practical to travel to a clinic and wait to be seen. With us,
                                you can talk to a doctor in minutes.</p>
                        
                    </div>

                    <div class="anywhereitemsdiv">
                        
                            <img src="/uploads/settings/home/icon4.png" alt="4thanywhereicon">
                            <h4>Future of Healthcare</h4>
                            <p>Online health services are growing. Be part of the changing landscape of
                                healthcare in Australia.</p>
                        
                    </div>

                    <div class="anywhereitemsdiv">
                    
                            <img src="/uploads/settings/home/icon5.png" alt="5thanywhereicon">
                            <h4>Secure HIPAA Complaint</h4>
                            <p>Patient data is safe and secure with our HIPPA compliant web-portal.</p>
                        
                    </div>

                    <div class="anywhereitemsdiv">
                    
                            <img src="/uploads/settings/home/icon6.png" alt="6thanywhereicon">
                            <h4>AHPRA Registered Practioners</h4>
                            <p>Fully registered and licenced practitioners, ready to give you expert
                                medical advice.</p>
                    
                    </div>

                </div>
            </div>
        </section>

    <!-- Bring Care End -->
    
        <section class="dc-haslayout wetrustsection">
            <div class="homecontainer">
                <div class="row what-wetreat-main">
                    <div class="col-md-8 what-wetreat-info">

                        <div class="headingitems">
                            <h1 class="homepagesectiontitles">What We <span>Treat</span></h1>
                            <p>We have a range of specialist practitioners available. Doctor, nurse, counsellor,
                                dermatologist and many more,
                                you can be sure there is an expert on hand for advice on any ailment.</p>


                            <div class="row what-wetreat-list">
                                <ul>
                                    <li>Cold & Flu</li>
                                    <li>Sore Throats</li>
                                    <li>Respiratory Tract Infections</li>
                                    <li>Sinus Infections</li>
                                    <li>Urinary Tract Infections</li>
                                    <li>Constipation</li>
                                    <li>Fever & Headaches</li>
                                    <li>Sports Injuries</li>
                                    <li>Diarrhoea & Vomiting</li>
                                    <li>Eye Conditions</li>
                                    <li>Nausea & Sickness</li>
                                    <li>Ear Infections</li>
                                    <li>Skin Conditions & Rashes</li>
                                    <li>Joint Pain & Aches</li>
                                    <li>Travel, Insect Bites & Stings</li>
                                    <li>Allergies (inc. Hayfever)</li>
                                    <li>Asthma</li>
                                    <li>Plus many more</li>
                                </ul>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 what-wetreat-image">
                        <img src="/uploads/settings/home/trustdoctor.png" alt="trustdoctorwhere">
                    </div>
                </div>
            </div>
        </section>
    
        <section class="dc-haslayout dc-main-section servicelistset">
            <div class="homecontainer">
                <h1 class="homepagesectiontitles">How Does <span>Telehealth Plus</span> Work?</h1>
                <p style="margin-bottom: 100px;" class="home-intro-desc">When you want to consult a doctor or
                    other
                    healthcare practitioner, just search the profiles of the providers we have registered.
                    Choose a provider you like, you can use the reviews to help you. Click to connect.</p>
                <div class="row how-does-telehealth-container">
                    <div class="how-does-item">
                        <img src="/uploads/settings/home/section5service1.png" alt="3thsection">
                        <h3>Search</h3>
                        <p>Search registered provider<br>
                            profiles and reviews</p>
                    </div>
                    <div class="how-does-item">
                        <img src="/uploads/settings/home/section5service2.png" alt="3thsection">
                        <h3>Select</h3>
                        <p>Select the provider you<br>
                            wish to visit with</p>
                    </div>
                    <div class="how-does-item">
                        <img src="/uploads/settings/home/section5service3.png" alt="3thsection">
                        <h3>Connect</h3>
                        <p>Connect live with your<br>
                            chosen provider</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Rated Start -->
        @if (Helper::getSpecialitySlider('display') == 'true')
           <!-- <section class="dc-haslayout dc-main-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
                            <div class="row">
                                <div class="dc-ratedecontent dc-bgcolor">
                                    <figure class="dc-neurosurgeons-img">
                                        <img src="{{{asset(Helper::getSpecialitySlider('speciality')['image'])}}}" alt="{{ trans('lang.img_desc') }}">
                                    </figure>
                                    <div class="dc-sectionhead dc-sectionheadvtwo dc-text-center">
                                        <div class="dc-sectiontitle">
                                            <h2>{{ trans('lang.our_top_rated') }}<span> Providers</span></h2>
                                        </div>
                                        <div class="dc-description">
                                            <p>{{ clean(Helper::getSpecialitySlider('speciality')['description']) }}</p>
                                        </div>
                                    </div>
                                    <div class="dc-btnarea">
                                        <a href="{{{url('search-results')}}}" class="dc-btn">{{ trans('lang.view_all') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty(Helper::getSpecialitySlider('speciality')['doctors']) && count(Helper::getSpecialitySlider('speciality')['doctors']) > 0)
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">
                                <div class="row">
                                    <div id="dc-docpostslider" class="dc-docpostslider owl-carousel">
                                        @foreach (Helper::getSpecialitySlider('speciality')['doctors'] as $service_id)
                                            @php 
                                                $doctor = App\User::find($service_id); 
                                                $user = App\User::findOrFail($doctor->id);
                                                $saved_doctors = Auth::check() && !empty(Auth::user()->profile->saved_doctors) ? unserialize(Auth::user()->profile->saved_doctors) : array();
                                                $avg_rating = App\Feedback::where('user_id', $user->id)->pluck('avg_rating')->first();
                                                $stars  = $avg_rating != 0 ? $avg_rating / 5 * 100 : 0;
                                            @endphp 
                                            <div class="item">
                                                <div class="dc-docpostholder">
                                                    <figure class="dc-docpostimg">
                                                        <img src="{{{asset(Helper::getImage('uploads/users/'.$doctor->id,  $doctor->profile->avatar, 'medium-', 'user.jpg'))}}}" alt="{{ trans('lang.img_desc') }}">
                                                    </figure>
                                                    <div class="dc-docpostcontent">
                                                        @if (!empty($saved_doctors) && in_array($user->id, $saved_doctors))
                                                            <a href="javascrip:void(0);" class="dc-like dc-clicksave dc-btndisbaled">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0);" class="dc-like"><i class="fa fa-heart"></i></a>
                                                            <a href="javascrip:void(0);" class="dc-like" id="doctor-{{ $user->id }}" @click.prevent="add_wishlist('doctor-{{ $user->id }}', '{{ $user->id }}', 'saved_doctors', '')" v-cloak>
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        @endif
                                                        <div class="dc-title">
                                                            <a href="javascript:void(0)" class="dc-docstatus">{{{ html_entity_decode(clean(Helper::getSpecialitySlider('speciality')['title'])) }}}</a>
                                                            <h3>
                                                                <a href="{{ route('userProfile', clean($doctor->slug)) }}">
                                                                    {{ !empty($doctor->profile->gender_title) ? Helper::getDoctorArray(clean($doctor->profile->gender_title)) : '' }} 
                                                                    {{{Helper::getUserName($doctor->id)}}}
                                                                </a> 
                                                                {{ Helper::verifyMedical(clean($doctor->id)) }} {{ Helper::verifyUser(clean($doctor->id)) }}
                                                            </h3>
                                                            <ul class="dc-docinfo">
                                                                <li>{{ html_entity_decode(clean($doctor->profile->tagline)) }}</li>
                                                                <li>
                                                                    <span class="dc-stars"><span style="width: {{ $stars }}%;"></span></span><em>{{ $doctor->feedbacks->count() }} {{ trans('lang.feedbacks') }}</em>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="dc-doclocation">                                 
                                                            @if (!empty($doctor->profile->available_days))
                                                                <span>
                                                                    <i class="ti-calendar"></i>
                                                                    @foreach (Helper::getAppointmentDays() as $key => $day)
                                                                        @if (!in_array($key, unserialize($doctor->profile->available_days)))
                                                                            <em class="dc-dayon">{{ html_entity_decode(clean($day['title'])) }}</em>
                                                                        @else
                                                                            {{ html_entity_decode(clean($day['title'])) }},
                                                                        @endif
                                                                    @endforeach
                                                                </span>
                                                            @endif
                                                            <a href="{{{route('userProfile', clean($doctor->slug))}}}" class="dc-btn">{{ trans('lang.view_more') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section> -->
        @endif
	<!-- Our Rated End -->

    <!-- Appointment Background Start -->
    <section class="dc-haslayout dc-main-section sectionappointment">
        <div class="contentsection">
            <h1>Changing Healthcare Services for the Better</h1>
            <p>We believe everyone should have access to the best possible healthcare. For those living in remote areas, or those with busy lifestyles, visiting a doctor is often pushed aside. It’s time for change, and we’re here to help!</p>
            <a href="#">GET STARTED NOW</a>
        </div>
    </section>
    <!-- Appointment Background End -->


    <!-- Mobile App Start -->
    <section class="dc-haslayout dc-main-section section6doctorimg">
        <div class="container">
            <h1 class="homepagesectiontitles">Use <span>Telehealth Plus</span> on your <br> Computer, tablet
                or smartphone</h1>
            <p>Securely connect to Telehealth Plus on a variety of computers and mobile devices.</p>
            <img src="/uploads/settings/home/usetelpathpluscom.png" class="multiple-device" alt="6thsection">
        </div>
    </section>
    <section class="dc-haslayout dc-main-section sectiondownloadapps">
        <div class="homecontainer">
            <div class="row downloads-container">
                <div class="col-12 col-sm-12 col-md-6 downloads-col">
                    <img src="/uploads/settings/home/mobileappdownloadleft.png" alt="downloadimg">
                </div>
                <div class="col-12 col-sm-12 col-md-6 downloads-col">
                    <h1 class="homepagesectiontitles">Are you interested? <br>
                        <span>Download</span> our app now!
                    </h1>
                    <p>It’s healthcare your way. Get access to Telehealth Plus today!</p>
                    <div class="downloadbtn">
                        <a href="#" class="downloadbtn-item"><img
                                src="/uploads/settings/home/iphonestoreicon.png" alt="iosapp"></a>
                        <a href="#" class="downloadbtn-item"><img
                                src="/uploads/settings/home/googlestoreicon.png"
                                alt="googleapp"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        @if (Helper::getArticleSectionSettings('show_article_sec') === 'true')
          <!--  <section class="dc-haslayout dc-main-section">
                <div class="container">
                    <div class="row justify-content-center align-self-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                            <div class="dc-sectionhead dc-text-center">
                                <div class="dc-sectiontitle">
                                    <h2>
                                        <span>{{ html_entity_decode(clean(Helper::getArticleSectionSettings('section_subtitle'))) }}</span>
                                        {{ html_entity_decode(clean(Helper::getArticleSectionSettings('section_title'))) }}
                                    </h2>
                                </div>
                                <div class="dc-description">
                                    <p>{{ clean(Helper::getArticleSectionSettings('section_description')) }}</p>
                                </div>
                            </div>
                        </div>
                        @if(!empty(\App\Article::getArticles(3, true)->count() > 0) )
                            <div class="dc-articlesholder">
                                @foreach (\App\Article::getArticles(3, true) as $article)
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                                        <div class="dc-article">
                                            <figure class="dc-articleimg">
                                                <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author->id.'/articles/', $article->image, 'featured-', 'featured-article-default.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                <figcaption>
                                                    <div class="dc-articlesdocinfo">
                                                        <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author->id, App\User::find($article->author->id)->profile->avatar, 'extra-small-', 'user-login.png')) }}" alt="{{ trans('lang.img_desc') }}">
                                                        <span>{{ Helper::getUserName($article->author_id) }}</span>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                            <div class="dc-articlecontent">
                                                <div class="dc-title">
                                                    <div class="dc-articleby-holder">
                                                        @if (!empty($article->categories) && $article->categories->count() > 0)
                                                            @foreach ($article->categories as $category)
                                                                <a href="{{ route('articleListing', clean($category->slug)) }}" class="dc-articleby">{{ $category->title }}</a>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <h3><a href="{{ route('articleDetail', ['slug' => clean($article->slug) ]) }}">{{ html_entity_decode(clean($article->title)) }}</a></h3>
                                                    <span class="dc-datetime"><i class="ti-calendar"></i> {{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</span>
                                                </div>
                                                <ul class="dc-moreoptions">
                                                    <li><a href="javascript:void(0);"><i class="ti-heart"></i></a> {{{ !empty($article->likes) ? clean($article->likes) : 0 }}} {{ trans('lang.likes') }}</li>
                                                    <li><a href="javascript:void(0);"><i class="ti-eye"></i></a>{{{ !empty($article->views) ? clean($article->views) : 0 }}} {{ trans('lang.views') }}</li>
                                                    <li id="dc-share-{{ clean($article->id) }}" @click="socialPopup('{{ clean($article->id) }}')" class="la-shareicon">
                                                        <a href="javascript:void(0);"><i class="ti-share"></i> {{ trans('lang.share') }}</a>
                                                        <ul class="dc-simplesocialicons dc-socialiconsborder">
                                                            <li class="dc-facebook">
                                                                <a href="javascript:void()" @click="socialShare('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dc-twitter">
                                                                <a href="javascript:void()" @click="socialShare('https://twitter.com/intent/tweet?url={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dc-linkedin">
                                                                <a href="javascript:void()" @click="socialShare('https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-linkedin-in"></i></a>
                                                            </li>
                                                            <li class="dc-googleplus">
                                                                <a href="javascript:void()" @click="socialShare('https://plus.google.com/share?url={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-google-plus-g"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section> -->
        @endif
	<!-- Latest Articles End -->
<!--
        <section class="dc-haslayaout dc-footeraboutus dc-bgcolor">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-widgetskills">
                            <div class="dc-fwidgettitle">
                                <h3>{{ html_entity_decode(clean(Helper::getFooterSettings('first_menu_title'))) }}</h3>
                            </div>
                            @if (!empty(\App\Speciality::count() > 0 ))
                                <ul class="dc-fwidgetcontent">
                                    @foreach (\App\Speciality::limit(5)->get() as $key => $speciality)
                                        <li><a href="{{{url('search-results?search=&speciality='.clean($speciality->slug))}}}">{{ html_entity_decode(clean($speciality->title)) }}</a></li>
                                    @endforeach
                                    <li class="dc-viewmore"><a href="{{{ url('search-results') }}}">{{trans('lang.view_all')}}</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-widgetskills">
                            <div class="dc-fwidgettitle">
                                <h3>{{ html_entity_decode(clean(Helper::getFooterSettings('second_menu_title'))) }}</h3>
                            </div>
                            @if (!empty(\App\Speciality::count() > 0 ))
                                <ul class="dc-fwidgetcontent">
                                    @foreach (\App\Speciality::limit(5)->get() as $key => $speciality)
                                        <li>
                                            <a href="{{{url('search-results?search=&speciality='.clean($speciality->slug).'&type=doctor&locations='.Helper::getFooterSettings('second_menu_location'))}}}">
                                                {{ html_entity_decode(clean($speciality->title)) }}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="dc-viewmore">
                                        <a href="{{{ url('search-results?type=doctor&locations='.Helper::getFooterSettings('second_menu_location')) }}}">
                                            {{trans('lang.view_all')}}
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-widgetskills">
                            <div class="dc-fwidgettitle">
                                <h3>{{ html_entity_decode(clean(Helper::getFooterSettings('third_menu_title'))) }}</h3>
                            </div>
                            @if (!empty(\App\Speciality::count() > 0 ))
                                <ul class="dc-fwidgetcontent">
                                    @foreach (\App\Speciality::limit(5)->get() as $key => $speciality)
                                        <li>
                                            <a href="{{{url('search-results?search=&speciality='.clean($speciality->slug).'&type=doctor&locations='.Helper::getFooterSettings('third_menu_location'))}}}">
                                                {{ html_entity_decode(clean($speciality->title)) }}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="dc-viewmore">
                                        <a href="{{{ url('search-results?type=doctor&locations='.Helper::getFooterSettings('third_menu_location')) }}}">
                                            {{trans('lang.view_all')}}
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="dc-footercol dc-widgetcategories">
                            <div class="dc-fwidgettitle">
                                <h3>{{ html_entity_decode(clean(Helper::getFooterSettings('fourth_menu_title'))) }}</h3>
                            </div>
                            @if (!empty(\App\Location::count() > 0 ))
                                <ul class="dc-fwidgetcontent">
                                    @foreach (\App\Location::limit(5)->get() as $key => $location)
                                        <li>
                                            <a href="{{{url('search-results?search=&locations='.clean($location->slug))}}}">
                                                {{ html_entity_decode(clean($location->title)) }}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="dc-viewmore"><a href="{{{ url('search-results') }}}">{{trans('lang.view_all')}}</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
@endsection
@push('front_end_scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript">
		// Services Section Slider
		var videoheightcalc = $("#headervideotitle").width();
		var videoheightcalcpara = (videoheightcalc * 1080) / 1920;
		console.log(videoheightcalcpara);
		$(".blackoverflowvideo").css({        		
	        	'height':videoheightcalcpara
		});
            <?php $loop = !empty(Helper::getServicesSection('services_tabs')) && count(Helper::getServicesSection('services_tabs')) > 5 ? true : false; ?>
            var _dc_doctorslider = jQuery("#dc-doctorslider")
            _dc_doctorslider.owlCarousel({
                loop:<?php echo json_encode($loop); ?>,
                margin:0,
                navSpeed:500,
                nav:false,
                autoplay: false,
                // rtl:true,
                items:5,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:2,
                    },
                    800:{
                        items:3,
                    },
                    1080:{
                        items:4,
                    },
                    1280:{
                        items:5,
                    },
                }
            });
        </script>
        <script>
            /* Our Rated Slider */
            var _dc_docpostslider = jQuery("#dc-docpostslider")
            _dc_docpostslider.owlCarousel({
                loop:false,
                margin:30,
                navSpeed:1000,
                nav:false,
                // rtl:true,
                items:5,
                autoplayHoverPause:true,
                autoplaySpeed:1000,
                autoplay: false,
                mouseDrag:false,
                navClass: ['dc-prev', 'dc-next'],
                navContainerClass: 'dc-docslidernav',
                navText: ['<span class="ti-arrow-left"></span>', '<span class="ti-arrow-right"></span>'],
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    480:{
                        items:2,
                    },
                    800:{
                        items:3,
                    },
                    992:{
                        items:2,
                    },
                    1200:{
                        items:3,
                    },
                    1366:{
                        items:4,
                    },
                    1681:{
                        items:5,
                    }
                }
            });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Swal.fire({
          // title: 'Important Information',
          // text: 'This website is for Demo Purposes only!',
          // icon: 'warning',
          // confirmButtonText: 'Continue'
        // })
    </script>
    <style>
        .swal2-icon .swal2-icon-content{
            display:none;
        }
        .swal2-styled.swal2-confirm{
            background-color:#3fabf3;
            box-shadow:none;
        }
        .swal2-styled.swal2-confirm:focus{
            box-shadow:none;
        }
        
    </style>
	    @endpush
