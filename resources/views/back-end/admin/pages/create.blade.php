@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="pages-listing" id="pages">
        <section class="dc-haslayout">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_page') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent dc-addpageholder">
                            {!! Form::open(['id' => 'page-form', 'class' => 'dc-formtheme dc-formprojectinfo dc-formcategory', '@submit.prevent' => "submitPage('{{$page_created}}')"]) !!}
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', null, ['class' =>'form-control', 'placeholder' => trans('lang.page_title'), 'v-model' =>'title', 'v-on:keyup'=>"updateSlug(title)"] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::text( 'slug', null, ['class' =>'form-control', 'placeholder' => trans('lang.page_slug'), 'v-model' =>'slug'] ) !!}
                                    </div>
                                    <div class="form-group dc-tinymceeditor">
                                        {!! Form::textarea('content', null,
                                            ['class' => ' form-control dc-tinymceeditor', 'id' => 'page-desc', 'placeholder' => trans('lang.desc')])
                                        !!}
                                    </div>
                                    @if ($parent_page->count() > 1)
                                    <div class="form-group">
                                        <span class="dc-select">
                                            {!! Form::select('parent_id', $parent_page, null ,array('class' => 'form-control jf-select2')) !!}
                                        </span>
                                    </div>
                                    @endif
                                    <div class="dc-securitysettings dc-tabsinfo dc-haslayout">
                                        <div class="dc-tabscontenttitle">
                                            <h3>{{{ trans('lang.seo_meta_desc') }}}</h3>
                                        </div>
                                        <div class="dc-sidepadding">
                                            <div class="dc-settingscontent dc-formtheme dc-userform">
                                                <fieldset>
                                                    <div class="form-group">
                                                        {!! Form::textarea('meta[seo_desc]', null, array('class' => 'form-group seo-meta', 'placeholder' => trans('lang.desc'),
                                                        'style' => 'height:300px')) !!}
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dc-tabscontenttitle la-switch-option">
                                        <h3>{{ trans('lang.add_menu_to_navbar') }}</h3>
                                        <switch_button v-model="show_page">{{{ trans('lang.add_menu_to_navbar') }}}</switch_button>
                                        <input type="hidden" :value="show_page" name="meta[show_page]">
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.add_page'), ['class' => 'dc-btn']) !!}
                                    </div>
                                </fieldset>
                            {!! Form::close() !!}
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
            extended_valid_elements  : "span[style],i[class]",
            relative_urls: false
        })
    </script>
@endpush
