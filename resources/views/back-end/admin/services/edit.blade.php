@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="dc-services-edit" id="services">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout dc-dbsectionspace la-editcategory">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.update_service') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['url' => url('admin/services/update/'.$service->id.''),
                                'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory', 'id' => 'services-form'] )
                            !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', e($service->title), ['class' =>'form-control'] ) !!}
                                    </div>
                                    <div class="form-group">
                                        <span class="dc-select">
                                            {!! Form::select('speciality', $specialities, e($speciality), ['placeholder' => trans('lang.ph.select_speciality')]) !!}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'description', e($service->description), ['class' =>'form-control',
                                        'placeholder' => trans('lang.ph_desc')] )
                                        !!}
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.update_service'), ['class' => 'dc-btn']) !!}
                                    </div>
                                </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
