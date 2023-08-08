@php 
    $user_name = '';
    $number_of_tweets = '';
    if (Schema::hasTable('site_managements')) {
        $tweeter = App\SiteManagement::getMetaValue('footer_settings');
        $user_name = !empty($tweeter) && !empty($tweeter['twitter_user_name']) ? $tweeter['twitter_user_name'] : '';
        $number_of_tweets = !empty($tweeter) && !empty($tweeter['number_of_tweets']) ? $tweeter['number_of_tweets'] : '';
    }
    try
    {
        $data = Helper::twitterUserTimeLine($user_name, $number_of_tweets); 
    }
    catch (Exception $e)
    {
        $twitter_error = Twitter::logs();
    }
@endphp
@if (!empty($data))
    <ul class="dc-livefeeddetails">
        @foreach ($data as $key => $value)
            @php 
                $text = !empty( $value['full_text'] ) ? $value['full_text'] : '';
                $text = substr( $text, 0, 75 );
                if (!empty($value['entities'])) {
                    foreach ( $value['entities'] as $type => $entity ) {
                        if ( $type == 'hashtags' ) {
                            foreach ( $entity as $j => $hashtag ) {
                                $update_with_link = '<a href="https://twitter.com/search?q=%23' . $hashtag->text . '&amp;src=hash" target="_blank" title="' . $hashtag->text . '">#' . $hashtag->text . '</a>';
                                $update_with = !empty( $hashtag->text ) ? $hashtag->text : '';
                                $text = str_replace( '#' . $hashtag->text, $update_with, $text );
                            }

                        }
                    }
                }
            @endphp
            <li>
                @if(!empty($value['extended_entities']['media']))
                    @foreach($value['extended_entities']['media'] as $v)
                        <figure class="dc-latestadimg">
                            <img src="{{ $v['media_url_https'] }}:thumb" width="40">
                        </figure>
                    @endforeach
                @endif
                <div class="dc-latestadcontent">
                    <p>{{$text}}</p>
                    <time datetime={{date( 'Y-m-d', strtotime( $value['created_at'] ) )}}>
                        {{date( 'H:i A - m D, Y', strtotime( $value['created_at'] ) )}}
                    </time>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p class="twitter-error">{{ trans('lang.no_tweet') }}</p>
@endif