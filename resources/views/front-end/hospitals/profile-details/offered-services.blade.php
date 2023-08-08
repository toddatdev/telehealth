@if (!empty($specialities))
    <div class="dc-services-holder dc-aboutinfo">
        <div class="dc-infotitle">
            <h3>{{ trans('lang.offered_services') }}</h3>
        </div>
        @foreach ($specialities as $key => $data)
            @php $speciality = App\Speciality::find($data['speciality_id']); @endphp
            @if (!empty($speciality))
                <div id="dc-accordion" class="dc-accordion" role="tablist" aria-multiselectable="true">
                    <div class="dc-panel">
                        <div class="dc-paneltitle">
                            <figure class="dc-titleicon"><img src="{{ asset(Helper::getImage('uploads/specialities', $speciality->image, '', 'speciality-default.png')) }}" alt="{{ trans('lang.img_desc') }}"></figure>
                            <span>{{  html_entity_decode(clean($speciality->title)) }}<em>{{ clean($speciality->services->count()) }} {{ trans('lang.services') }}</em></span>
                        </div>
                        @if (!empty($data['services']))
                            <div class="dc-panelcontent">
                                <div id="dc-childaccordion" class="dc-childaccordion" role="tablist" aria-multiselectable="true">
                                @foreach ($data['services'] as $service_key => $service_data)
                                    @php $service_obj = App\Service::find($service_data['service']); @endphp
                                    @if (!empty($service_obj))
                                        <div class="dc-subpanel">
                                            <div class="dc-subpaneltitle">
                                                <span>{{  html_entity_decode(clean($service_obj->title)) ?? '' }}<em> {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{ clean($service_data['price']) }}</em></span>
                                            </div>
                                            <div class="dc-subpanelcontent">
                                                <div class="dc-description">
                                                    <p>{{  html_entity_decode(clean($service_data['description'])) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif
