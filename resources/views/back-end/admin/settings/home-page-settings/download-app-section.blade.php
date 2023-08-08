{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-downloadapp-form', '@submit.prevent'=>'submitDownloadAppSettings'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('lang.download_app_sec_settings') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_app_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_app_sec" name="show_app_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', e($app_sec_title), ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('subtitle', e($app_sec_subtitle), ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.sub_heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', $app_sec_desc, ['class' =>
                            'dc-tinymceeditor form-control', 'id' => 'dc-tinymceeditor', 'placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                    <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                        <div class = "dc-formtheme dc-userform">
                            @if (!empty($app_sec_img))
                                <upload-media
                                :title="'{{ trans('lang.app_section_image') }}'"
                                :img="'{{ $app_sec_img }}'"
                                :img_id="'app_sec_img'"
                                :img_name="'app_sec_img'"
                                :img_ref="'app_sec_img'"
                                :img_hidden_name="'app_sec_img'"
                                :img_hidden_id="'hidden_app_sec_img'"
                                :existed_img="'{{$app_sec_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/app_sec_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$app_sec_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $app_sec_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $app_sec_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('lang.app_section_image') }}'"
                                :img="'app_sec_img'"
                                :img_id="'app_sec_img'"
                                :img_name="'app_sec_img'"
                                :img_ref="'app_sec_img'"
                                :img_hidden_name="'app_sec_img'"
                                :img_hidden_id="'hidden_app_sec_img'"
                                :url="'{{ url("media/upload-temp-image/settings/app_sec_img") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                    </div>
                    <div class="dc-tabscontenttitle">
                        <h3>{{ trans('lang.android_app_url') }}</h3>
                    </div>
                    <div class="form-group">
                        {!! Form::text('android_url', $app_android_url, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.app_android_url')]) !!}
                    </div>
                    <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                        <div class = "dc-formtheme dc-userform">
                            @if (!empty($android_img))
                                <upload-media
                                :title="'{{ trans('lang.app_android_image') }}'"
                                :img="'{{ $android_img }}'"
                                :img_id="'android_img'"
                                :img_name="'android_img'"
                                :img_ref="'android_img'"
                                :img_hidden_name="'android_img'"
                                :img_hidden_id="'hidden_android_img'"
                                :existed_img="'{{$android_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/android_img/mobile_app") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$android_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $android_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $android_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('lang.app_android_image') }}'"
                                :img="'android_img'"
                                :img_id="'android_img'"
                                :img_name="'android_img'"
                                :img_ref="'android_img'"
                                :img_hidden_name="'android_img'"
                                :img_hidden_id="'hidden_android_img'"
                                :url="'{{ url("media/upload-temp-image/settings/android_img/mobile_app") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                    </div>
                    <div class="dc-tabscontenttitle">
                        <h3>{{ trans('lang.ios_app_url') }}</h3>
                    </div>
                    <div class="form-group">
                        {!! Form::text('ios_url', $app_ios_url, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.app_ios_url')]) !!}
                    </div>
                    <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                        <div class = "dc-formtheme dc-userform">
                            @if (!empty($ios_img))
                                <upload-media
                                :title="'{{ trans('lang.app_ios_image') }}'"
                                :img="'{{ $ios_img }}'"
                                :img_id="'ios_img'"
                                :img_name="'ios_img'"
                                :img_ref="'ios_img'"
                                :img_hidden_name="'ios_img'"
                                :img_hidden_id="'hidden_ios_img'"
                                :existed_img="'{{ $ios_img }}'"
                                :url="'{{ url("media/upload-temp-image/settings/ios_img/mobile_app") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$ios_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $ios_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $ios_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('lang.app_ios_image') }}'"
                                :img="'ios_img'"
                                :img_id="'ios_img'"
                                :img_name="'ios_img'"
                                :img_ref="'ios_img'"
                                :img_hidden_name="'ios_img'"
                                :img_hidden_id="'hidden_ios_img'"
                                :url="'{{ url("media/upload-temp-image/settings/ios_img/mobile_app") }}'"
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
