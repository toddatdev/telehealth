@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
    <div class="row" id="appointment_locations">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
            @include('back-end.doctors.appointment_locations.edit.location')
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 dc-responsive-mt mt-xl-0">
            @include('back-end.doctors.appointment_locations.edit.service')
        </div>
    </div>
@endsection
@push('backend_scripts')
    <script>
        jQuery(document).ready(function (){
            /* THEME ACCORDION */
        function themeAccordion() {
            jQuery('.dc-panelcontent').hide();
            jQuery('.dc-accordion .dc-paneltitle:first').addClass('active').next().slideDown('slow');
            jQuery('.dc-accordion .dc-paneltitle').on('click',function() {
                if(jQuery(this).next().is(':hidden')) {
                    jQuery('.dc-accordion .dc-paneltitle').removeClass('active').next().slideUp('slow');
                    jQuery(this).toggleClass('active').next().slideDown('slow');
                }
            });
        }
        themeAccordion();
        function childAccordion() {
            jQuery('.dc-subpanelcontent').hide();
            jQuery('.dc-childaccordion .dc-subpaneltitle:first').addClass('active').next().slideDown('slow');
            jQuery('.dc-childaccordion .dc-subpaneltitle').on('click',function() {
                if(jQuery(this).next().is(':hidden')) {
                    jQuery('.dc-childaccordion .dc-subpaneltitle').removeClass('active').next().slideUp('slow');
                    jQuery(this).toggleClass('active').next().slideDown('slow');
                }
            });
        }
        childAccordion();
        });
    </script>
@endpush