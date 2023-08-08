@extends('back-end.master')
@section('content')
    <div class="dc-haslayout" id="settings">
        <div class="dc-preloader-section" v-if="is_loading" v-cloak>
            <div class="dc-preloader-holder">
                <div class="dc-loader"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <div class="dc-dashboardbox dc-dashboardtabsholder">
                    <div class="dc-dashboardtabs">
                        <ul class="dc-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="active" data-toggle="tab" href="#dc-general-settings">{{ trans('lang.general_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-email-settings">{{ trans('lang.email_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-payment-settings">{{ trans('lang.payment_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-registration">{{ trans('lang.registration_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-topbar">{{ trans('lang.topbar_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-inner-pages">{{ trans('lang.inner_page_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-socials">{{ trans('lang.social_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-dashboard-icons">{{ trans('lang.dashboard_icons') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-footer">{{ trans('lang.footer_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-roles">{{ trans('lang.role_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-sidebar">{{ trans('lang.sidebar_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-cache">{{ trans('lang.clear_cache') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-demo-content">{{ trans('lang.demo_content') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-chat-setting">{{ trans('lang.chat_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-forum-setting">{{ trans('lang.forum_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-booking-setting">{{ trans('lang.booking_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#dc-import-update">{{ trans('lang.import_update') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="dc-tabscontent tab-content">
                        <div class="dc-personalskillshold tab-pane active fade show" id="dc-general-settings">
                            @include('back-end.admin.settings.general.general-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-email-settings">
                            @include('back-end.admin.settings.general.email-settings.index')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-payment-settings">
                            @include('back-end.admin.settings.general.payment-settings.index')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-registration">
                            @include('back-end.admin.settings.general.registration-form')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-topbar">
                            @include('back-end.admin.settings.general.topbar-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-inner-pages">
                            @include('back-end.admin.settings.general.inner-page-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-socials">
                            @include('back-end.admin.settings.general.socials')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-dashboard-icons">
                            @include('back-end.admin.settings.general.dashboard-icon-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-footer">
                            @include('back-end.admin.settings.general.footer-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-roles">
                            @include('back-end.admin.settings.general.role-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-sidebar">
                            @include('back-end.admin.settings.general.sidebar-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-cache">
                            @include('back-end.admin.settings.general.clear-cache')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-demo-content">
                            @include('back-end.admin.settings.general.demo-content')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-chat-setting">
                            @include('back-end.admin.settings.general.chat-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-forum-setting">
                            @include('back-end.admin.settings.general.forum-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-booking-setting">
                            @include('back-end.admin.settings.general.booking-settings')
                        </div>
                        <div class="dc-personalskillshold tab-pane fade show" id="dc-import-update">
                            @include('back-end.admin.settings.general.import-update')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
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

