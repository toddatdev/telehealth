@push('backend_stylesheets')
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endpush
{!! Form::open(['class' =>'dc-formtheme dc-userform', 'id' =>'payment-form', '@submit.prevent'=>'submitPaymentSettings'])!!}
    <div class="dc-currencysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.currency_setting') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        <span class="dc-select">
                        {{{ Form::select('currency', $currency, e($existing_currency), ['class'=>'form-control','placeholder'=>trans('lang.select_currency')]) }}}
                    </span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-paymentmethod dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.select_payment_method') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        <span class="dc-select">
                            <select name="payment_method[]" class="chosen-select" multiple data-placeholder = "{{trans('lang.select_payment_method')}}">
                                @foreach ($payment_methods as $key => $payment_method)
                                    @php $selected = in_array($payment_method['value'], $payment_gateway) ? 'selected': ''; @endphp
                                    <option value="{{$payment_method['value']}}" {{$selected}}>{{ html_entity_decode(clean($payment_method['title'])) }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-min-payout dc-tabsinfo">
        <div class="dc-tabscontenttitle">
            <h3>{{{ trans('lang.min_payout') }}}</h3>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-description">
                <p>{{ trans('lang.set_min_payout') }}</p>
            </div>
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::number('min_payout', e($min_payout), ['class' => 'form-control', 'placeholder' => trans('lang.min_payout')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-updateall-holder mb-5 mt-0">
            {!! Form::submit(trans('lang.btn_save'),['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
@push('backend_scripts')
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script>
        jQuery('.chosen-select').chosen();
    </script>
@endpush

