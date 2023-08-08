{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id'=>'home-services-tabs-form', '@submit.prevent'=>'submitServicesTabSettings']) !!}
    <div class="dc-sectionsettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('lang.services_settings') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_services_section">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_services_section" name="show_services_section">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="service-tab-content">
                    @if (!empty($tabs_unserialize_array))
                        @php $counter = 0 @endphp
                        @foreach ($tabs_unserialize_array as $key => $value)
                            <div class="wrap-tab-icons dc-haslayout">
                                <div class="form-group-holder">
                                    <div class="form-group form-group-half">
                                        {!! Form::text('service_tab['.$counter.'][title]', e($value['title']),
                                        ['class' => 'form-control', 'placeholder' => trans('lang.ph.title')]) !!}
                                    </div>
                                    <div class="form-group form-group-half">
                                        {!! Form::text('service_tab['.$counter.'][subtitle]', e($value['subtitle']),
                                        ['class' => 'form-control', 'placeholder' => trans('lang.ph.subtitle')]) !!}
                                    </div>
                                    <div class="form-group form-group-half">
                                        {!! Form::text('service_tab['.$counter.'][btn_title]', e($value['btn_title']),
                                        ['class' => 'form-control', 'placeholder' => trans('lang.ph.btn_title') ]) !!}
                                    </div>
                                    <div class="form-group form-group-half">
                                        {!! Form::text('service_tab['.$counter.'][btn_url]', $value['btn_url'],
                                        ['class' => 'form-control', 'placeholder' => trans('lang.ph.btn_url')]) !!}
                                    </div>
                                    <div class="form-group la-color-picker">
                                        <verte display="widget" v-model="stored_colors.color{{$key}}" menuPosition="left" model="hex"></verte>
                                        <input type="hidden" name="service_tab[{{{$counter}}}][color]" :value="stored_colors.color{{$key}}">
                                    </div>
                                    <div class="form-group dc-rightarea">
                                        @if ($key == 0 )
                                            <span class="dc-addinfobtn" @click="addServiceTab"><i class="fa fa-plus"></i></span>
                                        @else
                                            <span class="dc-addinfobtn dc-deleteinfo delete-tab" data-check="{{{$counter}}}">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @php $counter++; @endphp
                        @endforeach
                    @else
                        <div class="wrap-tab-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group form-group-half">
                                    {!! Form::text('service_tab[0][title]', null, ['class' => 'form-control',
                                    'placeholder' => trans('lang.ph.title'),'v-model' => 'first_service_tab_title']) !!}
                                </div>
                                <div class="form-group form-group-half">
                                    {!! Form::text('service_tab[0][subtitle]', null, ['class' => 'form-control',
                                    'placeholder' => trans('lang.ph.subtitle'),'v-model' => 'first_service_tab_subtitle']) !!}
                                </div>
                                <div class="form-group form-group-half">
                                    {!! Form::text('service_tab[0][btn_title]', null, ['class' => 'form-control',
                                    'placeholder' => trans('lang.ph.btn_title'),'v-model' => 'first_service_tab_btn_title']) !!}
                                </div>
                                <div class="form-group form-group-half">
                                    {!! Form::text('service_tab[0][btn_url]', null, ['class' => 'form-control',
                                    'placeholder' => trans('lang.ph.btn_url'),'v-model' => 'first_service_tab_btn_url']) !!}
                                </div>
                                <div class="form-group la-color-picker">
                                    <verte display="widget" v-model="first_service_tab_color" menuPosition="left" model="hex"></verte>
                                    <input type="hidden" name="service_tab[0][color]" :value="color">
                                </div>
                            </div>
                            <div class="form-group dc-rightarea">
                                <span class="dc-addinfo" @click="addServiceTab"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                    @endif
                        <div v-for="(service_tab, index) in service_tabs" v-cloak>
                            <div class="wrap-tab-icons dc-haslayout">
                                <div class="form-group-holder">
                                    <div class="form-group form-group-half">
                                        <input placeholder="{{{trans('lang.ph.title')}}}" v-bind:name="'service_tab['+[service_tab.count]+'][title]'" type="text" class="form-control"
                                            v-model="service_tab.service_tab_title">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <input placeholder="{{{trans('lang.ph.subtitle')}}}" v-bind:name="'service_tab['+[service_tab.count]+'][subtitle]'" type="text" class="form-control"
                                            v-model="service_tab.service_tab_subtitle">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <input placeholder="{{{trans('lang.ph.btn_title')}}}" v-bind:name="'service_tab['+[service_tab.count]+'][btn_title]'" type="text" class="form-control"
                                            v-model="service_tab.service_tab_btn_title">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <input placeholder="{{{trans('lang.ph.btn_url')}}}" v-bind:name="'service_tab['+[service_tab.count]+'][btn_url]'" type="text" class="form-control"
                                            v-model="service_tab.service_tab_btn_url">
                                    </div>
                                    <div class="form-group la-color-picker">
                                        <verte display="widget" v-model="service_tab.color" menuPosition="left" model="hex"></verte>
                                        <input type="hidden" v-bind:name="'service_tab['+[service_tab.count]+'][color]'" :value="service_tab.color">
                                    </div>
                                    <div class="form-group dc-rightarea">
                                        <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeServiceTab(index)"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </fieldset>
            </div>
        </div>
        <div class="dc-experienceaccordion">
            <div class="dc-updatall la-btn-setting">
                {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
