@extends('front-end.master')
@section('content')
    <div class="dc-breadcrumbarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ol class="dc-breadcrumb">
                        <li><a href="{{ url('/') }}">{{ trans('lang.home') }}</a></li>
                        <li>{{ trans('lang.page_not_found') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="dc-haslayout dc-main-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-10 push-md-1 col-lg-8 push-lg-2">
                    <div class="dc-errorcontent">
                        <div class="dc-404errorcontent">
                            <div class="dc-title">
                                <h3>{{ trans('lang.no_access') }}</h3>
                            </div>
                            <div class="dc-description">
                            <a class="dc-btn btn-large" href="{{{ url('/') }}}">{{ trans('lang.go_home') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


