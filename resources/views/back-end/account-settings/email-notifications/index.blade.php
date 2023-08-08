<div class="dc-emailnoti">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.manage_email_notifications') }}</h3>
    </div>
    <div class="dc-settingscontent dc-sidepadding">
        <div class="dc-description">
            <p>{{ trans('lang.desc_email') }}</p>
        </div>
        {!! Form::open(['class' => 'dc-formtheme dc-userform']) !!}
            <fieldset>
                <div class="form-group form-disabeld">
                    {!! Form::email('email', e(Auth::user()->email), ['class' => 'form-control', 'placeholder' => trans('lang.your_email'), 'disabled' => 'disabled'] ) !!}
                </div>
            </fieldset>
        {!! Form::close(); !!}
    </div>
</div>
