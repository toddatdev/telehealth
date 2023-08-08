@extends('master')

@push('stylesheets')
	<link href="{{ asset('css/tipso.css') }}" rel="stylesheet">
	@stack('front_end_stylesheets')
@endpush

@section('header')
	@if (($page->title == "Privacy Policy") || ($page->title == "Terms & Conditions"))
		@include('front-end.includes.header')
	@else
		@include('front-end.includes.headernew')
	@endif
@endsection
@php 
	$inner_page_settings = !empty(App\SiteManagement::getMetaValue('inner_page_data')) ? App\SiteManagement::getMetaValue('inner_page_data') : array();
@endphp

@section('main')
<main id="dc-main" class="dc-main dc-haslayout innerpagecheck">
	@yield('content')
</main>
@endsection

@section('footer')
	@include('front-end.includes.footer')
@endsection

@push('scripts')
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/tipso.js') }}"></script>
<script>
	jQuery('.dc-tipso').tipso({
    tooltipHover: true
});
</script>
@stack('front_end_scripts')
@endpush
