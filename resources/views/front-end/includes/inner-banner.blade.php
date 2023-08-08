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
                        <div class="dc-formtheme dc-form-advancedsearch dc-innerbannerform">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="search" value="{{ !empty(request()->search) ? request()->search : '' }}" class="form-control" 
                                        placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
                                </div>
                                <div class="form-group">
                                    <div class="dc-select">
                                        <select class="locations item1" data-placeholder="{{ trans('lang.select_country') }}" name="locations">
                                            <option value="">{{ trans('lang.select_country') }}</option>
                                            @foreach ($locations as $key => $location)
                                                <option value="{{{ clean($location->slug) }}}">{{{ html_entity_decode(clean($location->title)) }}}*</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="dc-btnarea">
                                    {!! Form::submit(trans('lang.search'), ['class' => 'dc-btn']) !!}
                                </div>
                            </fieldset>
                        </div>
                        <a href="javascript:void(0);" class="dc-docsearch" v-on:click="displayFilfer">
                            <span class="dc-advanceicon"><i></i> <i></i> <i></i></span>
                            <span>{{ trans('lang.advanced') }} <br>{{ trans('lang.search') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dc-advancedsearch-holder">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="dc-advancedsearchs">
                            <div class="dc-formtheme dc-form-advancedsearchs">
                                <fieldset>
                                    <div class="form-group">
                                        <div class="dc-select">
                                            <select name="type">
                                                @if (!empty($roles))
                                                    <option value="both" selected>{{ trans('lang.both') }}</option>
                                                    @foreach ($roles as $key => $role)
                                                        @if (!in_array($role['role_type'] == 'admin', $roles) && !in_array($role['role_type'] == 'regular', $roles))
                                                            @php $selected = !empty($_GET['type']) && $_GET['type'] == $role['role_type'] ? 'selected' : ''; @endphp
                                                            <option value="{{{$role['role_type']}}}" {{$selected}}>{{{ html_entity_decode(clean($role['name'])) }}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <speciality-services 
                                    :specialities="specialities" 
                                    v-if="show_speciality"
                                    :speciality_value_type="'slug'"
                                    :service_value_type="'slug'"
                                    v-cloak >
                                    </speciality-services>
                                    <div class="dc-btnarea">
                                        <a href="javascript:void(0);" class="dc-btn dc-resetbtn">{{ trans('lang.reset_filters') }}</a>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! form::close(); !!}
</div>
