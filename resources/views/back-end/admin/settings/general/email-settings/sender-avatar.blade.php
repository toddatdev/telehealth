<div class="dc-emailavatar dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{{ trans('lang.email_sender_avatar') }}}</h3>
    </div>
    <div class="dc-settingscontent">
        @if (!empty($sender_avatar))
            <upload-media
                :img="'{{ $sender_avatar }}'"
                :img_id="'sender_avatar'"
                :img_name="'sender_avatar'"
                :img_ref="'sender_avatar'"
                :img_hidden_name="'sender_avatar'"
                :img_hidden_id="'hidden_sender_avatar'"
                :existed_img="'{{$sender_avatar}}'"
                :url="'{{ url("media/upload-temp-image/settings/sender_avatar") }}'"
                :existing_img_url="'{{ url("uploads/settings/email-settings/".$sender_avatar) }}'"
                :size = "'{{ Helper::getImageDetail( $sender_avatar, 'size', 'uploads/settings/email-settings') }}'"
                >
            </upload-media>
        @else
            <upload-media
                :img="'sender_avatar'"
                :img_id="'sender_avatar'"
                :img_name="'sender_avatar'"
                :img_ref="'sender_avatar'"
                :img_hidden_name="'sender_avatar'"
                :img_hidden_id="'hidden_sender_avatar'"
                :url="'{{ url("media/upload-temp-image/settings/sender_avatar") }}'"
                >
            </upload-media>
        @endif
    </div>
</div>