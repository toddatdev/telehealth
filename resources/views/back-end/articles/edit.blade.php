@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row" id="articles">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            {!! Form::open(['url' => '', 'class' =>'dc-haslayout dc-dbsectionspace dc-dbsectionspacetest', 'id' =>'update-article-form', '@submit.prevent'=>'updateArticle("'.$article->id.'")'])!!}
                <div class="dc-dashboardbox">
                    <div class="dc-dashboardboxtitle la-switch-option">
                        <h2>{{ trans('lang.edit_article') }}</h2>
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
                                    {!! Form::text('title', e($article->title), ['class' =>
                                    'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                                </div>
                                <div class="form-group dc-tinymceeditor">
                                    {!! Form::textarea('description', e($article->description),
                                        ['class' => 'dc-tinymceeditor', 'id' => 'article-desc'])
                                    !!}
                                </div>
                            </fieldset>
                        </div>
                        <div class="dc-profilephoto dc-tabsinfo">
                            <div class="dc-tabscontenttitle">
                                <h3>{{ trans('lang.featured_photo') }}</h3>
                            </div>
                            <div class="dc-profilephotocontent dc-featuredphoto">
                                <div class="dc-description">
                                    <p>{{ trans('lang.featured_photo_desc') }}</p>
                                </div>
                                <div class="dc-formtheme dc-formprojectinfo dc-formcategory">
                                    <div class="dc-settingscontent">
                                        @if (!empty($article->image))
                                            <upload-media
                                            :img="'{{ $article->image }}'"
                                            :img_id="'feature_img'"
                                            :img_name="'feature_img'"
                                            :img_ref="'feature_img'"
                                            :img_hidden_name="'hidden_feature_img'"
                                            :img_hidden_id="'hidden_feature_img'"
                                            :existed_img="'{{ $article->image }}'"
                                            :url="'{{ url("media/upload-temp-image/users/feature_img/articles") }}'"
                                            :existing_img_url="'{{ url('uploads/users/'.Auth::user()->id.'/articles/'.$article->image.'') }}'"
                                            :size = "'{{ Helper::getImageDetail( $article->image, 'size', 'uploads/users/' .Auth::user()->id. '/articles/') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $article->image, 'name', 'uploads/users/' .Auth::user()->id) }}'"
                                            >
                                            </upload-media>
                                        @else
                                            <div class = "dc-formtheme dc-userform">
                                                <upload-media
                                                :img="'feature_img'"
                                                :img_id="'feature_img'"
                                                :img_name="'feature_img'"
                                                :img_ref="'feature_img'"
                                                :img_hidden_name="'hidden_feature_img'"
                                                :img_hidden_id="'hidden_feature_img'"
                                                :url="'{{ url("media/upload-temp-image/users/feature_img/articles") }}'"
                                                >
                                                </upload-media>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty($categories) && count($categories) > 0)
                            <div class="dc-profilephoto dc-tabsinfo">
                                <div class="dc-tabscontenttitle">
                                    <h3>{{ trans('lang.select_category') }}</h3>
                                </div>
                                <article-cats :placeholder="'{{ trans('lang.all_cats_selected') }}'"></article-cats>
                            </div>
                        @endif
                        <div class="dc-btnarea">
                            {!! Form::submit(trans('lang.post_now'), ['class' => 'dc-btn']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('backend_scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.dc-tinymceeditor',
            height: 300,
            theme: 'modern',
            plugins: ['code advlist autolink lists link image charmap print preview hr anchor pagebreak'],
            menubar: false,
            statusbar: false,
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify code',
            image_advtab: true,
            remove_script_host: false,
            })
    </script>
@endpush
