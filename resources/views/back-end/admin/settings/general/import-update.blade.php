{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'import-update-form', '@submit.prevent'=>'importUpdate'])!!}
    <div class="dc-socialiconsetting dc-tabsinfo dc-haslayout">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.import_update') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-settingscontent">
                <div class="dc-description">
                    <p>{{{ trans('lang.import_update_desc') }}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
