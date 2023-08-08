<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.your_details') }} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group form-group-half">
                {!! Form::text( 'first_name',  e(Auth::user()->first_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.first_name')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'last_name', e(Auth::user()->last_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.last_name')] ) !!}
            </div>
            <div class="form-group">
                {!! Form::text( 'subheading', e($sub_heading), ['class' =>'form-control', 'placeholder' => trans('lang.ph.sub_heading_optional')] ) !!}
            </div>
            <div class="form-group">
                {!! Form::text( 'description', e($description), ['class' =>'form-control', 'placeholder' => trans('lang.ph.short_description')] ) !!}
            </div>
        </fieldset>
    </div>
</div>
<div class="dc-working-time dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.working_time') }} </h3>
    </div>
    <div class="dc-sidepadding la-working-time">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group la-radio-holder">
                    <span class="dc-radio">
                        {!! Form::radio('working_time', '24_hours', 1, ['id' => 'working_time', '@change' => 'checkOther(check_other)', 'v-model' => 'check_other']) !!}    
                        {!! Form::label('working_time', trans('lang.working_time'), array()) !!}
                    </span>
                    <span class="dc-radio">
                        {!! Form::radio('working_time', 'other', 0, ['id' => 'others', '@change' => 'checkOther(check_other)', 'v-model' => 'check_other']) !!}    
                        {!! Form::label('others', 'others', array()) !!}
                    </span>
                </div>
                <div class="form-group">
                    <div v-if="show_other_time" v-cloak>
                        {!! Form::text('working_time', null, ['class' => 'form-control', 'placeholder' => trans('lang.add_other_time')]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="dc-working-days dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.working_days') }} </h3>
    </div>
    <div class="dc-sidepadding la-working-day">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group dc-checkbox-holder">
                    @foreach (Helper::getAppointmentDays() as $key => $day)
                        @php
                            $selected_days = in_array($day['title'], $available_days) ? 'checked' : '' ; 
                        @endphp
                        <span class="dc-checkbox">
                            <input id="{{ $key }}-day" type="checkbox" name="days[]" value="{{ html_entity_decode(clean($day['title'])) }}" {{$selected_days}}>
                            <label for="{{ $key }}-day"><span>{{ html_entity_decode(clean($day['name'])) }}</span></label> 
                        </span>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </div>
</div>
