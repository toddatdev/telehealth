@extends('front-end.master')
@section('title'){{ clean($search_list_meta_title) }} @stop
@section('description', clean($search_list_meta_desc))
@push('front_end_stylesheets')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('searchResults') !!}
    <div class="nsearch-main">

        <div class="dc-main-section">
            <div id="user-profile">
                <div class="dc-preloader-section" v-if="loading" v-cloak>
                    <div class="dc-preloader-holder">
                        <div class="dc-loader"></div>
                    </div>
                </div>


                <!-- Start of Search -->

                <div class="nsearch-top-bar">
                    <div class="container">
                        <h2>Search Telehealth Plus</h2>
                        <div class="nsearch-breadcrumbs" style="display: none;">
                            <a href="#"><img src="/uploads/resources/img/line-home-icon.png" style="width: 14px;">
                                &nbsp;Home</a>
                            <span>&bull;</span>
                            <a href="#">Search</a>
                        </div>

                        @php
                            $locations = App\Location::all();
                            $roles     = Spatie\Permission\Models\Role::all()->toArray();
                        @endphp
                        <div class="dc-innerbanner-holder" id="dc_search_bar">
                            {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => '']) !!}
                            <div class="container">
                                <div class="row">

                                    <div class="col-12">

                                        <div class="dc-innerbanner">
                                            <div class="dc-formtheme dc-form-advancedsearch dc-innerbannerform">
                                                <fieldset class="nsearch-filter-bar">
                                                    <div class="form-group form-group-search-bar">
                                                        <input type="text" name="search"
                                                               value="{{ !empty(request()->search) ? request()->search : '' }}"
                                                               class="form-control nsearch-input"
                                                               placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="dc-select">
                                                            <select data-placeholder="lang.select_speciality"
                                                                    name="speciality">
                                                                <option value="">Select Speciality</option>
                                                                <option value="general-practitioner">General
                                                                    Practitioner
                                                                </option>
                                                                <option value="acupuncturist">Acupuncturist</option>
                                                                <option value="audiologist">Audiologist</option>
                                                                <option value="bowen-therapist">Bowen Therapist</option>
                                                                <option value="cardiologist">Cardiologist</option>
                                                                <option value="chinese-medicine">Chinese Medicine
                                                                </option>
                                                                <option value="chiropractor">Chiropractor</option>
                                                                <option value="counsellor">Counsellor</option>
                                                                <option value="dentist">Dentist</option>
                                                                <option value="dermatologist">Dermatologist</option>
                                                                <option value="dietician">Dietician</option>
                                                                <option value="exercise-physiologist">Exercise
                                                                    Physiologist
                                                                </option>
                                                                <option value="family-planning">Family Planning</option>
                                                                <option value="health-coach">Health Coach</option>
                                                                <option value="homeopath">Homeopath</option>
                                                                <option value="medical-cannabis-specialist">Medical
                                                                    Cannabis Specialist
                                                                </option>
                                                                <option value="myotherapist">Myotherapist</option>
                                                                <option value="naturopath">Naturopath</option>
                                                                <option value="nurse">Nurse</option>
                                                                <option value="nutritionist">Nutritionist</option>
                                                                <option value="obstetrician">Obstetrician</option>
                                                                <option value="occupational-therapist">Occupational
                                                                    Therapist
                                                                </option>
                                                                <option value="oncologist">Oncologist</option>
                                                                <option value="optometrist">Optometrist</option>
                                                                <option value="orthodontist">Orthodontist</option>
                                                                <option value="osteopath">Osteopath</option>
                                                                <option value="other">Other</option>
                                                                <option value="paediatrician">Paediatrician</option>
                                                                <option value="physiotherapist">Physiotherapist</option>
                                                                <option value="plastic-surgeon">Plastic Surgeon</option>
                                                                <option value="podiatrist">Podiatrist</option>
                                                                <option value="psychologist">Psychologist</option>
                                                                <option value="psychiatrist">Psychiatrist</option>
                                                                <option value="rheumatologist">Rheumatologist</option>
                                                                <option value="speech-pathologist">Speech Pathologist
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="dc-select">
                                                            <select class="locations"
                                                                    data-placeholder="{{ trans('lang.select_country') }}"
                                                                    name="locations">
                                                                <option value="">{{ trans('lang.select_country') }}</option>
                                                                <option value="English">English</option>
                                                                @foreach ($locations as $key => $location)
                                                                    <option value="{{{ clean($location->slug) }}}">{{{ html_entity_decode(clean($location->title)) }}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="dc-select">
                                                            <select name="type">
                                                                <option value="both" selected="selected">Gender</option>
                                                                <option value="both">Any</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group n-submit">
                                                        {!! Form::submit(trans('lang.search'), ['class' => 'dc-btn sbmt-btn']) !!}
                                                    </div>
                                                </fieldset>


                                            </div>
                                        </div>


                                    </div>


                                </div>
                            </div>
                            {!! form::close(); !!}
                        </div>

                    </div>
                </div>
                <div class="nsearch-result">


                    <div class="container">
                        <div class="row">
                            <div class="dc-searchresult-head nsearch-result-top">

                                <div class="dc-title nsearch-matches">
                                    <h4><span>{{{ clean($total_records) }}}</span> {{trans('lang.matches_found') }}</h4>
                                </div>


                                <div class="nsearch-sortby">
                                    <div class="dc-select">
                                        <select data-placeholder="{{ trans('lang.sort_by') }}" name="sort_by"
                                                v-model="sort_by" v-on:change="resultSortBy('sort_by', sort_by)"
                                                style="border-radius: initial;">
                                            <option value="null">Sort By:</option>
                                            <option value="lowprice">Lowest Price</option>
                                            <option value="highprice">Highest Price</option>
                                            <option value="availablenow">Available Now</option>
                                            <option value="date">Join Date</option>
                                            <option value="rating">Rating</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="dc-searchresult-holder" style="padding:0 15px;">

                                <div class="dc-searchresult-grid dc-searchresult-list nsearch-grid">

                                    <!-- Start User List -->
                                    @if (!empty($users) && $users->count() > 0)
                                        @foreach ($users as $key => $user)
                                            @php
                                                $user_obj = App\User::find($user->id);
                                                $avg_rating = \App\Feedback::where('user_id', $user_obj->id)->pluck('avg_rating')->first();
                                                $stars  = $avg_rating != 0 ? $avg_rating/5*100 : 0;
                                                $specialities = $user_obj->services->count() > 0 ? DB::table('user_service')->select('speciality')
                                                            ->where('user_id', $user_obj->id)->groupBy('speciality')->get()->pluck('speciality')->random(1)->toArray() : '';
                                                $day_list = Helper::getAppointmentDays();
                                                $servicelistdata = Helper::getDoctorsServicesList($user->id, 15);
                                                $serviceavailabledata = Helper::getDoctorsAvailableList($user->id, 15);
                                                $alreadyappointmenthave = Helper::getDoctorsAvailabelStateNow($user->id);
                                    $doctorstartendtime = Helper::getDoctorStartEndTime($user->id);
                                    $doctoravailabletodayend = Helper::getDoctorAvailableTodayEnd($user->id);

                                                $current_package = Helper::getCurrentPackage($user_obj);
                                                $featured = !empty($current_package) && !empty($current_package['featured']) ? $current_package['featured'] : 'false';
                                                $userMeta = \App\UserMeta::where('user_id', $user->id)->first();

                                            @endphp

                                            <div class="dc-docpostholder">
                                                <div class="dc-docpostcontent">
                                                    <div class="dc-searchvtwo">
                                                        <figure class="dc-docpostimg">
                                                            <img src="{{ asset(Helper::getImage('uploads/users/'.$user_obj->id, $user_obj->profile->avatar, 'medium-', 'user.jpg')) }}"
                                                                 alt="{{ trans('lang.img_desc') }}">
                                                            <div class="n-available">
                                                                @if (!empty($user_obj->profile->working_time) && $type == 'hospital')
                                                                    {{{ $user_obj->profile->working_time == '24_hours' ? trans('lang.24_hours') : html_entity_decode(clean($user_obj->profile->working_time)) }}}
                                                                @else
                                                                    @if (!empty($serviceavailabledata))
                                                                        @if (in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata))
                                                                            @if ($doctoravailabletodayend == 1)
                                                                                <span><img src="/uploads/resources/img/circle_halo.png"
                                                                                           style="width:9px; display: inline-block;"> Available Today</span>
                                                                            @else
                                                                                <span style="background-color:#EC293A;">Not Available Today</span>
                                                                            @endif
                                                                        @else
                                                                            <span style="background-color:#EC293A;">Not Available Today</span>
                                                                        @endif
                                                                    @else
                                                                        <span style="background-color:#EC293A;">Not Available Today</span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </figure>
                                                        <div class="dc-title">
                                                            <h3 class="ndoctor-name">
                                                                <a href="{{ route('userProfile', ['slug' => clean($user_obj->slug)]) }}">
                                                                    {{ !empty($user_obj->profile->gender_title) ? Helper::getDoctorArray(html_entity_decode(clean($user_obj->profile->gender_title))) : '' }}
                                                                    {{Helper::getUsername($user->id)}}
                                                                </a>
                                                                {{ Helper::verifyUser(clean($user_obj->id)) }} {{ Helper::verifyMedical(clean($user_obj->id)) }}
                                                            </h3>

                                                            <ul class="dc-docinfo">
                                                                <li class="dc-available">
                                                                    <strong><i class="far fa-calendar-alt"></i> Schedule</strong>
                                                                    <span>
                                      @if (!empty($serviceavailabledata) && !empty($day_list))
                                                                            @php $last_day = end($day_list); @endphp
                                                                            @foreach ($day_list as $key => $day)
                                                                                @if (!in_array($key, $serviceavailabledata))
                                                                                    <em class="dc-dayon">{{ html_entity_decode(clean($day['title'])) }}</em>
                                                                                    @if ($day['title'] != $last_day['title'])
                                                                                        , @endif
                                                                                @else
                                                                                    {{ html_entity_decode(clean($day['title'])) }}@if ($day['title'] != $last_day['title'])
                                                                                        , @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                    </span>
                                                                </li>
                                                                <li class="dc-available">
                                                                    <strong><i class="fas fa-globe"></i> LANGUAGES
                                                                        SPOKEN</strong>
                                                                    <span>{{Helper::getUserLanguage($user->id)}}</span>
                                                                </li>
                                                                <li class="dc-available">
                                                                    <!--  <strong><i class="fas fa-laptop-house"></i> Available Platforms </strong> -->
                                                                    <strong><i class="fas fa-laptop-house"></i> LOCATION</strong>
                                                                    <span>
						{{  html_entity_decode(clean($user_obj->country)) }}, {{  html_entity_decode(clean($user_obj->city)) }}, {{  html_entity_decode(clean($user_obj->zipcode)) }}
					</span>
                                                                <!--
                                    <span>
                                        @if ( $user_obj->zoomlink )
                                                                    <img src="/uploads/resources/img/zoom_logo.png" style="width:24px; display: inline-block;">
