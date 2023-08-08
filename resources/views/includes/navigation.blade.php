<ul class="navbar-nav">
    <li class="nav-item">
       <!-- <a href="{{ route('forumQuestions') }}">{{ trans('lang.health_forum') }}</a> -->
	<a href="/">Home</a>
    </li>
    <li class="nav-item"><a href="/page/about">About</a></li>
    <li class="nav-item"><a href="/page/patients">Patients</a></li>
    <li class="nav-item"><a href="/page/providers">Providers</a>
	<!-- <a href="{{{ url('search-results') }}}">Providers</a> -->
       <!-- <ul class="sub-menu menu-item-moved">
            <li>
                <a href="{{{ url('search-results') }}}">{{ trans('lang.search_doctors') }}</a>
            </li>
            <li>
                <a href="{{{ url('search-results') }}}">{{ trans('lang.search_hospitals') }}</a>
            </li>
        </ul> -->
    </li>
    <li class="nav-item"><a href="/contactus">Contact</a></li>
<!--
    <li class="menu-item-has-children page_item_has_children">
        <a href="javascript:void(0);">{{ trans('lang.pages') }}</a>
        <ul class="sub-menu">
            <li class="nav-item">
                <a href="{{ route('articleListing') }}">{{ trans('lang.articles') }}</a>
            </li>
            @if (Schema::hasTable('pages'))
                @php $pages = App\Page::all(); @endphp
                @if (!empty($pages) && $pages->count() > 0)
                    @foreach ($pages as $key => $page)
                        @php
                            $page_has_child = App\Page::pageHasChild($page->id); 
                            $pageID = Request::segment(2);
                            $meta = !empty($page->meta) ? Helper::getUnserializeData($page->meta) : '';
                            $has_parent = App\Page::pageHasParent($page->id);
                        @endphp
                        @if (!empty($meta['show_page']) && $meta['show_page'] == 'true' && $has_parent == 0)
                            @if (!empty($page_has_child))
                                <li class="menu-item-has-children page_item_has_children dc-notificationicon">
                            @else
                                <li>    
                            @endif
                                <a href="{{url('page/'.$page->slug)}}">{{{ html_entity_decode(clean($page->title)) }}}</a>
                                <ul class="sub-menu">
                                    @foreach($page_has_child as $parent)
                                        @php $child = App\Page::getChildPages($parent->child_id);@endphp
                                        <li><a href="{{url('page/'.$child->slug.'/')}}">{{{ html_entity_decode(clean($child->title)) }}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endif
        </ul>
        
    </li> -->
</ul>
