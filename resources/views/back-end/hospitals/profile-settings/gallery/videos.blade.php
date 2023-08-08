<div class="dc-doc-video dc-tabsinfo dc-formtheme dc-socials-form la-video-content">
    <fieldset class="video-content">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.videos') }}</h3>
        </div>
        @if (!empty($gallery_videos))
            @php $counter = 0 @endphp
            @foreach ($gallery_videos as $video_key => $mem_value)
                <div class="wrap-video dc-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            {!! Form::text('video['.$counter.'][url]', e($mem_value['url']),
                            ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group dc-rightarea">
                            @if ($video_key == 0 )
                                <span class="dc-addinfobtn" @click="addVideo"><i class="fa fa-plus"></i></span> 
                            @else
                                <span class="dc-addinfobtn dc-deleteinfo delete-video" data-check="{{{$counter}}}">
                                    <i class="fa fa-trash"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            <div class="wrap-video dc-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        {!! Form::text('video[0][url]', null, ['class' => 'form-control',
                            'placeholder' => trans('lang.video_url')])
                        !!}
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-addinfobtn" @click="addVideo"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
            </div>
        @endif
        <div v-for="(video, index) in videos" v-cloak>
            <div class="wrap-video dc-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        <input v-bind:name="'video['+[video.count]+'][url]'" type="text" class="form-control"
                            v-model="video.url" placeholder="{{trans('lang.video_url')}}">
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeVideo(index)"><i class="fa fa-trash"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
