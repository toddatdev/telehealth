<div class="dc-userlogedin">
    <figure class="dc-userimg">
        <img src="{{ asset(Helper::getImage('uploads/users/'.Auth::user()->id, Auth::user()->profile->avatar, 'extra-small-', 'user-login.png')) }}" 
            alt="{{ trans('lang.img_desc') }}">
    </figure>
    <div class="dc-username">
        <h4>{{ Helper::getUserName(Auth::user()->id) }}</h4>
        <span>{{ Helper::getRoleTypeByUserID(Auth::user()->id) }}</span>
    </div>
    <nav class="dc-usernav">
        <ul>
           {{ Helper::displayDashboardMenu('profile') }}
           <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
                    <i class="lnr lnr-exit"></i>{{{trans('lang.logout')}}}
                </a>
                <form id="profile-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>

    </nav>
</div>
