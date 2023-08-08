<div class="dc-searchresult-grid dc-searchresult-list dc-searchvlistvtwo">
    @if (!empty($teams) && $teams->count() > 0)
        @foreach ($teams as $key => $hospital_team)
            @php
                $slots = unserialize($hospital_team->slots);
                $team = App\Team::findOrFail($hospital_team->id);
                $hospital_obj = App\User::findOrFail($team->hospital->id);
                $services = !empty($slots['services']) ? $slots['services'] : array();
                $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
                $specialities = '';
                if (DB::table('user_service')->select('speciality')
                    ->where('user_id', $hospital_obj->id)->count() > 0) {
                    $specialities =    DB::table('user_service')->select('speciality')
                    ->where('user_id', $hospital_obj->id)->groupBy('speciality')->get()->pluck('speciality')->random(1)->toArray();
                    }
                $role_type = Helper::getRoleTypeByUserID($team->hospital->id);
                $hospital_profile = $role_type == 'hospital' ? url('profile/'.$team->hospital->slug) : 'javascript:;';
            @endphp
            <div class="dc-docpostholder">
                <div class="dc-docpostcontent">
                    <div class="dc-searchvtwo">
                        <figure class="dc-docpostimg">
                            <img src="{{ asset(Helper::getImage('uploads/users/'.$team->hospital->id, $team->hospital->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                        </figure>
                        <div class="dc-title">
                            @if (!empty($specialities))
                                @foreach ($specialities as $key => $user_speciality)
                                    @php $speciality = Helper::getSpecialityByID($user_speciality); @endphp
                                    @if (!empty($speciality))
                                        <a href="{{ url('/search-results?speciality='.$speciality->slug) }}" class="dc-docstatus">{{ html_entity_decode(clean($speciality->title)) }}</a>  
                                    @endif
                                @endforeach
                            @endif
                            <h3>
                                <a href="javascript:void(0);">{{ Helper::getUserName($team->hospital->id) }} </a>
                                {{ Helper::verifyUser(clean($team->hospital->id)) }} 
                                {{ Helper::verifyMedical(clean($team->hospital->id)) }} 
                            </h3>
                            <ul class="dc-docinfo">
                                <li><em>{{ $hospital_obj->profile->sub_heading ?? '' }}</em></li>
                            </ul>
                        </div>
                        @if (!empty($hospital_obj->services))
                            <div class="dc-tags">
                                <ul>
                                    @foreach ($hospital_obj->services as $key => $service)
                                        @if ($key <= 4)
                                            <li>
                                                <a href="javascript:void(0);">{{{ html_entity_decode(clean($service->title)) }}}</a>
                                            </li> 
                                        @else
                                            <li style="display:none">
                                                <a href="javascript:void(0);">{{{ html_entity_decode(clean($service->title)) }}}</a>
                                            </li>    
                                        @endif
                                    @endforeach
                                    @if ($hospital_obj->services->count() >= 6)
                                        <li class="dc-viewall-services">
                                            <a href="javascript:;" id="view-service-{{$hospital_obj->id}}" class="dc-tagviewall" v-on:click="displayServices('view-service-{{$hospital_obj->id}}')">{{ trans('lang.view_all') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="dc-doclocation dc-doclocationvtwo">
                        @if (!empty($hospital_obj->location->title))
                            <span><i class="ti-direction-alt"></i> {{ html_entity_decode(clean($hospital_obj->location->title)) ?? '' }}</span>
                        @endif
                        @if (!empty($appointment_days))
                            <span><i class="ti-calendar"></i>
                                @foreach (Helper::getAppointmentDays() as $key => $day)
                                    @if (!in_array($key, $appointment_days))
                                        <em class="dc-dayon">{{ html_entity_decode(clean($day['title'])) }}</em>
                                    @else
                                        {{ html_entity_decode(clean($day['title'])) }},
                                    @endif
                                @endforeach
                            </span>
                        @endif
                        <span><i class="ti-thumb-up"></i>{{ trans('lang.doctors_onboard') }}: {{ clean($hospital_obj->approvedTeams()->count()) }}</span>
                        <span>
                            <i class="ti-wallet"></i>
                            {{{ $hospital_obj->profile->working_time == '24_hours' ? trans('lang.24_hours') : clean($hospital_obj->profile->working_time) }}}
                        </span>
                        <div class="dc-btnarea">
                            <a href="{{{ $hospital_profile }}}" class="dc-btn">{{ trans('lang.view_more') }}</a>
                            @if (in_array($team->hospital->id, $saved_hospitals))
                                <a href="javascrip:void(0);" class="dc-like dc-clicksave dc-btndisbaled">
                                    <i class="fa fa-heart"></i>
                                </a>
                            @else
                                <a href="javascrip:void(0);" class="dc-like" id="location-{{ $team->hospital->id }}" @click.prevent="add_wishlist('location-{{ $team->hospital->id }}', '{{ $team->hospital->id }}', 'saved_hospitals', '')" v-cloak>
                                    <i class="fa fa-heart"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ( method_exists($teams,'links') )
            {{ $teams->links('pagination.custom') }}
        @endif
    @else
        @include('errors.no-record')
    @endif
</div>
