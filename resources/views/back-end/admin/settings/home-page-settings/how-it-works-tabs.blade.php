{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-dbsectionspace', 'id'=>'home-hwtabs-section-form', '@submit.prevent'=>'submitHwTabSectionSettings']) !!}
<div class="dc-securitysettings dc-hwtabsinfo">
    <div class="dc-tabscontenttitle la-switch-option">
        <h3>{{ trans('lang.hw_section_tabs') }}</h3>
        <div class="float-right">
            <switch_button v-model="show_hwtabs">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
            <input type="hidden" :value="show_hwtabs" name="show_hwtabs">
        </div>
    </div>
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset class="how-it-tab-area">
                @if (!empty($home_how_works_tabs))
                    @php $counter = 0; @endphp
                    @foreach ($home_how_works_tabs as $key => $value)
                        <div class="wrap-hwtabs-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group">
                                    {!! Form::text('tabs['.$counter.'][title]', e($value['title']),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.title')]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::text('tabs['.$counter.'][subtitle]', e($value['subtitle']),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.subtitle')]) !!}
                                </div>
                                <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                                    <div class = "dc-formtheme dc-userform">
                                         @if (!empty($value['tab_img']))
                                            <upload-media
                                            :img="'{{{ $value['tab_img'] }}}'"
                                            :img_id="'tab_img-{{{ $counter }}}'"
                                            :img_name="'tabs[{{{ $counter }}}][tab_img]'"
                                            :img_ref="'tab_img-{{{ $counter }}}'"
                                            :img_hidden_name="'tabs[{{{ $counter }}}][tab_img]'"
                                            :img_hidden_id="'hidden_tab_img-{{{ $counter }}}'"
                                            :existed_img="'{{ $value['tab_img'] }}'"
                                            :url="'{{ url("media/upload-temp-image/settings/tabs.$counter.tab_img") }}'"
                                            :existing_img_url="'{{ url("uploads/settings/home/".$value['tab_img']) }}'"
                                            :size = "'{{ Helper::getImageDetail( $value['tab_img'], 'size', 'uploads/settings/home') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $value['tab_img'], 'name', 'uploads/settings/home') }}'"
                                            >
                                            </upload-media>
                                        @else
                                            <upload-media
                                            :img="'tabs[{{{ $counter }}}][tab_img]'"
                                            :img_id="'tab_img-{{{ $counter }}}'"
                                            :img_name="'tabs[{{{ $counter }}}][tab_img]'"
                                            :img_ref="'tab_img-{{{ $counter }}}'"
                                            :img_hidden_name="'tabs[{{{ $counter }}}][tab_img]'"
                                            :img_hidden_id="'hidden_tab_img-{{{ $counter }}}'"
                                            :url="'{{ url("media/upload-temp-image/settings/tabs.$counter.tab_img]") }}'"
                                            >
                                            </upload-media>
                                         @endif
                                    </div>
                                </div>
                                <div class="form-group dc-rightarea">
                                    @if ($key == 0 )
                                        <span class="dc-addinfobtn" @click="addHwTab"><i class="fa fa-plus"></i>{{ trans('lang.add_more') }}</span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-hwtab" data-check="{{{ $counter }}}">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                @else
                    <div class="wrap-hwtabs-icons dc-haslayout">
                        <div class="form-group-holder">
                            <div class="form-group">
                                {!! Form::text('tabs[0][title]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.title')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('tabs[0][subtitle]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.subtitle')]) !!}
                            </div>
                            <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                                <div class = "dc-formtheme dc-userform">
                                     @if (!empty($hw_tab_img))
                                        <upload-media
                                        :img="'{{ $hw_tab_img }}'"
                                        :img_id="'tab_img-0'"
                                        :img_name="'tabs[0][tab_img]'"
                                        :img_ref="'tab_img-0'"
                                        :img_hidden_name="'tabs[0][tab_img]'"
                                        :img_hidden_id="'hidden_tab_img-0'"
                                        :existed_img="'{{$hw_tab_img}}'"
                                        :url="'{{ url("media/upload-temp-image/settings/tabs.0.tab_img") }}'"
                                        :existing_img_url="'{{ url("uploads/settings/home/$hw_tab_img") }}'"
                                        >
                                        </upload-media>
                                    @else
                                        <upload-media
                                        :img="'tabs[0][tab_img]'"
                                        :img_id="'tab_img-0'"
                                        :img_name="'tabs[0][tab_img]'"
                                        :img_ref="'tab_img-0'"
                                        :img_hidden_name="'tabs[0][tab_img]'"
                                        :img_hidden_id="'hidden_tab_img-0'"
                                        :url="'{{ url("media/upload-temp-image/settings/tabs.0.tab_img") }}'"
                                        >
                                        </upload-media>
                                     @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfobtn" @click="addHwTab"><i class="fa fa-plus"></i>{{ trans('lang.add_more') }}</span>
                        </div>
                    </div>
                @endif
                <div class="wrap-hwtabs-icons dc-haslayout" v-for="(hwtab, index) in hwtabs" ref="howlistelement" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group">
                            <input placeholder="{{{trans('lang.ph.title')}}}" v-bind:name="'tabs['+[hwtab.count]+'][title]'" type="text" class="form-control"
                                v-model="hwtab.tab_title">
                        </div>
                        <div class="form-group">
                            <input placeholder="{{{trans('lang.ph.subtitle')}}}" v-bind:name="'tabs['+[hwtab.count]+'][subtitle]'" type="text" class="form-control"
                                v-model="hwtab.tab_subtitle">
                        </div>
                        <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                            <div class = "dc-formtheme dc-userform">
                                <upload-media
                                    :img="'tab_img'"
                                    :img_id="'tab_img-'+hwtab.count"
                                    :img_name="'tabs['+[hwtab.count]+'][tab_img]'"
                                    :img_ref="'tab_img-'+hwtab.count"
                                    :img_hidden_name="'tabs['+[hwtab.count]+'][tab_img]'"
                                    :img_hidden_id="'hidden_tab_img-'+hwtab.count"
                                    :url="'{{ url("media/upload-temp-image/settings/tabs.'+[hwtab.count]+'.tab_img") }}'"
                                    >
                                </upload-media>
                            </div>
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeHwTab(index)"><i class="fa fa-trash"></i></span>
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
