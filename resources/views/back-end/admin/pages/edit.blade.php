@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
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
        @if ($errors->any())
            <ul class="dc-jobalerts">
                @foreach ($errors->all() as $error)
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time='10' :message="'{{{ $error }}}'" v-cloak></flash_messages>
                    </div>
                @endforeach
            </ul>
        @endif
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_page') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['class' =>'dc-formtheme dc-formprojectinfo dc-formcategory', 'id' => 'page-edit-form', '@submit.prevent' => "updatePage('$page->id')"]) !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', e($page->title), ['class' =>'form-control', 'placeholder' => trans('lang.ph_page_title')] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'content', e($page->body), ['class' =>'form-control dc-tinymceeditor', 'id' => 'page-desc', 'placeholder' => trans('lang.ph_desc')]) !!}
                                    </div>
                                    @if (empty($has_child))
                                        @if ($parent_page->count() >= 1)
                                            <div class="form-group">
                                                <span class="dc-select">
                                                    {!! Form::select('parent_id', $parent_page, e($parent_selected_id) , array('class' => 'form-control dc-select2')) !!}
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="dc-securitysettings dc-tabsinfo dc-haslayout">
                                        <div class="dc-tabscontenttitle">
                                            <h3>{{{ trans('lang.seo_meta_desc') }}}</h3>
                                        </div>
                                        <div class="dc-settingscontent">
                                            <div class="form-group">
                                                {!! Form::textarea('meta[seo_desc]', e($seo_description), array('class' => 'form-control seo-meta', 'placeholder' => trans('lang.desc'))) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dc-tabscontenttitle la-switch-option">
                                        <h3>{{ trans('lang.add_menu_to_navbar') }}</h3>
                                        <switch_button v-model="show_page">{{{ trans('lang.add_menu_to_navbar') }}}</switch_button>
                                        <input type="hidden" :value="show_page" name="meta[show_page]">
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.update_page'), ['class' => 'dc-btn']) !!}
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
@push('backend_scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.dc-tinymceeditor',
            height: 300,
            theme: 'modern',
            plugins: ['code advlist autolink lists link image charmap print preview hr anchor pagebreak'],
            menubar: false,
            statusbar: false,
            toolbar1: 'undo redo | insert | image | styleselect | bold italic | alignleft aligncenter alignright alignjustify code',
            image_advtab: true,
            inline_styles : true,
            remove_script_host: false,
            relative_urls: false,
            extended_valid_elements  : "span[style],i[class]"
        })
    </script>
@endpush
