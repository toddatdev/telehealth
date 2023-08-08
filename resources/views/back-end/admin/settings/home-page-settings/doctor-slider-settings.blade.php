{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-doctors-slider-form', '@submit.prevent'=>'submitHomeDoctorsSliderSettings'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('lang.doctors_slider_section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_doctors_slider">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_doctors_slider" name="show_doctors_slider">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        <span class="dc-select">
                            {!! Form::select('speciality', !empty($specialities) ? $specialities : array(), e($slider_speciality), ['class' => 'form-control', 
                            'placeholder' => trans('lang.ph.select_speciality')]) !!}
                        </span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
