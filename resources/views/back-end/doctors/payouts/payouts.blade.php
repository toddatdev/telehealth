@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <section class="dc-haslayout dc-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 float-right" id="invoice_list">
                <div class="dc-dashboardbox dc-dashboardinvocies">
                    @if (file_exists(resource_path('views/extend/back-end/doctors/profile-settings/tabs.blade.php')))
                        @include('extend.back-end.doctors.payouts.tabs')
                    @else
                        @include('back-end.doctors.payouts.tabs')
                    @endif
                    <div class="dc-tabscontent tab-content">
                        <div class="dc-tabscontenttitle">
                            <h3>{{ trans('lang.payouts') }}</h3>
                        </div>
                        <div class="dc-dashboardboxcontent dc-categoriescontentholder dc-categoriesholder">
                            @if ($payouts->count() > 0)
                                <table class="dc-tablecategories">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('lang.date') }}</th>
                                            <th>{{ trans('lang.amount') }}</th>
                                            <th>{{ trans('lang.payment_method') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payouts as $key => $payout)
                                            <tr>
                                                <td>{{{ \Carbon\Carbon::parse($payout->created_at)->format('M d, Y') }}}</td>
                                                <td>{{ Helper::currencyList($payout->currency)['symbol'] }}{{{ intVal(clean($payout->amount)) }}}</td>
                                                <td>
                                                    {{!empty($payout->payment_method) ? html_entity_decode(clean($payout->payment_method)) : ''}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($payouts,'links') )
                                    {{ $payouts->links('pagination.custom') }}
                                @endif
                            @else
                                @if (file_exists(resource_path('views/extend/errors/no-record.blade.php')))
                                    @include('extend.errors.no-record')
                                @else
                                    @include('errors.no-record')
                                @endif
                            @endif
                        </div>
                    </div
                </div>
            </div>
        </div>
    </section>
@endsection
