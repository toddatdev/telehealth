{!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'paypal-form', '@submit.prevent'=>'submitPaypalSettings'])!!}
    <div class="dc-paypalsettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{{ trans('lang.paypal_settings') }}}</h3>
            <switch_button v-model="enable_sandbox">{{{ trans('lang.enable_sandbox') }}}</switch_button>
            <input type="hidden" :value="enable_sandbox" name="enable_sandbox">
        </div>
        <div class="dc-sidepadding">
            <div class="dc-settingscontent">
                <div class="dc-formtheme dc-userform">
                    <div class="form-group">
                        {!! Form::text('client_id', e($client_id), ['class' => 'form-control', 'placeholder' => trans('lang.ph_paypal_id')]) !!}
                    </div>
                </div>
            </div>
            <div class="dc-settingscontent">
                <div class="dc-formtheme dc-userform">
                    <div class="form-group">
                        {{{Form::input('password', 'paypal_password', e($payment_password), ['class' => 'form-control', 'placeholder' => trans('lang.ph_paypal_pass')])}}}
                    </div>
                </div>
            </div>
            <div class="dc-settingscontent">
                <div class="dc-formtheme dc-userform">
                    <div class="form-group">
                        {{{Form::input('password', 'paypal_secret', e($existing_payment_secret), ['class' => 'form-control', 'placeholder' => trans('lang.ph_paypal_secret')])}}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder mb-5 mt-0">
            {!! Form::submit(trans('lang.btn_save'),['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
