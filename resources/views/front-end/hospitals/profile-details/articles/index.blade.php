
<div class="dc-contentdoctab dc-articles-holder tab-pane" id="articles">
    @if (!empty($articles) && $articles->count() > 0 )
        <div class="dc-articles">
            <div class="dc-searchresult-head">
                <div class="dc-title"><h4>{{ trans('lang.articles_by') }}&nbsp;"{{ Helper::getUserName($user->id) }}"</h4></div>
                <div class="dc-rightarea">
                    <div class="dc-select">
                        <select>
                            <option value="sort_by">{{ trans('lang.sort_by') }}</option>
                            <option value="last_created">{{ trans('lang.last_created_on_top') }}</option>
                            <option value="last_modified">{{ trans('lang.last_modified_on_top') }}</option>
                            <option value="alphabet">{{ trans('lang.alphabetically') }}</option>
                        </select>
                    </div>
                </div>
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
                                        <a href="javascript:void(0);" class="dc-articleby">{{ html_entity_decode(clean($category->title)) }}</a>
                                    @endforeach
                                @endif
                                <h3><a href="{{ route('articleDetail', ['slug' => clean($article->slug)]) }}">{{ html_entity_decode(clean($article->title)) }}</a></h3>
                                <span class="dc-datetime"><i class="ti-calendar"></i> {{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</span>
                            </div>
                            {{-- <ul class="dc-moreoptions">
                                <li><a href="javascript:void(0);"><i class="ti-heart"></i> 12,032</a></li>
                                <li><a href="javascript:void(0);"><i class="ti-eye"></i> 1,26,558</a></li>
                                <li><a href="javascript:void(0);"><i class="ti-share"></i> {{ trans('lang.share') }}</a></li>
                            </ul> --}}
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
    @include('front-end.hospitals.profile-details.share-profile.index')
</div>
