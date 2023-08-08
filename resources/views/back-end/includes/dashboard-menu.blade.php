@php
    $items = Helper::getDashboardList();
    $output = '';
    $role_type = Helper::getAuthRoleType();
    $profile_link = $role_type == 'doctor' || $role_type == 'hospital' ? route('userProfile', ['slug' => Auth::user()->slug]) : 'javascript:;';
@endphp
<div id="dc-btnmenutoggle" class="dc-btnmenutoggle">
    <i class="ti-arrow-left"></i>
</div>
<div id="dc-verticalscrollbar" class="dc-verticalscrollbar">
    <div class="dc-companysdetails dc-usersidebar">
        <figure class="dc-companysimg" style="height: 150px; background: #fff; border-bottom: 1px solid #eee;">
            <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->banner, 'small-', 'user-banner.jpg')) }}" alt="{{ trans('lang.img_desc') }}" style="display: none;">
        </figure>
        <div class="dc-companysinfo">
            <figure><img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}"></figure>
            <div class="dc-title">
                <h2><a href="{{ $profile_link }}"> {{ Helper::getUserName(Auth::user()->id) }}</a></h2>
                <span>@ {{ Auth::user()->slug }} <i class="fa fa-clone"></i></span>
            </div>
        </div>
    </div>
    <nav id="dc-navdashboard" class="dc-navdashboard">
        <ul>
            {{ Helper::displayDashboardMenu('dashboard') }}
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dashboard-logout-form').submit();">
                    <i class="lnr lnr-exit"></i>{{{trans('lang.logout')}}}
                </a>
                <form id="dashboard-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </nav>
<!--
    <div class="dc-navdashboard-footer">
        <span><a href="#"> {{ Helper::getFooterSettings('footer_copyright') }}</a></span>
        <span class="version-area">{{ config('app.version') }}</span>
    </div>-->
</div>
