@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    <div class="packages-listing" id="packages">
        <section class="dc-haslayout la-addpackages">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_packages') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['class' =>'dc-formtheme dc-formprojectinfo dc-formcategory', 'id' => 'package_form', '@submit.prevent' => 'submitPackage']) !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'package_title', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph_pkg_title')] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::text( 'package_subtitle', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph_pkg_subtitle')] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number( 'package_price', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph_pkg_price')] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number('options[no_of_services]', null, array('class' => 'form-control', 'placeholder' => trans('lang.no_of_services'))) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number('options[no_of_brochures]', null, array('class' => 'form-control', 'placeholder' => trans('lang.no_of_brochures'))) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number('options[no_of_articles]', null, array('class' => 'form-control', 'placeholder' => trans('lang.no_of_articles'))) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number('options[no_of_awards]', null, array('class' => 'form-control', 'placeholder' => trans('lang.no_of_awards'))) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::number('options[no_of_memberships]', null, array('class' => 'form-control', 'placeholder' => trans('lang.no_of_memberships'))) !!}
                                    </div>
                                    <div class="form-group">
                                        <span class="dc-select">
                                            <select name="options[duration]" v-model="package.duration" @change="packageDuration">
                                                <option value="" disabled="">{{ trans('lang.select_duration') }}</option>
                                                    @foreach ($durations as $key => $options['duration'])
                                                        <option value="{{$key}}">{{ Helper::getPackageDurationList($key) }}</option>
                                                    @endforeach
                                            </select>
                                        </span>
                                        <input type="text" name="options[duration]" v-if="duration" placeholder="{{ trans('lang.make_other_duration') }}">
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
                                        {!! Form::submit(trans('lang.add_packages'), ['class' => 'dc-btn']) !!}
                                    </div>
                                </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 dc-responsive-mt mt-lg-0 float-right">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch">
                            <h2>{{{ trans('lang.packages') }}}</h2>
                            {!! Form::open(['url' => url('admin/packages/search'), 'method' => 'get', 'class' => 'dc-formtheme dc-formsearch']) !!}
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}" class="form-control" placeholder="{{{ trans('lang.ph_search_packages') }}}">
                                        <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                    </div>
                                </fieldset>
                            {!! Form::close() !!}
                        </div>
                        @if (!empty($packages) || $packages->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($packages as $package)
                                            <tr class="del-{{{ $package->id }}}" v-bind:id="packageID">
                                                <td>{{{ html_entity_decode(clean($package->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($package->slug)) }}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{{ url('admin/packages/edit') }}}/{{{ intVal(clean($package->id)) }}}" class="dc-addinfo dc-packagesaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        @if ($package->trial != 1)
                                                            <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{intVal(clean($package->id))}}'" :message="'{{trans("lang.ph_pkg_delete_message")}}'" :url="'{{url('admin/packages/delete-package')}}'"></delete>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($packages,'links') ) {{ $packages->links('pagination.custom') }} @endif
                            </div>
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
        </section>
    </div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>
<script type="text/javascript">
    jQuery('.dc-table-responsive').basictable({
            breakpoint: 767,
    });
</script>
@endpush