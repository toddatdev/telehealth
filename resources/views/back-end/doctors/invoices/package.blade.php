@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section class="dc-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 float-right" id="invoice_list">
                <div class="dc-dashboardbox dc-dashboardinvocies">
                    <div class="dc-dashboardboxtitle dc-titlewithsearch">
                        <h3>{{ trans('lang.invoices') }}</h3>
                    </div>
                    <div class="dc-dashboardboxcontent dc-categoriescontentholder dc-categoriesholder" id="printable_area">
                        @if (!empty($invoices) && $invoices->count() > 0)
                            <table class="dc-tablecategories dc-table-responsive">
                                <thead>
                                    <tr>
                                        <th>{{ trans('lang.invoice_id') }}</th>
                                        <th>{{ trans('lang.purchase_date') }}</th>
                                        <th>{{ trans('lang.expriry_date') }}</th>
                                        <th>{{ trans('lang.amount') }}</th>
                                        <th>{{ trans('lang.status') }}</th>
                                        <th>{{ trans('lang.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        @php
                                            $order = App\Order::findOrFail($invoice->id);
                                            $expiry_date = '';
                                            if (!empty($order->metaValue('package'))) {
                                                $options = unserialize($order->metaValue('package'));
                                                $package_options = unserialize($options['options']);
                                                if ($package_options['duration'] === '10') {
                                                    $expiry_date = !empty($order->created_at) ? $order->created_at->addDays(4) : '';
                                                } elseif ($package_options['duration'] === '30') {
                                                    $expiry_date = !empty($order->created_at) ? $order->created_at->addDays(30): '';
                                                } elseif ($package_options['duration'] === '360') {
                                                    $expiry_date = !empty($order->created_at) ? $order->created_at->addDays(360) : '';
                                                } 
                                            } else {
                                                $expiry_date = '';
                                            }
                                        @endphp
                                        @if (!empty($invoice))
                                            <tr>
                                                <td>{{{ !empty($order->metaValue('invoice_id')) ? $order->metaValue('invoice_id') : trans('lang.not_available') }}}</td>
                                                <td>{{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}}</td>
                                                <td>{{{ \Carbon\Carbon::parse($expiry_date)->format('M d, Y') }}}</td>
                                                <td>{{{ !empty($symbol) ? $symbol['symbol'] : '$'  }}}{{{ intVal(clean($options['cost'])) }}}</td>
                                                <td> {{{ $order->status }}} </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        @if ($order->status == 'completed')
                                                            <a class="print-window dc-addinfo dc-skillsaddinfo" href="{{ route('showInvoice',['id' => intVal(clean($order->id))]) }}">
                                                                {{ trans('lang.view_invoice') }}
                                                            </a>
                                                        @else
                                                            <a class="print-window dc-addinfo dc-skillsaddinfo disable-eye" href="javascript:;">
                                                                {{ trans('lang.view_invoice') }}
                                                            </a>
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
                        @if ( method_exists($invoices,'links') )
                            {{ $invoices->links('pagination.custom') }}
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