@extends('front-end.master')
@section('title'){{ clean($search_list_meta_title) }} @stop
@section('description', clean($search_list_meta_desc))
@section('content')
@include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('searchResults') !!}
    <div class="dc-main-section" style="padding-top: 10px;">
        <div id="user-profile">
            <div class="dc-preloader-section" v-if="loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
	    <div class="row">
		<div class="dc-searchresult-head row" style="padding: 20px; height: 70px; margin-bottom: 0px;">
                    <div class="col-lg-3 col-md-3"></div>
                    <div class="col-lg-5 col-md-5">
                        <div class="dc-rightarea" style="float: left;">
                            <div class="dc-select" style="width: 250px; margin-left: 5px;">
                                <select data-placeholder="{{ trans('lang.sort_by') }}" name="sort_by" v-model="sort_by" v-on:change="resultSortBy('sort_by', sort_by)" style="border-radius: initial;">
                                    <option value="null">{{ trans('lang.sort_by') }}</option>
                                    <option value="lowprice">Lowest Price</option>
				    <option value="highprice">Highest Price</option>
				    <option value="availablenow">Available Now</option>
                                    <option value="date">Join Date</option>
                                    <option value="rating">Rating</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="dc-title">
                            <h4 style="color: var(--terthemecolor); font-weight: 500; padding-left: 10px; padding-top: 10px; font-size: 18px; font-family: ProximaNova, 'Open Sans', sans-serif;
">{{{ clean($total_records) }}} {{trans('lang.matches_found') }} </h4>
                        </div>
                    </div>
                </div>
                <div id="dc-twocolumns" class="dc-twocolumns dc-haslayout">
                    @php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'; @endphp
                    @if ($display_sidebar == 'true')
                        @php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9'; @endphp
			@endif
			@if ($display_sidebar == 'true')
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 float-left" style="border: 1px solid #eee; height: calc(100% + 50px); margin-top: -50px;">
                            @include('front-end.sidebar.index')
                        </div>
                    @endif
                    <div class="{{ $columns }} float-left">
			<div class="dc-searchresult-holder" style="padding-right: 25px;">
				<p style="color:red;font-size: 16px;font-weight: 500;line-height: 22px;font-family: ProximaNova, 'Open Sans', sans-serif; display: none;">IF THIS IS AN EMERGENCY PLEASE DIAL 000 OR GO TO THE NEAREST EMERGENCY ROOM. TELEHEALTH PLUS DOES NOT OFFER EMERGENCY SERVICES.</p>
				<div class="search-gray-block" style="background: #e8e8e8;padding: 10px 5px 0 10px; width: 75%; display: none;">
                            <div class="row">
                                 <div class="col-lg-9 col-md-9">
                                                <img src="/uploads/settings/general/sdoc.jpg" style="float:left; margin-right:10px;width: 75px;">
                                                <h4 style="font-weight: 600; font-size: 22px; line-height: 15px; margin-top: 7px; color: #000; font-family: ProximaNova, 'Open Sans', sans-serif;
