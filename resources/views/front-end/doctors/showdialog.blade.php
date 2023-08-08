@extends('front-end.master')
@section('title'){{ Helper::getUserName($user->id) }} @stop
@section('description', clean($user->profile->description))
@push('PackageStyle')
    <link href="{{ asset('css/antd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('userProfile', $user) !!}
    <div class="dc-haslayout dc-main-section" id="user-profile">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
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
        @php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'; @endphp
        @if ($display_sidebar == 'true')
            @php 
                $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12';
            @endphp
        @endif
        <div class="container">
            <div class="row">
                <div class="dc-twocolumns dc-haslayout">
                    <div class="{{ $columns }} float-left">
                        <div class="dc-docsingle-header">
                            <figure class="dc-docsingleimg">
                                <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id.'/', $user->profile->avatar, 'medium-', 'user.jpg')) }}" alt="img description">
                                @if ($featured == 'true')
                                    <figcaption>
                                        <span class="dc-featuredtag"><i class="fa fa-bolt"></i></span>
                                    </figcaption>
                                @endif
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
                                        <li><em>{{ html_entity_decode(clean($user->profile->sub_heading)) ?? '' }}</em></li>
                                        <li>
                                            <span class="dc-stars"><span style="width: {{ $stars }}%;"></span></span><em>{{ clean($user->feedbacks->count()) }} {{ trans('lang.feedbacks') }}</em>
					</li>
				    </ul>
					<a href="/search-results" class="dc-replay"><i class="fa fa-reply"></i></a>
                                    @if (in_array($user->id, $saved_doctors))
                                        <a href="javascript:void(0);" class="dc-like dc-clicksave" id="removedoctor-{{ intVal(clean($user->id)) }}" @click.prevent="remove_wishlist('removedoctor-{{ intVal(clean($user->id)) }}', '{{ intVal(clean($user->id)) }}', 'saved_doctors', '')" v-cloak>
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="dc-like" id="doctor-{{ intVal(clean($user->id)) }}" @click.prevent="add_wishlist('doctor-{{ intVal(clean($user->id)) }}', '{{ intVal(clean($user->id)) }}', 'saved_doctors', '')" v-cloak>
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="dc-description">
                                    <p>{{  html_entity_decode(clean($user->profile->description)) ?? '' }}</p>
				</div>

				<div class="dc-btnarea">
					<?php $sessionparametercheck = session()->get('sessionparametercheck'); ?>
                                    <input type="hidden" id="sessionparametercheck" name="sessionparametercheck" value="<?php  echo $sessionparametercheck; ?>">
				    <a href="javascript:void(0);" class="dc-btn feedback-btn" v-b-modal.modal-md v-on:click="showModal('feedback_modal', '{{ (Auth::check() && Helper::getRoleTypeByUserID(Auth::user()->id) == 'regular' ? 'authorise' : 'not_authorise' ) }}')">{{ trans('lang.add_feedback') }}</a>
				<?php // if( $doctor_immediatestatenow['immediate_bookings'] == "1") { 
				$alreadyappointmenthave = Helper::getDoctorsAvailabelStateNow($user->id);
				$serviceavailabledata = Helper::getDoctorsAvailableList($user->id, 15);
				if (in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata)) { 
				if ($alreadyappointmenthave == "0") {  ?>
				    <a href="javascript:void(0);" class="dc-btn bookingnowevent" v-b-modal.modal-sm v-on:click="showModal('appointment_modal', '{{ (Auth::check() && Helper::getRoleTypeByUserID(Auth::user()->id) == 'regular' ? 'authorise' : 'not_authorise' ) }}', '{{count($teams)}}', '1' )">{{ trans('lang.book_now') }}</a>
				<?php } else { ?>
                                    <a style="background: red; border: 1px solid red; color: #fff;" href="javascript:void(0);" class="dc-btn">Unavailable</a>
				<?php } } else { ?>
					<a href="javascript:void(0);" class="dc-btn bookingnowevent" style="background: red; border: 1px solid red;">Not Available</a>				
				<?php }  // } ?>
				<a href="javascript:void(0);" class="dc-btn schedulebtnevent" v-b-modal.modal-sm v-on:click="showModal('appointment_modal', '{{ (Auth::check() && Helper::getRoleTypeByUserID(Auth::user()->id) == 'regular' ? 'authorise' : 'not_authorise' ) }}', '{{count($teams)}}', '0' )">Schedule</a>
                                </div>
                            </div>
                        </div>
                        <div class="dc-docsingle-holder">
                            <ul class="dc-navdocsingletab nav navbar-nav" style="display: none;">
                                <!-- <li class="nav-item">
                                    <a class="active" id="locations-tab" data-toggle="tab" href="#location_tab">{{ trans('lang.available_locs') }}</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="active" id="userdetails-tab" data-toggle="tab" href="#userdetails">{{ trans('lang.detail_gallery') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a id="consultation-tab" data-toggle="tab" href="#consultation">{{ trans('lang.online_consultation') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a id="feedback-tab" data-toggle="tab" href="#educationitem">Education & Experience</a>
                                </li>
                                <li class="nav-item">
                                    <a id="articles-tab" data-toggle="tab" href="#doc-articles">{{ trans('lang.articles') }}</a>
                                </li>
                            </ul>
			    <div class="tab-content dc-haslayout">
				<!--
                                <div class="dc-contentdoctab dc-location-holder tab-pane fade active show" id="location_tab">
                                    <div class="dc-searchresult-holder">
                                        <div class="dc-searchresult-head">
                                            <div class="dc-title"><h4>“{{ !empty($gender_title) ? Helper::getDoctorArray(clean($gender_title)) : '' }} {{ Helper::getUserName($user->id) }}” {{ trans('lang.locations') }}</h4></div>
                                        </div>
                                        @include('front-end.doctors.profile-details.locations.index')
                                    </div>
                                    @include('front-end.doctors.profile-details.share-profile.index')
                                </div> -->
				<div class="dc-contentdoctab dc-userdetails-holder tab-pane active" id="userdetails">
				<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding-right: 50px;">
                                    <div class="dc-aboutdoc dc-aboutinfo">
                                        <div class="dc-infotitle">
                                            <h3>
                                                {{ trans('lang.about') }} 
                                                “{{ !empty($gender_title) ? Helper::getDoctorArray(clean($gender_title)) : '' }} {{ Helper::getUserName($user->id) }}”
                                            </h3>
                                        </div>
                                        <div class="dc-description"><p>{{ html_entity_decode(clean($user->profile->description)) }}</p></div>
				    </div>
				<div class="dc-feedback">
                                        <div class="dc-searchresult-head">
                                            <div class="dc-title"><h4>{{ trans('lang.patient_feedback') }}</h4></div>
                                        </div>
                                        <div class="dc-consultation-content dc-feedback-content">
                                            @if (!empty($user->feedbacks) && $user->feedbacks->count() > 0 )
                                                @foreach ($user->feedbacks as $feedback)                                                   
                                                        @if ($feedback->keep_anonymous == 'on')
							@php $patient = App\User::findOrFail($feedback->patient_id); @endphp
							<div class="dc-consultation-details">
                                                            <figure class="dc-consultation-img">
                                                                <img src="{{ asset(Helper::getImage('uploads/users/'.$patient->id.'/', $patient->profile->avatar, 'small-', 'user-logo-def.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                            </figure>
                                                            <div class="dc-consultation-title">
                                                                <h5><a href="javascript:void(0);"><em>{{ Helper::getUserName($feedback->patient_id) }} {{ Helper::verifyUser(clean($feedback->patient_id)) }}</em></a></h5>
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
                                @if (!empty($gallery_images))
                                    <div class="dc-aboutgallery-holder dc-aboutinfo">
                                        <div class="dc-infotitle">
                                            <h3>{{ trans('lang.gallery') }}</h3>
                                        </div>
                                        <div class="dc-aboutgallery">
                                            <div class="dc-aboutgallery-img">
                                                @foreach ($gallery_images as $gallery_image)
                                                    <figure>
                                                        <a data-rel="prettyPhoto[video]" href="{{asset('/uploads/users/'.$user->id.'/gallery/images/'.$gallery_image)}}" rel="prettyPhoto[video]">
                                                            <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id.'/gallery/images/', $gallery_image, 'small-', '')) }}" alt="image description"><i class="ti-plus"></i>
                                                        </a>
                                                    </figure>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (!empty($gallery_videos))
                                    <div class="dc-aboutgallery-video dc-aboutinfo">
                                        <div class="dc-infotitle">
                                            <h3>{{ trans('lang.gallery_videos') }}</h3>
                                        </div>
                                        <div class="dc-aboutgallery">
                                            <div class="dc-aboutgallery-img">
                                                @foreach ($gallery_videos as $gallery_video)
                                                    <figure>
                                                        @php 
                                                            $width 	= 367;
                                                            $height 		= 206;
                                                            $url = parse_url($gallery_video['url']);
                                                            if ( isset( $url['host'] ) && ( $url['host'] == 'vimeo.com' || $url['host'] == 'player.vimeo.com' ) ) {
                                                                $content_exp = explode("/", $media);
                                                                $content_vimo = array_pop($content_exp);
                                                                echo '<iframe width="' . intval($width) . '" height="' . intval($height) . '" src="https://player.vimeo.com/video/' . $content_vimo . '" 
                                                        ></iframe>';
                                                            } elseif ( isset( $url['host'] ) && $url['host'] == 'soundcloud.com') {
                                                                $video = wp_oembed_get($media, array('height' => intval($height)));
                                                                $search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="no"', 'scrolling="no"');
                                                                $video = str_replace($search, '', $video);
                                                                echo str_replace('&', '&amp;', $video);
                                                            } else {
                                                                echo '<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.str_replace("v=", '', $url['query']).'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                                            }
                                                        @endphp
                                                    </figure>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
				    @include('front-end.doctors.profile-details.share-profile.index')
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="dc-services-holder dc-aboutinfo">
                   <div class="dc-infotitle"> <h3 class="profilerightsidetitle">Availabel Platform</h3></div>
                    <div class="availablevideoicons">
                        @if ( $user->zoomlink )
                            <img src="/uploads/settings/general/zoomplatformicon.png">
                        @endif
                        @if ( $user->gotomeetinglink )
                            <img src="/uploads/settings/general/gotomeeting.png">
                        @endif
                    </div>
                </div>
					<div class="dc-services-holder dc-aboutinfo">
                       <div class="dc-infotitle">
                          <h3 class="profilerightsidetitle">Location</h3>
                          <p style="margin-bottom: 0px;">{{  html_entity_decode(clean($user->country)) }}, {{  html_entity_decode(clean($user->state)) }}, {{  html_entity_decode(clean($user->city)) }} </p>
                       </div>
                    </div>
                    <div class="dc-services-holder dc-aboutinfo">
                       <div class="dc-infotitle">
                          <h3 class="profilerightsidetitle">Language Spoken</h3>
                          <p style="margin-bottom: 0px;">{{  html_entity_decode(clean($user->languagelist)) }} </p>
                       </div>
                    </div>

					@include('front-end.doctors.profile-details.user-details.offered-services')
				</div>
				</div>
                                </div>
                                <div class="dc-contentdoctab dc-consultation-holder tab-pane" id="consultation">
                                    @include('front-end.doctors.profile-details.consultation.index')
                                    @include('front-end.doctors.profile-details.share-profile.index')
                                </div>

				<div class="dc-contentdoctab dc-feedback-holder tab-pane" id="educationitem">
				    <div class="dc-feedback">
					@include('front-end.doctors.profile-details.user-details.education')
					@include('front-end.doctors.profile-details.user-details.experience')
					@include('front-end.doctors.profile-details.user-details.awards')
	                                @include('front-end.doctors.profile-details.user-details.memberships')
                             	        @include('front-end.doctors.profile-details.user-details.registrations')
	                                @include('front-end.doctors.profile-details.user-details.downloads')			
				    </div>
                                    @include('front-end.doctors.profile-details.share-profile.index')
                                </div>
                                @include('front-end.doctors.profile-details.articles.index')
                            </div>
                        </div>
		    </div>
                </div>
            </div>
        </div>
        {{--  FeedBack Modal  --}}
        <b-modal ref="feedback_modal" class="dc-feedbackpopup" id="la-addfeedbackpopup" size="md" hide-footer title="{{ trans('lang.add_feedback') }}" no-close-on-backdrop>
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
                                <div class="dc-popupsubtitle"><h3>{{ trans('lang.long_waite') }}</h3></div>
                                <div id="dc-productrangeslider" class="dc-productrangeslider dc-themerangeslider">
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
                                            <input type="hidden" name="rating[{{ $key }}][reason]" value="{{{ clean($option->id) }}}">
                                            <span class="dc-rating-content"></span>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <textarea class="form-control" name="comments" placeholder="{{ trans('lang.share_exp') }}"></textarea>
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
        <b-modal ref="appointment_modal" v-model="AppointmentmodalShow" size="lg" class="dc-feedbackpopup" id="dc-feedbackpopup" hide-footer title="{{ trans('lang.book_appointment') }}" no-close-on-backdrop>
            <div class="dc-appointmentpopup" id="appointmodalheaderitem">
                <div class="dc-modalcontent modal-content">
                    <section id="sec1" class="sec1">
                        {!! Form::open(['class' => 'dc-formtheme', 'id' => 'submit_appointment_form', '@submit.prevent'=>'checkAppointmentStep1()']) !!}
                            <div id="immediatebookstatecheck" class="dc-visitingdoctor" v-if="step === 1" v-cloak>
                                <ul class="dc-joinsteps">
                                    <li class="dc-active"><a href="javascript:void(0);">{{ trans('lang.01') }}</a></li>
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
                                    <li class="dc-done-next"><a href="javascript:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="dc-active"><a href="javascript:void(0);">{{ trans('lang.02') }}</a></li>
                                  <!--  <li><a href="javascript:void(0);">{{ trans('lang.03') }}</a></li>
                                    <li><a href="javascript:void(0);">{{ trans('lang.04') }}</a></li> -->
                                </ul>
                                <div class="dc-visit">
                                    <span>{{ trans('lang.verify_you') }}</span>
                                </div>
                                {!! Form::open() !!}
                                    <div class="form-row dc-popup-row">
                                        <div class="form-group col-6">
                                            <input type="password" id="appointment_password" class="form-control" placeholder="{{ trans('lang.pass') }}" v-model="appointment.password">
                                        </div>
                                        <div class="form-group col-6">
                                            <input type="password" id="appointment_retypassword" class="form-control" placeholder="{{ trans('lang.ph_retry_pass') }}" v-model="appointment.retry_password">
					</div>
					<div class="form-group col-12"><a style="color: #3fabf3; cursor: default;"><i class="fab fa-paypal" style="font-size: 20px;"></i> <span><em>Pay Amount Via</em> Paypal Payment Gateway</span></a></div>
		
					<div class="row" id="selectedconferenceitemoption">
					<input type="hidden" id="videoconferenceseting" name="videoconferenceseting" value="zoom">
					<div style="display: none;">
					@if ( $user->zoomlink )
					<div class="form-group col-6" style="text-align: center;">
						<img src="/uploads/settings/general/zoomlogo.png" class="selected" style="width: 150px; cursor: pointer;" id="zoomimgid" v-on:click="selectconferenceplatform('zoom')">
					</div>
					@endif
					@if ( $user->gotomeetinglink )
						<div class="form-group col-6" style="text-align: center;">
						<img src="/uploads/settings/general/gotomeetinglogo.png" style="width: 150px; cursor: pointer;" id="gotomeetingimgid" v-on:click="selectconferenceplatform('gotomeeting')">
						</div>
					@endif
					</div>
					</div>
                                    </div>
                                    <div class="modal-footer dc-modal-footer">
                                        <a href="javascript:void(0);" v-on:click="checkAppointmentStep2('{{Auth::user()->id}}', '{{$user->id}}')" class="btn dc-btn btn-primary">{{ trans('lang.continue') }}</a>
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
@endsection
@push('front_end_scripts')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/prettyPhoto.js') }}"></script>
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
    $(".feedback-btn").on('click', function(event) {
        $(function() {
            jQuery("#dc-productrangeslider").slider({
            range: "max",
            min: 1,
            max: 4,
            value: 1,
            slide: function( event, ui ) {
                $("#time").val( ui.value );
            }
            });
            jQuery("#time").val( jQuery("#dc-productrangeslider").slider("value"));
        } );
    });

    $(".bookingnowevent").on('click', function(event) {
        if( jQuery('#immediatebookstatecheck').hasClass('booknowoption') ) {} else {
		$("#immediatebookstatecheck").addClass("booknowoption");
		var date = new Date();
	var australiatime = date.toLocaleTimeString('en-US', {timeZone: "Australia/Sydney"}, { hour: '2-digit', minute: '2-digit', hour12: true });
	australiatime = australiatime.replace("AM", "am");
	australiatime = australiatime.replace("PM", "pm");
	var elementspecial = australiatime.split(" ")[1];

	var lastCommaIndex = australiatime.lastIndexOf(":");
	var hourmintime = australiatime.substr(0,lastCommaIndex);
	var totalresult = hourmintime + " " + elementspecial;

		//$("#immediatebookstatecheck").append( '<input type="radio" id="availableslot-0" name="appointment[time]" value="' + totalresult + '" checked style="display: none;">' );	
        }
    });
    $(".schedulebtnevent").on('click', function(event) {
        if( jQuery('#immediatebookstatecheck').hasClass('booknowoption') ) {
            $("#immediatebookstatecheck").removeClass("booknowoption");
        }
    });

    jQuery(document).ready(function (){
            /* THEME ACCORDION */
        function themeAccordion() {
            jQuery('.dc-panelcontent').hide();
            jQuery('.dc-accordion .dc-paneltitle:first').addClass('active').next().slideDown('slow');
            jQuery('.dc-accordion .dc-paneltitle').on('click',function() {
                if(jQuery(this).next().is(':hidden')) {
                    jQuery('.dc-accordion .dc-paneltitle').removeClass('active').next().slideUp('slow');
                    jQuery(this).toggleClass('active').next().slideDown('slow');
                }
            });
        }
        themeAccordion();
        function childAccordion() {
            jQuery('.dc-subpanelcontent').hide();
            jQuery('.dc-childaccordion .dc-subpaneltitle:first').addClass('active').next().slideDown('slow');
            jQuery('.dc-childaccordion .dc-subpaneltitle').on('click',function() {
                if(jQuery(this).next().is(':hidden')) {
                    jQuery('.dc-childaccordion .dc-subpaneltitle').removeClass('active').next().slideUp('slow');
                    jQuery(this).toggleClass('active').next().slideDown('slow');
                }
            });
        }
	childAccordion();

	var sessionparametercheck = '<?php echo $sessionparametercheck; ?>';
        if(sessionparametercheck == "booknow") {
            if( jQuery('#immediatebookstatecheck').hasClass('booknowoption') ) {} else {
		    $("#immediatebookstatecheck").addClass("booknowoption");

		    var date = new Date();
            var australiatime = date.toLocaleTimeString('en-US', {timeZone: "Australia/Sydney"}, { hour: '2-digit', minute: '2-digit', hour12: true });
            australiatime = australiatime.replace("AM", "am");
            australiatime = australiatime.replace("PM", "pm");
            var elementspecial = australiatime.split(" ")[1];
            
            var timevalue = australiatime.split(" ")[0];
            var houroptvalue = timevalue.split(":")[0];
            var mintimeoptvalue = timevalue.split(":")[1];
            if(houroptvalue < 10)
            	hourtimevalue = "0"+ houroptvalue;
            else
            	hourtimevalue = houroptvalue;

        // var lastCommaIndex = australiatime.lastIndexOf(":");
        // var hourmintime = australiatime.substr(0,lastCommaIndex);
            var totalresult = hourtimevalue + ":" + mintimeoptvalue + " " + elementspecial;

        	$("#immediatebookstatecheck").append( '<input type="radio" id="availableslot-0" name="appointment[time]" value="' + totalresult + '" checked style="display: none;">' );
        	$("#appointmodalheaderitem").append( '<input id="booknowoptioncheck" style="display: none;" name="booknowoptioncheck" value="now">' );

            }
	} else {
		$("#appointmodalheaderitem").append( '<input id="booknowoptioncheck" style="display: none;" name="booknowoptioncheck" value="later">' );	
	}

        });
</script>
@endpush
