@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <section class="dc-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9" id="dashboard">
                <div class="dc-dashboardbox dc-dashboardtabsholder dc-saveitemholder">
                    <div class="dc-dashboardtabs">
                        <ul class="dc-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="active" data-toggle="tab" href="#dc-doctors">{{ trans('lang.saved_doctors') }}</a>
                            </li>
                            <li class="nav-item"><a data-toggle="tab" href="#dc-hospitals">{{ trans('lang.saved_hospitals') }}</a></li>
                        </ul>
                    </div>
                    <div class="dc-tabscontent tab-content">
                        <div class="dc-personalskillshold tab-pane active fade show" id="dc-doctors">
                            <div class="dc-yourdetails">
                                <div class="dc-tabscontenttitle">
                                    <h3>{{ trans('lang.saved_doctors') }}</h3>
                                </div>
                                <div class="dc-sidepadding">
                                    <div class="row">
                                        @if (!empty($saved_doctors))
                                            @foreach ($saved_doctors as $key => $user_id)
                                                @php 
                                                    $user_obj = App\User::find($user_id); 
                                                    $avg_rating = \App\Feedback::where('user_id', $user_obj->id)->pluck('avg_rating')->first();
                                                    $stars  = $avg_rating != 0 ? $avg_rating/5*100 : 0;
                                                    $specialities = DB::table('user_service')->select('speciality')
                                                        ->where('user_id', $user_obj->id)->groupBy('speciality')->get()->pluck('speciality')->random(1)->toArray();
                                                @endphp
                                                <div class="dc-docpostholder la-docpostholder">
                                                    <div class="dc-docpostcontent">
                                                        <div class="dc-searchvtwo">
                                                            <figure class="dc-docpostimg">
                                                                <img src="{{ asset(Helper::getImage('uploads/users/'.$user_obj->id, $user_obj->profile->avatar, 'saved_items-', 'user-logo-def.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                            </figure>
                                                            <div class="dc-title">
                                                                @if (!empty($specialities))
                                                                    @foreach ($specialities as $key => $user_speciality)
                                                                        @php $speciality = Helper::getSpecialityByID($user_speciality); @endphp
                                                                        @if (!empty($speciality))
                                                                            <a href="{{ url('/search-results?type=hospital&speciality='.clean($speciality->slug)) }}" class="dc-docstatus">{{ html_entity_decode(clean($speciality->title)) }}</a>  
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <h3>
                                                                    <a href="{{ route('userProfile', ['slug' => $user_obj->slug]) }}">
                                                                        {{ !empty($user_obj->profile->gender_title) ? Helper::getDoctorArray(clean($user_obj->profile->gender_title)) : '' }}
                                                                        {{Helper::getUsername($user_obj->id)}} 
                                                                    </a>
                                                                    {{ Helper::verifyUser(intVal(clean($user_obj->id))) }} {{ Helper::verifyMedical(intVal(clean($user_obj->id))) }}
                                                                </h3>
                                                                <ul class="dc-docinfo">
                                                                    <li><em>{{ html_entity_decode(clean($user_obj->profile->tagline)) }}</em></li>
                                                                    <li><span class="dc-stars"><span style="width: {{ clean($stars) }}%;"></span></span><em>{{ clean($user_obj->feedbacks->count()) }} {{ trans('lang.feedbacks') }}</em></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ( method_exists($saved_doctors,'links') )
                                                {{ $saved_doctors->links() }}
                                            @endif
                                        @else
                                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                @include('extend.errors.no-record')
                                            @else 
                                                @include('errors.no-record')
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dc-educationholder tab-pane fade" id="dc-hospitals">
                            <div class="dc-userexperience dc-followcompomy">
                                <div class="dc-tabscontenttitle">
                                    <h3>{{ trans('lang.saved_hospitals') }}</h3>
                                </div>
                                <div class="dc-sidepadding">
                                    <div class="row">
                                        @if (!empty($saved_hospitals))
                                                @foreach ($saved_hospitals as $key => $user_id)
                                                    @php 
                                                        $user_obj = App\User::find($user_id);
                                                        $specialities = DB::table('user_service')->select('speciality')
                                                        ->where('user_id', $user_obj->id)->groupBy('speciality')->get()->pluck('speciality')->random(1)->toArray(); 
                                                    @endphp
                                                    <div class="dc-docpostholder la-docpostholder">
                                                        <div class="dc-docpostcontent">
                                                            <div class="dc-searchvtwo">
                                                                <figure class="dc-docpostimg">
                                                                    <img src="{{ asset(Helper::getImage('uploads/users/'.$user_obj->id, $user_obj->profile->avatar, 'saved_items-', 'user-logo-def.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                                </figure>
                                                                <div class="dc-title">
                                                                    @if (!empty($specialities))
                                                                        @foreach ($specialities as $key => $user_speciality)
                                                                            @php $speciality = Helper::getSpecialityByID($user_speciality); @endphp
                                                                            @if (!empty($speciality))
                                                                                <a href="{{ url('/search-results?type=hospital&speciality='.clean($speciality->slug)) }}" class="dc-docstatus">{{ html_entity_decode(clean($speciality->title)) }}</a>  
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    <h3>
                                                                        <a href="{{ route('userProfile', ['slug' => $user_obj->slug]) }}">
                                                                            {{ !empty($user_obj->profile->gender_title) ? Helper::getDoctorArray(clean($user_obj->profile->gender_title)) : '' }}
                                                                            {{Helper::getUsername($user_obj->id)}} 
                                                                        </a>
                                                                        {{ Helper::verifyUser(intVal(clean($user_obj->id))) }} {{ Helper::verifyMedical(intVal(clean($user_obj->id))) }}
                                                                    </h3>
                                                                    <ul class="dc-docinfo">
                                                                        <li><em>{{ html_entity_decode(clean($user_obj->profile->tagline)) ?? '' }}</em></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @if ( method_exists($saved_hospitals,'links') )
                                                {{ $saved_hospitals->links('pagination.custom') }}
                                            @endif
                                        @else
                                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                                @include('extend.errors.no-record')
                                            @else 
                                                @include('errors.no-record')
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 dc-responsive-mt mt-lg-0 mt-xl-0">
                <aside id="dc-sidebar" class="dc-sidebar dc-dashboardsave">
                    <div class="dc-proposalsr">
                        <div class="dc-proposalsrcontent">
                            <figure>
                                {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_doctor_image ?? '', 'user-md') }}
                            </figure>
                            <div class="dc-title">
                                <h3>{{{ count($saved_doctors) }}}</h3>
                                <span>{{ trans('lang.doctors_you_saved') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="dc-proposalsr">
                        <div class="dc-proposalsrcontent dc-componyfolow">
                            <figure>
                                {{ Helper::getDashboardImages('uploads/settings/icon', $hidden_hospital_image ?? '', 'building') }}
                            </figure>
                            <div class="dc-title">
                                <h3>{{{ count($saved_hospitals) }}}</h3>
                                <span>{{ trans('lang.saved_hospitals') }}</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
