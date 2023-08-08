@extends('front-end.master')
@section('content')
@include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('showArticle', $article) !!}
    <div class="dc-main-section">
        <div class="container">
            <div class="row">
               <!-- <div class="col-md-4 col-xl-3 float-left order-last order-md-first">
                    @include('front-end.articles.sidebar.index')
                </div> -->
                <div class="col-md-12 col-xl-12 float-left">
                    <div class="dc-runner">
                        <figure class="dc-runner-img">
                            <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author->id.'/articles', $article->image, 'blog-single-', 'article-default.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                        </figure>
                        <div class="dc-runner-content">
                            @if (!empty($article->categories) && $article->categories->count() > 0)
                                @foreach ($article->categories as $category)
                                    @php $cat = App\Category::where('id', $category->id)->select('title', 'slug')->first(); @endphp
                                    <a href="{{{ route('articleListing', $cat->slug) }}}">{{ clean($cat->title) }}</a>
                                @endforeach
                            @endif
                            <div class="dc-runner-heading">
                                <h3>{{ clean($article->title) }}</h3>
                            </div>
                            <ul class="d-flex flex-wrap">
                                <li><i class="ti-calendar"></i> {{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</li>
                                <li><a href="javascript:void(0);"><i class="ti-heart"></i> {{{ !empty($article->likes) ? intVal(clean($article->likes)) : 0 }}}</a></li>
                                <li><a href="javascript:void(0);"><i class="ti-eye"></i> {{{ !empty($article->views) ? intVal(clean($article->views)) : 0 }}}</a></li>
                                <li class="la-shareicon">
                                    <a href="javascript:void(0);"><i class="ti-share"></i> {{ trans('lang.share') }}</a>
                                    <ul class="dc-simplesocialicons dc-socialiconsborder">
                                        <li class="dc-facebook">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" class="social-share">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="dc-twitter">
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="dc-linkedin">
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                                                <i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li class="dc-googleplus">
                                            <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" class="social-share"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dc-articlesingle-content">
                        {!! clean($article->description) !!}
                    </div>
                    <div class="dc-heading dc-py-20">
                        <h3 class="mb-0">{{ trans('lang.about_author') }}</h3>
                    </div>
                    <div class="card dc-cardbg-color dc-card dc-mb-20">
                        <div class="card-body dc-card-firstbody">
                            <div class="card-title d-flex dc-cardtitle-firstuser flex-wrap">
                                <div>
                                    <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author->id.'/', $article->author->profile->avatar, 'extra-small-', 'user-logo-def.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                </div>

                                <div class="dc-title-content dc-pl-10 align-self-center">
                                    <div><h5 class="m-0">{{ Helper::getUserName($article->author->id) }}</h5></div>
                                    <div><i class="far fa-calendar"></i><span>{{ trans('lang.member_since') }}: {{ Carbon\Carbon::parse($article->author->created_at)->format('M d, Y') }}</span></div>
                                </div>
                                <ul class="d-flex ml-auto align-self-center dc-title-socialicons">
                                    <li class="dc-fb">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('userProfile', ['slug' => clean($article->author->slug)])) }}" class="social-share">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="dc-twit">
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('userProfile', ['slug' => clean($article->author->slug)])) }}" class="social-share">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="dc-ld">
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('userProfile', ['slug' => clean($article->author->slug)])) }}" class="social-share">
                                            <i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li class="dc-google">
                                        <a href="https://plus.google.com/share?url={{ urlencode(route('userProfile', ['slug' => clean($article->author->slug)])) }}" class="social-share"><i class="fab fa-google-plus-g"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-text dc-author-description">
                                <p class="m-0">{{ clean($article->author->short_desc) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('front_end_scripts')
    <script>
         / SHARE OPTION  /
        jQuery('.la-shareicon').on('click', function() {
            jQuery('.la-shareicon ul').slideToggle('100');
        });
    </script>
    <script>
        var popupMeta = {
            width: 400,
            height: 400
        }
        jQuery(document).on('click', '.social-share', function(event){
            event.preventDefault();

            var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
                hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

            var url = $(this).attr('href');
            var popup = window.open(url, 'Social Share',
                'width='+popupMeta.width+',height='+popupMeta.height+
                ',left='+vPosition+',top='+hPosition+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup) {
                popup.focus();
                return false;
            }
        });
    </script>
@endpush
