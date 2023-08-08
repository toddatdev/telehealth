<div class="dc-contentdoctab dc-articles-holder tab-pane" id="doc-articles">
    @if (!empty($articles) && $articles->count() > 0 )
        <div class="dc-articles">
            <div class="dc-searchresult-head">
                <div class="dc-title"><h4>{{ trans('lang.articles_by') }}&nbsp;"{{ Helper::getUserName($user->id) }}"</h4></div>
            </div>
            <div class="dc-articleslist-content dc-articles-list">
                @foreach ($articles as $key => $article)
                    <div class="dc-article">
                        <figure class="dc-articleimg">
                            <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id.'/articles/', $article->image, 'list-', 'list-article-default.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                            <figcaption>
                                <div class="dc-articlesdocinfo">
                                    <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id, $user->profile->avatar, 'extra-small-', 'user-login.png')) }}" alt="{{ trans('lang.img_desc') }}">
                                    <span>{{ Helper::getUserName($user->id) }}</span>
                                </div>
                            </figcaption>
                        </figure>
                        <div class="dc-articlecontent">
                            <div class="dc-title">
                                @if (!empty($article->categories) && $article->categories->count() > 0)
                                    @foreach ($article->categories as $category)
                                        <a href="{{ route('articleListing', clean($category->slug)) }}" class="dc-articleby">{{ html_entity_decode(clean($category->title)) }}</a>
                                    @endforeach
                                @endif
                                <h3><a href="{{ route('articleDetail', ['slug' => clean($article->slug)]) }}">{{ html_entity_decode(clean($article->title)) }}</a></h3>
                                <span class="dc-datetime"><i class="ti-calendar"></i> {{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</span>
                            </div>
                            <ul class="dc-moreoptions">
                                <li>
                                    <a href="javascript:void(0);" class="{{ (in_array($article->id, $saved_articles) ? 'dc-clicksave dc-btndisbaled' : '') }}"
                                        id="article-{{ $article->id }}" @click.prevent="add_wishlist('article-{{ $article->id }}', '{{ $article->id }}', 'saved_articles', '')">
                                        <i class="ti-heart"></i>
                                        <span v-if=show_likes>@{{article_likes}}</span>
                                        <span v-else>{{{ !empty($article->likes) ? clean($article->likes) : 0}}}</span>
                                    </a>
                                </li>
                                {{-- <li><a href="javascript:void(0);"><i class="ti-heart"></i> {{{ !empty($article->likes) ? clean($article->likes) : 0 }}}</a></li> --}}
                                <li><a href="javascript:void(0);"><i class="ti-eye"></i> {{{ !empty($article->views) ? clean($article->views) : 0 }}}</a></li>
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
                        </div>
                    </div>
                @endforeach
                @if ( method_exists($articles,'links') )
                    {{ $articles->links('pagination.custom') }}
                @endif
            </div>
        </div>
    @else
        @include('errors.no-record')
    @endif
    @include('front-end.doctors.profile-details.share-profile.index')
</div>