">Doctor On Call</h4>
                                                <p style="color: #000; font-weight: 400; font-size: 18px; font-family: ProximaNova, 'Open Sans', sans-serif; line-height: 22px;">Doctor On Call is a 24 hr service where you can get an instant consultation<br> with the next available provider.</p>
                                     </div>
                                     
                                      <div class="col-lg-3 col-md-3">
                                          <a class="btn-visit" href="#!" style=" font-size: 12px; padding: 5px 10px; margin-top: 25px; float: right; margin-right: 20px; background: #11b6b8; color: #fff; min-width: 100px; border: 1px solid #11b6b8;">Choose First Available</a>
                                          </div>
                                
                            </div>
			</div>
			<div style="color: #11b6b8; padding-top: 30px; font-weight: 400; font-family: ProximaNova, 'Open Sans', sans-serif; font-size: 16px; padding-bottom: 10px; display: none;">or choose a specific provider below</div>
                            <div class="dc-searchresult-grid dc-searchresult-list dc-searchvlistvtwo la-searchvlistvtwo">
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
					
                                            $current_package = Helper::getCurrentPackage($user_obj);
                                            $featured = !empty($current_package) && !empty($current_package['featured']) ? $current_package['featured'] : 'false';
                                        @endphp
                                        <div class="dc-docpostholder">
                                            <div class="dc-docpostcontent">
                                                <div class="dc-searchvtwo">
                                                    <figure class="dc-docpostimg">
                                                        <img src="{{ asset(Helper::getImage('uploads/users/'.$user_obj->id, $user_obj->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                        @if ($featured == 'true')
                                                            <figcaption>
                                                                <span class="dc-featuredtag"><i class="fa fa-bolt"></i></span>
                                                            </figcaption>
                                                        @endif
                                                    </figure>
                                                    <div class="dc-title">
                                                        @if (!empty($specialities))
                                                            @foreach ($specialities as $key => $user_speciality)
                                                                @php $speciality = Helper::getSpecialityByID($user_speciality); @endphp
                                                                @if (!empty($speciality))
                                                                <!--    <a href="{{ url('/search-results?speciality='.clean($speciality->slug)) }}" class="dc-docstatus">{{ html_entity_decode(clean($speciality->title)) }}</a>  -->
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <h3>
                                                            <a href="{{ route('userProfile', ['slug' => clean($user_obj->slug)]) }}">
                                                                {{ !empty($user_obj->profile->gender_title) ? Helper::getDoctorArray(html_entity_decode(clean($user_obj->profile->gender_title))) : '' }}
                                                                {{Helper::getUsername($user->id)}} 
                                                            </a>
                                                            {{ Helper::verifyUser(clean($user_obj->id)) }} {{ Helper::verifyMedical(clean($user_obj->id)) }}
                                                        </h3>
                                                        <ul class="dc-docinfo">
                                                            <li><em>{{ html_entity_decode(clean($user_obj->profile->sub_heading)) }}</em></li>
                                                            @if (Helper::getRoleTypeByUserID($user_obj->id) == 'doctor')
                                                                <li>
                                                                    <span class="dc-stars">
                                                                        <span style="width: {{ clean($stars) }}%;"></span>
                                                                    </span>
                                                                    <em>{{ html_entity_decode(clean($user_obj->feedbacks->count())) }} {{ trans('lang.feedbacks') }}</em>
                                                                </li>
								@endif
								<li class="dc-available">Language Spoken</li>
								<li>{{Helper::getUserLanguage($user->id)}} </li>
								<li class="dc-available">
                                    Available Platforms:  
                                    @if ( $user_obj->zoomlink )
                                        <img src="/uploads/settings/general/zoomplatformicon.png" style="width: 20px; margin-left: 5px;">
                                    @endif
                                    @if ( $user_obj->gotomeetinglink )
                                        <img src="/uploads/settings/general/gotomeeting.png" style="width: 20px; margin-left: 5px;">
                                    @endif
                                </li>
                                                        </ul>
						    </div>
						<?php	if($servicelistdata) {	?>
						<div class="dc-tags">
                                                	<ul>						
							<?php for ($i = 0; $i < count($servicelistdata); $i++) { ?>
							<li><a><?php echo $servicelistdata[$i]['speciality_title'];
					    		//print_r($servicelistdata[$i]);
						        if($servicelistdata[$i]['service_price']) {
								$servicepriceitem = str_replace("$" , "" , $servicelistdata[$i]['service_price']);
								$servicepriceitem = $servicepriceitem * 1.2;
					    			echo "   $".$servicepriceitem;
					    		}
							 ?></a></li>
							<?php } ?>
							</ul>
                                                </div>
						<?php } ?>                                            
                                                </div>
                                                <div class="dc-doclocation dc-doclocationvtwo">
                                                    @if (!empty($user_obj->location->title))
                                                    <!--    <span><i class="ti-direction-alt"></i> {{ html_entity_decode(clean($user_obj->location->title)) ?? '' }}</span> -->
                                                    @endif
                                                    @if (!empty($serviceavailabledata) && !empty($day_list))
                                                        @php $last_day = end($day_list); @endphp
                                                        <span>
                                                            <i class="ti-calendar"></i>
                                                            @foreach ($day_list as $key => $day)
                                                                @if (!in_array($key, $serviceavailabledata))
                                                                    <em class="dc-dayon">{{ html_entity_decode(clean($day['title'])) }}</em> 
                                                                    @if ($day['title'] != $last_day['title']), @endif
                                                                @else
                                                                    {{ html_entity_decode(clean($day['title'])) }}@if ($day['title'] != $last_day['title']), @endif
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                    @if (Helper::getRoleTypeByUserID($user_obj->id) == 'doctor')
                                                        <span><i class="ti-thumb-up"></i> {{ empty($user_obj->profile->votes) ? 0 : clean($user_obj->profile->votes) }} {{trans('lang.votes') }}</span>
                                                      <!--  <span><i class="ti-wallet"></i> {{ trans('lang.starting_from') }} {{ !empty($symbol['symbol']) ? html_entity_decode(clean($symbol['symbol'])) : '$' }}{{ !empty($user_obj->profile->starting_price) ? html_entity_decode(clean($user_obj->profile->starting_price)) : 0 }}</span> -->
                                                    @elseif (Helper::getRoleTypeByUserID($user_obj->id) == 'hospital')
                                                        <span><i class="ti-thumb-up"></i>{{ trans('lang.doctors_onboard') }}: {{ clean($user_obj->approvedTeams()->count()) }}</span>
                                                    @endif
                                                    @if (!empty($user_obj->profile->available_days))
                                                        <span>
                                                            <i class="ti-clipboard"></i>
							    <em class="dc-available">
							    <?php //print_r($serviceavailabledata); ?>
                                                                @if (!empty($user_obj->profile->working_time) && $type == 'hospital')
                                                                   {{{ $user_obj->profile->working_time == '24_hours' ? trans('lang.24_hours') : html_entity_decode(clean($user_obj->profile->working_time)) }}}
                                                                @else 
                                                                   	@if ( in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata) )
                                                                     		<?php if ($doctorstartendtime == "1") {  ?>
                                                                     			<font>Available Today</font>
	                                                                       <?php } else { ?>
        	                                                                    <font style="color: red;">Not Available Today</font>
                	                                                       <?php } ?>
									@else
										 <font style="color: red;">Not Available Today</font>
									@endif
                                                                @endif
                                                            </em>
                                                        </span>
                                                    @endif
                                                    @php
                                                        $column = !empty($user_obj->id) && Helper::getRoleTypeByUserID($user_obj->id) == 'doctor' ? 'saved_doctors' : 'saved_hospitals'; 
							$saved_user = Auth::check() && !empty(Auth::user()->profile->$column) ? unserialize(Auth::user()->profile->$column) : array();												                                  
                                                    @endphp 
						    <div class="dc-btnarea">     

							<?php  if($servicelistdata) { ?>
							@if ( in_array(strtolower(Carbon\Carbon::now()->format('D')), $serviceavailabledata) )
							<?php echo $doctorstartendtime; if( $alreadyappointmenthave == "0") { ?>
							<?php if (Auth::check()) { 
							if ($doctorstartendtime == "1") { 
?>
							<a style="background: green; color: #fff; border: 1px solid green;" href="{{{url('profile/'.clean($user_obj->slug).'/booknow')}}}" class="dc-btn" v-b-modal.modal-sm v-on:click="profiledialogsetting('1')">{{ trans('lang.book_now') }}</a>
							<?php } else { ?>
			                                    <a href="javascript:void(0);" class="dc-btn bookingnowevent" style="background: red; border: 1px solid red;">Not Available</a>
							<?php } } else {
							if ($doctorstartendtime == "1") {  ?>
							<a style="background: green; color: #fff; border: 1px solid green;" href="javascript:void(0);" v-on:click="showError('You need to be login as regular user to perform this action')" class="dc-btn">{{ trans('lang.book_now') }}</a>
							<?php } else { ?>
                                                            <a href="javascript:void(0);" class="dc-btn bookingnowevent" style="background: red; border: 1px solid red;">Not Available</a>
							<?php } } ?>
							<?php } else { ?>
								<a style="background: red; color: #fff; border: 1px solid red;" href="javascrip:void(0);" class="dc-btn">Unavailable</a>
							<?php } ?>
				@else				
					<a style="background: red; color: #fff; border: 1px solid red;" href="javascrip:void(0);" class="dc-btn">Not Available</a>			
                                @endif
 <?php } else { ?>
<a style="background: red; color: #fff; border: 1px solid red;" href="javascrip:void(0);" class="dc-btn">Not Available</a>
							<?php } ?>
							@if (!empty($saved_user) && in_array($user_obj->id, $saved_user))
                                                            <a href="javascrip:void(0);" class="dc-like dc-clicksave dc-btndisbaled">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        @else
                                                            <a href="javascrip:void(0);" class="dc-like" id="doctor-{{ clean($user_obj->id) }}" @click.prevent="add_wishlist('doctor-{{ clean($user_obj->id) }}', '{{ clean($user_obj->id) }}', '{{ $column }}', '')" v-cloak>
                                                                <i class="fa fa-heart"></i>
                                                            </a>
							@endif
							<?php if (Auth::check()) { ?>					    
							<a href="{{{url('profile/'.clean($user_obj->slug).'/schedule')}}}" class="dc-btn" style="margin-top: 15px; display: block; background-color: var(--themecolor); color: #fff;" v-b-modal.modal-sm v-on:click="profiledialogsetting('0')">{{ trans('lang.view_more') }}</a>
							<?php } else { ?>
							<a href="javascript:void(0);" v-on:click="showError('You need to be login as regular user to perform this action')" class="dc-btn" style="margin-top: 15px; display: block; background-color: var(--themecolor); color: #fff;">{{ trans('lang.view_more') }}</a>
							<?php } ?>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
