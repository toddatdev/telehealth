@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="pages-listing" id="pages">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
        <div class="flash_msg">
            <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
        </div>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 float-right">
                    <div class="dc-dashboardbox dc-addpage-holdertwo">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>{{{ trans('lang.add_page') }}}</h2>
                            <div class="dc-rightarea">
                                <a href="javascript:void(0);" v-if="this.is_show" @click="deleteChecked('{{ trans('lang.ph_delete_confirm_title') }}', '{{ trans('lang.ph_page_delete_message') }}')" class="dc-skilldel">
                                    <i class="lnr lnr-trash"></i>
                                    <span>{{ trans('lang.del_select_rec') }}</span>
                                </a>
                                <a href="{{{ route('createPage') }}}" class="dc-btn">{{{ trans('lang.create_page') }}}</a>
                            </div>
                        </div>
                        @if ($pages->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="dc-tablecategories dc-table-responsive" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="dc-checkbox">
                                                    <input name="pages[]" id="dc-pages" @click="selectAll" type="checkbox">
                                                    <label for="dc-pages"></label>
                                                </span>
                                            </th>
                                            <th>{{{ trans('lang.name') }}}</th>
                                            <th>{{{ trans('lang.slug') }}}</th>
                                            <th>{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($pages as $page)
                                            <tr class="del-{{{ $page->id }}}" v-bind:id="pageID">
                                                <td>
                                                    <span class="dc-checkbox">
                                                        <input name="pages[]" @click="selectRecord" value="{{{ intVal(clean($page->id)) }}}" id="dc-check-{{{ $counter }}}" type="checkbox">
                                                        <label for="dc-check-{{{ $counter }}}"></label>
                                                    </span>
                                                </td>
                                                <td>{{{ html_entity_decode(clean($page->title)) }}}</td>
                                                <td>{{{ html_entity_decode(clean($page->slug)) }}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{{ url('admin/pages/edit-page') }}}/{{{ intVal(clean($page->id)) }}}" class="dc-addinfo dc-pages">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($page->id)) }}'" :message="'{{trans("lang.ph_page_delete_message")}}'" :url="'{{url('admin/pages/delete-page')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if( method_exists($pages,'links') ) {{ $pages->links('pagination.custom') }} @endif
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