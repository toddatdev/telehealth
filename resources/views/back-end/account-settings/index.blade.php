@extends('back-end.master')
@section('content')
    <div class="dc-haslayout dc-manage-account la-setting-holder" id="account_settings">
        <div class="dc-preloader-section" v-if="is_loading" v-cloak>
            <div class="dc-preloader-holder">
                <div class="dc-loader"></div>
            </div>
        </div>

        @if (\Session::has('error'))
            <p style="font-weight: 500; color: red;letter-spacing: 0.5px; font-size: 18px">Your Password or ConfirmPassword dosen't match</p>
        @endif

        @if (\Session::has('message'))
            <p style="font-weight: 500; color: #1ce11c;letter-spacing: 0.5px; font-size: 18px">Your password update successfully and send to your mail account</p>
        @endif

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                @if (Session::has('error'))
                    <div class="flash_msg float-right">
                        <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                <div class="dc-dashboardbox dc-dashboardtabsholder dc-accountsettingholder">
                    <div class="dc-dashboardtabs">
                        <ul class="dc-tabstitle nav navbar-nav">
                            @if (Helper::getAuthRoleType() != 'admin')
                                <li class="nav-item">
                                    <a class="{{ Helper::getAuthRoleType() != 'admin' ? 'active' : '' }}" data-toggle="tab" href="#dc-delete-account">{{{ trans('lang.delete_account') }}}</a>
                                </li>
                            @endif
                            @if(Helper::getAuthRoleType() === 'admin' || Helper::getAuthRoleType() === 'doctor' || Helper::getAuthRoleType() === 'hospital' || Helper::getAuthRoleType() === 'regular')
                                <li class="nav-item">
                                    <a class="{{ Helper::getAuthRoleType() == 'admin' ? 'active' : '' }}" data-toggle="tab" href="#dc-reset-pass">{{{ trans('lang.reset_pass') }}}</a>
                                </li>
                            @endif
                            @if (Helper::getAuthRoleType() === 'admin')
                                <li class="nav-item">
                                    <a class="" data-toggle="tab" href="#dc-email-notifications">{{{ trans('lang.email_notifications') }}}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="dc-tabscontent tab-content">
                        <div class="dc-securityhold tab-pane la-section-settings {{ Helper::getAuthRoleType() != 'admin' ? 'active' : '' }}" id="dc-delete-account">
                            @include('back-end.account-settings.delete-account.index')
                        </div>
                        <div class="dc-securityhold tab-pane {{ Helper::getAuthRoleType() === 'admin' ? 'active' : '' }} la-section-settings" id="dc-reset-pass">
                            @include('back-end.account-settings.reset-password.index')
                        </div>
                        <div class="dc-securityhold tab-pane  la-section-settings" id="dc-email-notifications">
                            @include('back-end.account-settings.email-notifications.index')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3"></div>
        </div>
    </div>
@endsection
