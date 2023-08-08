<div class="preloader-section" v-if="is_loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<div class="dc-clearcache dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.menu_clear_cache') }}}</h3>
    </div>
    {!! Form::open(['class' =>'dc-formtheme dc-userform', 'id'
            =>'form-cache-clear', '@submit.prevent'=>'clearCache']) !!}
        <div class="dc-securitysettings dc-tabsinfo dc-sidepadding dc-haslayout">
            <div class="dc-settingscontent">
                <div class="dc-description">
                    <p>{{{ trans('lang.selected_cache_note') }}}</p>
                </div>
                <ul class="dc-accountinfo">
                    <li>
                        <switch_button v-model="clear_cache">{{{ trans('lang.clear_cache') }}}</switch_button>
                        <input type="hidden" :value="clear_cache" name="clear_cache">
                    </li>
                    <li>
                        <switch_button v-model="clear_views">{{{ trans('lang.clear_views') }}}</switch_button>
                        <input type="hidden" :value="clear_views" name="clear_views">
                    </li>
                    <li>
                        <switch_button v-model="clear_routes">{{{ trans('lang.clear_routes') }}}</switch_button>
                        <input type="hidden" :value="clear_routes" name="clear_routes">
                    </li>
                </ul>
            </div>
        </div>
    {!! Form::submit(trans('lang.btn_clear_selected_cache'), array('class' => 'dc-btn')) !!}
    {!! Form::close() !!}
</div>
<div class="dc-clearcache-all dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.clr_all_cache') }}}</h3>
    </div>
    {!! Form::open(['class' =>'dc-formtheme dc-userform', 'id'
        =>'cache-clear', '@submit.prevent'=>'clearAllCache']) !!}
        <div class="dc-securitysettings dc-sidepadding dc-tabsinfo dc-haslayout">
            <div class="dc-settingscontent">
                <div class="dc-description">
                    <p>{{{ trans('lang.clear_all_cache_note') }}}</p>
                </div>
            </div>
        </div>
    {!! Form::submit(trans('lang.btn_clear_all_cache'), array('class' => 'dc-btn')) !!}
    {!! Form::close() !!}
</div>
