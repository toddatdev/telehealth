<div class="la-inner-pages dc-haslayout">
    {!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'inner-page-form', '@submit.prevent'=>'submitInnerPage'])!!}
        <div class="dc-breadcrumbs dc-tabsinfo">
            <div class="dc-tabscontenttitle">
                <h3>{{{ trans('lang.breadcrumbs_option') }}}</h3>
            </div>
            <div class="dc-sidepadding">
                <div class="dc-description"><p>{{ trans('lang.breadcrumbs_option_note') }}</p></div>
                <switch_button v-model="enable_breadcrumbs">{{{ trans('lang.enable_disable') }}}</switch_button>
                <input type="hidden" :value="enable_breadcrumbs" name="inner_page[enable_breadcrumbs]">
            </div>
        </div>
        <div class="dc-breadcrumbs dc-tabsinfo">
            <div class="dc-tabscontenttitle">
                <h3>{{{ trans('lang.search_form') }}}</h3>
            </div>
            <div class="dc-sidepadding">
                <div class="dc-description"><p>{{ trans('lang.show_hide_search_form') }}</p></div>
                <switch_button v-model="show_search_form">{{{ trans('lang.show_hide_search_form') }}}</switch_button>
                <input type="hidden" :value="show_search_form" name="inner_page[show_search_form]">
            </div>
        </div>
        <div class="dc-doctorlisting dc-tabsinfo">
            <div class="dc-tabscontenttitle">
                <h3>{{{ trans('lang.search_listing') }}}</h3>
            </div>
            <div class="dc-sidepadding">
                <div class="dc-settingscontent">
                    <div class="dc-description"><p>{{ trans('lang.seo_meta_title') }}</p></div>
                    <div class="dc-formtheme dc-userform">
                        <fieldset>
                            <div class="form-group">
                                {!! Form::text('inner_page[search_list_meta_title]', e($search_list_meta_title), array('class' => 'form-control')) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="dc-settingscontent">
                    <div class="dc-description"><p>{{ trans('lang.seo_meta_desc') }}</p></div>
                    <div class="dc-formtheme dc-userform">
                        <fieldset>
                            <div class="form-group">
                                {!! Form::textarea('inner_page[search_list_meta_desc]', e($search_list_meta_desc), array('class' => 'form-control')) !!}
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
</div>
