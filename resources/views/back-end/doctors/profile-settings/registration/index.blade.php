<div class="dc-bannerphoto dc-doc-registration">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.registration_nmbr') }}</h3>
    </div>
    <div class="dc-profilephotocontent">
        <div class="dc-description">
            <p>{{ trans('lang.registration_desc') }}</p>
        </div>
        {!! Form::open(['url' => '',
            'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory','id' =>'submit-registration-details', '@submit.prevent'=>'submitRegistrationDetails'] )
        !!}
            <fieldset>
                <div class="form-group">
                    {!! Form::text( 'registration_number', e($registration_number), ['class' =>'form-control', 'placeholder' => trans('lang.registration_nmbr')] ) !!}
                </div>
                <div class="dc-settingscontent dc-dbsectionspace">
                    @if (!empty($registration_document))
                        <upload-media
                        :title="'{{ trans('lang.upload_document') }}'"
                        :img="'{{ $registration_document}}'"
                        :img_id="'registration_document'"
                        :img_name="'registration_document'"
                        :img_ref="'registration_document'"
                        :img_hidden_name="'registration_document'"
                        :img_hidden_id="'hidden_registration_document'"
                        :existed_img="'{{$registration_document}}'"
                        :url="'{{ url("media/upload-temp-image/users/registration_document/multiple_types") }}'"
                        :existing_img_url="'{{ url('uploads/users/'.Auth::user()->id.'/'.$registration_document) }}'"
                        :file_type="'multiple_types'"
                        >
                        </upload-media>
                    @else
                        <upload-media
                            :title="'{{ trans('lang.upload_document') }}'"
                            :img="'registration_document'"
                            :img_id="'registration_document'"
                            :img_name="'registration_document'"
                            :img_ref="'registration_document'"
                            :img_hidden_name="'registration_document'"
                            :img_hidden_id="'hidden_registration_document'"
                            :url="'{{ url("media/upload-temp-image/users/registration_document/multiple_types") }}'"
                            :file_type="'multiple_types'"
                            >
                        </upload-media>
                    @endif
                </div>
            </fieldset>
            <div class="dc-experienceaccordion">
                <div class="dc-updatall la-updateall-holder">
                    {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
                </div>
            </div>
        {!! Form::close(); !!}
    </div>
</div>
