{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-search-banner-form', '@submit.prevent'=>'submitHomeSearchBannerSettings'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('lang.search_banner_settings') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_search_banner">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_search_banner" name="show_search_banner">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('search_form_title', e($search_form_title), ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('search_banner_heading', e($search_banner_heading), ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.banner_heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('search_banner_subheading', e($search_banner_subheading), ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.banner_sub_heading')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('search_banner_btn_title', e($search_banner_btn_title), ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.btn_title')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('search_banner_btn_url', $search_banner_btn_url, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.btn_url')]) !!}
                    </div>
                   <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                            @if (!empty($search_banner_img))
                                <upload-media
                                :title="'{{ trans('lang.search_banner_image') }}'"
                                :img="'{{ $search_banner_img }}'"
                                :img_id="'search_banner_img'"
                                :img_name="'search_banner_img'"
                                :img_ref="'search_banner_img'"
                                :img_hidden_name="'hidden_search_banner_img'"
                                :img_hidden_id="'hidden_search_banner_img'"
                                :existed_img="'{{$search_banner_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/search_banner_img/banner_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$search_banner_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $search_banner_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $search_banner_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('lang.search_banner_image') }}'"
                                :img="'search_banner_img'"
                                :img_id="'search_banner_img'"
                                :img_name="'search_banner_img'"
                                :img_ref="'search_banner_img'"
                                :img_hidden_name="'hidden_search_banner_img'"
                                :img_hidden_id="'hidden_search_banner_img'"
                                :url="'{{ url("media/upload-temp-image/settings/search_banner_img/banner_img") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
