@extends('back-end.master')

@section('content')
@include('includes.pre-loader')
    <div class="row" id="hospitals">
        <div class="dc-preloader-section" v-if="is_loading" v-cloak>
            <div class="dc-preloader-holder">
                <div class="dc-loader"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-6">
            <div class="dc-haslayout dc-dbsectionspacetest">
                <div class="dc-dashboardbox dc-manageteam-wrap">
                    <div class="dc-searchresult-head">
                        <div class="dc-title"><h3>{{ trans('lang.manage_team') }}</h3></div>
                    </div>
                    @if (!empty($teams) && $teams->count() > 0)
                        <div class="dc-recentapoint-holder">
                            @foreach ($teams as $key => $team)
                                @php $user = \App\User::findOrFail($team->doctor_id); @endphp
                                <div class="dc-recentapoint">
                                    <div class="dc-recentapoint-content dc-apoint-noti dc-noti-colorone">
                                        <div class="dc-recentapoint-figure">
                                            <figure><img src="{{ asset(Helper::getImage('uploads/users/'.$user->id, $user->profile->avatar, 'extra-small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}"></figure>
                                        </div>
                                        <div class="dc-recent-content">
                                            <span><a href="{{ route('userProfile', ['slug' => clean($user->slug)]) }}"> {{{ ucwords(Helper::getUserName($user->id)) }}}</a> <em>{{ trans('lang.status') }}: {{ clean($team->status) }}</em></span>
                                            <div class="dc-recent-contenttest">
                                                @if ($team->status === 'pending')
                                                    <a v-on:click.prevent="approveUser('{{{ trans('lang.approve_user') }}}','{{{ trans('lang.user_approved') }}}','{{{ trans('lang.approved') }}}', {{ clean($team->id) }})" href="javascript:void(0);" class="dc-btn dc-btn-sm">{{ trans('lang.approve_user') }}</a>
                                                    <a v-on:click.prevent="rejectUser('{{{ trans('lang.reject_user') }}}','{{{ trans('lang.user_rejected') }}}','{{{ trans('lang.rejected') }}}', {{ clean($team->id) }})" href="javascript:void(0);" class="dc-userbtn">{{ trans('lang.reject_user') }}</a>
                                                @else
                                                    <a v-on:click.prevent="deleteUser('{{{ trans('lang.delete_user') }}}','{{{ trans('lang.user_deleted') }}}','{{{ trans('lang.deleted') }}}', {{ clean($team->id) }})" href="javascript:void(0);" class="dc-userbtn">{{ trans('lang.delete_user') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ( method_exists($teams,'links') )
                                {{ $teams->links('pagination.custom') }}
                            @endif
                        </div>
                    @else
                        @include('errors.no-record')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
