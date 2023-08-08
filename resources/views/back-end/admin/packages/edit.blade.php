@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    @include('includes.pre-loader')
    <div class="package-listing" id="packages">
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_package') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['class' =>'dc-formtheme dc-formprojectinfo dc-formcategory', 'id' => 'update-package', '@submit.prevent' => 'updatePackage("'.$package->id.'")'] ) !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'package_title', e($package->title), ['class' =>'form-control', 'placeholder' => trans('lang.ph_pkg_title')]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::text( 'package_subtitle', e($package->subtitle), ['class' =>'form-control', 'placeholder' => trans('lang.ph_pkg_subtitle')]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number( 'package_price', e($package->cost), ['class' =>'form-control', 'placeholder' => trans('lang.ph_pkg_price')]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number('options[no_of_services]', e($no_of_services), array('class' => 'form-control', 'placeholder' => trans('lang.no_of_services'))) !!}
                                    </div>
                                        <div class="form-group">
                                            {!! Form::number('options[no_of_brochures]', e($no_of_brochures), array('class' => 'form-control', 'placeholder' => trans('lang.no_of_brochures'))) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::number('options[no_of_articles]', e($no_of_articles), array('class' => 'form-control', 'placeholder' => trans('lang.no_of_articles'))) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::number('options[no_of_awards]', e($no_of_awards), array('class' => 'form-control', 'placeholder' => trans('lang.no_of_awards'))) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::number('options[no_of_memberships]', e($no_of_memberships), array('class' => 'form-control', 'placeholder' => trans('lang.no_of_memberships'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <span class="dc-select">
                                                {!! Form::select('options[duration]', $durations, $duration, ['plceholder' => trans('lang.select_duration')]) !!}
                                                {{--  <select name="options[duration]" v-model="package.duration" @change="packageDuration">
                                                    <option value="" disabled="">{{ Helper::getPackageDurationList($duration) }}</option>
                                                    @foreach ($durations as $key => $options['duration'])
                                                        <option value="{{$key}}">{{ Helper::getPackageDurationList($key) }}</option>
                                                    @endforeach
                                                </select>  --}}
                                            </span>
                                            {{--  <input type="text" name="options[duration]" v-if="duration" placeholder="{{ trans('lang.make_other_duration') }}">  --}}
                                            @if ($errors->has('options[duration]'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('options[duration]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <switch_button v-model="bookings">{{{ trans('lang.bookings') }}}</switch_button>
                                            <input type="hidden" :value="bookings" name="options[bookings]">
                                        </div>
                                        <div class="form-group">
                                            <switch_button v-model="private_chat">{{{ trans('lang.enabale_disable_pvt_chat') }}}</switch_button>
                                            <input type="hidden" :value="private_chat" name="options[private_chat]">
                                        </div>
                                        <div class="form-group">
                                            <switch_button v-model="featured">{{{ trans('lang.featured') }}}</switch_button>
                                            <input type="hidden" :value="featured" name="options[featured]">
                                        </div>
                                        @if ($doctor_trial->count() == 0)
                                            <div class="form-group">
                                                <span class="dc-checkbox">
                                                    <input id="trial" type="checkbox" name="trial">
                                                    <label for="trial"><span>{{{ trans('lang.enable_trial') }}}</span></label>
                                                </span>
                                            </div>
                                        @endif
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.update_package'), ['class' => 'dc-btn']) !!}
                                    </div>
                                </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
