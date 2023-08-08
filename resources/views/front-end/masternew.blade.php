@extends('master')

@push('stylesheets')
	<link href="{{ asset('css/tipso.css') }}" rel="stylesheet">

	@stack('front_end_stylesheets')
@endpush

@section('header')
	@include('front-end.includes.headernew')
@endsection
@php 
	$inner_page_settings = !empty(App\SiteManagement::getMetaValue('inner_page_data')) ? App\SiteManagement::getMetaValue('inner_page_data') : array();
@endphp

@section('main')
<main id="dc-main" class="dc-main dc-haslayout firstpagecheck">
	@yield('content')
</main>
@endsection

@section('footer')
	@include('front-end.includes.footer')
@endsection

@push('scripts')
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/tipso.js') }}"></script>
<script src="{{ asset('extra/js/jquery.easy-autocomplete.min.js') }}"></script>

<script type="text/javascript">
	jQuery('.dc-tipso').tipso({
    	tooltipHover: true
	});

	fetch("{{ asset('extra/js/postcodes.json') }}", {credentials: 'same-origin'}).then(response => {
		console.log(response);
	});

	var options = {

		url: "{{ asset('extra/js/postcodes.json') }}",
		
		getValue: function(field){
				return field.locality + " " + field.state + " " + field.postcode;
		},
		requestDelay: 1000,

		list: {
			match: {
				enabled: true
			}
		}

	};

	jQuery(".search-query-autocomplete").easyAutocomplete(options);


</script>

@stack('front_end_scripts')
@endpush
