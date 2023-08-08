@extends('master')
@push('PackageStyle')
    <link href="{{ asset('css/antd.css') }}" rel="stylesheet">
@endpush
@push('stylesheets')
@stack('backend_stylesheets')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/dbresponsive.css') }}" rel="stylesheet">
<link href="{{ asset('css/emojionearea.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/scrollbar.css') }}" rel="stylesheet">
@endpush
@section('main')
<div class="dc-contentwrapper">
    @include('back-end.includes.header')
	<main id="dc-main" class="dc-main dc-haslayout">
        @auth
            <div id="dc-sidebarwrapper" class="dc-sidebarwrapper">
                @include('back-end.includes.dashboard-menu')
            </div>
        @endauth
		<section class="dc-haslayout dc-dbsectionspace">
			@yield('content')
		</section>
	</main>
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script src="{{ asset('js/scrollbar.min.js') }}"></script>
<script type="text/javascript">
    $(window).scroll(function () {          
        var $pscroll = $(window).scrollTop();                       
            if($pscroll > 76) {
             $('.dc-sidebarwrapper').addClass('dc-fixednav');
            }else{
             $('.dc-sidebarwrapper').removeClass('dc-fixednav');
            }
        });
</script>

<script>
    $('ul li a').filter(function(){
        return this.href === location.href;
    }).addClass('active');

</script>
@endpush
