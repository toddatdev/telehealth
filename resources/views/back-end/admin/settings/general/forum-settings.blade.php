{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'forum-setting-form', '@submit.prevent'=>'submitForumSettings'])!!}
    <div class="dc-sidebar-ask-query dc-tabsinfo dc-location">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{{ trans('lang.forum_settings') }}}</h3>
        </div>
        <div class="dc-settingscontent">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    @if (!empty($forum_banner_image))
                        <upload-media
                        :img="'{{ $forum_banner_image ?? '' }}'"
                        :img_id="'forum_banner_image'"
                        :img_name="'forum_banner_image'"
                        :img_ref="'forum_banner_image'"
                        :img_hidden_name="'hidden_forum_banner_image'"
                        img_hidden_id="'hidden_forum_banner_image'"
                        :existed_img="'{{ $forum_banner_image ?? '' }}'"
                        :url="'{{ url("media/upload-temp-image/settings/forum_banner_image") }}'"
                        :existing_img_url="'{{ url("uploads/settings/general/$forum_banner_image") }}'"
                        :size = "'{{ Helper::getImageDetail( $forum_banner_image, 'size', 'uploads/settings/general') }}'"
                        :existing_img_name = "'{{ Helper::getImageDetail( $forum_banner_image, 'name', 'uploads/settings/general') }}'"
                        >
                        </upload-media>
                    @else
                        <upload-media
                            :img="'forum_banner_image'"
                            :img_id="'forum_banner_image'"
                            :img_name="'forum_banner_image'"
                            :img_ref="'forum_banner_image'"
                            :img_hidden_name="'hidden_forum_banner_image'"
                            img_hidden_id="'hidden_forum_banner_image'"
                            :url="'{{ url("media/upload-temp-image/settings/forum_banner_image") }}'"
                            >
                        </upload-media>
                    @endif
                    <div class="form-group">
                        {!! Form::text('forum_banner_title', e($forum_banner_title ?? ''), array('class' => 'form-control', 'placeholder'=>trans('lang.title'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('forum_banner_subtitle', e($forum_banner_subtitle ?? ''), array('class' => 'form-control', 'placeholder'=>trans('lang.subtitle'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('forum_banner_desc', e($forum_banner_desc ?? ''), array('class' => 'form-control', 'placeholder'=>trans('lang.desc'))) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
