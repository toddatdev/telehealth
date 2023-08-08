@extends('front-end.master')
@section('content')
@include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('articleListing') !!}
    <div class="dc-main-section">
        <div class="container" id="articles">
            <div class="row">
                <div class="dc-twocolumns dc-borderlt-0 dc-haslayout">
                    <div class="col-md-12 col-xl-12 float-right">
                        <div class="row dc-articles-mt dc-articles-list">
                            <div class="col-sm-12 float-left">
                                <div class="dc-searchresult-head">
                                    <div class="dc-title"><h3>{{ trans('lang.latest_articles') }}</h3></div>
                                </div>
                            </div>
                            @if(!empty($articles) && $articles->count() > 0 )
                                @foreach ($articles as $key => $article)
                                    <div class="col-sm-12 float-right">
                                        <div class="dc-article">
                                            <figure class="dc-articleimg">
                                                <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author->id.'/articles/', $article->image, 'listing-', 'article-default.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                <figcaption>
                                                    <div class="dc-articlesdocinfo">
                                                        <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author->id, App\User::find($article->author->id)->profile->avatar, 'extra-small-', 'user-login.png')) }}" alt="{{ trans('lang.img_desc') }}">
                                                        <span>{{ Helper::getUserName($article->author_id) }}</span>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                            <div class="dc-articlecontent">
                                                <div class="dc-title dc-ellipsis dc-titlep">
                                                    <div class="dc-articleby-holder">
                                                        @if (!empty($article->categories) && $article->categories->count() > 0)
                                                            @foreach ($article->categories as $category)
                                                                <a href="{{ route('articleListing', clean($category->slug)) }}" class="dc-articleby">{{ clean($category->title) }}</a>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <h3><a href="{{ route('articleDetail', ['slug' => clean($article->slug)]) }}">{{ clean($article->title) }}</a></h3>
                                                    <span class="dc-datetime"><i class="ti-calendar"></i> {{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</span>
                                                </div>
                                                <ul class="dc-moreoptions d-flex justify-content-end dc-option">
                                                    <li>
                                                        <a href="javascript:void(0);" class="{{ (in_array($article->id, $saved_articles) ? 'dc-like dc-clicksave dc-btndisbaled' : '') }}"
                                                            id="article-{{ $article->id }}" v-on:click.prevent="add_wishlist('article-{{ $article->id }}', '{{ $article->id }}', 'saved_articles', '')">
                                                            <i class="ti-heart"></i>
                                                        </a>
                                                        {{{ !empty($article->likes) ? clean($article->likes) : 0 }}} {{ trans('lang.likes') }}
                                                    </li>
                                                    <li><a href="javascript:void(0);"><i class="ti-eye"></i></a>{{{ !empty($article->views) ? clean($article->views) : 0 }}} {{ trans('lang.views') }}</li>
                                                    <li id="dc-share-{{ $article->id }}" v-on:click="socialPopup('{{ $article->id }}')" class="la-shareicon">
                                                        <a href="javascript:void(0);"><i class="ti-share"></i> {{ trans('lang.share') }}</a>
                                                        <ul class="dc-simplesocialicons dc-socialiconsborder">
                                                            <li class="dc-facebook">
                                                                <a href="javascript:void()" v-on:click="socialShare('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dc-twitter">
                                                                <a href="javascript:void()" v-on:click="socialShare('https://twitter.com/intent/tweet?url={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dc-linkedin">
                                                                <a href="javascript:void()" v-on:click="socialShare('https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-linkedin-in"></i></a>
                                                            </li>
                                                            <li class="dc-googleplus">
                                                                <a href="javascript:void()" v-on:click="socialShare('https://plus.google.com/share?url={{ urlencode(route('articleDetail', ['slug' => clean($article->slug)])) }}')" class="social-share">
                                                                    <i class="fab fa-google-plus-g"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @include('errors.no-record')
                            @endif
                            <div class="col-12">
                                @if ( method_exists($articles,'links') )
                                    {{ $articles->links('pagination.custom') }}
                                @endif
                            </div>
                        </div>
                    </div>
                  <!--  <div class="col-md-4 col-xl-3 float-left">
                        @include('front-end.articles.sidebar.index')
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection
