@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
    <link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 float-right" id="invoice_list">
                <div class="wt-dashboardbox la-payout-admin">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch wt-titlewithbtn">
                        <h3>{{ trans('lang.payouts') }}</h3>
                        <div class="dc-rightarea">
                            {!! Form::open(['url' => url('admin/payouts'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch', 'id'=>'payout_year_filter']) !!}
                                <span class="dc-select">
                                    <select name="year" @change.prevent='getPayouts' id="payout_year">
                                        <option value="" disabled selected>{{ trans('lang.select_year') }}</option>
                                        @foreach ($years as $key => $year)
                                            @php $selected = $selected_year == $year ? 'selected' : '' @endphp
                                            <option value="{{$year}}" {{$selected}}> {{clean($year)}} </option>
                                        @endforeach
                                    </select>
                                </span>
                                <span class="dc-select">
                                    <select name="month" @change.prevent='getPayouts' id="payout_month">
                                        <option value="" disabled selected>{{ trans('lang.select_month') }}</option>
                                        @foreach ($months as $key => $month)
                                            @php $selected = $selected_month == $key ? 'selected' : '' @endphp
                                            <option value="{{$key}}" {{$selected}}> {{clean($month)}} </option>
                                        @endforeach
                                    </select>
                                </span>
                            {!! Form::close() !!}
                             @if ($selected_year)
                                <a href="{{url('admin/payouts/download/'.$selected_year.'/'.$selected_month)}}" class="dc-btn"> {{ trans('lang.download') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="wt-dashboardboxcontent wt-categoriescontentholder wt-categoriesholder">
                        @if (file_exists(resource_path('views/extend/back-end/admin/payouts-table.blade.php'))) 
                            @include('extend.back-end.admin.payouts-table')
                        @else 
                            @include('back-end.admin.payouts-table')
                        @endif
                        @if ($payouts->count() === 0)
                            @if (file_exists(resource_path('views/extend/errors/no-record.blade.php'))) 
                                @include('extend.errors.no-record')
                            @else 
                                @include('errors.no-record')
                            @endif
                        @endif
                        @if ( method_exists($payouts,'links') )
                            {{ $payouts->links('pagination.custom') }}
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
