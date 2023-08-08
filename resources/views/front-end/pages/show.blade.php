@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ?
 'extend.front-end.master': 'front-end.masterpage', ['body_class' => 'dc-innerbgcolor'] )
@push('stylesheets')
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
@endpush
@section('title'){{ clean($page->title) }} @stop
@section('description', clean("$meta_desc"))
@section('content')
@include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('showPage', $page) !!}
    @if (!empty($page))
        <div class="dc-contentwrappers">                 
            <div class="dc-howitwork-hold dc-haslayout">
                <div class="dc-haslayout">
                    @php echo htmlspecialchars_decode(stripslashes($page->body)); @endphp
                </div>
            </div>                   
        </div>
    @else
        @if (file_exists(resource_path('views/extend/errors/404.blade.php')))
            @include('extend.errors.404')
        @else
            @include('errors.404')
        @endif
    @endif
@endsection
@push('scripts')
    <script src="{{ asset('js/prettyPhoto.js') }}"></script>
    <script>
        jQuery("a[data-rel]").each(function () {
            jQuery(this).attr("rel", jQuery(this).data("rel"));
        });
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'dark_square',
            slideshow: 3000,
            autoplay_slideshow: false,
            social_tools: false
        });
    </script>


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
                return field.locality+" "+field.state+" "+field.postcode;
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
@endpush
