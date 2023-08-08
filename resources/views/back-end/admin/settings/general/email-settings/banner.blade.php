<div class="dc-location dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.email_banner') }}}</h3>
    </div>
    <div class="dc-settingscontent">
        @if (!empty($email_banner)) 
            <upload-media
                :img="'{{ $email_banner }}'"
                :img_id="'email_banner'"
                :img_name="'email_banner'"
                :img_ref="'email_banner'"
                :img_hidden_name="'email_banner'"
                :img_hidden_id="'hidden_email_banner'"
                :existed_img="'{{$email_banner}}'"
                :url="'{{ url("media/upload-temp-image/settings/email_banner") }}'"
                :existing_img_url="'{{ url("uploads/settings/email-settings/".$email_banner) }}'"
                :size = "'{{ Helper::getImageDetail( $email_banner, 'size', 'uploads/settings/email-settings') }}'"
                :width="600"
                >
            </upload-media>
        @else
            <upload-media
                :img="'email_banner'"
                :img_id="'email_banner'"
                :img_name="'email_banner'"
                :img_ref="'email_banner'"
                :img_hidden_name="'email_banner'"
                :img_hidden_id="'hidden_email_banner'"
                :url="'{{ url("media/upload-temp-image/settings/email_banner") }}'"
                :width="600"
                >
            </upload-media>
        @endif
    </div>
</div>