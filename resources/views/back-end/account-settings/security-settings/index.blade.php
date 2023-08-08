{!! Form::open(['url' => url('profile/settings/save-account-settings'), 'class' =>'dc-formtheme dc-userform'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.accnt_security_setting') }}</h3>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-description">
                <p>{{ trans('lang.desc_accnt_security') }}</p>
            </div>
            <ul class="dc-accountinfo">
                <li>
                    <switch_button v-model="profile_searchable">{{{ trans('lang.profile_searchable') }}}</switch_button>
                    <input type="hidden" :value="profile_searchable" name="profile_searchable">
                </li>
                <li>
                    <switch_button v-model="disable_account">{{{ trans('lang.disable_accnt_temp') }}}</switch_button>
                    <input type="hidden" :value="disable_account" name="disable_account">
                </li>
            </ul>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall">
            <i class="ti-announcement"></i>
            <span>{{ trans('lang.update_all_note') }}</span>
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
