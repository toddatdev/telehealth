{!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'home-banner-form', '@submit.prevent'=>'submitHomeSliderSettings'])!!}
    <div class="dc-settingscontent dc-tabsinfo dc-sliderimg-holder">
        <div class = "dc-formtheme dc-userform">
            @if (!empty($slider_bg_image))
                <upload-media
                :title="'{{ trans('lang.slider_background_image') }}'"
                :img="'{{ $slider_bg_image }}'"
                :img_id="'slider_bg_img'"
                :img_name="'slider_bg_img'"
                :img_ref="'slider_bg_img'"
                :img_hidden_name="'slider_bg_img'"
                :img_hidden_id="'hidden_slider_bg_img'"
                :existed_img="'{{$slider_bg_image}}'"
                :url="'{{ url("media/upload-temp-image/settings/slider_bg_img") }}'"
                :existing_img_url="'{{ url("uploads/settings/home/$slider_bg_image") }}'"
                :size = "'{{ Helper::getImageDetail( $slider_bg_image, 'size', 'uploads/settings/home') }}'"
                :existing_img_name = "'{{ Helper::getImageDetail( $slider_bg_image, 'name', 'uploads/settings/home') }}'"
                >
                </upload-media>
            @else
                <upload-media
                :title="'{{ trans('lang.slider_background_image') }}'"
                :img="'slider_bg_img'"
                :img_id="'slider_bg_img'"
                :img_name="'slider_bg_img'"
                :img_ref="'slider_bg_img'"
                :img_hidden_name="'slider_bg_img'"
                :img_hidden_id="'hidden_slider_bg_img'"
                :url="'{{ url("media/upload-temp-image/settings/slider_bg_img") }}'"
                >
                </upload-media>
            @endif
        </div>
    </div>
    <div class="dc-tabsinfo dc-addslider-holder">
        <home-slider
            :ph_slide_title_one="'{{ trans('lang.ph.slide_title_one') }}'"
            :ph_slide_title_two="'{{ trans('lang.ph.slide_title_two') }}'"
            :ph_slide_title_three="'{{ trans('lang.ph.slide_title_three') }}'"
            :ph_slide_btn_title_one="'{{ trans('lang.ph.slide_btn_title_one') }}'"
            :ph_slide_btn_url_one="'{{ trans('lang.ph.slide_btn_url_one') }}'"
            :ph_slide_btn_title_two="'{{ trans('lang.ph.slide_btn_title_two') }}'"
            :ph_slide_btn_url_two="'{{ trans('lang.ph.slide_btn_url_two') }}'"
        >
        </home-slider>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
@section('bootstrap_script')
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
@stop
