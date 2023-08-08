@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 'extend.front-end.master' : 'front-end.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('lang.verify_email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('lang.link_sent') }}
                        </div>
                    @endif

                    {{ trans('lang.check_email') }}
                    {{ trans('lang.didnot_receive') }}, <a href="{{ route('verification.resend') }}">{{ trans('lang.req_another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
