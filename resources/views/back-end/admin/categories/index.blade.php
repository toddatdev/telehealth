@extends('back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    @include('includes.pre-loader')
    <div class="dc-categories" id="cats">
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
                            <h2>{{{ trans('lang.cats') }}}</h2>
                            <div class="dc-rightarea">
                                {!! Form::open(['url' => url('admin/categories/search'),
                                    'method' => 'get', 'class' => 'dc-formtheme dc-formsearch'])
                                !!}
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                            class="form-control" placeholder="{{{ trans('lang.ph.search_cats') }}}">
                                        <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                    </div>
                                </fieldset>
                                {!! Form::close() !!}
                                <multi-delete
                                    v-cloak
                                    v-if="this.is_show"
                                    :title="'{{trans("lang.ph.delete_confirm_title")}}'"
                                    :message="'{{trans("lang.ph.cat_delete_message")}}'"
                                    :url="'{{url('admin/delete-checked-categories')}}'"
                                    :redirect_url="'{{url('admin/categories')}}'"
                                >
                                </multi-delete>
                            </div>
                        </div>
                        @if ($cats->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="dc-checkbox">
                                                    <input name="cats[]" id="dc-cats" @click="selectAll" type="checkbox">
                                                    <label for="dc-cats"></label>
                                                </span>
                                            </th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($cats as $cat)
                                            <tr class="del-{{{ $cat->id }}}">
                                                <td>
                                                    <span class="dc-checkbox">
                                                        <input name="cats[]" @click="selectRecord" value="{{{ intVal(clean($cat->id)) }}}" id="wt-check-{{{ $counter }}}" type="checkbox">
                                                        <label for="wt-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td>{{{ html_entity_decode(clean($cat->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($cat->slug)) }}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{{ url('admin/categories/edit') }}}/{{{ html_entity_decode(clean($cat->slug)) }}}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph.delete_confirm_title")}}'" :id="'{{ intVal(clean($cat->id)) }}'" :message="'{{trans("lang.ph.cat_delete_message")}}'" :url="'{{url('admin/categories/delete')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($cats,'links') )
                                    {{ $cats->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox dc-offered-holder dc-addnewlocation">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_new_cat') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open([
                                'url' => url('admin/store-category'),
                                'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory dc-formtheme dc-userform', 'id'=> 'categories'
                                ])
                            !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph.cat_title')] ) !!}
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'abstract', null, ['class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                    </div>
                                    <div class="dc-settingscontent form-group">
                                        <div class = "dc-formtheme dc-userform">
                                            <upload-media
                                            :img="'category_image'"
                                            :img_id="'category_image'"
                                            :img_name="'category_image'"
                                            :img_ref="'category_image'"
                                            :img_hidden_name="'hidden_category_image'"
                                            :img_hidden_id="'hidden_category_image'"
                                            :url="'{{ url("media/upload-temp-image/categories/category_image/category") }}'"
                                            >
                                            </upload-media>
                                        </div>
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.add_cat'), ['class' => 'dc-btn']) !!}
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