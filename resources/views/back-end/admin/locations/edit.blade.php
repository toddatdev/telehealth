@extends('back-end.master')
@section('content')
    @include('includes.pre-loader')
    <div class="dc-locations-edit" id="locations">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout la-editcategory">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-6 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.update_location') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['url' => url('admin/locations/update/'.$location->id.''),
                                'class' =>'dc-formtheme dc-userform dc-formprojectinfo dc-formcategory dc-updatelocation', 'id' => 'locations-form'] )
                            !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', e($location->title), ['class' =>'form-control'] ) !!}
                                    </div>
                                    @if (!empty($location_parent))
                                        <div class="form-group">
                                            <span class="dc-select">
                                                {!! Form::select('parent_location', $locations_list, e($location_parent), ['placeholder' => trans('lang.ph.select_parent')]) !!}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {!! Form::textarea( 'loc_desc', e($location->description), ['class' =>'form-control',
                                        'placeholder' => trans('lang.ph_desc')] )
                                        !!}
                                    </div>
                                    <div class="dc-settingscontent form-group">
                                        @if (!empty($location->flag))
                                            <upload-media
                                            :img="'{{ $location->flag }}'"
                                            :img_id="'location_image'"
                                            :img_name="'location_image'"
                                            :img_ref="'location_image'"
                                            :img_hidden_name="'hidden_location_image'"
                                            :img_hidden_id="'hidden_location_image'"
                                            :existed_img="'{{$location->flag}}'"
                                            :url="'{{ url("media/upload-temp-image/locations/location_image/location") }}'"
                                            :existing_img_url="'{{ url("uploads/locations/$location->flag") }}'"
                                            :size = "'{{ Helper::getImageDetail( $location->flag, 'size', 'uploads/locations') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $location->flag, 'name', 'uploads/locations') }}'"
                                            >
                                            </upload-media>
                                        @else
                                            <upload-media
                                                :img="'location_image'"
                                                :img_id="'location_image'"
                                                :img_name="'location_image'"
                                                :img_ref="'location_image'"
                                                :img_hidden_name="'hidden_location_image'"
                                                :img_hidden_id="'hidden_location_image'"
                                                :url="'{{ url("media/upload-temp-image/locations/location_image/location") }}'"
                                                >
                                            </upload-media>
                                        @endif
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.update_location'), ['class' => 'dc-btn']) !!}
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
