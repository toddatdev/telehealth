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
                    <h2>{{ trans('lang.add_new_user') }}</h2>
                </div>
                <div class="dc-dashboardtabs">
                    <ul class="dc-tabstitle nav navbar-nav">
                        <li class="nav-item">
                            <a class="active show" data-toggle="tab" href="#dc-skills">{{ trans('lang.new_user') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="dc-tabscontent tab-content">
                    <div class="dc-personalskillshold tab-pane active fade show" id="dc-skills">
                        {!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'create-user-details', '@submit.prevent'=>'createUser'])!!}
                            <div class="dc-yourdetails dc-tabsinfo">
                                <div class="dc-tabscontenttitle">
                                    <h3> {{ trans('lang.user_detail') }} </h3>
                                </div>
                                <div class="dc-formtheme dc-userform">
                                    <fieldset>
                                        <div class="form-group form-group-half">
                                            {!! Form::text( 'first_name', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph.first_name')] ) !!}
                                        </div>
                                        <div class="form-group form-group-half">
                                            {!! Form::text( 'last_name', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph.last_name')] ) !!}
                                        </div>
                                        <div class="form-group form-group-half">
                                            {!! Form::email( 'email', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph.email')] ) !!}
                                        </div>
                                        <div class="form-group form-group-half">
                                            {!! Form::password('password', ['class' => 'form-control','placeholder' => trans('lang.ph.newpass')]) !!}
                                        </div>
                                        <div class="form-group">
                                            @if (!empty($roles))
                                                <ul class="dc-startoption">
                                                    @foreach ($roles as $key => $role)
                                                        @if (!in_array($role['id'] == 1, $roles))
                                                            <li>
                                                                <span class="dc-radio">
                                                                    <input id="dc-company-{{$key}}" type="radio" name="role" value="{{{ $role['role_type'] }}}">
                                                                    <label for="dc-company-{{$key}}">{{{ $role['name'] }}}</label>
                                                                </span>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="form-group dc-btnarea">{!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}</div>
                                    </fieldset>
                                </div>
                            </div>
                        {!! Form::close(); !!}
                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection