{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-addexperience dc-tabsinfo', 'id' => 'experience-form', '@submit.prevent' => 'submitExperiences']) !!}
    @include('back-end.doctors.profile-settings.experience-education.experience')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
{!! Form::open(['class' => 'dc-formtheme dc-addeducation', 'id' => 'education-form', '@submit.prevent' => 'submitEducations']) !!}
    @include('back-end.doctors.profile-settings.experience-education.education')
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
