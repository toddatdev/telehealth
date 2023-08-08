@extends('front-end.master')
@section('title'){{ Helper::getUserName($user->id) }} @stop
@section('description', clean($user->profile->description))
@push('PackageStyle')
    <link href="{{ asset('css/antd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('userProfile', $user) !!}

    @php
        $userMeta = \App\UserMeta::where('user_id', $user->id)->first();

    @endphp


    <div class="nsearch-main nsearch-profile-page">

        <div class="dc-haslayout dc-main-section nuser-profile" id="user-profile">
            @if (Session::has('message'))
                <div class="flash_msg">
                    <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'"
                                    v-cloak></flash_messages>
                </div>
            @elseif (Session::has('error'))
                <div class="flash_msg">
                    <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'"
                                    v-cloak></flash_messages>
                </div>
            @endif
            <div class="dc-preloader-section" v-if="loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
            @if ($display_chat == true)
                @if (Auth::user())
                    @if ($user->id != Auth::user()->id && $role_type != 'hospital')
                        <chat
                                :trans_image_alt="'{{trans('lang.img')}}'"
                                :ph_new_msg="'{{ trans('lang.ph_new_msg') }}'"
                                :trans_placeholder="'{{ trans('lang.ph_type_msg') }}'"
                                :receiver_id="'{{$user->id}}'"
                                :receiver_profile_image="'{{{ asset(Helper::getImage('uploads/users/'.$user->id.'/', $user->profile->avatar, 'medium-', 'user.jpg')) }}}'"
                                :empty_error="'{{trans('lang.empty_fields_not_allowed')}}'">
                        </chat>
                    @endif
                @endif
            @endif

            <div class="nsearch-top-bar" style="height: 150px;">
                <div class="container">
                    <h2>Search Telehealth Plus</h2>
                    <div class="nsearch-breadcrumbs" style="display: none;">
                        <a href="#"><img src="/uploads/resources/img/line-home-icon.png" style="width: 14px;">
                            &nbsp;Home</a>
                        <span>&bull;</span>
                        <a href="#">Search</a>
                        <span>&bull;</span>
                        <a href="#">Profile</a>
                    </div>
                </div>
            </div>
            <div class="nuser-profile-main">
                <div class="container">
                    <div class="row" style="position: relative;">
                        <div class="nuser-top-controls">
                            <a href="/search-results" class="dc-replay dc-like"><i class="fa fa-reply"> <span>Search Results</span></i></a>
                            @if (in_array($user->id, $saved_doctors))
                                <a href="javascript:void(0);" class="dc-like dc-clicksave"
                                   id="removedoctor-{{ intVal(clean($user->id)) }}"
                                   @click.prevent="remove_wishlist('removedoctor-{{ intVal(clean($user->id)) }}', '{{ intVal(clean($user->id)) }}', 'saved_doctors', '')"
                                   v-cloak>
                                    <i class="fa fa-heart"><span>Mark as Favorite</span></i>
                                </a>
                            @else
                                <a href="javascript:void(0);" class="dc-like" id="doctor-{{ intVal(clean($user->id)) }}"
                                   @click.prevent="add_wishlist('doctor-{{ intVal(clean($user->id)) }}', '{{ intVal(clean($user->id)) }}', 'saved_doctors', '')"
                                   v-cloak>
                                    <i class="fa fa-heart"><span>Mark as Favorite</span></i>
                                </a>
                            @endif
                        </div>
                        @php
                            $serviceavailabledata = Helper::getDoctorsAvailableList($user->id, 15);
                            $alreadyappointmenthave = Helper::getDoctorsAvailabelStateNow($user->id);
            $doctorstartendtime = Helper::getDoctorStartEndTime($user->id);
            $doctoravailabletodayend = Helper::getDoctorAvailableTodayEnd($user->id);
                            $day_list = Helper::getAppointmentDays();
                        @endphp
                        <div class="dc-twocolumns dc-haslayout nuser-profile-white-bg">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                                <div class="dc-docsingle-header">
                                    <figure class="dc-docsingleimg">
                                        <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id.'/', $user->profile->avatar, 'medium-', 'user.jpg')) }}"
                                             alt="img description">

                                        <div class="n-available">
                                            @if (!empty($user->profile->working_time) && $type == 'hospital')
                                                {{{ $user->profile->working_time == '24_hours' ? trans('lang.24_hours') : html_entity_decode(clean($user->profile->working_time)) }}}
                                            @else
                                                @if (!empty($serviceavailabledata))
                                                    @if ( in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata) )
                                                        <?php if ($doctorstartendtime == "1") {  ?>
                                                        <span><img src="/uploads/resources/img/circle_halo.png"
                                                                   style="width:9px; display: inline-block;"> Available Today</span>
                                                        <?php } else { ?>
                                                        <span style="background-color:#EC293A;">Not Available Today</span>
                                                        <?php } ?>
                                                    @else
                                                        <span style="background-color:#EC293A;">Not Available Today</span>
                                                    @endif
                                                @else
                                                    <span style="background-color:#EC293A;">Not Available Today</span>
                                                @endif
                                            @endif
                                        </div>
                                    </figure>
                                    <div class="dc-docsingle-content">
                                        <div class="dc-title">
                                            <h2>
                                                <a href="javascript:void(0);">
                                                    {{ !empty($gender_title) ? Helper::getDoctorArray(clean($gender_title)) : '' }} {{ Helper::getUserName($user->id) }}
                                                </a>
                                                {{ Helper::verifyUser(intVal(clean($user->id)), true) }}
                                                {{ Helper::verifyMedical(intVal(clean($user->id)), true) }}
                                            </h2>
                                            <ul class="dc-docinfo">

                                                <li>
                                                    <span class="dc-stars"><span style="width: 0%;"></span></span><em>
                                                        ( {{ clean($user->feedbacks->count()) }} {{ trans('lang.feedbacks') }}
                                                        )</em>
                                                </li>
                                            </ul>
                                        </div>


                                        <div class="dc-btnarea">
                                            <?php $sessionparametercheck = session()->get('sessionparametercheck'); ?>
                                            <input type="hidden" id="sessionparametercheck" name="sessionparametercheck"
                                                   value="<?php  echo $sessionparametercheck; ?>">
                                            <?php
                                            if (!empty($serviceavailabledata)) {
                                            if (in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata)) {
                                            if ($alreadyappointmenthave == "0") {
                                            if ($doctorstartendtime == "1") {  ?>
                                            {{--                            v-b-modal.modal-sm v-on:click="showModal('appointment_modal', '{{ (Auth::check() && Helper::getRoleTypeByUserID(Auth::user()->id) == 'regular' ? 'authorise' : 'not_authorise' ) }}', '{{count($teams)}}', '1' )"--}}
                                            <a style="background: #1BC559; color: rgb(255, 255, 255); border: 2px solid #1BC559;"
                                               href="javascript:void(0);" class="dc-btn bookingnowevent"
                                               onclick="window.location.reload()">{{ trans('lang.book_now') }}</a>
                                            <?php } else { ?>
                                            <a href="javascript:void(0);" class="dc-btn bookingnowevent"
                                               style="background: red; border: 1px solid red;">Not Available</a>
                                            <?php } } else { ?>
                                            <a style="background: red; border: 1px solid red; color: #fff;"
                                               href="javascript:void(0);" class="dc-btn">With Patient</a>
                                            <?php } } else { ?>
                                            <a href="javascript:void(0);" class="dc-btn bookingnowevent"
                                               style="background: red; border: 1px solid red;">Not Available</a>
                                            <?php } } else { ?>
                                            <a href="javascript:void(0);" class="dc-btn bookingnowevent"
                                               style="background: red; border: 1px solid red;">Not Available</a>
                                            <?php } ?>

                                            <a href="javascript:void(0);" style="color: white !important;"
                                               class="dc-btn schedulebtnevent" v-b-modal.modal-sm
                                               v-on:click="showModal('appointment_modal', '{{ (Auth::check() && Helper::getRoleTypeByUserID(Auth::user()->id) == 'regular' ? 'authorise' : 'not_authorise' ) }}', '{{count($teams)}}', '0' )">
                                                Schedule</a>
                                            <a style="background: #F2F2F2; border: 2px solid #F2F2F2;"
                                               href="javascript:void(0);" class="dc-btn feedback-btn" v-b-modal.modal-md
                                               v-on:click="showModal('feedback_modal', '{{ (Auth::check() && Helper::getRoleTypeByUserID(Auth::user()->id) == 'regular' ? 'authorise' : 'not_authorise' ) }}')">
                                                {{ trans('lang.add_feedback') }}</a>
                                        </div>

                                        <div class="dc-shareprofile">
                                            <ul class="dc-simplesocialicons dc-socialiconsborder">
                                                <li class="dc-sharecontent"><span>Share Profile:</span></li>
                                                <li class="dc-facebook">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftelehealthplus.com.au%2Fprofile%2Fleon-kadon"
                                                       class="social-share">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li class="dc-twitter">
                                                    <a href="https://twitter.com/intent/tweet?url=http%3A%2F%2Ftelehealthplus.com.au%2Fprofile%2Fleon-kadon"
                                                       class="social-share">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="dc-linkedin">
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Ftelehealthplus.com.au%2Fprofile%2Fleon-kadon"
                                                       class="social-share">
                                                        <i class="fab fa-linkedin-in"></i></a>
                                                </li>
                                                <li class="dc-googleplus">
                                                    <a href="https://plus.google.com/share?url=http%3A%2F%2Ftelehealthplus.com.au%2Fprofile%2Fleon-kadon"
                                                       class="social-share"><i
                                                                class="fab fa-google-plus-g"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="dc-docsingle-holder nuser-profile-info">
                                    <div class="tab-content dc-haslayout">

                                        <div class="dc-contentdoctab dc-userdetails-holder tab-pane active"
                                             id="userdetails">
                                            <div class="row">

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="dc-services-holder dc-aboutinfo" style="display: none;">
                                                        <div class="dc-infotitle">
                                                            <h3 class="profilerightsidetitle"><i
                                                                        class="fas fa-laptop-house"></i> Available
                                                                Platform
                                                            </h3>
                                                        </div>
                                                        <div class="availablevideoicons">
                                                            @if ( $user->zoomlink )
                                                                <img src="/uploads/resources/img/zoom_logo.png"
                                                                     style="width:32px; display: inline-block;">
                                                            @endif
                                                            @if ( $user->gotomeetinglink )
                                                                <img src="/uploads/resources/img/goto_meeting_logo.png"
                                                                     style="width:32px; display: inline-block;">
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="dc-services-holder dc-aboutinfo">
                                                        <div class="dc-infotitle">
                                                            <h3 class="profilerightsidetitle"><i
                                                                        class="far fa-calendar-alt"></i> Schedule</h3>
                                                            <p style="margin-bottom: 0px;">
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
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dc-services-holder dc-aboutinfo">
                                                        <div class="dc-infotitle">
                                                            <h3 class="profilerightsidetitle"><i
                                                                        class="fas fa-map-marker-alt"></i> Location</h3>
                                                            <p style="margin-bottom: 0px;">{{  html_entity_decode(clean($user->country)) }}
                                                                , {{  html_entity_decode(clean($user->city)) }}
                                                                , {{  html_entity_decode(clean($user->zipcode)) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="dc-services-holder dc-aboutinfo">
                                                        <div class="dc-infotitle">
                                                            <h3 class="profilerightsidetitle"><i
                                                                        class="fas fa-globe"></i> LANGUAGES SPOKEN</h3>
                                                            <p style="margin-bottom: 0px;">{{  html_entity_decode(clean($user->languagelist)) }} </p>
                                                        </div>
                                                    </div>

                                                    <div class="dc-services-holder dc-aboutinfo">
                                                        <div class="dc-infotitle">
                                                            <h3 class="profilerightsidetitle"><i
                                                                        class="fas fa-briefcase-medical"></i> Specialty
                                                            </h3>
                                                        </div>


{{--                                                        @php--}}
{{--                                                            $exp = unserialize($userMeta->experiences);--}}
{{--                                                            if ($exp) {--}}
{{--                                                               $exp = $exp[0];--}}
{{--                                                            }--}}
{{--                                                        @endphp--}}

{{--                                                        @php--}}
{{--                                                            $edu = unserialize($userMeta->educations);--}}
{{--                                                            if ($edu) {--}}
{{--                                                               $edu = $edu[0];--}}
{{--                                                            }--}}
{{--                                                        @endphp--}}

{{--                                                        @if(isset($exp['job_title']))--}}
{{--                                                        <div class="dc-services-holder dc-aboutinfo">--}}
{{--                                                            <div class="dc-infotitle">--}}
{{--                                                                <h3 class="profilerightsidetitle">--}}
{{--                                                                    <i class="fas fa-user-graduate"></i>Experience & Education--}}
{{--                                                                </h3>--}}
{{--                                                                <p style="margin-bottom: 0px;">{{ isset($exp['job_title']) ? $exp['job_title'] : '----' }} : {{ isset($edu['degree_title']) ? $edu['degree_title'] : '----' }} </p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        @endif--}}


{{--                                                        @php--}}
{{--                                                            $award = unserialize($userMeta->awards);--}}
{{--                                                            if ($award) {--}}

{{--                                                               $award = array_values($award)[0];--}}
{{--                                                            }--}}
{{--                                                        @endphp--}}


{{--                                                        @if(isset($award['title']))--}}
{{--                                                        <div class="dc-services-holder dc-aboutinfo">--}}
{{--                                                            <div class="dc-infotitle">--}}
{{--                                                                <h3 class="profilerightsidetitle">--}}
{{--                                                                    <i class="fas fa-certificate"></i>Awards--}}
{{--                                                                </h3>--}}
{{--                                                                <p style="margin-bottom: 0px;">{{ isset($award['title']) ? $award['title'] : '-----' }} </p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        @endif--}}

                                                        @php
                                                            $medicalRegistrationNumber = unserialize($userMeta->verify_medical);
                                                        @endphp

                                                        @if(isset($medicalRegistrationNumber['registration_number']))
                                                            <div class="dc-services-holder dc-aboutinfo">
                                                                <div class="dc-infotitle">
                                                                    <h3 class="profilerightsidetitle">
                                                                        <i class="fas fa-hashtag"></i>Registration Number
                                                                    </h3>
                                                                    <p style="margin-bottom: 0px;">{{$medicalRegistrationNumber['registration_number']}}</p>
                                                                </div>
                                                            </div>
                                                        @endif


{{--                                                        @php--}}
{{--                                                            $file = unserialize($userMeta->downloads);--}}

{{--                                                        @endphp--}}
{{--                                                        @if(isset($file[0]))--}}

{{--                                                        <div class="dc-services-holder dc-aboutinfo">--}}
{{--                                                            <div class="dc-infotitle">--}}
{{--                                                                <h3 class="profilerightsidetitle">--}}
{{--                                                                    <i class="fas fa-file"></i>Download--}}
{{--                                                                </h3>--}}
{{--                                                                <p style="margin-bottom: 0px;">--}}
{{--                                                                    <a class="" href="{{route('getfile', ['users', $user->id, $file[0] ?? '']) }}"><i class="fas fa-file-pdf"></i> {{ isset($award['title']) ? 'Download' : '' }} </a>--}}

{{--                                                                </p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        @endif--}}

                                                        <div id="dc-accordion" class="dc-accordion" role="tablist"
                                                             aria-multiselectable="true">
                                                            @foreach ($specialities as $key => $data)
                                                                @php
                                                                    $speciality = App\Speciality::find($data['speciality_id']);
                                                                        $servicepriceitem = intval($data['services'][0]['price']) * 1.2;
                                                                @endphp

                                                                @if (!empty($speciality))
                                                                    <div class="nuser-service-item">
                                                                        <span class="servicetitle"
                                                                              style="vertical-align: text-top;">{{ html_entity_decode(clean($speciality->title)) }}</span>
                                                                        <span class="priceimtes"
                                                                              style="margin-left: 20px; vertical-align: text-top;">{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{ clean($servicepriceitem) }}</span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 nuser-info-col">
                                                    <div class="dc-aboutdoc dc-aboutinfo">
                                                        <div class="dc-infotitle">
                                                            <h2>
                                                                {{ trans('lang.about') }}
                                                                “{{ !empty($gender_title) ? Helper::getDoctorArray(clean($gender_title)) : '' }} {{ Helper::getUserName($user->id) }}
                                                                ”
                                                            </h2>
                                                        </div>
                                                        <div class="dc-description">
                                                            <p>{{  html_entity_decode(clean($user->profile->description)) }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="experience-and-education my-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="experience">
                                                                    @php
                                                                        $experiences = unserialize($userMeta->experiences);
                                                                    @endphp
                                                                    @if($experiences)
                                                                        @foreach ($experiences as $exp)

                                                                            <h6 class="font-weight-normal"
                                                                                style="font-size: 16px"><i
                                                                                        class="fas fa-chalkboard-teacher mr-2"></i>Experience
                                                                            </h6>
                                                                            <ul class="p-2 list-unstyled">
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">Company
                                                                                    title
                                                                                    <span class="float-right  font-weight-normal">{{ isset($exp['company_title']) ? $exp['company_title'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">Start Date
                                                                                    <span class="float-right  font-weight-normal">{{ isset($exp['start_date']) ? $exp['start_date'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">End Date
                                                                                    <span class="float-right  font-weight-normal">{{ isset($exp['end_date']) ? $exp['end_date'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">Job title
                                                                                    <span class="float-right font-weight-normal ">{{ isset($exp['job_title']) ? $exp['job_title'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">Job
                                                                                    Description:
                                                                                </li>
                                                                                <li class="list-unstyled font-weight-normal">{{ isset($exp['job_desc']) ? $exp['job_desc'] : '' }}</li>
                                                                            </ul>
                                                                            <hr>
                                                                        @endforeach
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="education">
                                                                    @php
                                                                        $educations = unserialize($userMeta->educations);
                                                                    @endphp
                                                                    @if($educations)
                                                                        @foreach ($educations as $edu)
                                                                            <h6 class="font-weight-normal"
                                                                                style="font-size: 16px"><i
                                                                                        class="fas fa-user-graduate mr-2"></i>Education
                                                                            </h6>
                                                                            <ul class="p-2 list-unstyled">
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">Degree
                                                                                    title
                                                                                    <span class="float-right font-weight-normal ">{{ isset($edu['degree_title']) ? $edu['degree_title'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">Start Date
                                                                                    <span class="float-right font-weight-normal ">{{ isset($edu['start_date']) ? $edu['start_date'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">End Date
                                                                                    <span
                                                                                            class="float-right font-weight-normal">{{ isset($edu['end_date']) ? $edu['end_date'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500"> title
                                                                                    <span
                                                                                            class="float-right font-weight-normal ">{{ isset($edu['job_title']) ? $edu['job_title'] : '' }}</span>
                                                                                </li>
                                                                                <li class="list-unstyled"
                                                                                    style="font-weight: 500">
                                                                                    Description:
                                                                                </li>
                                                                                <li class="list-unstyled font-weight-normal">{{ isset($edu['job_desc']) ? $edu['job_desc'] : '' }}</li>
                                                                            </ul>
                                                                            <hr>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>

                                                    <div class="dc-feedback">
                                                        <div class="dc-searchresult-head">
                                                            <div class="dc-infotitle">
                                                                <h2>Feedback and Ratings</h2>
                                                            </div>
                                                        </div>
                                                        <div class="dc-consultation-content dc-feedback-content">
                                                            @if (!empty($user->feedbacks) && $user->feedbacks->count() > 0 )
                                                                @foreach ($user->feedbacks as $feedback)
                                                                    @if ($feedback->keep_anonymous == 'on')
                                                                        @php $patient = App\User::findOrFail($feedback->patient_id); @endphp
                                                                        <div class="dc-consultation-details">
                                                                            <figure class="dc-consultation-img">
                                                                                <img src="{{ asset(Helper::getImage('uploads/users/'.$patient->id.'/', $patient->profile->avatar, 'small-', 'user-logo-def.jpg')) }}"
                                                                                     alt="{{ trans('lang.img_desc') }}">
                                                                            </figure>
                                                                            <div class="dc-consultation-title">
                                                                                <h5>
                                                                                    <a href="javascript:void(0);"><em>{{ Helper::getUserName($feedback->patient_id) }} {{ Helper::verifyUser(clean($feedback->patient_id)) }}</em></a>
                                                                                </h5>
                                                                                <span>{{ \Carbon\Carbon::parse($feedback->created_at)->format('M d, Y') }}</span>
                                                                            </div>
                                                                            <div class="dc-description">
                                                                                <p>{{  html_entity_decode(clean($feedback->comment)) }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                    <!-- <figure class="dc-consultation-img">
                                                                                    <img src="{{ asset(Helper::getImage('', '', '', 'user-logo-def.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                                                </figure>
                                                                                <div class="dc-consultation-title">
                                                                                    <h5><a href="javascript:void(0);"><em>{{ trans('lang.anonymous') }}</em></h5>
                                                                                    <span>{{ \Carbon\Carbon::parse($feedback->created_at)->format('M d, Y') }}</span>
                                                                                </div> -->
                                                                    @endif
                                                                @endforeach
                                                                @if ( method_exists($user->feedbacks,'links') )
                                                                    {{ $user->feedbacks->links('pagination.custom') }}
                                                                @endif
                                                            @else
                                                                @include('errors.no-record')
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--  FeedBack Modal  --}}
            <b-modal ref="feedback_modal" class="dc-feedbackpopup" id="la-addfeedbackpopup" size="md" hide-footer
                     title="{{ trans('lang.add_feedback') }}" no-close-on-backdrop>
                <div class="dc-appointmentpopup">
                    <div class="dc-modalcontent modal-content">
                        <div class="modal-body">
                            {!! Form::open(['class' => 'dc-formtheme dc-formfeedback', 'id' => 'submit-feedback', '@submit.prevent' => 'submitFeedback("'.$user->id.'")']) !!}
                            <div class="dc-popupsubtitle dc-subtitlewithbtn">
                                <h3>{{ trans('lang.i_recomend') }}</h3>
                                <div class="dc-btnarea dc-tabbtns">
                                    <div class="dc-radio">
                                        {!! Form::radio('votes', 1, 1, ['id' => 'yes', 'class' => 'dc-btn']) !!}
                                        {!! Html::decode(Form::label('yes', '<i class="ti-thumb-up"></i> Yes', [])) !!}
                                    </div>
                                    <div class="dc-radio">
                                        {!! Form::radio('votes', 0, 0, ['id' => 'no', 'class' => 'dc-btn']) !!}
                                        {!! Html::decode(Form::label('no', '<i class="ti-thumb-down"></i> No', [])) !!}
                                    </div>
                                </div>
                            </div>
                            <fieldset class="dc-improvedinfo">
                                <div class="dc-popupsubtitle" style="display: none;">
                                    <h3>{{ trans('lang.long_waite') }}</h3></div>
                                <div id="dc-productrangeslider" class="dc-productrangeslider dc-themerangeslider"
                                     style="display: none;">
                                    <ul class="dc-timerange">
                                        @foreach (Helper::getWaitingTime() as $key => $value)
                                            <li id="time"><span>{{html_entity_decode(clean($value))}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="dc-popupsubtitle"><h3>{{ trans('lang.rate_doc') }}</h3></div>
                                @if(!empty($feedback_questions))
                                    @foreach ($feedback_questions as $key => $option)
                                        <div class="form-group dc-rating-holder">
                                            <div class="dc-ratingtitle">
                                                <h3><span>{{ html_entity_decode(clean($option->title)) }}</h3>
                                            </div>
                                            <div class="dc-ratingarea">
                                                <div class="dc-jrate">
                                                    <vue-stars
                                                            :name="'rating[{{ $key }}][rate]'"
                                                            :active-color="'#fecb02'"
                                                            :inactive-color="'#999999'"
                                                            :shadow-color="'#ffff00'"
                                                            :hover-color="'#dddd00'"
                                                            :max="5"
                                                            :value="0"
                                                            :readonly="false"
                                                            :char="'★'"
                                                            id="rating-{{ $key }}"
                                                    />
                                                    <div class="counter wt-pointscounter"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="rating[{{ $key }}][reason]"
                                                   value="{{{ clean($option->id) }}}">
                                            <span class="dc-rating-content"></span>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <textarea class="form-control" name="comments"
                                              placeholder="{{ trans('lang.share_exp') }}"></textarea>
                                </div>
                            </fieldset>
                            <fieldset class="dc-formsubmit">
                                <div class="dc-btnarea">
                                    <span class="dc-checkbox">
                                        <input id="feedbackpublicly" type="checkbox" name="feedbackpublicly">
                                        <label for="feedbackpublicly"><span>{{ trans('lang.keep_anonymous') }}</span></label>
                                    </span>
                                    {!! Form::submit(trans('lang.submit_now'), ['class' => 'dc-btn']) !!}
                                </div>
                            </fieldset>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </b-modal>
            {{--  Appointment Modal  --}}
            @auth
                <b-modal ref="appointment_modal" v-model="AppointmentmodalShow" size="lg" class="dc-feedbackpopup"
                         id="dc-feedbackpopup" hide-footer title="{{ trans('lang.book_appointment') }}"
                         no-close-on-backdrop>
                    <div class="dc-appointmentpopup" id="appointmodalheaderitem">
                        <div class="dc-modalcontent modal-content">
                            <section id="sec1" class="sec1">
                                {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_appointment_form', '@submit.prevent'=>'checkAppointmentStep1()']) !!}
                                <div id="immediatebookstatecheck" class="dc-visitingdoctor" v-if="step === 1" v-cloak>
                                    <ul class="dc-joinsteps">
                                        <li class="dc-active"><a href="javascript:void(0);">{{ trans('lang.01') }}</a>
                                        </li>
                                        <li><a href="javascript:void(0);">{{ trans('lang.02') }}</a></li>
                                    <!-- <li><a href="javascript:void(0);">{{ trans('lang.03') }}</a></li>
                                    <li><a href="javascript:void(0);">{{ trans('lang.04') }}</a></li> -->
                                    </ul>

                                    <book-appointment-dialog
                                            :hospitals="'{{ json_encode($doctor_hospitals) }}'"
                                            :user_id="{{ $user->id }}"
                                            :currency="'{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}'"
                                    >
                                    </book-appointment-dialog>
                                    <div class="modal-footer dc-modal-footer">
                                        {!! Form::submit(trans('lang.continue'), ['class' => 'btn dc-btn btn-primary']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                                <div class="dc-visitingdoctor dc-popup-doc dc-popup-step2" v-if="step === 2" v-cloak>
                                    <ul class="dc-joinsteps">
                                        <li class="dc-done-next"><a href="javascript:void(0);"><i
                                                        class="fa fa-check"></i></a></li>
                                        <li class="dc-active"><a href="javascript:void(0);">{{ trans('lang.02') }}</a>
                                        </li>
                                    <!--  <li><a href="javascript:void(0);">{{ trans('lang.03') }}</a></li>
                                    <li><a href="javascript:void(0);">{{ trans('lang.04') }}</a></li> -->
                                    </ul>
                                    <div class="dc-visit">
                                        <span>{{ trans('lang.verify_you') }}</span>
                                    </div>
                                    {!! Form::open() !!}
                                    <div class="form-row dc-popup-row">
                                        <div class="form-group col-6">
                                            <input type="password" id="appointment_password" class="form-control"
                                                   placeholder="{{ trans('lang.pass') }}"
                                                   v-model="appointment.password">
                                        </div>
                                        <div class="form-group col-6">
                                            <input type="password" id="appointment_retypassword" class="form-control"
                                                   placeholder="{{ trans('lang.ph_retry_pass') }}"
                                                   v-model="appointment.retry_password">
                                        </div>
                                        <div class="form-group col-12"><a style="color: #3fabf3; cursor: default;"><i
                                                        class="fab fa-paypal" style="font-size: 20px;"></i> <span><em>Pay Amount Via</em> Paypal Payment Gateway</span></a>
                                        </div>
                                        <div class="row" id="selectedconferenceitemoption">
                                            <input type="hidden" id="videoconferenceseting" name="videoconferenceseting"
                                                   value="zoom">
                                            <div style="display: none;">
                                                @if ( $user->zoomlink )
                                                    <div class="form-group col-6" style="text-align: center;">
                                                        <img src="/uploads/settings/general/zoomlogo.png"
                                                             class="selected" style="width: 150px; cursor: pointer;"
                                                             id="zoomimgid"
                                                             v-on:click="selectconferenceplatform('zoom')">
                                                    </div>
                                                @endif
                                                @if ( $user->gotomeetinglink )
                                                    <div class="form-group col-6" style="text-align: center;">
                                                        <img src="/uploads/settings/general/gotomeetinglogo.png"
                                                             style="width: 150px; cursor: pointer;"
                                                             id="gotomeetingimgid"
                                                             v-on:click="selectconferenceplatform('gotomeeting')">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer dc-modal-footer">
                                        <a href="javascript:void(0);"
                                           v-on:click="checkAppointmentStep2('{{Auth::user()->id}}', '{{$user->id}}')"
                                           class="btn dc-btn btn-primary">{{ trans('lang.continue') }}</a>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            <!-- <div class="dc-visitingdoctor dc-popup-doc dc-popup-step3" v-if="step === 3" v-cloak>
                                <ul class="dc-joinsteps">
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="dc-active"><a href="javascript:void(0);">{{ trans('lang.03') }}</a></li>
                                    <li><a href="javascript:void(0);">{{ trans('lang.04') }}</a></li>
                                </ul>
                                <h5>{{ trans('lang.enter_auth_code') }}</h5>
                                <p>{{ trans('lang.verify_code_sent') }}<a href="javascript:void(0)"> {{ Auth::user()->email }}</a></p>
                                <input type="text" placeholder="Authentication Code Here" v-model="appointment.code">
                                <div class="modal-footer dc-modal-footer">
                                    <a href="javascript:void(0);" v-on:click="checkAppointmentStep3('{{$user->id}}')" class="btn dc-btn btn-primary">{{ trans('lang.continue') }}</a>
                                </div>
                            </div>
                            <div class="dc-visitingdoctor dc-popup-doc dc-popup-step4" v-if="step === 3" v-cloak>
                                <ul class="dc-joinsteps">
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                </ul>
                                <div class="dc-modal-body4-title">
                                    <h6>{{ trans('lang.congrats') }}</h6>
                                    @if (!empty($appointment_confirm))
                                <h4>{{$appointment_confirm}}</h4>
                                    @endif
                                    </div>
                                    <div class="dc-modal-body4-description">
                                        <p>{{ $appointment_detail_text }}</p>
                                </div>
                                <div class="modal-footer dc-modal-footer">
                                    <a href="javascript:void(0);" v-on:click="finalStep({{$online_appointment}})" class="btn dc-btn btn-primary">{{ $appointment_btn_text }}</a>
                                </div>
                            </div> -->
                            </section>
                        </div>
                    </div>
                </b-modal>
            @endauth
        </div>

    </div>
@endsection
@push('front_end_scripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/prettyPhoto.js') }}"></script>
    <script src="https://kit.fontawesome.com/e85d0a7610.js" crossorigin="anonymous"></script>
    <script>
        jQuery("a[data-rel]").each(function () {
            jQuery(this).attr("rel", jQuery(this).data("rel"));
        });
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'dark_square',
            slideshow: 3000,
            default_width: 800,
            default_height: 500,
            allowfullscreen: true,
            autoplay_slideshow: false,
            social_tools: false,
            iframe_markup: "<iframe src='{path}' width='{width}' height='{height}' frameborder='no' allowfullscreen='true'></iframe>",
            deeplinking: false
        })
        $(".feedback-btn").on('click', function (event) {
            $(function () {
                jQuery("#dc-productrangeslider").slider({
                    range: "max",
                    min: 1,
                    max: 4,
                    value: 1,
                    slide: function (event, ui) {
                        $("#time").val(ui.value);
                    }
                });
                jQuery("#time").val(jQuery("#dc-productrangeslider").slider("value"));
            });
        });

        $(".bookingnowevent").on('click', function (event) {
            if (jQuery('#immediatebookstatecheck').hasClass('booknowoption')) {
            } else {
                $("#immediatebookstatecheck").addClass("booknowoption");
                var date = new Date();
                var australiatime = date.toLocaleTimeString('en-US', {timeZone: "Australia/Sydney"}, {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
                australiatime = australiatime.replace("AM", "am");
                australiatime = australiatime.replace("PM", "pm");
                var elementspecial = australiatime.split(" ")[1];

                var lastCommaIndex = australiatime.lastIndexOf(":");
                var hourmintime = australiatime.substr(0, lastCommaIndex);
                var totalresult = hourmintime + " " + elementspecial;

                //$("#immediatebookstatecheck").append( '<input type="radio" id="availableslot-0" name="appointment[time]" value="' + totalresult + '" checked style="display: none;">' );
                //$("#appointmodalheaderitem").append( '<input id="booknowoptioncheck" style="display: none;" name="booknowoptioncheck" value="now">' );
            }
        });
        $(".schedulebtnevent").on('click', function (event) {
            if (jQuery('#immediatebookstatecheck').hasClass('booknowoption')) {
                $("#immediatebookstatecheck").removeClass("booknowoption");
            }
            //$("#appointmodalheaderitem").append( '<input id="booknowoptioncheck" value="later" style="display: none;" name="booknowoptioncheck">' );
        });

        jQuery(document).ready(function () {
            /* THEME ACCORDION */
            function themeAccordion() {
                jQuery('.dc-panelcontent').hide();
                jQuery('.dc-accordion .dc-paneltitle:first').addClass('active').next().slideDown('slow');
                jQuery('.dc-accordion .dc-paneltitle').on('click', function () {
                    if (jQuery(this).next().is(':hidden')) {
                        jQuery('.dc-accordion .dc-paneltitle').removeClass('active').next().slideUp('slow');
                        jQuery(this).toggleClass('active').next().slideDown('slow');
                    }
                });
            }

            themeAccordion();

            function childAccordion() {
                jQuery('.dc-subpanelcontent').hide();
                jQuery('.dc-childaccordion .dc-subpaneltitle:first').addClass('active').next().slideDown('slow');
                jQuery('.dc-childaccordion .dc-subpaneltitle').on('click', function () {
                    if (jQuery(this).next().is(':hidden')) {
                        jQuery('.dc-childaccordion .dc-subpaneltitle').removeClass('active').next().slideUp('slow');
                        jQuery(this).toggleClass('active').next().slideDown('slow');
                    }
                });
            }

            childAccordion();

            var sessionparametercheck = '<?php echo $sessionparametercheck; ?>';
            if (sessionparametercheck == "booknow") {
                if (jQuery('#immediatebookstatecheck').hasClass('booknowoption')) {
                } else {
                    $("#immediatebookstatecheck").addClass("booknowoption");

                    var date = new Date();
                    var australiatime = date.toLocaleTimeString('en-US', {timeZone: "Australia/Sydney"}, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    });
                    australiatime = australiatime.replace("AM", "am");
                    australiatime = australiatime.replace("PM", "pm");
                    var elementspecial = australiatime.split(" ")[1];

                    var timevalue = australiatime.split(" ")[0];
                    var houroptvalue = timevalue.split(":")[0];
                    var mintimeoptvalue = timevalue.split(":")[1];
                    if (houroptvalue < 10)
                        hourtimevalue = "0" + houroptvalue;
                    else
                        hourtimevalue = houroptvalue;

                    // var lastCommaIndex = australiatime.lastIndexOf(":");
                    // var hourmintime = australiatime.substr(0,lastCommaIndex);
                    var totalresult = hourtimevalue + ":" + mintimeoptvalue + " " + elementspecial;

                    $("#immediatebookstatecheck").append('<input type="radio" id="availableslot-0" name="appointment[time]" value="' + totalresult + '" checked style="display: none;">');
                    $("#appointmodalheaderitem").append('<input id="booknowoptioncheck" style="display: none;" name="booknowoptioncheck" value="now">');

                }
            } else {
                $("#appointmodalheaderitem").append('<input id="booknowoptioncheck" style="display: none;" name="booknowoptioncheck" value="later">');
            }

        });
    </script>
@endpush
	

