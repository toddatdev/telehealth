<div class="dc-accountdel">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.delete_account') }}</h3>
    </div>
    <div class="dc-tabsinfo dc-sidepadding">
        {!! Form::open(['class' =>'dc-formtheme dc-userform delete-user-form', '@submit.prevent' => 'deleteAccount($event)', 'id' => 'delete_acc_form' ])!!}
            <fieldset>
                <div class="form-group form-group-half">
                    {!! Form::password('old_password', ['class' => 'form-control','placeholder' => 'Password']) !!}
                </div>
                <div class="form-group form-group-half">
                    {!! Form::password('retype_password', ['class' => 'form-control','placeholder' => trans('lang.ph.retype_pass')]) !!}
                </div>
                <div class="form-group">
                    <span class="dc-select">
                        {!! Form::select('delete_reason', Helper::getDeleteAccReason(), null, array('placeholder' => trans('lang.ph.select_reason'))) !!}
                    </span>
                </div>
                <div class="form-group">
                    <textarea name="delete_description" class="form-control" placeholder="{{{ trans('lang.ph.desc_optional') }}}"></textarea>
                </div>
                <div class="form-group form-group-half dc-btnarea">
                    {!! Form::submit(trans('lang.delete_account'), ['class' => 'dc-btn']) !!}
                </div>
            </fieldset>
        {!! Form::close() !!}
    </div>
</div>
