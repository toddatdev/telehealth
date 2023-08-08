<div class="dc-searchresult-holder">
    <div class="dc-searchresult-head">
        <div class="dc-title"><h4>{{ trans('lang.all_onboard_docs') }}</h4></div>
    </div>
    @if (!empty($user->approvedTeams) && $user->approvedTeams->count() > 0)
        <div class="dc-searchresult-grid dc-searchresult-list dc-searchvlistvtwo">
            @foreach ($user->approvedTeams as $key => $doctor)
                @php
                    $slots = unserialize($doctor->slots);
                    $doctor_obj = App\User::find($doctor->doctor_id);
                    $services = !empty($slots['services']) ? $slots['services'] : array();
                    $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
                    $specialities = $doctor_obj->services->count() > 0 ? DB::table('user_service')->select('speciality')
                        ->where('user_id', $doctor_obj->id)->groupBy('speciality')->get()->pluck('speciality')->random(1)->toArray() : '';
                    $avg_rating = \App\Feedback::where('user_id', $doctor_obj->id)->pluck('avg_rating')->first();
                    $stars  = $avg_rating != 0 ? $avg_rating/5*100 : 0;
                    
                @endphp
                @if (Helper::getRoleTypeByUserID($doctor_obj->id) == 'doctor')
                    <div class="dc-docpostholder">
                        <div class="dc-docpostcontent">
                            <div class="dc-searchvtwo">
                                <figure class="dc-docpostimg">
                                    <img src="{{ asset(Helper::getImage('uploads/users/'.$doctor_obj->id, $doctor_obj->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                </figure>
                                <div class="dc-title">
                                    @if (!empty($specialities))
                                        @foreach ($specialities as $key => $user_speciality)
                                            @php $speciality = Helper::getSpecialityByID($user_speciality); @endphp
                                            @if (!empty($speciality))
                                                <a href="{{ url('/search-results?speciality='.clean($speciality->slug)) }}" class="dc-docstatus">{{ html_entity_decode(clean($speciality->title)) }}</a>  
                                            @endif
                                        @endforeach
                                    @endif
                                    <h3>
                                        <a href="{{ route('userProfile', ['slug' => clean($doctor_obj->slug)]) }}">
                                            {{ !empty($doctor_obj->profile->gender_title) ? Helper::getDoctorArray($doctor_obj->profile->gender_title) : ''}} 
                                            {{ Helper::getUserName($doctor_obj->id) }} 
                                        </a>
                                        {{ Helper::verifyUser(clean($doctor_obj->id), true) }}
                                        {{ Helper::verifyMedical(clean($doctor_obj->id), true) }} 
                                    </h3>
                                    <ul class="dc-docinfo">
                                        <li><em>{{ html_entity_decode(clean($doctor_obj->profile->sub_heading)) }}</em></li>
                                        <li>
                                            <span class="dc-stars">
                                                <span style="width: {{ clean($stars) }}%;"></span>
                                            </span>
                                            <em>{{ clean($doctor_obj->feedbacks->count()) }} {{ trans('lang.feedbacks') }}</em>
                                        </li>
                                    </ul>
                                </div>
                                @if ($doctor_obj->services->count() > 0)
                                    <div class="dc-tags">
                                        <ul>
                                            @foreach ($doctor_obj->services as $key => $service)
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
                                            @if ($doctor_obj->services->count() >= 6)
                                                <li class="dc-viewall-services">
                                                    <a href="javascript:;" id="view-service-{{$doctor_obj->id}}" class="dc-tagviewall" v-on:click="displayServices('view-service-{{$doctor_obj->id}}')">{{ trans('lang.view_all') }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="dc-doclocation dc-doclocationvtwo">
                                @if (!empty($doctor_obj->location->title))
                                    <span><i class="ti-direction-alt"></i> {{ html_entity_decode(clean($doctor_obj->location->title)) ?? '' }}</span>
                                @endif
                                <span>
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
                                </span>
                                <span><i class="ti-thumb-up"></i>{{ empty($doctor_obj->profile->votes) ? 0 : clean($doctor_obj->profile->votes) }} {{ trans('lang.votes') }}</span>
                                <span><i class="ti-wallet"></i> {{ trans('lang.starting_from') }} ${{ clean($doctor_obj->profile->starting_price) ?? '' }}</span>
                                <span><i class="ti-clipboard"></i> <em class="dc-available">
                                    {{ in_array(strtolower(Carbon\Carbon::now()->format('D')), $appointment_days)
                                    ? trans('lang.available_today') : trans('lang.not_available_today') }}</em></span>
                                <div class="dc-btnarea">
                                    <a href="{{{ url('profile/'.$doctor_obj->slug) }}}" class="dc-btn">{{ trans('lang.view_more') }}</a>
                                    @if (in_array($doctor_obj->id, $saved_doctors))
                                        <a href="javascrip:void(0);" class="dc-like dc-clicksave dc-btndisbaled">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @else
                                        <a href="javascrip:void(0);" class="dc-like" id="doctor-{{ $doctor_obj->id }}" @click.prevent="add_wishlist('doctor-{{ $doctor_obj->id }}', '{{ $doctor_obj->id }}', 'saved_doctors', '')" v-cloak>
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        @include('errors.no-record')
    @endif
</div>
