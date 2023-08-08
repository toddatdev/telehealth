@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="dc-specialities" id="specialities">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="dc-haslayout dc-dbsectionspace">
                        <div class="dc-dashboardbox">
                            <div class="dc-dashboardboxtitle">
                                <h2>{{{ trans('lang.update_speciality') }}}</h2>
                            </div>
                            <div class="dc-dashboardboxcontent dc-addservices">
                                {!! Form::open(['url' => url('admin/specialities/update/'.$speciality->id), 'class' => 'dc-formtheme dc-formsearch edit-speciality-form', 'id' => 'speclity'])!!}
                                    <fieldset>
                                        <div class="form-group">
                                            {!! Form::text( 'title', e($speciality->title), ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {!! Form::textarea( 'desc', e($speciality->description), ['class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                        </div>
                                        <div class="dc-settingscontent">
                                            @if (!empty($speciality->image))
                                                <upload-media
                                                :img="'{{ $speciality->image }}'"
                                                :img_id="'speciality_image'"
                                                :img_name="'speciality_image'"
                                                :img_ref="'speciality_image'"
                                                :img_hidden_name="'speciality_image'"
                                                img_hidden_id="'speciality_image'"
                                                :existed_img="'{{$speciality->image}}'"
                                                :url="'{{ url("media/upload-temp-image/specialities/speciality_image/speciality") }}'"
                                                :existing_img_url="'{{ url("uploads/specialities/$speciality->image") }}'"
                                                :size = "'{{ Helper::getImageDetail($speciality->image, 'size', 'uploads/specialities/') }}'"
                                                :existing_img_name = "'{{ Helper::getImageDetail($speciality->image, 'name', 'uploads/specialities/') }}'"
                                                >
                                                </upload-media>
                                                @else
                                                <upload-media
                                                    :img="'speciality_image'"
                                                    :img_id="'speciality_image'"
                                                    :img_name="'speciality_image'"
                                                    :img_ref="'speciality_image'"
                                                    :img_hidden_name="'speciality_image'"
                                                    img_hidden_id="'speciality_image'"
                                                    :url="'{{ url("media/upload-temp-image/specialities/speciality_image/speciality") }}'"
                                                    >
                                                </upload-media>
                                            @endif
                                        </div>
                                        <div class="form-group dc-btnarea">
                                            {!! Form::submit(trans('lang.update_speciality'), ['class' => 'dc-btn']) !!}
                                        </div>
                                    </fieldset>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
