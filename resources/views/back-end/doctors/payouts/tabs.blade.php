<div class="dc-dashboardtabs">
    <ul class="dc-tabstitle nav navbar-nav">
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName() == 'doctorPayoutsSettings'? 'active': '' }}}" href="{{{ route('doctorPayoutsSettings') }}}">{{{ trans('lang.payout_settings') }}}</a>
        </li>
        <li class="nav-item">
            <a class="{{{ \Request::route()->getName() == 'getDoctorPayouts'? 'active': '' }}}" href="{{{ route('getDoctorPayouts') }}}">{{{ trans('lang.payouts') }}}</a>
        </li>
    </ul>
</div>