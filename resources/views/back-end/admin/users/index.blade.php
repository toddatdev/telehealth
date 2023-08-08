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
                        <h2>{{{ trans('lang.manage_users') }}}</h2>
                        <div class="dc-rightarea"><a href="{{ route('adminAddUser')}}" class="dc-btn">Add new user</a></div>
                    </div>
                    <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                        @if ($users->count() > 0)
                            <table class="dc-tablecategories dc-table-responsive">
                                <thead>
                                    <tr>
                                        <th>{{{ trans('lang.user_name') }}}</th>
                                        <th>{{{ trans('lang.ph_email') }}}</th>
                                        <th>{{{ trans('lang.role') }}}</th>
                                        <th>{{{ trans('lang.medical_verified') }}}</th>
                                        <th>{{{ trans('lang.user_verified') }}}</th>
                                        <th>{{{ trans('lang.action') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user_data)
                                        @php 
                                            $user = \App\User::find($user_data['id']); 
                                            $verify_medical = Helper::getUnserializeData($user->profile->verify_medical); 
                                        @endphp
                                        @if (Helper::getRoleTypeByUserID($user->id) != 'admin')
                                            <tr class="del-{{{ $user->id }}}">
                                                <td>{{{ ucwords(\App\Helper::getUserName($user->id)) }}}</td>
                                                <td>{{{ clean($user->email) }}}</td>
                                                <td>{{ $user->getRoleNames()->first() }}</td>
                                                @if (!empty($verify_medical)) 
                                                    <td>
                                                        {{ html_entity_decode(clean($verify_medical['registration_number'])) }}</br>
                                                        <a href="{{{route('getfile', ['type'=>'users', 'id'=>clean($user->id), 'attachment'=>$verify_medical['registration_document']])}}}">
                                                            {{ trans('lang.download') }}
                                                        </a>
                                                    </td>
                                                @elseif (Helper::getRoleTypeByUserID($user->id) == 'regular')
                                                    <td>{{ trans('lang.not_available') }}</td>
                                                @else
                                                    <td>{{ trans('lang.not_uploaded') }}</td>
                                                @endif
                                                <td id="verify_cell-{{$user->id}}">
                                                    @if ($user->profile->verify_registration == 1)
                                                        <a href="javascript:;" class="" v-on:click.prevent="verifiedUser('verify_cell-{{$user->id}}', '{{$user->id}}', 'not_verify')">{{ trans('lang.verified') }}</a>
                                                    @elseif (Helper::getRoleTypeByUserID($user->id) == 'regular')                                                        
                                                        <a href="javascript:;">{{ trans('lang.not_available') }}</a>
                                                    @else
                                                        <a href="javascript:;" class="" v-on:click.prevent="verifiedUser('verify_cell-{{$user->id}}', '{{$user->id}}', 'verify')">{{ trans('lang.not_verified') }}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{ route('adminEditUser',$user->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph.delete_confirm_title")}}'" :id="'{{$user->id}}'" :message="'{{trans("lang.user_deleted")}}'" :url="'{{url('admin/delete-user')}}'"></delete>
                                                        @if (Helper::getRoleTypeByUserID($user->id) != 'regular')
                                                            <a href="{{ url('profile/'.clean($user->slug)) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                                        @else
                                                            <a href="javascript:;" class="dc-addinfo dc-skillsaddinfo disable-eye"><i class="lnr lnr-eye"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
                        @if ( method_exists($users,'links') )
                            {{ $users->links('pagination.custom') }}
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