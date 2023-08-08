{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-article-section-form', '@submit.prevent'=>'submitArticleSettings'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('lang.article_sec_settings') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_article_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_article_sec" name="show_article_sec">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', !empty($article_sec_title) ? e($article_sec_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('subtitle', !empty($article_sec_subtitle) ? e($article_sec_subtitle) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.sub_heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($article_sec_desc) ? e($article_sec_desc) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
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
