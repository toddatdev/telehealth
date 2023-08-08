<div class="preloader-section" v-if="is_loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform la-dashboard-icons', 'id'
=>'upload_dashboard_icon', '@submit.prevent'=>'uploadDashboardIcons']) !!}
@foreach ($icons as $key => $icon)
    <div class="dc-dashboardicons dc-tabsinfo">
        <div class="dc-selectdesign la-selectthemecolor">
            @if (!empty($dash_icons['hidden_'.$key]))
                <dashboard-icon
                :title="'{{$icon['title']}}'"
                :icon="'{{$icon['value']}}'"
                :icon_id="'{{$icon['value']}}'"
                :icon_name="'{{$icon['value']}}'"
                :icon_ref="'{{$icon['value']}}'"
                :icon_hidden_name="'icons[hidden_{{$icon['value']}}][hidden_{{$icon['value']}}]'"
                icon_hidden_id="'hidden_{{$icon['value']}}'"
                :existed_icon="'{{$dash_icons['hidden_'.$key]}}'"
                :size = "'{{ Helper::getImageDetail( $dash_icons['hidden_'.$key], 'size', 'uploads/settings/icon') }}'"
                >
                </dashboard-icon>
            @else
                <dashboard-icon
                :title="'{{$icon['title']}}'"
                :icon="'{{$icon['value']}}'"
                :icon_id="'{{$icon['value']}}'"
                :icon_name="'{{$icon['value']}}'"
                :icon_ref="'{{$icon['value']}}'"
                :icon_hidden_name="'icons[hidden_{{$icon['value']}}][hidden_{{$icon['value']}}]'"
                icon_hidden_id="'hidden_{{$icon['value']}}'"
                >
                </dashboard-icon>
            @endif
        </div>
    </div>
@endforeach
<div class="dc-experienceaccordion">
    <div class="dc-updatall la-updateall-holder">
        {!! Form::submit(trans('lang.btn_save'),['class' => 'dc-btn']) !!}
    </div>
</div>
{!! Form::close() !!}
