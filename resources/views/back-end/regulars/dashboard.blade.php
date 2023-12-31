@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @include('includes.pre-loader')
    <section class="dc-haslayout dc-jobpostedholder dc-dbsectionspace">
        <div class="row">
           <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="dc-insightsitem dc-dashboardbox dc-insightnoticon">
                    <figure class="dc-userlistingimg">
                        {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_new_message, 'envelope') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ trans('lang.new_messages') }}</h3>
                            <a href="{{ route('message')}}">{{ trans('lang.click_view') }}</a>
                        </div>													
                    </div>	
                </div>
            </div> -->
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
                        {{ Helper::getDashboardImages('uploads/settings/icon', $latest_appointment_icon, 'edit') }}
                    </figure>
                    <div class="dc-insightdetails">
                        <div class="dc-title">
                            <h3>{{ trans('lang.appointments') }}</h3>
                            <span>{{ DB::table('appointments')->where('patient_id', Auth::user()->id)->get()->count() }}</span>
                        </div>													
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
