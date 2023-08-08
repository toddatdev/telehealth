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
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dc-errorpage">
                        <figure>
                            <img src="{{ asset('images/doc-error/img-01.jpg') }}">
                        </figure>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="dc-errorcontent">
                        <div class="dc-title">
                            <h4>{{ trans('lang.something_went_wrong') }}</h4>
                            <h3>{{ trans('lang.oop_page_not_found') }}</h3>
                        </div>
                        <div class="dc-description">
                            <p>{{ trans('lang.404_note') }}</p>
                        </div>
                        {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'error_search_form', 'class' => 'dc-formtheme dc-formnewsletter']) !!}
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
                                </div>
                            </fieldset>
                            <div class="dc-btnarea">
                                {!! Form::submit(trans('lang.search'), ['class' => 'dc-btn']) !!}
                                <span>{{ trans('lang.go_back_to') }} <a href="{{ url('/') }}"> {{ trans('lang.homepage') }}</a> {{ trans('lang.start_again') }}</span>
                            </div>
                        {!! form::close(); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
