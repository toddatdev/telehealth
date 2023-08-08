<div class="dc-widget dc-mobileappoptions">
    <figure class="dc-appimgs">
        <img src="{{ asset(Helper::getImage('uploads/settings/general', $download_app_img, '', 'def-sidebar-2.jpg')) }}">
    </figure>
    <div class="dc-mobileapp-content">
        @if (!empty($download_app_subtitle) 
            || !empty($download_app_title)
            || !empty($download_app_desc)
        )
            <div class="dc-title">
                <h3><span>{{ clean($download_app_subtitle) }}</span> {{ clean($download_app_title) }}</h3>
            </div>
            <div class="dc-description">
                <p>{{ clean($download_app_desc) }}</p>
            </div>
        @endif
        {!! Form::open(['class' => 'dc-appemail-form', 'id' => 'download-app', '@submit.prevent' => 'sendAppLink']) !!}
            <input type="email" id="email" name="email" value="{{ !empty(request()->email) ? request()->email : '' }}" class="form-control" placeholder="{{ trans('lang.email_id') }}" required="">
            <button type="submit"><i class="fa fa-paper-plane"></i></button>
        {!! Form::close() !!}
    </div>
</div>
