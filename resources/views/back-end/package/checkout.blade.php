@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
@include('includes.pre-loader')
    <section class="wt-haslayout wt-dbsectionspace" id="user-profile">
        <div class="row">
            <div class=" col-sm-12 col-md-8 push-md-2 col-lg-8 push-lg-2">
                <div class="dc-preloader-section" v-if="loading" v-cloak>
                    <div class="dc-preloader-holder">
                        <div class="dc-loader"></div>
                    </div>
                </div>
                <div class="wt-dashboardbox">
                    @if (Session::has('message'))
                        <div class="flash_msg">
                            <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                        </div>
                        @php session()->forget('message') @endphp;
                    @elseif (Session::has('error'))
                        <div class="flash_msg">
                             <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ str_replace("'s", " ", Session::get('error')) }}}'" v-cloak></flash_messages>
                        </div>
                        @php session()->forget('error'); @endphp
                    @endif
                    <div class="sj-checkoutjournal">
                        <div class="sj-title">
                            <h3>{{{trans('lang.checkout')}}}</h3>
                        </div>
                        @php
                            session()->put(['product_id' => e($appointment->id)]);
                            session()->put(['price' => e($appointment->charges)]);
                            session()->put(['name' => e('appointment:'.$appointment->appointment_date.'-'.$appointment->appointment_time)]);
                            session()->put(['type' => 'appointment']);
                        @endphp 
                        <table class="sj-checkouttable">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="sj-checkpaydetails">
                                            {{ trans('lang.doctor_name') }}
                                        </div>
                                    </td>
                                    <td>{{ Helper::getUserName($appointment->user_id) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.appointment_date') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.appointment_time') }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.appointment_status') }}</td>
                                    <td>{{ $appointment->status }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.total') }}</td>
                                    <td>{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{ $appointment->charges }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (!empty($payment_gateway))
                        <div class="sj-checkpaymentmethod">
                            <div class="sj-title">
                                <h3>{{ trans('lang.select_pay_method') }}</h3>
                            </div>
                            <div class="sj-paymentmethodcontent">
                                <ul class="sj-paymentmethod">
                                    @foreach ($payment_gateway as $gateway)
                                        <li>
                                            @if ($gateway == "paypal")
                                                @php session()->put(['gateway' => 'paypal']); @endphp
                                                <a href="{{{url('paypal/ec-checkout')}}}">
                                                    <i class="fab fa-paypal"></i>
                                                    <span><em>{{ trans('lang.pay_amount_via') }}</em> {{ Helper::getPaymentMethodList($gateway)['title']}} {{ trans('lang.pay_gateway') }}</span>
                                                </a>
                                            @elseif ($gateway == "stripe")
                                                
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <b-modal id="la-pay-stripe" ref="appointmentCheckout" hide-footer title="Stripe Payment" class="la-pay-stripe" :no-close-on-backdrop="true">
                            <div class="d-block text-center">
                                <form class="dc-formtheme wt-form-paycard" method="POST" id="stripe-payment-form" role="form" action="" @submit.prevent='submitStripeFrom' v-cloak>
                                    {{ csrf_field() }}
                                    <fieldset>
                                        <div class="form-group wt-inputwithicon {{ $errors->has('card_no') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.card_no') }}</label>
                                            <img src="{{asset('images/pay-icon.png')}}">
                                            <input id="card_no" type="text" class="form-control" name="card_no" value="{{ old('card_no') }}" autofocus>
                                            @if ($errors->has('card_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('card_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('ccExpiryMonth') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.expiry_month') }}</label>
                                            <input id="ccExpiryMonth" type="number" class="form-control" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" min="1" max="12" autofocus>
                                            @if ($errors->has('ccExpiryMonth'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('ccExpiryYear') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.expiry_year') }}</label>
                                            <input id="ccExpiryYear" type="text" class="form-control" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus>
                                            @if ($errors->has('ccExpiryYear'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group wt-inputwithicon {{ $errors->has('cvvNumber') ? ' has-error' : '' }}">
                                            <label>{{ trans('lang.cvc_no') }}</label>
                                            <img src="{{asset('images/pay-img.png')}}">
                                            <input id="cvvNumber" type="number" class="form-control" name="cvvNumber" value="{{ old('cvvNumber') }}" autofocus>
                                            @if ($errors->has('cvvNumber'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cvvNumber') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group wt-btnarea">
                                            <input type="submit" name="button" class="wt-btn" value="Pay {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{$appointment->charges}}">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </b-modal>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
