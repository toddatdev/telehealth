<div class="dc-widget dc-mobileappoptions">
    @if (!empty($download_app_img))
        <figure class="dc-appimgs">
            <img src="{{ asset(Helper::getImage('uploads/settings/general', $download_app_img)) }}">
        </figure>
    @endif
    <div class="dc-mobileapp-content">
        @if (!empty($download_app_subtitle) 
            || !empty($download_app_title)
            || !empty($download_app_desc)
        )
            <div class="dc-title">
                <h3><span>{{ html_entity_decode(clean($download_app_subtitle)) }}</span> {{ html_entity_decode(clean($download_app_title)) }}</h3>
            </div>
            <div class="dc-description">
                <p>{{ html_entity_decode(clean($download_app_desc)) }}</p>
            </div>
        @endif
        {!! Form::open(['class' => 'dc-appemail-form', 'id' => 'download-app', '@submit.prevent' => 'sendAppLink']) !!}
            <input type="email" id="email" name="email" v-model="app.email" class="form-control" placeholder="{{ trans('lang.email_id') }}" required="">
            <button type="submit"><i class="fa fa-paper-plane"></i></button>
        {!! Form::close() !!}
    </div>
</div>
