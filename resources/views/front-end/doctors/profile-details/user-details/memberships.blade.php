
@if (!empty($memberships))
    <div class="dc-specializations dc-aboutinfo dc-memberships">
        <div class="dc-infotitle">
            <h3>{{ trans('lang.memberships') }}
                @if (count($memberships) > 3)
                    <a href="javascript:void(0)" v-on:click="showModal('memberModal')">{{ trans('lang.more') }}</a>
                @endif
            </h3>
        </div>
            <ul class="dc-specializationslist">
                @foreach(Helper::customPaginator(request(), $memberships, 3) as $key => $membership)
                    <li><span>{{ html_entity_decode(clean($membership['title'])) }}</span></li>
                @endforeach
            </ul>
        <b-modal ref="memberModal" hide-footer title="{{ trans('lang.memberships') }}">
            <div class="d-block text-left">
                <ul class="dc-expandedu">
                    @foreach($memberships as $key => $membership)
                        <li><span>{{ html_entity_decode(clean($membership['title'])) }}</span></li>
                    @endforeach
                </ul>
            </div>
        </b-modal>
    </div>
@endif
