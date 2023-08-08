<div class="dc-settingscontent dc-tabsinfo la-profilephoto">
    @if (!empty($galleries))
        <upload-media
        :title="'{{ trans('lang.images') }}'"
        :img="'gallery'"
        :img_id="'gallery'"
        :img_name="'gallery'"
        :img_ref="'gallery'"
        :img_hidden_name="'user_gallery'"
        :img_hidden_id="'hidden_gallery'"
        :url="'{{ url("media/upload-temp-image/users/gallery/profile_gallery") }}'"
        :no_of_files="10"
        :file_type="'gallery'">
        </upload-media>
        <div class="form-group form-group-label gallery gallery-image-area">
            <div class="la-gallery-image-holder">
                @foreach ($galleries as $key => $gallery)
                    @php 
                        if (file_exists(public_path('uploads/users/'.Auth::user()->id.'/gallery/images/'.$gallery))) {
                                $document_size = File::size(Helper::publicPath().'/uploads/users/'.Auth::user()->id.'/gallery/images/'.$gallery);
                        } else {
                                $document_size = 0;
                        }
                    @endphp
                    <div class="la-gallery-image">
                        <div class="dc-uploadingbox dz-image-preview dz-processing dz-success dz-complete" id="attachment-item-{{$key}}">
                            <figure><img src="{{asset('/uploads/users/'.Auth::user()->id.'/gallery/images/'.$gallery)}}" alt=""></figure>
                            <div class="dc-uploadingbar">
                                <div class="dz-filename">{{Helper::formateFileName($gallery)}}</div>
                                <span>{{ trans('lang.file_size') }} {{$document_size}}</span>
                                <a class="lnr lnr-cross" href="javascript:;" v-on:click.prevent="deleteAttachment('attachment-item-{{$key}}')"></a>
                            </div> 
                            <input type="hidden" value="{{$gallery}}" id="gallery-{{$key}}" class="hidden-file" name="images[{{$key}}]">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class = "dc-formtheme dc-userform">
            <upload-media
                :title="'{{ trans('lang.images') }}'"
                :img="'gallery'"
                :img_id="'gallery'"
                :img_name="'gallery'"
                :img_ref="'gallery'"
                :img_hidden_name="'user_gallery'"
                :img_hidden_id="'hidden_gallery'"
                :url="'{{ url("media/upload-temp-image/users/gallery/profile_gallery") }}'"
                :no_of_files="10"
                :file_type="'gallery'"
                >
            </upload-media>
            <div class="form-group form-group-label gallery gallery-image-area"></div>
        </div>
    @endif
</div>
