@if (!empty($awards))
    <div class="dc-awards-holder dc-aboutinfo">
        <div class="dc-infotitle">
            <h3>{{ trans('lang.awards_recogn') }}
                @if (count($awards) > 3)
                    <a href="javascript:void(0)" v-on:click="showModal('awardsModal')">{{ trans('lang.more') }}</a>
                @endif
            </h3>
        </div>
        <ul class="dc-expandedu">
            @foreach (Helper::customPaginator(request(), $awards, 3) as $key => $award)
                <li><span>{{ html_entity_decode(clean($award['title'])) }} <em>( {{ clean($award['year']) }} )</em></span></li>
            @endforeach
        </ul>
        <b-modal ref="awardsModal" hide-footer title="{{ trans('lang.awards') }}">
            <div class="d-block text-left">
                <ul class="dc-expandedu">
                    @foreach ($awards as $key => $award)
                        <li><span>{{ html_entity_decode(clean($award['title'])) }} <em>( {{ clean($award['year']) }} )</em></span></li>
                    @endforeach
                </ul>
            </div>
        </b-modal>
    </div>
@endif
