<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.your_details') }} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group form-group-half">
                {!! Form::text( 'first_name',  e(Auth::user()->first_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.first_name')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'last_name', e(Auth::user()->last_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.last_name')] ) !!}
	    </div>
	    <div class="form-group form-group-half">
                {!! Form::email( 'email', e(Auth::user()->email), ['class' =>'form-control', 'placeholder' => trans('lang.ph.email')] ) !!}
	    </div>
	    <div class="form-group form-group-half">
                {!! Form::number( 'phonenumber', e(Auth::user()->phonenumber), ['class' =>'form-control', 'placeholder' => 'Phone Number'] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::date( 'patientbirth', e(Auth::user()->patientbirth), ['class' =>'form-control', 'placeholder' => 'Date of Birth'] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::email( 'paypal_address', e(Auth::user()->paypal_address), ['class' =>'form-control', 'placeholder' => 'PayPal email address'] ) !!}
            </div>
            @include('back-end.regulars.profile-settings.personal-detail.location')
        </fieldset>
    </div>
</div>
