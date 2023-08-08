@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @include('includes.pre-loader')
    <section class="dc-haslayout dc-jobpostedholder dc-dbsectionspace" id="dashboard">
        <div class="row">
            @if (!empty($package))
              <!--  <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="wt-insightsitem wt-dashboardbox user_current_package">
                        <countdown
                        date="{{$expiry_date}}"
                        :image_url="'{{{ Helper::getDashExpiryImages('uploads/settings/icon', $latest_package_expiry_icon) }}}'"
                        :title="'{{ trans('lang.check_pkg_expiry') }}'"
                        :package_url="'{{url('doctor/packages')}}'"
                        :trail="'{{$trail}}'"
                        :current_package="'{{ html_entity_decode(clean($package->title)) }}'"
                        >
                        </countdown>
                    </div>
                </div>  -->
            @endif          
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="dc-insightsitem dc-dashboardbox">
                    <figure class="dc-userlistingimg">
                        {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_saved_item, 'heart') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ trans('lang.view_saved_items') }}</h3>
                            <a href="{{ route('getSavedItems', Helper::getAuthRoleType(Auth::user()->id)) }}">{{ trans('lang.click_view') }}</a>
                        </div>													
                    </div>	
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="dc-insightsitem dc-dashboardbox">
                    <figure class="dc-userlistingimg">
                        {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_available_balance, 'gift') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{ number_format((float)Auth::user()->appointments()->sum('charges'), 2, '.', '') }}</h3>
                            <span>{{ trans('lang.available_balance') }}</span>
                        </div>													
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="dc-insightsitem dc-dashboardbox">
                    <figure class="dc-userlistingimg">
                        {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_check_invoices, 'book') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ trans('lang.check_invoices') }}</h3>
                            <a href="{{route('userInvoice')}}">{{ trans('lang.click_view') }}</a>
                        </div>													
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="dc-insightsitem dc-dashboardbox">
                    <figure class="dc-userlistingimg">
                        {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_total_posted_articles, 'newspaper') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ Auth::user()->articles()->count() }}</h3>
                            <a href="{{route('createArticle')}}">{{ trans('lang.total_posted_articles') }}</a>
                        </div>													
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="dc-insightsitem dc-dashboardbox">
                    <figure class="dc-userlistingimg">
                        {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_latest_recieved_booking, 'bookmark') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ trans('lang.latest_recieved_booking') }}</h3>
                            <a href="{{route('doctorAppointments')}}">{{ trans('lang.click_view') }}</a>
                        </div>													
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
