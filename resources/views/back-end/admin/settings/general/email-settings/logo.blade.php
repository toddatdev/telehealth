<div class="dc-emaillogo dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.email_logo') }}}</h3>
    </div>
    <div class="dc-settingscontent">
        @if (!empty($email_logo)) 
            <upload-media
                :img="'{{ $email_logo }}'"
                :img_id="'email_logo'"
                :img_name="'email_logo'"
                :img_ref="'email_logo'"
                :img_hidden_name="'email_logo'"
                :img_hidden_id="'hidden_email_logo'"
                :existed_img="'{{$email_logo}}'"
                :url="'{{ url("media/upload-temp-image/settings/email_logo") }}'"
                :existing_img_url="'{{ url("uploads/settings/email-settings/".$email_logo) }}'"
                :size = "'{{ Helper::getImageDetail( $email_logo, 'size', 'uploads/settings/email-settings') }}'"
                >
            </upload-media>
        @else
            <upload-media
                :img="'email_logo'"
                :img_id="'email_logo'"
                :img_name="'email_logo'"
                :img_ref="'email_logo'"
                :img_hidden_name="'email_logo'"
                :img_hidden_id="'hidden_email_logo'"
                :url="'{{ url("media/upload-temp-image/settings/email_logo") }}'"
                >
            </upload-media>
        @endif
    </div>
</div>