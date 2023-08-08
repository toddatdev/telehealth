@php 
    $locations = App\Location::all(); 
    $roles     = Spatie\Permission\Models\Role::all()->toArray();
@endphp
<div class="dc-innerbanner-holder dc-haslayout" id="dc_search_bar">
    {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => '']) !!}
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dc-innerbanner">
                        <div class="dc-formtheme dc-form-advancedsearch dc-innerbannerform" style="padding: 30px 25px;">
			    <fieldset style="padding-right: 0px;">
				<h4 style="margin: 20px 0px 50px 5px;">Refine Research </h4>
                                <div class="form-group" style="width: 100%;">
                                    <input type="text" name="search" value="{{ !empty(request()->search) ? request()->search : '' }}" class="form-control" 
                                        placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
				</div>
				<div class="form-group">
	<div class="dc-select">
		<select data-placeholder="lang.select_speciality" name="speciality">
			<option value="">Select Speciality</option>
			<option value="general-practitioner">General Practitioner</option>
			<option value="acupuncturist">Acupuncturist</option>
			<option value="audiologist">Audiologist</option>
			<option value="bowen-therapist">Bowen Therapist</option>
			<option value="cardiologist">Cardiologist</option>
			<option value="chinese-medicine">Chinese Medicine</option>
			<option value="chiropractor">Chiropractor</option>
			<option value="counsellor">Counsellor</option>
			<option value="dentist">Dentist</option>
			<option value="dermatologist">Dermatologist</option>
			<option value="dietician">Dietician</option>
			<option value="exercise-physiologist">Exercise Physiologist</option>
			<option value="family-planning">Family Planning</option>
			<option value="health-coach">Health Coach</option>
			<option value="homeopath">Homeopath</option>
			<option value="medical-cannabis-specialist">Medical Cannabis Specialist</option>
			<option value="myotherapist">Myotherapist</option>
			<option value="naturopath">Naturopath</option>
			<option value="nurse">Nurse</option>
			<option value="nutritionist">Nutritionist</option>
			<option value="obstetrician">Obstetrician</option>
			<option value="occupational-therapist">Occupational Therapist</option>
			<option value="oncologist">Oncologist</option>
			<option value="optometrist">Optometrist</option>
			<option value="orthodontist">Orthodontist</option>
			<option value="osteopath">Osteopath</option>
			<option value="other">Other</option>
			<option value="paediatrician">Paediatrician</option>
			<option value="physiotherapist">Physiotherapist</option>
			<option value="plastic-surgeon">Plastic Surgeon</option>
			<option value="podiatrist">Podiatrist</option>
			<option value="psychologist">Psychologist</option>
			<option value="psychiatrist">Psychiatrist</option>
			<option value="rheumatologist">Rheumatologist</option>
			<option value="speech-pathologist">Speech Pathologist</option>
		</select>
	</div>
</div>
                                <div class="form-group" style="width: 100%;">
                                    <div class="dc-select">
					<select class="locations" data-placeholder="{{ trans('lang.select_country') }}" name="locations">
						<option value="">{{ trans('lang.select_country') }}</option>
						<option value="English">English</option>
                                            @foreach ($locations as $key => $location)
                                                <option value="{{{ clean($location->slug) }}}">{{{ html_entity_decode(clean($location->title)) }}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
				    <div class="dc-select">
					<select name="type">
	<option value="both" selected="selected">Gender</option>
	<option value="both">Any</option>
	<option value="male">Male</option>
	<option value="female">Female</option>
</select>
                                     <!--   <select name="type">
                                            @if (!empty($roles))
                                                <option value="both" selected>{{ trans('lang.both') }}</option>
                                                @foreach ($roles as $key => $role)
                                                    @if (!in_array($role['role_type'] == 'admin', $roles) && !in_array($role['role_type'] == 'regular', $roles))
                                                        @php $selected = !empty($_GET['type']) && $_GET['type'] == $role['role_type'] ? 'selected' : ''; @endphp
                                                        <option value="{{{$role['role_type']}}}" {{$selected}}>{{{ html_entity_decode(clean($role['name'])) }}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select> -->
                                    </div>
                                </div>
                                <div class="dc-btnarea" style="position: relative; text-align: center; width: 100%; margin: 30px 0px;">
                                    {!! Form::submit(trans('lang.search'), ['class' => 'dc-btn']) !!}
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! form::close(); !!}
</div>

