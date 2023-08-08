@push('backend_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/chosen.css') }}">
@endpush
@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row la-article-holder" id="articles">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="dc-dashboardbox dc-offered-holder">
                <div class="dc-dashboardboxtitle">
                    <h2>{{ trans('lang.article_listing') }}</h2>
                </div>
                @if (!empty($articles) && $articles->count() > 0 )
                    <div class="dc-dashboardboxcontent">
                        <div class="dc-contentdoctab dc-articles-holder dc-listedarticle dc-postarticle">
                            <div class="dc-articles">
                                <div class="dc-articleslist-content dc-articles-list">
                                    @foreach ($articles as $article)
                                        <div class="dc-article del-{{{ $article->id }}}">
                                            <div>
                                                <figure class="dc-articleimg">
                                                    <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id.'/articles/', $article->image, 'list-', 'list-article-default')) }}" alt="{{ trans('lang.img_desc') }}">
                                                    <figcaption>
                                                        <div class="dc-articlesdocinfo">
                                                            <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->avatar, 'extra-small-', 'user-login.png')) }}" alt="{{ trans('lang.img_desc') }}">
                                                            <span>
                                                                @if (Helper::getRoleTypeByUserID(Auth::user()->id) == 'admin')
                                                                    <a href="javascript:void(0);"> {{ Helper::getUserName($article->author_id) }}</a>
                                                                @else
                                                                    <a href="{{ route('userProfile', ['slug' => clean(Auth::user()->slug)]) }}"> {{ Helper::getUserName($article->author_id) }}</a>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                            <div class="dc-articlecontent">
                                                <div class="dc-title">
                                                    @if (!empty($article->categories))
                                                        <div class="dc-articleby-holder">
                                                            @foreach ($article->categories as $category)
                                                                <a href="javascript:void(0);" class="dc-articleby">{{ html_entity_decode(clean($category->title)) }}</a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <h3><a href="{{ route('articleDetail', ['slug' => $article->slug]) }}">{{ html_entity_decode(clean($article->title)) }}</a></h3>
                                                    <span class="dc-datetime"><i class="ti-calendar"></i> {{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</span>
                                                </div>
                                                <div class="dc-optionarea">
                                                    <ul class="dc-moreoptions">
                                                        <li><a href="javascript:void(0);"><i class="ti-heart"></i> {{{ !empty($article->likes) ? intVal(clean($article->likes)) : 0 }}}</a></li>
                                                        <li><a href="javascript:void(0);"><i class="ti-eye"></i> {{{ !empty($article->views) ? intVal(clean($article->views)) : 0 }}}</a></li>
                                                        <li id="dc-share-{{ $article->id }}" @click="socialPopup('{{ $article->id }}')" class="la-shareicon">
                                                            <a href="javascript:void(0);"><i class="ti-share"></i> {{ trans('lang.share') }}</a>
                                                            <ul class="dc-simplesocialicons dc-socialiconsborder">
                                                                <li class="dc-facebook">
                                                                    <a href="javascript:void()" @click="socialShare('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articleDetail', ['slug' => $article->slug])) }}')" class="social-share">
                                                                        <i class="fab fa-facebook-f"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="dc-twitter">
                                                                    <a href="javascript:void()" @click="socialShare('https://twitter.com/intent/tweet?url={{ urlencode(route('articleDetail', ['slug' => $article->slug])) }}')" class="social-share">
                                                                        <i class="fab fa-twitter"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="dc-linkedin">
                                                                    <a href="javascript:void()" @click="socialShare('https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articleDetail', ['slug' => $article->slug])) }}')" class="social-share">
                                                                        <i class="fab fa-linkedin-in"></i></a>
                                                                </li>
                                                                <li class="dc-googleplus">
                                                                    <a href="javascript:void()" @click="socialShare('https://plus.google.com/share?url={{ urlencode(route('articleDetail', ['slug' => $article->slug])) }}')" class="social-share">
                                                                        <i class="fab fa-google-plus-g"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="dc-rightarea dc-btnaction">
                                                        <a href="{{ route('editArticle', ['slug' => $article->slug]) }}" v-on:click='getFeaturedArticle("{{  $article->slug }}")' class="dc-addinfo"><i class="lnr lnr-pencil"></i></a>
                                                        <delete 
                                                        :title="'{{trans("lang.ph_delete_confirm_title")}}'" 
                                                        :id="'{{$article->id}}'" 
                                                        :message="'{{trans("lang.article_delete_message")}}'" 
                                                        :url="'{{url('delete/article')}}'" 
                                                        :redirect_url="'{{url('create-article')}}'">
                                                        </delete>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ( method_exists($articles,'links') )
                                        {{ $articles->links('pagination.custom') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @include('errors.no-record')
                @endif

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
            @include('back-end.articles.create')
        </div>
    </div>
@endsection
@push('backend_scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script>
        jQuery(".dc-chosen-select").chosen();
    </script>
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
