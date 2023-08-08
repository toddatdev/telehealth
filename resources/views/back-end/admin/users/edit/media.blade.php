<div class="dc-settingscontent dc-tabsinfo la-profilephoto">
    @if (!empty($avatar))
        <upload-media
        :title="'{{ trans('lang.profile_photo') }}'"
        :img="'{{ $avatar }}'"
        :img_id="'avatar_img'"
        :img_name="'avatar_img'"
        :img_ref="'avatar_img'"
        :img_hidden_name="'avatar_img'"
        :img_hidden_id="'hidden_avatar_img'"
        :existed_img="'{{$avatar}}'"
        :url="'{{ url("media/upload-temp-image/users/avatar_img/profile_img") }}'"
        :existing_img_url="'{{ url('uploads/users/'.$id.'/'.$avatar.'') }}'"
        :size = "'{{ Helper::getImageDetail( $avatar, 'size', 'uploads/users/'.$id) }}'"
        :existing_img_name = "'{{ Helper::getImageDetail( $avatar, 'name', 'uploads/users/'.$id) }}'"
        >
        </upload-media>
    @else
        <div class = "dc-formtheme dc-userform">
            <upload-media
            :title="'{{ trans('lang.profile_photo') }}'"
            :img="'avatar_img'"
            :img_id="'avatar_img'"
            :img_name="'avatar_img'"
            :img_ref="'avatar_img'"
            :img_hidden_name="'avatar_img'"
            :img_hidden_id="'hidden_avatar_img'"
            :url="'{{ url("media/upload-temp-image/users/avatar_img/profile_img") }}'"
            >
            </upload-media>
        </div>
    @endif
</div>
<div class="dc-settingscontent dc-tabsinfo">
    @if (!empty($banner))
        <upload-media
        :title="'{{ trans('lang.banner_photo') }}'"
        :img="'{{ $banner }}'"
        :img_id="'avatar_banner_img'"
        :img_name="'avatar_banner_img'"
        :img_ref="'avatar_banner_img'"
        :img_hidden_name="'avatar_banner_img'"
        :img_hidden_id="'hidden_avatar_banner_img'"
        :existed_img="'{{$banner}}'"
        :url="'{{ url("media/upload-temp-image/users/avatar_banner_img/profile_banner") }}'"
        :existing_img_url="'{{ url('uploads/users/'.$id.'/'.$banner.'') }}'"
        :size = "'{{ Helper::getImageDetail( $banner, 'size', 'uploads/users/' .$id) }}'"
        :existing_img_name = "'{{ Helper::getImageDetail( $banner, 'name', 'uploads/users/' .$id) }}'"
        >
        </upload-media>
    @else
    <div class = "dc-formtheme dc-userform">
        <upload-media
        :title="'{{ trans('lang.banner_photo') }}'"
        :img="'avatar_banner_img'"
        :img_id="'avatar_banner_img'"
        :img_name="'avatar_banner_img'"
        :img_ref="'avatar_banner_img'"
        :img_hidden_name="'avatar_banner_img'"
        :img_hidden_id="'hidden_avatar_banner_img'"
        :url="'{{ url("media/upload-temp-image/users/avatar_banner_img/profile_banner") }}'"
        >
        </upload-media>
    </div>
    @endif
</div>

