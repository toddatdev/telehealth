<div class="dc-homesliderholder dc-haslayout" style="background:url({{ asset(Helper::getImage('uploads/settings/home', Helper::getHomeSlider('slider_bg_image'))) }})">
    <div id="dc-homeslider" class="dc-homeslider">
        <div id="dc-bannerslider" class="dc-bannerslider carousel slide" data-ride="false" data-interval="false">
            <ol class="carousel-indicators dc-bannerdots">
                <li data-target="#dc-bannerslider" data-slide-to="0" class="active"></li>
                <li data-target="#dc-bannerslider" data-slide-to="1"></li>
                <li data-target="#dc-bannerslider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @php $counter = 1; @endphp
                @foreach (Helper::getHomeSlider('home_slides') as $key => $slide)
                    @php $class = !empty($counter) && $counter === 1 ? 'active' : ''; @endphp
                    <div class="carousel-item {{ $class }}" id="carousel-item-{{ $counter }}">
                        <div class="d-flex justify-content-center dc-craousel-content">
                            <div class="mx-auto">
                                <img class="d-block dc-bannerimg" src="{{ asset(Helper::getImage('uploads/settings/home', $slide['hidden_slide_inner_image'], '', 'slider-default.png')) }}" 
                                    alt="{{ clean(trans('lang.slide_img')) }}">
                                <div class="dc-bannercontent dc-bannercotent-craousel" >
                                    <div class="dc-content-carousel">
                                        <div class="dc-num">{{ sprintf("%02d.", $counter) }}</div>
                                        <h1>
                                            <em>{{ html_entity_decode(clean($slide['slide_title_one'])) }}</em> 
                                            {{ html_entity_decode(clean($slide['slide_title_two'])) }}
                                            <span> {{ html_entity_decode(clean($slide['slide_title_three'])) }}</span>
                                        </h1>
                                        @if (!empty($slide['slide_btn_title_one']) || $slide['slide_btn_title_two'])
                                            <div class="dc-btnarea">
                                                @if (!empty($slide['slide_btn_title_one']))
                                                    <a href="{{ $slide['slide_btn_url_one'] }}" class="dc-btn dc-btnactive">{{ html_entity_decode(clean($slide['slide_btn_title_one'])) }}</a>
                                                @endif
                                                @if (!empty($slide['slide_btn_title_two']))
                                                    <a href="{{ $slide['slide_btn_url_two'] }}" class="dc-btn">{{ html_entity_decode(clean($slide['slide_btn_title_two'])) }}</a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $counter++; @endphp
                @endforeach
                <a class="dc-carousel-control-prev" href="#dc-bannerslider" role="button" data-slide="prev">
                    <span class="dc-carousel-control-prev-icon" aria-hidden="true"><span>{{ clean(trans('lang.pr')) }}</span><span class="d-block">{{ clean(trans('lang.ev')) }}</span></span>
                    <span class="sr-only">{{ clean(trans('lang.previous')) }}</span>
                </a>
                <a class="dc-carousel-control-next" href="#dc-bannerslider" role="button" data-slide="next">
                    <span class="dc-carousel-control-next-icon " aria-hidden="true"><span>{{ clean(trans('lang.ne')) }}</span><span class="d-block">{{ clean(trans('lang.xt')) }}</span></span>
                    <span class="sr-only">{{ clean(trans('lang.next')) }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
