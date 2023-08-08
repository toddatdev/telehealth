@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('stylesheets')
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print" type="text/css">
@endpush
@section('content')
    <div class="dc-haslayout dc-dbsectionspace">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="invoice_list">
                <div class="dc-transactionhold">
                    <div class="dc-borderheading dc-borderheadingvtwo">
                        <h3>{{{trans('lang.transaction_detl')}}}</h3>
                        <a class="print-window" href="javascript:void(0);" @click="print()">
                            <i class="fa fa-print"></i>
                            {{{trans('lang.print')}}}
                        </a>
                    </div>
                    <div class="dc-transactioncontent" id="printable_area">
                        <ul class="dc-transactiondetails">
                            <li><span><em>{{{trans('lang.pay_rec')}}}</em> {{{trans('lang.from')}}} {{ $order->metaValue('payer_name') }}</span><span class="dc-grossamount">{{{trans('lang.gross_amnt')}}}</span></li>
                            <li>
                                <span>
                                    {{{ Carbon\Carbon::parse($order->created_at)->diffForHumans()}}} on {{{Carbon\Carbon::parse($order->created_at)->format('l \\a\\t H:i:s')}}}
                                </span>
                                <span class="dc-transactionid">
                                    {{{trans('lang.transaction_id')}}}:&nbsp;{{ html_entity_decode(clean($order->metaValue('transaction_id'))) }}
                                </span>
                                @if (!empty($order->metaValue('customer_id')))
                                    <span class="dc-transactionid">
                                        {{{trans('lang.customer_id')}}}:&nbsp;{{ html_entity_decode(clean($order->metaValue('customer_id'))) }}
                                    </span>
                                @endif
                                <span class="dc-grossamount dc-grossamountusd">{{{ $symbol }}}{{ intVal(clean($options['charges'])) }}&nbsp;{{{ clean($currency_code) }}}</span>
                            </li>
                            <li>
                                <span>{{{trans('lang.pay_status')}}}&nbsp;&colon;</span>
                                @if (!empty($order->status))
                                    <span class="dc-paymentstatus">{{{ clean($order->status) }}}</span>
                                @endif
                            </li>
                        </ul>
                        <table class="table dc-carttable">
                            <thead>
                                <tr>
                                    <th>{{{trans('lang.product_name')}}}</th>
                                    <th>{{{trans('lang.product_qty')}}}</th>
                                    <th>{{{trans('lang.product_price')}}}</th>
                                    <th>{{{trans('lang.product_subtotal')}}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{ html_entity_decode(clean($order->metaValue('invoice_id'))) }}}</em>
                                    </td>
                                    <td data-title="Unit Price">{{{ clean($options['charges']) }}}</td>
                                    <td data-title="Total">{{ $symbol }}{{{ clean($options['charges']) }}}&nbsp;{{ clean($currency_code) }}</td>
                                    <td data-title="Total">{{ $symbol }}{{{ clean($options['charges']) }}}&nbsp;{{ clean($currency_code) }}</td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name"></td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Unit Price">{{{trans('lang.purchase_total')}}}</td>
                                    <td data-title="Total">{{ $symbol }}{{{ clean($options['charges']) }}}&nbsp;{{ clean($currency_code) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table dc-carttable dc-carttablevtwo">
                            <thead>
                                <tr>
                                    <th>{{{trans('lang.pay_detl')}}}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.purchase_total')}}}</em>
                                        <span>{{ $symbol }}{{{ clean($options['charges']) }}}&nbsp;{{ clean($currency_code) }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.sales_tax')}}}</em>
                                        <span>{{ $symbol }}{{{ clean($order->metaValue('sales_tax')) }}} {{ clean($currency_code) }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.shiping_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ clean($order->metaValue('shipping_amount')) }}} {{ clean($currency_code) }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.handling_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ clean($order->metaValue('handling_amount')) }}} {{ clean($currency_code) }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.insurance_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ clean($order->metaValue('handling_amount')) }}} {{ clean($currency_code) }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                                <tr>
                                    <td data-title="Product Name">
                                        <em>{{{trans('lang.net_amnt')}}}</em>
                                        <span>{{ $symbol }}{{{ clean($options['charges']) }}} {{ clean($currency_code) }}</span>
                                    </td>
                                    <td data-title="Unit Price"></td>
                                    <td data-title="Total"></td>
                                    <td data-title="Total"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="dc-createtransactionhold dc-createtransactionholdvtwo">
                            <div class="dc-createtransactionheading">
                                <span></span>
                            </div>
                            <div class="dc-refundscontent">
                                <ul class="dc-refundsdetails">
                                    <li>
                                        <strong>{{{trans('lang.invoice_id')}}}</strong>
                                        <div class="dc-rightarea"><span>{{{ html_entity_decode(clean($order->metaValue('invoice_id'))) }}}</span></div>
                                    </li>
                                    <li>
                                        <strong>{{{trans('lang.paid_by')}}}</strong>
                                        <div class="dc-rightarea">
                                            <span>{{{ html_entity_decode(clean($order->metaValue('payer_name'))) }}}</span>
                                            <span>{{{trans('lang.pay_sender_note')}}} <em>{{{ clean($order->status) }}}</em> </span>
                                            <span>{{{ html_entity_decode(clean($order->metaValue('payer_email'))) }}}</span>
                                        </div>
                                    </li>
                                    @if ($order->payment_gateway == "paypal")
                                        <li>
                                            <strong><span>{{{trans('lang.need_help')}}}</span></strong>
                                            <span class="dc-refundsinfo">{{{trans('lang.paypal_note')}}}</span>
                                        </li>
                                        <li><span class="dc-refundsinfo">{{{ trans('lang.paypal_warning_note') }}}</span></li>
                                    @endif
                                    <li>
                                        <strong>{{{trans('lang.memo')}}}</strong>
                                        <div class="dc-rightarea"><span>{{{ html_entity_decode(clean($order->metaValue('invoice_id'))) }}}</span></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
