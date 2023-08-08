@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9" id="profile_settings">
            <div class="dc-dashboardbox dc-dashboardtabsholder">
                <div class="dc-dashboardboxtitle">
                    <h2>{{ trans('lang.profile_setting') }}</h2>
                </div>
                <div class="dc-dashboardtabs">
                    <ul class="dc-tabstitle nav navbar-nav">
                        <li class="nav-item">
                            <a class="active show" data-toggle="tab" href="#dc-skills">{{ trans('lang.personal_detail') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="dc-tabscontent tab-content">
                    <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                        @include('back-end.admin.profile-settings.personal-detail.index')
                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection