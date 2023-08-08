<div class="dc-haslayout">
    <div class="dc-dashboardbox">
        <div class="dc-dashboardboxtitle dc-titlewithbtn">
            <h2>Avaiable Appointment</h2>
        </div>
        <div class="dc-dashboardboxcontent dc-offerday-holder la-offerday-holder">
            <div class="dc-clinics">
                <div>
                    <figure class="dc-clinicsimg">
                        <img src="{{ asset(Helper::getImage('uploads/users/'.$location->hospital->id, $location->hospital->profile->avatar, 'small-', 'user.jpg')) }}" 
                            alt="{{ trans('lang.img_desc') }}">
                    </figure>
                </div>
                <div class="dc-clinics-content">
                    <div class="dc-clinics-title">
                        <a href="javascript:void(0);">{{ App\User::findOrFail($location->hospital->id)->getRoleNames()->first() }}</a>
                        <h4>{{ Helper::getUserName($location->hospital->id) }} {{ Helper::verifyUser($location->hospital->id) }}</h4>
                        @if (!empty($appointment_days))
                            <span>
                                @foreach (Helper::getAppointmentDays() as $key => $day)
                                    @if (!in_array($key, $appointment_days))
                                        <em class="dc-dayon">{{ html_entity_decode(clean($day['title'])) }}</em>
                                    @else
                                        {{ html_entity_decode(clean($day['title'])) }},
                                    @endif
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="dc-tabscontenttitle">
                <h3>{{ trans('lang.days_offer_services') }}</h3>
            </div>
            <div id="dc-childaccordion" class="dc-childaccordion dc-offeraccordion" role="tablist" aria-multiselectable="true">
                @foreach ($days as $key => $day)
                    @if (!empty($slots[$key]['slots']))
                        @php
                            $selected_day = Helper::getAppointmentDays($key);
                        @endphp
                        <div class="dc-subpanel">
                            <div class="dc-subpaneltitle dc-subpaneltitlevtwo">
                                <span> {{ html_entity_decode(clean($selected_day['name'])) }} </span>
                                <div class="dc-rightarea">
                                    <div class="dc-btnaction">
                                        <a href="javascript:void(0);" class="dc-editbtn"><i class="lnr lnr-pencil"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dc-subpanelcontent">
                                <div class="dc-dayspaces-holder dc-titlewithbtn">
                                    <div class="dc-rightarea">
                                        <a href="javascript:void(0);" v-on:click="showAddSlotForm('show_slot_form_{{$key}}')" class="dc-btn dc-btn-block">
                                            {{ trans('lang.add_more') }}
                                        </a>
                                        <a href="javascript:void(0);" v-on:click="deleteAllSlot('dc-spaces-wrap-{{$key}}', '{{$key}}', '{{$id}}', 'do u want to delete slot', 'slot deleted', 'successfully')" class="dc-btn dc-btn-del">
                                            {{ trans('lang.delete_all') }}
                                        </a>
                                    </div>
                                    @if (!empty($slots[$key]['slots']))
                                        <div class="dc-spaces-holder">
                                            <ul class="dc-spaces-wrap" id="dc-spaces-wrap-{{$key}}">
                                                @php
                                                    $starting_time = !empty($slots[$key]['start_time']) ? Carbon\Carbon::parse($slots[$key]['start_time']): '';
						    $start_time =  !empty($slots[$key]['start_time']) ? $slots[$key]['start_time'] : '';
                                                @endphp
                                                @foreach ($slots[$key]['slots'] as $slot_key => $slot)
                                                    @php
                                                        $start_slot = explode("-",$slot_key);
							$slot_id = $key.'-slot'.'-'.str_replace(array(':', ' '), '', $start_slot[0]);
							$datastrtotimevalue = strtotime($start_slot[0]);
                                                    @endphp
                                                    <li id="{{$slot_id}}" data-position="{{{$datastrtotimevalue}}}">
                                                        <a href="javascript:void(0);" v-on:click="deleteSlot('{{$slot_id}}', '{{$slot_key}}', '{{$key}}', '{{$id}}', 'do u want to delete slot', 'slot deleted', 'successfully')" class="dc-spaces">
                                                            <span>{{{$start_slot[0]}}}</span>
                                                            <span>{{ trans('lang.spaces') }}: {{{$slot['space']}}}</span>
                                                            <i class="lnr lnr-cross"></i>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="dc-dashboardboxcontent dc-appsetting" v-if="show_slot_form_{{$key}}">
                                    <div class="dc-tabscontenttitle">
                                        <h3>{{ trans('lang.add_new_slot') }}</h3>
                                    </div>
                                    {!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-form-appointment', 'id' =>'update_slot-form-'.$key, 
                                        '@submit.prevent'=>'updateSlots("'.$key.'","'.$id.'", "update_slot-form-'.$key.'", "location_start_time-")'])!!}
                                        <fieldset>
                                            <start-time
                                                :start_time_id="'location_start_time-{{$key}}'"
                                                :start_time_name="'slots[start_time]'"
                                                :start_time_obj_id="'start_time_obj-{{$key}}'"
                                            ></start-time>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select name="slots[duration]" v-model="duration" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        <option value="Select Duration" disabled hidden>{{ trans('lang.select_duration') }}</option>
                                                        @foreach ($durations as $duration_key => $value)
                                                            <option value="{{{$duration_key}}}">{{{ $value }}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select id="number_of_slots" name="slots[number_of_slots]" class="form-control" v-model="no_of_slot" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        @for ($i = 1; $i <= 99; $i++)
                                                            <option value="{{ $i }}">{{ $i }} {{$i > 1 ? 'slots' : 'slot'}}</option>
                                                        @endfor
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select name="slots[intervals]" v-model="intervals" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        <option value="Select Interval">{{ trans('lang.select_interval') }}</option>
                                                        @foreach ($intervals as $interval_key => $value)
                                                            <option value="{{{$interval_key}}}">{{{ $value }}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group dc-datepicker form-group-half">
                                                <input type="text" value="" id="end_time-{{$key}}" name="slots[end_time]" readonly placeholder="{{ trans('lang.end_time') }}">
                                            </div>
                                        </fieldset>
                                        <fieldset class="dc-spacesholder">
                                            <legend>{{ trans('lang.assign_apointment_spaces') }}</legend>
                                            <div class="form-group form-group-half dc-radio-holder">
                                                @foreach ($spaces as $space_key => $value)
                                                    <span class="dc-radio">
                                                        <input id="dc-spaces{{$space_key}}" type="radio" name="slots[appointment_spaces]" value="{{{$value['value']}}}" checked="" v-model="appointment_space" v-on:change="selectedSpace(appointment_space)">
                                                        <label for="dc-spaces{{$space_key}}">{{{$value['value']}}}</label>
                                                    </span>
                                                @endforeach
                                                <span class="dc-radio">
                                                    <input id="dc-spaces" type="radio" value="other" checked="" v-model="appointment_space" v-on:change="selectedSpace(appointment_space)">
                                                    <label for="dc-spaces">{{ trans('lang.other') }}</label>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half" v-if="is_show">
                                                <input type="text" id="custom_appt_spaces-{{$key}}" name="slots[appointment_spaces]" class="form-control" placeholder="{{ trans('lang.ph.appointment_spaces') }}">
                                            </div>
                                            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                                        </fieldset>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="dc-subpanel">
                            <div class="dc-subpaneltitle dc-subpaneltitlevtwo">
                                <span>{{$day['name']}}</span>
                                <div class="dc-rightarea">
                                    <div class="dc-btnaction">
                                        <a href="javascript:void(0);" class="dc-editbtn"><i class="lnr lnr-pencil"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dc-subpanelcontent">
                                <div class="dc-dayspaces-holder dc-titlewithbtn">
                                    <div class="dc-rightarea">
                                        <a href="javascript:void(0);" v-on:click="showAddSlotForm('show_slot_form_{{$key}}')" class="dc-btn dc-btn-block">Add More</a>
                                    </div>
                                </div>
                                <div class="dc-dashboardboxcontent dc-appsetting" v-if="show_slot_form_{{$key}}">
    '                               <div class="dc-tabscontenttitle">
                                        <h3>{{ trans('lang.add_new_slot') }}</h3>
                                    </div>
                                    {!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-form-appointment', 'id' =>'update_slot-form-'.$key,
                                        '@submit.prevent'=>'updateDaySlots("'.$key.'", "'.$id.'", "update_slot-form-'.$key.'", "location_start_time-")'])!!}
                                        <fieldset>
                                            <start-time
                                                :start_time_id="'location_start_time-{{$key}}'"
                                                :start_time_name="'slots[start_time]'"
                                                :start_time_obj_id="'start_time_obj-{{$key}}'">
                                            </start-time>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select name="slots[duration]" v-model="duration" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        <option value="Select Duration" disabled hidden>{{ trans('lang.select_duration') }}</option>
                                                        @foreach ($durations as $duration_key => $value)
                                                            <option value="{{{$duration_key}}}">{{{$value}}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select id="number_of_slots" name="slots[number_of_slots]" class="form-control" v-model="no_of_slot" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        @for ($i = 1; $i <= 99; $i++)
                                                            <option value="{{ $i }}">{{ $i }} {{$i > 1 ? 'slots' : 'slot'}}</option>
                                                        @endfor
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half">
                                                <span class="dc-select">
                                                    <select name="slots[intervals]" v-model="intervals" v-on:change="onChangeTime('start_time_obj-{{$key}}', 'end_time-{{$key}}')">
                                                        <option value="Select Interval">{{ trans('lang.select_interval') }}</option>
                                                        @foreach ($intervals as $interval_key => $value)
                                                            <option value="{{{$interval_key}}}">{{{$value}}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="form-group dc-datepicker form-group-half">
                                                <input type="text" value="" id="end_time-{{$key}}" name="slots[end_time]" readonly placeholder="{{ trans('lang.end_time') }}">
                                            </div>
                                        </fieldset>
                                        <fieldset class="dc-spacesholder">
                                            <legend>{{ trans('lang.assign_apointment_spaces') }}</legend>
                                            <div class="form-group form-group-half dc-radio-holder">
                                                @foreach ($spaces as $space_key => $value)
                                                    <span class="dc-radio">
                                                        <input id="dc-spaces{{$space_key}}" type="radio" name="slots[appointment_spaces]" value="{{{$value['value']}}}" checked="" v-model="appointment_space" v-on:change="selectedSpace(appointment_space)">
                                                        <label for="dc-spaces{{$space_key}}">{{{$value['value']}}}</label>
                                                    </span>
                                                @endforeach
                                                <span class="dc-radio">
                                                    <input id="dc-spaces" type="radio" value="other" checked="" v-model="appointment_space" v-on:change="selectedSpace(appointment_space)">
                                                    <label for="dc-spaces">{{ trans('lang.other') }}</label>
                                                </span>
                                            </div>
                                            <div class="form-group form-group-half" v-if="is_show">
                                                <input type="text" id="custom_appt_spaces-{{$key}}" name="slots[appointment_spaces]" class="form-control" placeholder="{{ trans('lang.ph.appointment_spaces') }}">
                                            </div>
                                            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                                        </fieldset>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('backend_scripts')
<script>
$(".dc-spaces-wrap").each(function(){
  $(this).html($(this).children('li').sort(function(a, b){
  	return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;
  }));
});
</script>
@endpush
