@if (!empty($registration_details['registration_number']))
    <div class="dc-specializations dc-aboutinfo dc-memberships">
        <div class="dc-infotitle">
            <h3>{{ trans('lang.registrations') }}</h3>
        </div>
        <ul class="dc-specializationslist">
            <li><span>{{ html_entity_decode(clean($registration_details['registration_number'])) }}</span></li>
        </ul>
    </div>
@endif
