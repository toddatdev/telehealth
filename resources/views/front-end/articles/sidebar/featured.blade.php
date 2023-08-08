@if (!empty($featured_articles) && $featured_articles->count() > 0)
    <div class="dc-widget dc-featured">
        <div class="dc-widgettitle">
            <h3>{{ trans('lang.featured_posts') }}</h3>
        </div>
        <div class="dc-widgetcontent">
            <ul class="dc-featured-content dc-widgeticon ">
                @foreach ($featured_articles as $article)
                    <li>
                        <img src="{{ asset(Helper::getImage('uploads/users/'.$article->author_id.'/articles/', $article->image, 'extra-small-', 'icon-default.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                        <span>
                            <a href="{{ route('articleDetail', ['slug' => clean($article->slug) ]) }}">
                                {{ clean(str_limit($article->title, 28)) }}
                            </a>
                            <span>{{ Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