@endif
                                                                @if ( $user_obj->gotomeetinglink )
                                                                    <img src="/uploads/resources/img/goto_meeting_logo.png" style="width:24px; display: inline-block;">
@endif
                                                                        </span> -->
                                                                </li>
                                                                <li class="dc-available nsearch-specialty">
                                                                    <strong><i class="fas fa-briefcase-medical"></i>
                                                                        Specialty</strong>
                                                                    <div class="dc-tags">
                                                                        <ul>
                                                                            <li>
                                                                                <a>
                                                                                    @if($servicelistdata)
                                                                                        @isset($servicelistdata[0]['speciality_title'])
                                                                                            {{ $servicelistdata[0]['speciality_title'] }}
                                                                                        @endisset

                                                                                        @isset($servicelistdata[0]['service_price'])
                                                                                            @php
                                                                                                $servicepriceitem = str_replace("$" , "" , $servicelistdata[0]['service_price'])
                                                                                            @endphp
                                                                                            <span>${{ (float)$servicepriceitem * 1.2 }}</span>
                                                                                        @endisset
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                            <li><a class="nsearch-more"
                                                                                   href="{{ route('userProfile', ['slug' => clean($user_obj->slug)]) }}">More
                                                                                    <i class="fas fa-chevron-right"></i></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>

                                                                @php
                                                                    $exp = unserialize($userMeta->experiences);

                                                                    if ($exp) {
                                                                       $exp = $exp[0];
                                                                    }
                                                                @endphp

                                                                @if(isset($exp['company_title']))
                                                                    <li class="dc-available">
                                                                        <strong><i class="fas fa-user"></i>Experience</strong>
                                                                        <span>{{ isset($exp['job_title']) ? $exp['company_title'] : '' }}</span>
                                                                    </li>
                                                                @endif

                                                                @php
                                                                    $edu = unserialize($userMeta->educations);
                                                                    if ($edu) {
                                                                       $edu = $edu[0];
                                                                    }
                                                                @endphp


                                                                @if(isset($edu['degree_title']))
                                                                    <li class="dc-available">
                                                                        <strong><i class="fas fa-user-graduate"></i>Education </strong>
                                                                        <span> {{ isset($edu['degree_title']) ? $edu['degree_title'] : '' }}</span>
                                                                    </li>
                                                                @endif

