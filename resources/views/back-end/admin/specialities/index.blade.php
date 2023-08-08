@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-specialities" id="specialities">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='100' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='100' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>{{ trans('lang.manage_specialities') }}</h2>
                            <div class="dc-rightarea">
                                {!! Form::open(['url' => url('admin/specialities/search'),
                                    'method' => 'get', 'class' => 'dc-formtheme dc-formsearch'])
                                !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                                class="form-control" placeholder="{{{ trans('lang.search_specialities') }}}">
                                            <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                        </div>
                                    </fieldset>
                                {!! Form::close() !!}
                                <multi-delete
                                    v-cloak
                                    v-if="this.is_show"
                                    :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                    :message="'{{trans("lang.ph.specialities_del_delete_message")}}'"
                                    :url="'{{url('admin/delete-checked-specialities')}}'"
                                    :redirect_url="'{{url('admin/specialities')}}'"
                                >
                                </multi-delete>
                            </div>
                        </div>
                        @if ($specialities->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="dc-checkbox">
                                                    <input name="speciality[]" id="dc-speciality" @click="selectAll" type="checkbox">
                                                    <label for="dc-speciality"></label>
                                                </span>
                                            </th>
                                            <th>{{{ trans('lang.img') }}}</th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($specialities as $key => $speciality)
                                            <tr class="del-{{{ $speciality->id }}}">
                                                <td>
                                                    <span class="dc-checkbox">
                                                        <input name="speciality[]" @click="selectRecord" value="{{{ intVal(clean($speciality->id)) }}}" id="wt-check-{{{ $counter }}}" type="checkbox">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td data-th="Icon"><span class="bt-content"><figure><img src="{{{ asset(Helper::getImage('uploads/specialities', $speciality->image, 'extra-small-', 'speciality-default.png')) }}}" alt="{{{ $speciality->title }}}"></figure></span></td>
                                                <td>{{{ html_entity_decode(clean($speciality->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($speciality->slug)) }}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{{ url('admin/specialities/edit') }}}/{{{ html_entity_decode(clean($speciality->slug)) }}}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($speciality->id)) }}'" :message="'{{trans("lang.ph_speciality_delete_message")}}'" :url="'{{url('admin/specialities/delete')}}'" :redirect_url="'{{url('admin/specialities')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($specialities,'links') )
                                    {{ $specialities->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_speciality') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent dc-addspeciality">
                                {!! Form::open(['url' => url('admin/store-speciality'), 'class' => 'dc-formtheme dc-formsearch dc-formtheme dc-userform', 'id' => 'speclity-form'])!!}
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
                                        {!! Form::textarea( 'desc', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                    </div>
                                    <div class="dc-settingscontent form-group">
                                        <div class = "dc-formtheme dc-userform">
                                            <upload-media
                                            :img="'speciality_image'"
                                            :img_id="'speciality_image'"
                                            :img_name="'speciality_image'"
                                            :img_ref="'speciality_image'"
                                            :img_hidden_name="'speciality_image'"
                                            img_hidden_id="'speciality_image'"
                                            :url="'{{ url("media/upload-temp-image/specialities/speciality_image/speciality") }}'"
                                            >
                                            </upload-media>
                                        </div>
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.create_speciality'), ['class' => 'dc-btn']) !!}
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
