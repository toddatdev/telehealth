<div class="dc-tabscontenttitle">
    <h3>{{{ trans('lang.import_demo') }}}</h3>
</div>
{!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'import-demo']) !!}
    <div class="dc-selectdesign la-dc-demo">
        <ul>
            <li>
                <div class="dc-templateoption">
                    <div class="dc-designimg"><img src="{{ asset('images/demo-content/screenshot.jpg') }}" alt="{{ trans('lang.img') }}"></div>
                    <div class="la-designtitle-holder">
                        <div class="dc-designtitle">
                            <span>{{ trans('lang.preview_demo') }}</span>
                            <a target="_blank" href="http://amentotech.com/projects/doctroc" class="dc-btn">{{ trans('lang.btn_preview') }}</a>
                        </div>
                        <div class="dc-designtitle">
                            <span>{{ trans('lang.refresh_site') }}</span>
                            <a href="javascript:void(0)" v-on:click.prevent="importDemo('{{trans("lang.import_demo_content")}}')" class="dc-btn">{{ trans('lang.btn_import_demo') }}</a>
                        </div>
                        <div class="dc-designtitle">
                            <span>{{ trans('lang.remove_demo_content') }}</span>
                            <a href="javascript:void(0)" v-on:click.prevent="removeDemoContent('{{trans("lang.remove_demo_content")}}')" class="dc-btn">{{ trans('lang.btn_remove_demo') }}</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
{!! Form::close() !!}