{{--                                                                @php--}}
{{--                                                                    $award = unserialize($userMeta->awards);--}}

{{--                                                                    if ($award) {--}}

{{--                                                                       $award = array_values($award)[0];--}}
{{--                                                                    }--}}
{{--                                                                @endphp--}}

{{--                                                                @if(isset($award['title']))--}}
{{--                                                                    <li class="dc-available">--}}
{{--                                                                        <strong><i class="fas fa-certificate"></i>Awards</strong>--}}
{{--                                                                        <span>{{ isset($award['title']) ? $award['title'] : '-----' }}</span>--}}
{{--                                                                    </li>--}}
{{--                                                                @endif--}}


                                                                @php
                                                                    $medicalRegistrationNumber = unserialize($userMeta->verify_medical);
                                                                @endphp


                                                                @if(isset($medicalRegistrationNumber['registration_number']))
                                                                    <li class="dc-available">
                                                                        <strong><i class="fas fa-hashtag"></i>Registration
                                                                            Number</strong>
                                                                        <span>{{$medicalRegistrationNumber['registration_number']}}</span>
                                                                    </li>
                                                                @endif


                                                            </ul>

                                                        </div>

                                                    </div>
                                                    @php
                                                        $column = !empty($user_obj->id) && Helper::getRoleTypeByUserID($user_obj->id) == 'doctor' ? 'saved_doctors' : 'saved_hospitals';
                                                        $saved_user = Auth::check() && !empty(Auth::user()->profile->$column) ? unserialize(Auth::user()->profile->$column) : array();
                                                    @endphp
                                                    <div class="dc-doclocation dc-doclocationvtwo">

                                                        <div class="dc-btnarea">
                                                            @if($servicelistdata)
                                                                @if (!empty($serviceavailabledata))
                                                                    @if ( in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata) )
                                                                        @if( $alreadyappointmenthave == "0")
                                                                            @if (Auth::check())
                                                                                @if ($doctorstartendtime == 1)
                                                                                    <a class="dc-btn"
                                                                                       style="background: #1BC559; color: rgb(255, 255, 255); border: 2px solid #1BC559;"
                                                                                       href="{{{url('profile/'.clean($user_obj->slug).'/booknow')}}}"
                                                                                       v-b-modal.modal-sm
                                                                                       v-on:click="profiledialogsetting('1')">{{ trans('lang.book_now') }}</a>
                                                                                @else
                                                                                    <a href="javascript:void(0);"
                                                                                       class="dc-btn bookingnowevent"
                                                                                       style="background:#EC293A; border: 2px solid #EC293A;">Not
                                                                                        Available</a>
                                                                                @endif
                                                                            @else
                                                                                @if ($doctorstartendtime == 1)
                                                                                    <a class="dc-btn"
                                                                                       style="background: #1BC559; color: rgb(255, 255, 255); border: 2px solid #1BC559;"
                                                                                       href="javascript:void(0);"
                                                                                       v-on:click="showError('You need to be login as regular user to perform this action')">{{ trans('lang.book_now') }}</a>
                                                                                @else
                                                                                    <a href="javascript:void(0);"
                                                                                       class="dc-btn bookingnowevent"
                                                                                       style="background:#EC293A; border: 2px solid #EC293A;">Not
                                                                                        Available</a>
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            <a class="dc-btn bookingnowevent"
                                                                               style="background:#EC293A; border: 2px solid #EC293A;"
                                                                               href="javascript:void(0);">With
                                                                                Patient</a>
                                                                        @endif
                                                                    @else
                                                                        <a class="dc-btn bookingnowevent"
                                                                           style="background:#EC293A; border: 2px solid #EC293A;"
                                                                           href="javascript:void(0);">Not Available</a>
                                                                    @endif
                                                                @else
                                                                    <a class="dc-btn bookingnowevent"
                                                                       style="background:#EC293A; border: 2px solid #EC293A;"
                                                                       href="javascript:void(0);">Not Available</a>
                                                                @endif
                                                            @else
                                                                <a class="dc-btn bookingnowevent"
                                                                   style="background:#EC293A; border: 2px solid #EC293A;"
                                                                   href="javascript:void(0);">Not Available</a>
                                                            @endif

                                                            @if (Auth::check())
                                                                <a href="{{{url('profile/'.clean($user_obj->slug).'/schedule')}}}"
                                                                   class="dc-btn"
                                                                   style="display: block; background-color: var(--themecolor); color: #fff;"
                                                                   v-b-modal.modal-sm
                                                                   v-on:click="profiledialogsetting('0')">{{ trans('lang.view_more') }}</a>
                                                            @else
                                                                <a href="javascript:void(0);"
                                                                   v-on:click="showError('You need to be login as regular user to perform this action')"
                                                                   class="dc-btn"
                                                                   style="display: block; background-color: var(--themecolor); color: #fff;">{{ trans('lang.view_more') }}</a>
                                                            @endif

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ( method_exists($users,'links') )
                                            <div class="dc-pagination">
                                                {{ $users->links() }}
                                            </div>
                                    @endif
                                @else
                                    @include('errors.no-record')
                                @endif
                                <!-- End Foreash -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Search -->

            </div>

        </div>

    </div>
@endsection

@push('front_end_scripts')
    <script src="https://kit.fontawesome.com/e85d0a7610.js" crossorigin="anonymous"></script>
@endpush
