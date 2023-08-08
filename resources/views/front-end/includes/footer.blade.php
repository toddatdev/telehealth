@section('footer')

    <footer id="dc-footer" class="dc-footer dc-haslayout">

        @if (Helper::getFooterSettings('show_contact_info_sec') === 'true')

            @if(!empty(Helper::getFooterSettings('contact_info_img_one')) || !empty(Helper::getFooterSettings('contact_info_img_two')))

              <!--  <div class="dc-footertopbar">

                    <div class="container">

                        <div class="row justify-content-center align-self-center">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">

                                <div class="dc-footer-call-email">

                                    <div class="dc-callinfoholder">

                                        @if (!empty(Helper::getFooterSettings('contact_info_img_one')))

                                            <figure class="dc-callinfoimg">

                                                <img src="{{ asset(Helper::getImage('uploads/settings/general/footer', Helper::getFooterSettings('contact_info_img_one'), 'small-')) }}" alt="{{ trans('lang.img_desc') }}">

                                            </figure>

                                        @endif

                                        <div class="dc-callinfocontent">

                                            <h3>

                                                <span>{{ html_entity_decode(clean(Helper::getFooterSettings('contact_info_title_one'))) }}</span> 

                                                <a href="tel:{{ clean(Helper::getFooterSettings('contact_info_number')) }}">{{ clean(Helper::getFooterSettings('contact_info_number')) }}</a>

                                            </h3>

                                        </div>

                                    </div>

                                    <div class="dc-callinfoholder dc-mailinfoholder">

                                        @if (!empty(Helper::getFooterSettings('contact_info_img_two')))

                                            <figure class="dc-callinfoimg">

                                                <img src="{{ asset(Helper::getImage('uploads/settings/general/footer', Helper::getFooterSettings('contact_info_img_two'), 'small-')) }}" alt="{{ trans('lang.img_desc') }}">

                                            </figure>

                                        @endif

                                        <div class="dc-callinfocontent">

                                            <h3>

                                                <span>{{ html_entity_decode(clean(Helper::getFooterSettings('contact_info_title_two'))) }}</span> 

                                                <a href="mailto:{{ clean(Helper::getFooterSettings('contact_info_email')) }}">{{ clean(Helper::getFooterSettings('contact_info_email')) }}</a>

                                            </h3>

                                        </div>

                                    </div>

                                    <span class="dc-or-text">- {{ trans('lang.or') }} -</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div> -->

            @endif

        @endif

        <div class="dc-fthreecolumns">

	    <div class="container">

		<div class="footerareasearch">

    <h1>Medical Consultations on your <span>Computer</span><br>

    <span>Tablet</span> or <span>Mobile Device</span></h1>

    <p>

    See a doctor WHEN and WHERE it’s convenient for you. <br> Professional advice available 24/7.

    </p>

            {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => 'dc-formtheme dc-form-advancedsearch']) !!}
            <fieldset>
                <div>
                    <input type="text" id="search-query-footer" name="search" value="" class="form-control search-query-autocomplete" placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
                </div>
                <div class="dc-formbtn">
                    {{ Form::button('<span>SEARCH</span>', ['type' => 'submit', 'class' => 'btn-sm'] )  }}
                </div>
            </fieldset>
            {!! form::close(); !!}

</div>

</div></div>



<div class="contactinfodata">

                    <div><i class="lnr lnr-map-marker"></i> Suite 482, 585 Little Collins st, Melbourne, 3000, Victoria</div>

                    <div style="margin-top: 5px;">

                        <span style="margin-right: 15px;">

                            <i class="lnr lnr-phone-handset"></i>

                            61 3 9010 5485 

                        </span>

                        <span style="margin-left: 15px;">

                            <i class="lnr lnr-envelope"></i> support@telehealthplus.com.au

                        </span>

                    </div>

                </div>

                <div class="socialiconlist">

                    <ul class='dc-simplesocialicons '><li class='dc-facebook'><a href = '#'><i class='fab fa-facebook-f' ></i></a></li><li class='dc-twitter'><a href = '#'><i class='fab fa-twitter' ></i></a></li><li class='dc-linkedin'><a href = '#'><i class='fab fa-linkedin-in' ></i></a></li><li class='dc-googleplus'><a href = '#'><i class='fab fa-google-plus-g' ></i></a></li><li class='dc-rss'><a href = '#'><i class='fas fa-rss' ></i></a></li><li class='dc-youtube'><a href = '#'><i class='fab fa-youtube' ></i></a></li></ul>

                </div>

<!--		<div class="row">

		    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 float-left">

                        <div class="tg-widgettwitter dc-fcol dc-flatestad dc-twitter-live-wgdets">                          

                            <div class="dc-footercontent">

                                @include('front-end.includes.footermenu')

                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">

                        <div class="dc-fcol dc-widgetcontactus">                           

                            <div class="dc-footercontent">                               

                                @if (!empty(Helper::getFooterSettings('footer_address'))

                                    || !empty(Helper::getFooterSettings('footer_email'))

                                    || !empty(Helper::getFooterSettings('footer_phone')))

                                    <ul class="dc-footercontactus">

                                        <li><address><i class="lnr lnr-map-marker"></i> {{ html_entity_decode(clean(Helper::getFooterSettings('footer_address'))) }}</address></li>

                                        <li><a href="mailto:{{ clean(Helper::getFooterSettings('footer_email')) }}"><i class="lnr lnr-envelope"></i> {{ clean(Helper::getFooterSettings('footer_email')) }}</a></li>

                                        <li>

                                            <span>

                                                <i class="lnr lnr-phone-handset"></i> 

                                                <a href="tel:{{ clean(Helper::getFooterSettings('footer_phone')) }}">{{ clean(Helper::getFooterSettings('footer_phone')) }}</a>

                                            </span>

                                        </li>

                                    </ul>

                                @endif



                                @if (Helper::getFooterSettings('show_footer_socials') === 'true')

                                    <div class="dc-fsocialicon">

                                        {{ Helper::displaySocials('footer') }}

                                    </div>

                                @endif



                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 float-left">

                        <div class="dc-fcol dc-newsletterholder">

                            <div class="dc-footercontent dc-newsletterholder">

                                @if ( !empty(Helper::getDownloadAppSection('show_app_sec')) && Helper::getDownloadAppSection('show_app_sec') == 'true')

                                    <div class="dc-footerapps">

                                        <div class="dc-ftitle"><h3>{{ html_entity_decode(clean(Helper::getDownloadAppSection('title'))) }}</h3></div>

                                        <ul class="dc-btnapps">

                                            <li>

                                                <a href="{{ Helper::getDownloadAppSection('android_url') }}">

                                                    <img src="{{ asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('android_img'), 'small-', 'default-footer-android.png')) }}" alt="{{ trans('lang.img_desc') }}">

                                                </a>

                                            </li>

                                            <li>

                                                <a href="{{ Helper::getDownloadAppSection('ios_url') }}">

                                                    <img src="{{ asset(Helper::getImage('uploads/settings/home', Helper::getDownloadAppSection('ios_img'), 'small-', 'default-footer-ios.png')) }}" alt="{{ trans('lang.img_desc') }}">

                                                </a>

                                            </li>

                                        </ul>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div> -->

        <div class="dc-footerbottom">

            <div class="homecontainer">

                <div class="row footer-container">

                    <div class="col-6">

                        <p class="dc-copyright">{{ html_entity_decode(clean(Helper::getFooterSettings('footer_copyright'))) }}</p>

		            </div>

			        <div class="col-4">

                      

                            <ul class="navbar-nav">

                                <li class="nav-item">

                                    <a href="/">Home</a>

                                </li>

                                <li class="nav-item">

                                    <a href="/page/about">About</a>

                                </li>

                                <li class="nav-item">

                                    <a href="/page/patients">Patients</a>

                                </li>

                                <li class="menu-item-has-children page_item_has_children">

                                    <a href="/page/providers">Providers</a>

                                </li>

                                <li class="nav-item">

                                    <a href="/contactus">Contact</a>

                                </li>

                            </ul>

                    

                        <!-- <div class="footercopyrightimg"> <img src="/uploads/settings/home/footerbannerimg.png" alt="footerbackimg"></div> -->

                    </div>

                    <div class="col-2">

                        <div class="termsprivacy">

                            <a href="/page/terms-conditions">Terms </a>  |

                            <a href="/page/privacy-policy">Privacy </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </footer>

@endsection



