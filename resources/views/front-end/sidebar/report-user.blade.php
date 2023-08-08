<div class="dc-widget dc-reportform-holder">
    <div class="dc-widgettitle">
        <h3>{{ trans('lang.report_profile') }}</h3>
    </div>
    <div class="dc-widgetcontent">
        {!! Form::open(['class' =>'dc-formtheme dc-reportform', 'id' => 'submit-report',  '@submit.prevent'=>'submitReport("'.$user->id.'")']) !!}
            <div class="dc-appemail-form">
                {!! Form::text('name', null, ['class' => 'form-control', 'v-model' => 'report.name', 'placeholder' => trans('lang.name')]) !!}
            </div>
            <div class="dc-appemail-form">
                {!! Form::email('email', null, ['class' => 'form-control', 'v-model' => 'report.email', 'placeholder' => trans('lang.email')]) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'v-model' => 'report.description', 'placeholder' => trans('lang.desc')]) !!}
            </div>
            <div class="dc-btnarea">
                {!! Form::submit(trans('lang.report_now'), ['class' => 'dc-btn']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
