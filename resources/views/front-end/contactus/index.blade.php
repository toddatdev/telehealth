@extends('front-end.masternew', ['body_class' => 'dc-home dc-userlogin'])

@section('scripts')
    {!! NoCaptcha::renderJs() !!}
@stop
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
    <div class="contactheaderbannerimage">
        <img src="/uploads/settings/general/contactusheader.jpg" style="width: 100%;">
    </div>
@endsection
@push('front_end_stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('extra/css/easy-autocomplete.min.css') }}" rel="stylesheet">
    <link href="{{ asset('extra/css/home-autocomplete.css') }}" rel="stylesheet">
    <link href="{{ asset('extra/css/new.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    <div id="home">
        <section class="dc-haslayout contactheadertitleset">
            <h1 class="homepagesectiontitles">Contact <span>Telehealth Plus</span></h1>
            <p>Please use the contact form below, or just pick up the phone and call if you have any questions.</p>
        </section>
        <section class="maparea" style="position: relative;">
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8169125883487!2d144.9532087158449!3d-37.81775724204586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4e769d03b3%3A0x1494d7f8dee22789!2s482%2F585%20Little%20Collins%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sjp!4v1589359301787!5m2!1sen!2sjp"
                        width="100%" height="900px" frameborder="0" style="border:0;" allowfullscreen=""
                        aria-hidden="false" tabindex="0"></iframe>
                <div class="contactinfosection">
                    <h4>Telehealth Plus</h4>
                    <div class="borderlayout"></div>
                    <h4>Australia</h4>
                    <div><img src="/uploads/settings/general/contactuslocatcord.png">
                        <p>Suite 482 <br>
                            585 Little Collins st <br>
                            Melbourne 3000 Victoria</p></div>
                    <div><img src="/uploads/settings/general/contactuslocatphone.png">
                        <p>61 3 9010 5485 </p></div>
                </div>
            </div>
            {!! Form::open(['url' => url('contactus/sendmessage'), 'class' =>''])!!}
            <div id="contactusformsection">
                <div class="formcontactarea form-column">
                    <div class="form-field">
                        <label>Name</label>
                        <input placeholder="Name" class="form-input" value="{{old('contact_fullname')}}" type="text" id="contact_fullname"
                               name="contact_fullname" value="">
                        <span style="color: #ff0000; font-size: 16px; font-weight: 500">@error('contact_fullname')
                            {{ $message }}
                            @enderror</span>
                    </div>

                    <div class="form-field">
                        <label>Email</label>
                        <input placeholder="Email Address" class="form-input" value="{{old('contact_email')}}" type="text" id="contact_email"
                               name="contact_email" value="">
                        <span style="color: #ff0000; font-size: 16px; font-weight: 500">@error('contact_email')
                            {{ $message }}
                            @enderror</span>
                        <span style="display: none;"></span></div>

                    <div class="form-field">
                        <label>Phone</label>
                        <input placeholder="Phone Number" value="{{old('contact_phone')}}" class="form-input" type="text" id="contact_phone"
                               name="contact_phone" value="">
                        <span style="color: #ff0000; font-size: 16px; font-weight: 500">@error('contact_phone')
                            {{ $message }}
                            @enderror</span>
                    </div>

                    <div class="form-field">
                        <label>Message</label>
                        <textarea placeholder="Message"  name="contact_question" id="contact_question" rows="5" cols="50"
                                  class="form-input">{{old('contact_question')}}</textarea>
                        <span style="color: #ff0000; font-size: 16px; font-weight: 500">@error('contact_question')
                            {{ $message }}
                            @enderror</span>
                        <span style="display: none;"></span>
                    </div>

                    <div class="form-field">
                        {!! NoCaptcha::display() !!}
                        <span style="color: #ff0000; font-size: 16px; font-weight: 500">@error('g-recaptcha-response')
                            {{ $message }}
                            @enderror</span>
                    </div>

                    <div class="form-actions">
                        <input id="contactsubmitform" class="button button--primary" type="submit" value="Send Message">
                    </div>
                </div>
            </div>
            {!! Form::close(); !!}
        </section>
    </div>
@endsection
@push('front_end_scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        // Services Section Slider
        <?php $loop = !empty(Helper::getServicesSection('services_tabs')) && count(Helper::getServicesSection('services_tabs')) > 5 ? true : false; ?>
        var _dc_doctorslider = jQuery("#dc-doctorslider")
        _dc_doctorslider.owlCarousel({
            loop:<?php echo json_encode($loop); ?>,
            margin: 0,
            navSpeed: 500,
            nav: false,
            autoplay: false,
            // rtl:true,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                800: {
                    items: 3,
                },
                1080: {
                    items: 4,
                },
                1280: {
                    items: 5,
                },
            }
        });
    </script>
    <script>
        /* Our Rated Slider */
        var _dc_docpostslider = jQuery("#dc-docpostslider")
        _dc_docpostslider.owlCarousel({
            loop: false,
            margin: 30,
            navSpeed: 1000,
            nav: false,
            // rtl:true,
            items: 5,
            autoplayHoverPause: true,
            autoplaySpeed: 1000,
            autoplay: false,
            mouseDrag: false,
            navClass: ['dc-prev', 'dc-next'],
            navContainerClass: 'dc-docslidernav',
            navText: ['<span class="ti-arrow-left"></span>', '<span class="ti-arrow-right"></span>'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                800: {
                    items: 3,
                },
                992: {
                    items: 2,
                },
                1200: {
                    items: 3,
                },
                1366: {
                    items: 4,
                },
                1681: {
                    items: 5,
                }
            }
        });
    </script>
@endpush
