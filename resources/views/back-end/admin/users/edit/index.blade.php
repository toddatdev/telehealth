@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9" id="account_settings">
            <div class="dc-preloader-section" v-if="is_loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
            <div class="dc-dashboardbox dc-dashboardtabsholder">
                <div class="dc-dashboardboxtitle">
                    <h2>{{Helper::getUserName($id)}} {{ trans('lang.profile_setting') }}</h2>
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
                        {!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'edit-user-details', '@submit.prevent'=>'updateUserProfile("'.$id.'", "'.trans("lang.update_role_war").'", "'.trans("lang.update_role_note").'")'])!!}
                            @include('back-end.admin.users.edit.detail')
                            @include('back-end.admin.users.edit.media')
                            <div class="dc-experienceaccordion">
                                <div class="dc-updatall la-updateall-holder">
                                    {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                                </div>
                            </div>
                        {!! Form::close(); !!}
                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection