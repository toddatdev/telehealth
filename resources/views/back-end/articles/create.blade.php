{!! Form::open(['url' => '', 'class' =>'dc-haslayout', 'id' =>'create-article-form', '@submit.prevent'=>'postArticle'])!!}
    <div class="dc-dashboardbox">
        <div class="dc-dashboardboxtitle la-switch-option">
            <h2>{{ trans('lang.post_new_article') }}</h2>
            <div class="float-right">
                <switch_button v-model="is_featured">{{{ trans('lang.feture_article') }}}</switch_button>
                <input type="hidden" :value="is_featured" name="is_featured">
            </div>
        </div>
        <div class="dc-dashboardboxcontent dc-addservices dc-articlesservices">
            <div class="dc-tabscontenttitle">
                <h3>{{ trans('lang.add_article_detail') }}</h3>
            </div>
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', null, ['class' =>
                        'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group dc-tinymceeditor">
                        {!! Form::textarea('description', null,
                            ['class' => 'dc-tinymceeditor', 'id' => 'article-desc'])
                        !!}
                    </div>
                </fieldset>
            </div>
            <div class="dc-profilephoto dc-tabsinfo">
                <div class="dc-tabscontenttitle">
                    <h3>{{ trans('lang.featured_photo') }}</h3>
                </div>
                <div class="dc-profilephotocontent">
                    <div class="dc-description">
                        <p>{{ trans('lang.featured_photo_desc') }}</p>
                    </div>
                    <div class="dc-formtheme dc-formprojectinfo dc-formcategory">
                        <div class="dc-settingscontent">
                            <div class = "dc-formtheme dc-userform">
                                <upload-media
                                :img="'feature_img'"
                                :img_id="'feature_img'"
                                :img_name="'feature_img'"
                                :img_ref="'feature_img'"
                                :img_hidden_name="'hidden_feature_img'"
                                :img_hidden_id="'hidden_feature_img'"
                                :url="'{{ url("media/upload-temp-image/users/feature_img/articles") }}'"
                                :width="825"
                                :height="360">
                                </upload-media>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dc-profilephoto dc-tabsinfo">
                <div class="dc-tabscontenttitle">
                    <h3>{{ trans('lang.select_category') }}</h3>
                </div>
                <article-cats :placeholder="'{{ trans('lang.all_cats_selected') }}'"></article-cats>
            </div>
            <div class="dc-btnarea">
                {!! Form::submit(trans('lang.post_now'), ['class' => 'dc-btn']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}

