@extends('front-end.master', ['body_class' => 'dc-home dc-userlogin'])
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
@endsection
@push('front_end_stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    <div id="home" style="margin-top: 100px;">
	<section class="dc-haslayout contactheadertitleset">
		<div class="contactsuccessmessage" style="font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size: 18px;">
			<p class="text-success" style="font-weight: 600;font-size: 24px">We've received your feedback and will respond shortly if required.&nbsp <a href="/contactus">Continue</a>.</p>
		</div>
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
@endpush
