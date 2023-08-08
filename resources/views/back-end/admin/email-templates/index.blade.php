@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
@php
    $selected_role = !empty($_GET['role']) ? $_GET['role'] : '';
    $selected_type = !empty($_GET['type']) ? $_GET['type'] : '';
@endphp
    <section class="dc-haslayout dc-emailtemplates-holder" id="settings">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-right">
                @if (Session::has('message'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                    </div>
                @elseif (Session::has('error'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                <div class="dc-dashboardbox">
                    <div class="dc-dashboardboxtitle dc-titlewithsearch">
                        <h2>{{{ trans('lang.email_templates') }}}</h2>
                        {!! Form::open(['url' => url('admin/email-templates/filter-templates'),
                            'method' => 'get', 'class' => 'dc-formtheme dc-formsearch'])
                        !!}
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}}"
                                        class="form-control" placeholder="{{{ trans('lang.ph_search_templates') }}}">
                                    <button type="submit" class="dc-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </fieldset>
                        {!! Form::close() !!}
                        {!! Form::open(['url' => url('admin/email-templates/filter-templates'), 'method' => 'get', 'class' => 'dc-formtheme dc-formsearch la-mailfilter', 'id'=>'template_filter_form']) !!}
                            <div class="form-group">
                                <span class="dc-select">
                                    {!! Form::select('role', array_map('strtoupper', $roles) ,$selected_role, array('placeholder' => trans('lang.filter_by_roles'), '@change'=>'submitTemplateFilter')) !!}
                                </span>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                        <table class="dc-tablecategories dc-table-responsive dc-emailtable">
                            <thead>
                                <tr>
                                    <th>{{{ trans('lang.title') }}}</th>
                                    <th>{{{ trans('lang.subject') }}}</th>
                                    <th>{{{ trans('lang.type') }}}</th>
                                    <th>{{{ trans('lang.role') }}}</th>
                                    <th>{{{ trans('lang.action') }}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templates as $key => $template)
                                    @php $type = App\EmailTemplate::getEmailType($template->email_type_id); @endphp
                                    <tr>
                                        <td>{{{ html_entity_decode(clean($template->title)) }}}</td>
                                        <td>{{{ html_entity_decode(clean($template->subject)) }}}</td>
                                        <td>{{{ $type->email_type }}}</td>
                                        <td>{{{ Helper::getRoleNameByRoleID(clean($template->role_id)) }}}</td>
                                        <td>
                                            <div class="dc-actionbtn">
                                                <a href="{{{url('admin/email-templates/'.$template->id)}}}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-pencil"></i></a>
                                                <a href="javascript:void(0);" v-on:click.prevent="emailContent('myModalRef-{{$key}}')" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <b-modal size="lg" ref="myModalRef-{{$key}}" hide-footer title="Email Content" v-cloak>
                                        <div class="d-block text-center dc-form-editpopup">
                                            @php 
                                                $body = "";
                                                $body .= App\EmailHelper::getEmailHeader();
                                                $body .= $template->content;
                                                $body .= App\EmailHelper::getEmailFooter();
                                                echo $body;
                                           @endphp
                                         </div>
                                    </b-modal>
                                @endforeach
                            </tbody>
                        </table>
                        @if ( method_exists($templates,'links') )
                            {{ $templates->links('pagination.custom') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@stack('backend_scripts')
<script src="{{ asset('js/jquery.basictable.min.js') }}"></script>
<script type="text/javascript">
    jQuery('.dc-table-responsive').basictable({
            breakpoint: 1280,
    });
</script>
@endpush