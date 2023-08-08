<div class="dc-yourdetails dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.your_details') }} </h3>
    </div>
    <div class="dc-formtheme dc-userform">
        <fieldset>
            <div class="form-group form-group-half">
                <span class="dc-select">
                    {!! Form::select('base_name', Helper::getDoctorArray(), $gender_title, array()) !!}
                </span>
	    </div>
	    <div class="form-group form-group-half">
                <span class="dc-select">
                    {!! Form::select('gender_name', Helper::getGenderArray(), $gender, array()) !!}
                </span>
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'subheading', e($sub_heading), ['class' =>'form-control', 'placeholder' => trans('lang.ph.sub_heading_optional')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'first_name', e(Auth::user()->first_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.first_name')] ) !!}
            </div>
            <div class="form-group form-group-half">
                {!! Form::text( 'last_name', e(Auth::user()->last_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph.last_name')] ) !!}
            </div>
            <div class="form-group form-group-half">
		<input name="starting_price" type="hidden" value="100" class="form-control">
		{!! Form::email( 'email', e(Auth::user()->email), ['class' =>'form-control', 'placeholder' => trans('lang.ph.email')] ) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea( 'description', e($description), ['class' =>'form-control', 'placeholder' => trans('lang.ph.short_description')] ) !!}
            </div>
        </fieldset>
    </div>
</div>
