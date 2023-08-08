@if (file_exists(resource_path('views/extend/back-end/admin/settings/general/email-settings/sender-avatar.blade.php'))) 
    @include('extend.back-end.admin.settings.general.email-settings.sender-avatar')
@else 
    @include('back-end.admin.settings.general.email-settings.sender-avatar')
@endif
<div class="dc-emailname dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.email_sender_name') }}}</h3>
    </div>
    <div class="dc-settingscontent dc-sidepadding">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group">
                    {!! Form::text('email_data[sender_name]', e($sender_name), array('class' => 'form-control')) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="dc-emailtagline dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.email_sender_tagline') }}}</h3>
    </div>
    <div class="dc-settingscontent dc-sidepadding">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group">
                    {!! Form::text('email_data[sender_tagline]', e($sender_tagline), array('class' => 'form-control')) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="dc-emailurl dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.email_sender_url') }}}</h3>
    </div>
    <div class="dc-settingscontent dc-sidepadding">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="form-group">
                    {!! Form::text('email_data[sender_url]', e($sender_url), array('class' => 'form-control')) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>
