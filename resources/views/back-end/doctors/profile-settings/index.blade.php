@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-9" id="profile_settings">
            <div class="dc-haslayout">
                <div class="dc-dashboardbox dc-dashboardtabsholder">
                    <div class="dc-dashboardboxtitle">
                        <h2>{{ trans('lang.profile_setting') }}</h2>
                    </div>
                    <div class="dc-dashboardtabs">
                        <ul class="dc-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="active show" data-toggle="tab" href="#dc-skills">{{ trans('lang.personal_detail') }}</a>
                            </li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-education" class="">{{ trans('lang.exp_edu') }}</a></li>
{{--                            <li class="nav-item"><a data-toggle="tab" href="#dc-awards" class="">{{ trans('lang.awards_downloads') }}</a></li>--}}
                            <li class="nav-item"><a data-toggle="tab" href="#dc-registration" class="">{{ trans('lang.registration') }}</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-services" class="">{{ trans('lang.services') }}</a></li>
                           <!-- <li class="nav-item"><a data-toggle="tab" href="#dc-gallery" class="">{{ trans('lang.gallery') }}</a></li> -->
                        </ul>
                    </div>
                    <div class="dc-tabscontent tab-content">
                        <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                            @include('back-end.doctors.profile-settings.personal-detail.index')
                        </div>
                        <div class="dc-educationholder tab-pane fade" id="dc-education">
                            @include('back-end.doctors.profile-settings.experience-education.index')
                        </div>
                        <div class="dc-awardsholder tab-pane fade" id="dc-awards">
                            @include('back-end.doctors.profile-settings.awards-downloads.index')
                        </div>
                        <div class="dc-registration tab-pane fade" id="dc-registration">
                            @include('back-end.doctors.profile-settings.registration.index')
                        </div>
                        <div class="dc-services tab-pane fade" id="dc-services">
                            @include('back-end.doctors.profile-settings.services.index')
                        </div>
                        <div class="dc-gallery tab-pane fade" id="dc-gallery">
                            @include('back-end.doctors.profile-settings.gallery.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
        </div>
    </div>
@endsection
