@if (!empty($categories) && $categories->count() > 0)
<div class="dc-widget dc-categories">
    <div class="dc-widgettitle">
        <h3>{{ trans('lang.categories') }}</h3>
    </div>
    <div class="dc-widgetcontent">
        <ul class="dc-categories-content">
            @foreach ($categories as $category)
                <li><a href="{{ route('articleListing', $category->slug) }}">{{ clean($category->title) }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endif
