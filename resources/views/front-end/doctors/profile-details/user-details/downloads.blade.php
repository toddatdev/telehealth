@if (!empty($downloads))
    <div class="dc-downloads-holder dc-aboutinfo">
        <div class="dc-infotitle">
            <h3>{{ trans('lang.downloads') }}</h3>
        </div>
        <ul class="dc-downloads-listing">
            @foreach ($downloads as $key => $download)
                <li id="attachment-item-{{$key}}">
                    <div class="dc-files-content">
                        <div class="dc-filecontent">
                            <a href="{{{route('getfile', ['type'=>'users', 'id'=>$user->id, 'attachment'=>$download])}}}">
                                <h3>
                                    {{{Helper::formateFileName($download)}}} 
                                    @if (file_exists(public_path('uploads/users/'.$user->id.'/'.$download)))
                                        <span> 
                                            {{ trans('lang.file_size') }} 
                                            {{{Helper::bytesToHuman(File::size(public_path('uploads/users/'.$user->id.'/'.$download)))}}} 
                                        </span>
                                    @endif
                                </h3>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif
