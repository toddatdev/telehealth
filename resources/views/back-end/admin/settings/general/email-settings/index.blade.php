{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'email-setting-form', '@submit.prevent'=>'submitEmailSettings'])!!}
    <div class="dc-emailid dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.from_email_id') }}}</h3>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('email_data[from_email]', e($from_email), array('class' => 'form-control')) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-mailname dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.from_email_name') }}}</h3>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('email_data[from_email_id]', e($from_email_id), array('class' => 'form-control')) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/general/email-settings/logo.blade.php')))
        @include('extend.back-end.admin.settings.general.email-settings.logo')
    @else
        @include('back-end.admin.settings.general.email-settings.logo')
    @endif
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/general/email-settings/banner.blade.php')))
        @include('extend.back-end.admin.settings.general.email-settings.banner')
    @else
        @include('back-end.admin.settings.general.email-settings.banner')
    @endif
    @if (file_exists(resource_path('views/extend/back-end/admin/settings/general/email-settings/signature.blade.php')))
        @include('extend.back-end.admin.settings.general.email-settings.signature')
    @else
        @include('back-end.admin.settings.general.email-settings.signature')
    @endif
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'),['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
