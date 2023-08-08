{!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'submit-chat-form', '@submit.prevent'=>'submitChatSettings'])!!}
    <div class="dc-hostinfo dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.host') }}</h3>
        </div>
        <div class="dc-settingscontent">
            <div class="dc-description">
                <ol>
                    <li>{{ trans('lang.host_note_1') }}</li>
                    <li>{{ trans('lang.host_note_2') }}</li>
                </ol>
            </div>
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('host', e($host), array('class' => 'form-control', 'placeholder'=> trans('lang.host'))) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-portinfo dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.port') }}</h3>
        </div>
        <div class="dc-settingscontent">
            <div class="dc-description">
                {{ trans('lang.port_note_1') }}
                <ol>
                    <li>{{ trans('lang.port_note_2') }}</li>
                    <li>{{ trans('lang.port_note_3') }}</li>
                    <li>
                        {{ trans('lang.port_note_4') }}
                        {{ trans('lang.port_note_5') }}
                        {{ trans('lang.port_note_6') }}
                    </li>
                </ol>
            </div>
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::number('port', e($port), array('class' => 'form-control', 'placeholder'=>trans('lang.port'))) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'),['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
