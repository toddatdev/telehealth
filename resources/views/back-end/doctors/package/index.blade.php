@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
@include('includes.pre-loader')
    <section class="dc-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left" id="packages">
                <div class="dc-dashboardbox">
                    <div class="dc-dashboardboxtitle">
                        <h2>{{ trans('lang.packages') }}</h2>
                    </div>
                    <div class="dc-dashboardboxcontent dc-packages">
                        <div class="dc-package dc-packagedetails">
                            <div class="dc-packagehead">
                            </div>
                            <div class="dc-packagecontent">
                                <ul class="dc-packageinfo">
                                    @foreach($package_options as $options)
                                        <li @if ($options == trans('lang.pkg_price')) class="dc-packageprices" @endif>
                                            <span>{{ $options }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if (!empty($packages) && $packages->count() > 0)
                            @foreach ($packages as $key => $package)
                                @php  $options = unserialize($package->options); @endphp
                                @if (!empty($package))
                                    <div class="dc-package dc-baiscpackage">
                                        @if (!empty($package->title || $package->subtitle ))
                                            <div class="dc-packagehead">
                                                <h3>{{ html_entity_decode(clean($package->title)) }}</h3>
                                                <span>{{ html_entity_decode(clean($package->subtitle)) }}</span>
                                            </div>
                                        @endif
                                        <div class="dc-packagecontent">
                                            <ul class="dc-packageinfo">
                                                <li class="dc-packageprice">
                                                    <span>
                                                        <sup>{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}</sup>
                                                        {{$package->cost}}
                                                        <sub>\ {{ !empty($options['duration']) ? Helper::getPackageDurationList($options['duration']) : '' }}</sub>
                                                    </span>
                                                </li>
                                                @foreach ($options as $key => $option)
                                                    @php
                                                        if ($key == 'featured' || $key == 'private_chat' || $key == 'bookings') {
                                                            $class = $option == 'true' ? 'ti-check' : 'ti-na';
                                                        }
                                                    @endphp
                                                    @if ($key == 'private_chat' || $key == 'featured')
                                                        <li><span><i class="{{ $class }}"></i></span></li>
                                                    @elseif ($key == 'duration')
                                                        <li><span> {{ Helper::getPackageDurationList($options['duration']) }}</span></li>
                                                    @elseif ($key == 'bookings')
                                                        <li><span><i class="{{ $class }}"></i></span></li>
                                                    @else
                                                        <li><span> {{ $option }}</span></li>
                                                    @endif
                                                @endforeach
                                                @php end($options); @endphp
                                                @if (key($options) != 'featured') 
                                                    <li><span><i class="ti-na"></i></span></li>
                                                @endif
                                            </ul>
                                            @if ($role_type != "admin")
                                                <a class="dc-btn" href="{{ route('doctorCheckout', ['id' => intVal(clean($package->id))]) }}">
                                                    <span>{{ trans('lang.buy_now') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 float-left">
                                <div class="dc-jobalerts">
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <em>{{ trans('lang.alert') }}</em> <span> {{ trans('lang.curr_on_trial') }}</span>
                                        <a href="javascript:void(0)" class="dc-alertbtn warning">{{ trans('lang.buy_now') }}</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                            </div>
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
								@include('extend.errors.no-record')
							@else 
								@include('errors.no-record')
							@endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
