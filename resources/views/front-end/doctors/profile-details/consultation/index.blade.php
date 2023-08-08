<div class="dc-consultation">
    <div class="dc-searchresult-head">
        <div class="dc-title"><h4>“{{ !empty($user->profile->gender_title) ? clean($user->profile->gender_title) : '' }} {{ Helper::getUserName($user->id) }}” {{ trans('lang.answers') }}</h4></div>
    </div>
    <div class="dc-consultation-content">
        @if (!empty($user->answers) && $user->answers->count() > 0)
            @foreach ($user->answers as $key => $forum)
                @php $speciality = App\Speciality::find($forum->speciality_id); @endphp
                @if (!empty($speciality))
                    <div class="dc-consultation-details">
                        <figure class="dc-consultation-img dc-imgcolor1">
                            <img src="{{ asset(Helper::getImage('uploads/specialities', $speciality->image, '-extra-small', 'default-speciality.png')) }}" alt="{{ trans('lang.ing_desc') }}">
                        </figure>
                        <div class="dc-consultation-title">
                            <h5><a href="{{ route('getForumAnswers', ['slug' => $forum->slug]) }}">{{ html_entity_decode(clean($forum->question_title)) }}</a><em>{{ Carbon\Carbon::parse($forum->created_at)->format('M d, Y') }}</em></h5>
                            <span>{{ trans('lang.answered_by') }} “{{ Helper::getUserName($user->id) }}”</span>
                        </div>
                        <div class="dc-description">
                            <p>{{ html_entity_decode(clean($forum->pivot->answer)) }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
            @if ( method_exists($user->answers,'links') )
                {{ $user->answers->links('pagination.custom') }}
            @endif
        @else
            @include('errors.no-record')
        @endif
    </div>
</div>
