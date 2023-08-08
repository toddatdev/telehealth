@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="cats-listing" id="emails">
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
                <div class="col-12 col-lg-8 col-xl-6 float-left">
                    <div class="dc-dashboardbox dc-editemail">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_email_template') }}}</h2>
                            @if (!empty($variables_array))
                                <div>
                                    <strong>{{{ trans('lang.variables') }}}</strong>
                                    <ul>
                                        @foreach ($variables_array as $key => $value )
                                            <li>{{ $key }} => {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                    <span>{{{ trans('lang.variable_note') }}}</span>
                                </div>
                            @endif
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['url' => url('admin/email-templates/update-templates/'.$template->id.''),
                                'class' =>'dc-formtheme dc-userform dc-form-editemail', 'id' => 'update_email_templates'] )
                            !!}
                            <fieldset>
                                <div class="form-group form-group-half">
                                    {!! Form::text( 'title', e($template->title), ['class' =>'form-control', 'placeholder' => trans('lang.title')] ) !!}
                                </div>
                                <div class="form-group form-group-half">
                                        {!! Form::text( 'subject', e($template->subject), ['class' =>'form-control', 'placeholder' => trans('lang.subject')] ) !!}
                                    </div>
                                <div class="form-group">
                                        {!! Form::textarea('email_content', $template->content, array('class' => 'dc-tinymceeditor form-control', 'id' => 'dc-tinymceeditor', 'placeholder' => trans('lang.add_template_content')) ) !!}
                                </div>
                                <div class="form-group dc-btnarea">
                                    {!! Form::submit(trans('lang.update_email_template'), ['class' => 'dc-btn']) !!}
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
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.dc-tinymceeditor',
            height: 300,
            theme: 'modern',
            plugins: ['code advlist autolink lists link image charmap print preview hr anchor pagebreak'],
            menubar: false,
            statusbar: false,
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify code',
            image_advtab: true,
            remove_script_host: false,
            })
    </script>
@endpush
