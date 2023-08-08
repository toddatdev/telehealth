<div class="dc-widget dc-onlineoptions">
    @if (!empty($ask_query_img))
        <figure class="dc-onlinuserimg">
            <img src="{{ asset(Helper::getImage('uploads/settings/general', $ask_query_img)) }}">
        </figure>
    @endif
    @if (!empty($query_title) 
        || !empty($query_subtitle)
        || !empty($query_btn_title)
        || !empty($query_desc) 
        )
        <div class="dc-onlineoption-content">
            <div class="dc-title">
                <h3><span>{{ html_entity_decode(clean($query_subtitle)) }}</span> {{ html_entity_decode(clean($query_title)) }}</h3>
            </div>
            <div class="dc-btnarea">
                <a href="{{ url($query_btn_link) }}" class="dc-btn dc-btnactive">{{ html_entity_decode(clean($query_btn_title)) }}</a>
                <span>{{ html_entity_decode(clean($query_desc)) }}</span>
            </div>
        </div>
    @endif
</div>
