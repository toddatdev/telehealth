@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section class="dc-haslayout" id="account_settings">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='500' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <div class="dc-preloader-section" v-if="is_loading" v-cloak>
            <div class="dc-preloader-holder">
                <div class="dc-loader"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-right">
                @if (Session::has('message'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                    </div>
                @endif
                <div class="dc-dashboardbox">
                    <div class="dc-dashboardboxtitle dc-titlewithsearch">
                        <h2>Manage Feedbacks</h2>
                    </div>
                    <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                        @if ($feedbacks->count() > 0)
                            <table class="dc-tablecategories dc-table-responsive">
                                <thead>
                                    <tr>
                                        <th>Doctor Name</th>
                                        <th>Patient Name</th>
                                        <th style="width: 50%;">Desc</th>
                                        <th>Point</th>
                                        <th>Publish</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $key => $feedback_data)
                                        @php 
                                            $feedbackitemid = $feedback_data['id'];
                                        @endphp
                                            <tr class="del-{{{ $feedbackitemid }}}">
                                                <td>{{{ ucwords(\App\Helper::getUserName($feedback_data['user_id'])) }}}</td>
                                                <td>{{{ ucwords(\App\Helper::getUserName($feedback_data['patient_id'])) }}}</td>
                                                <td style="width: 50%;">{{{ $feedback_data['comment'] }}}</td>
                                                <td>{{{ $feedback_data['avg_rating'] }}}</td>
                                                <td id="publish_rating-{{$feedbackitemid}}">
                                                    @if ($feedback_data['keep_anonymous'] == 'on')
                                                        <a href="javascript:;" class="" v-on:click.prevent="verifiedFeedback('publish_rating-{{$feedbackitemid}}', '{{$feedbackitemid}}', 'off')">Publish</a>
                                                    @else
                                                        <a href="javascript:;" class="" v-on:click.prevent="verifiedFeedback('publish_rating-{{$feedbackitemid}}', '{{$feedbackitemid}}', 'on')">Not Publish</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <!-- <a href="{{ route('adminEditUser',$feedbackitemid) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a> -->
                                                        <delete :title="'{{trans("lang.ph.delete_confirm_title")}}'" :id="'{{$feedbackitemid}}'" :message="'Feedback Deleted'" :url="'{{url('admin/delete-feedback')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php')))
                                @include('extend.errors.no-record')
                            @else
                                @include('errors.no-record')
                            @endif
                        @endif
                        @if ( method_exists($feedbacks,'links') )
                            {{ $feedbacks->links('pagination.custom') }}
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
            breakpoint: 767,
    });
</script>
@endpush
