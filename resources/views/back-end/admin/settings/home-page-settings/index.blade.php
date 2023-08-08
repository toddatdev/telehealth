@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
<div class="dc-haslayout dc-manage-account la-setting-holder" id="settings">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
            <div class="dc-dashboardbox dc-dashboardtabsholder dc-accountsettingholder">
                <div class="dc-dashboardtabs">
                    <ul class="dc-tabstitle nav navbar-nav">
                        <li class="nav-item">
                            <a class="{{{ \Request::route()->getName() <> 'homeServicesSection'? 'active': '' }}}" data-toggle="tab" href="#dc-slider">{{ trans('lang.slider_settings') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-search-banner-settings">{{ trans('lang.search_banner_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{{ \Request::route()->getName()==='homeServicesSection'? 'active': '' }}}" href="{{{ route('homeServicesSection') }}}">{{ trans('lang.services_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-about-us-settings">{{ trans('lang.about_us_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-how-works-settings">{{ trans('lang.how_works_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-app-section-settings">{{ trans('lang.download_app_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-doc-slider-settings">{{ trans('lang.doctors_slider_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-article-section">{{ trans('lang.article_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-seo-section">{{ trans('lang.seo') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="dc-tabscontent tab-content">
                    <div class="dc-securityhold tab-pane {{{ \Request::route()->getName() <> 'homeServicesSection'? 'active': '' }}} la-banner-settings" id="dc-slider">
                        @include('back-end.admin.settings.home-page-settings.home-slider')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-search-banner-settings">
                        @include('back-end.admin.settings.home-page-settings.search-banner')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-about-us-settings">
                        @include('back-end.admin.settings.home-page-settings.about-us-section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-how-works-settings">
                        @include('back-end.admin.settings.home-page-settings.how-it-works-section')
                    </div>
                    <div class="dc-securityhold tab-pane {{{ \Request::route()->getName() === 'homeServicesSection'? 'active': '' }}} la-section-settings" id="dc-services-tabs-settings">
                        @include('back-end.admin.settings.home-page-settings.service-tabs-section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-app-section-settings">
                        @include('back-end.admin.settings.home-page-settings.download-app-section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-doc-slider-settings">
                        @include('back-end.admin.settings.home-page-settings.doctor-slider-settings')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-article-section">
                        @include('back-end.admin.settings.home-page-settings.article-section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-seo-section">
                        @include('back-end.admin.settings.home-page-settings.seo-settings')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend_scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.dc-tinymceeditor',
            height: 300,
            theme: 'modern',
            plugins: ['code advlist autolink lists link image charmap print preview hr anchor pagebreak'],
            menubar: false,
            statusbar: false,
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify code',
            image_advtab: true,
            remove_script_host: false,
            })
    </script>
@endpush
