{!! Form::open(['class' =>'dc-formtheme dc-userform dc-stripe-form', 'id' =>'stripe-form', '@submit.prevent'=>'submitStripeSettings'])!!}
    <div class="dc-stripesettings dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.stripe_settings') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-settingscontent">
                <div class="dc-formtheme dc-userform">
                    <fieldset>
                        <div class="form-group">
                            {!! Form::text('stripe_key', e($stripe_key), ['class' => 'form-control', 'placeholder' => trans('lang.stripe_key')]) !!}
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="dc-settingscontent">
                <div class="dc-formtheme dc-userform">
                    <fieldset>
                        <div class="form-group">
                            {!! Form::text('stripe_secret', e($stripe_secret), ['class' => 'form-control', 'placeholder' => trans('lang.stripe_secret')]) !!}
                        </div>
                    </fieldset>
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
