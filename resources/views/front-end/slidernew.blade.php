<div class="video-banner-container">
    <video autoplay muted loop preload="auto" src="/uploads/settings/home/banner.mov" style="width: 100%;" id="headervideotitle"></video>
    <div class="blackoverflowvideo"></div>
</div>


<div class="dc-advancedsearch">
<h1>Medical Consultations on your <span>Computer</span><br> 
<span>Tablet</span> or <span>Mobile Device</span></h1>
<p>See a doctor WHEN and WHERE it’s convenient for you. Professional advice available 24/7.</p>
    {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'search_form', 'class' => 'dc-formtheme dc-form-advancedsearch']) !!}
        <fieldset>
            <div>
                <input type="text" id="search-query-header" name="search" value="" class="form-control search-query-autocomplete" placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
            </div>
            <div class="dc-formbtn">
                {{ Form::button('<span>SEARCH</span>', ['type' => 'submit', 'class' => 'btn-sm'] )  }}
            </div>
        </fieldset>
    {!! form::close(); !!}
</div>