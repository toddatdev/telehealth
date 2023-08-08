{!! Form::open(['url' => '', 'class' =>'dc-formtheme', 'id' =>'submit-personal-details', '@submit.prevent'=>'submitPersonalDetails("'.$user_role.'")'])!!}
    @include('back-end.admin.profile-settings.personal-detail.detail') 
    @include('back-end.admin.profile-settings.personal-detail.media')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close(); !!}