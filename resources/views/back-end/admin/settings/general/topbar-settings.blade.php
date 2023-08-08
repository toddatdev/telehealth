{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'topbar-setting-form', '@submit.prevent'=>'submitTopBarSettings'])!!}
    <div class="dc-socialiconsetting dc-tabsinfo dc-haslayout">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.topbar') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-settingscontent">
                <div class="dc-description">
                    <p>{{{ trans('lang.enable_disable_topbar') }}}</p>
                </div>
                <ul class="dc-accountinfo">
                    <li>
                        <switch_button v-model="enable_topbar">
                            <span>{{{ trans('lang.show_hide_topbar') }}}</span>
                        </switch_button>
                        <input type="hidden" :value="enable_topbar" name="enable_topbar">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="dc-topbartitle dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.title') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', e($topbar_title), array('class' => 'form-control', 'placeholder'=>trans('lang.ph.title'))) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-phonenumber dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.phone_no') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-settingscontent">
                <div class="dc-formtheme dc-userform">
                    <fieldset>
                        <div class="form-group">
                            {!! Form::text('number', e($topbar_number), array('class' => 'form-control', 'placeholder'=>trans('lang.ph.number'))) !!}
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <div class="dc-socialiconsetting dc-tabsinfo dc-haslayout">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.social_icons') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-settingscontent">
                <div class="dc-description">
                    <p>{{{ trans('lang.enable_disable_topbar_socials') }}}</p>
                </div>
                <ul class="dc-accountinfo">
                    <li>
                        <switch_button v-model="enable_social_icons">
                            <span>{{{ trans('lang.enable_socials') }}}</span>
                        </switch_button>
                        <input type="hidden" :value="enable_social_icons" name="enable_social_icons">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
