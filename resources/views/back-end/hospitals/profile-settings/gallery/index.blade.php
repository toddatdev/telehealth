{!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'gallery-upload', '@submit.prevent'=>'uploadGallery("'.$user_role.'")'])!!}
    @include('back-end.hospitals.profile-settings.gallery.images')
    @include('back-end.hospitals.profile-settings.gallery.videos')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close(); !!}