@extends('back-end.master')
@push('backend_stylesheets')
<link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-services" id="services">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>{{{ trans('lang.manage_services') }}}</h2>
                            <div class="dc-rightarea">
                                {!! Form::open(['url' => url('admin/services/search'),
                                    'method' => 'get', 'class' => 'dc-formtheme dc-formsearch'])
                                !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                                class="form-control" placeholder="{{{ trans('lang.ph.search_services') }}}">
                                            <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                        </div>
                                    </fieldset>
                                {!! Form::close() !!}
                                <multi-delete
                                    v-cloak
                                    v-if="this.is_show"
                                    :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                    :message="'{{trans("lang.ph.services_del_delete_message")}}'"
                                    :url="'{{url('admin/delete-checked-services')}}'"
                                    :redirect_url="'{{url('admin/services')}}'"
                                >
                                </multi-delete>
                            </div>
                        </div>
                        @if ($services->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="dc-checkbox">
                                                    <input name="services[]" id="dc-services" @click="selectAll" type="checkbox">
                                                    <label for="dc-services"></label>
                                                </span>
                                            </th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($services as $key => $service)
                                            <tr class="del-{{{ $service->id }}}">
                                                <td>
                                                    <span class="dc-checkbox">
                                                        <input name="services[]" @click="selectRecord" value="{{{ intVal(clean($service->id)) }}}" id="wt-check-{{{ $counter }}}" type="checkbox">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td>{{{ html_entity_decode(clean($service->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($service->slug)) }}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{{ url('admin/services/edit') }}}/{{{ html_entity_decode(clean($service->slug)) }}}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($service->id)) }}'" :message="'{{trans("lang.ph_loc_service_del_msg")}}'" :url="'{{url('admin/services/delete')}}'" :redirect_url="'{{url('admin/services')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($services,'links') )
                                    {{ $services->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox dc-offered-holder">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_service') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open([
                                'url' => url('admin/store-service'),
                                'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory dc-userform', 'id'=> 'services-form'
                                ])
                            !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.title')] ) !!}
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <span class="dc-select">
                                            {!! Form::select('speciality', $specialities, null, ['class' =>'form-control'.($errors->has('speciality') ? ' is-invalid' : ''), 'placeholder' => !empty($specialities) ? trans('lang.ph.select_speciality') : trans('lang.ph.please_add_speciality') ]) !!}
                                            @if ($errors->has('speciality'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('speciality') }}</strong>
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'description', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph.service_desc')] ) !!}
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.add_service'), ['class' => 'dc-btn']) !!}
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
@push('scripts')
@stack('backend_scripts')
<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>
<script type="text/javascript">
    jQuery('.dc-table-responsive').basictable({
            breakpoint: 767,
    });
</script>
@endpush