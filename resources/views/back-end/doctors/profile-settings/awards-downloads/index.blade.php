{!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'awards-downloads-form', '@submit.prevent'=>'submitAwardsDownloads'])!!}
<div class="dc-addawardsholder dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.awards_recogn') }}</h3>
    </div>
    <div class="dc-skillscontent-holder dc-doc-awards">
        <awards></awards>
    </div>
</div>
<div class="dc-bannerphoto dc-tabsinfo">
    <div class="dc-settingscontent dc-doc-downloads">
        @if (!empty($downloads))
            <upload-media
            :title="'{{ trans('lang.downloads') }}'"
            :img="'downloads'"
            :img_id="'downloads'"
            :img_name="'downloads'"
            :img_ref="'downloads'"
            :img_hidden_name="'hidden_downloads'"
            :img_hidden_id="'hidden_downloads'"
            :url="'{{ url("media/upload-temp-image/users/downloads/multiple_types") }}'"
            :file_type="'multiple_types'"
            :no_of_files=10>
            </upload-media>
            <div class="dc-downloads-files">
                <ul>
                    @foreach ($downloads as $key => $download)
                        @php 
                            if (file_exists(public_path('uploads/users/'.Auth::user()->id.'/'.$download))) {
                                    $document_size =  File::size(Helper::publicPath().'/uploads/users/'.Auth::user()->id.'/'.$download);
                            } else {
                                    $document_size = 0;
                            }
                        @endphp
                        <li id="attachment-item-{{$key}}">
                            <div class="dc-files-content">
                                <img src="{{{url('/images/file-icon.png')}}}">
                                <div class="dc-filecontent">
                                    <span>{{{Helper::formateFileName($download)}}}</span>
                                    <a href="javascript:void(0);" v-on:click.prevent="deleteAttachment('attachment-item-{{$key}}')" class="dc-closediv">
                                        <i class="lnr lnr-cross"></i>
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" value="{{{$download}}}" class="" name="attachments[{{$key}}]">
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <upload-media
                :title="'{{ trans('lang.downloads') }}'"
                :img="'downloads'"
                :img_id="'downloads'"
                :img_name="'downloads'"
                :img_ref="'downloads'"
                :img_hidden_name="'hidden_downloads'"
                :img_hidden_id="'hidden_downloads'"
                :url="'{{ url("media/upload-temp-image/users/downloads/multiple_types") }}'"
                :file_type="'multiple_types'"
                :no_of_files=10
                >
            </upload-media>
        @endif
    </div>
</div>
<div class="dc-experienceaccordion">
    <div class="dc-updatall la-updateall-holder">
        {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
    </div>
</div>
{!! Form::close(); !!}
