@extends('front-end.master')
@section('content')
@include('includes.pre-loader')
    @php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'; @endphp
    @if ($display_sidebar == 'true')
        @php 
            $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12';
        @endphp
    @endif
    <div class="container">
        <div class="row">
            <div class="dc-twocolumns dc-haslayout" id="forum">
                <div class="dc-preloader-section" v-if="loading" v-cloak>
                    <div class="dc-preloader-holder">
                        <div class="dc-loader"></div>
                    </div>
                </div>
                <div class="{{ $columns }} float-left">
                    <div class="dc-questionsection">
                        <div class="dc-askquery">
                            <div class="dc-postquestion">
                                <div class="dc-title">
                                    <span href="javascript:void(0)">{{{ html_entity_decode(clean($forum_banner_subtitle)) }}}</span>
                                    <h2>{{{ html_entity_decode(clean($forum_banner_title)) }}}</h2>
                                </div>
                                <div class="dc-description">
                                    <p>{{{ html_entity_decode(clean($forum_banner_desc)) }}}</p>
                                </div>
                                <div class="dc-btnarea">
                                    <a href="javascript:void(0);" class="dc-btn" v-on:click="showModal('postQuestion')">{{ trans('lang.post_question') }}</a>
                                </div>
                            </div>
                            @if (!empty($forum_banner_image))
                                <figure>
                                    <img src="{{ asset('uploads/settings/general/'.$forum_banner_image) }}" alt="{{trans('lang.img_desc') }}">
                                </figure>
                            @endif
                        </div>
                    </div>
                    <div class="dc-forumcomments">
                        <div class="dc-forumcomments-details">
                            <a href="javascript:void(0);"><i class="ti-angle-left"></i></a>
                            @if (!empty($user))
                                <figure class="dc-consultation-img ">
                                    <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id, $user->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{trans('lang.img_desc') }}">
                                </figure>
                                <div class="dc-consultation-title">
                                    <h5><a href="javascript:void(0);"></a>{{ Helper::getUserName($user->id) }}<em>{{ html_entity_decode(clean($user->profile->gender_title)) }}</em></h5>
                                </div>
                            @endif
                            <div class="dc-description">
                                <p>{{ html_entity_decode(clean($forum->question_description)) }}</p>
                            </div>
                        </div>
                        {!! Form::open(['class' => 'dc-formtheme', 'id' => 'post-answer-form', '@submit.prevent'=>'postAnswer("'.$forum->id.'")']) !!}
                            <div class="form-group">
                                {!! Form::textarea('forum_answer', null, ['class' => 'form-control', 'placeholder' => trans('lang.type_reply')]) !!}
                            </div>
                            <div class="dc-btnarea">
                                {!! Form::submit(trans('lang.submit'), ['class' => "dc-btn"]) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                     <div class="dc-docsingle-holder">
                        <div class="tab-content dc-haslayout">
                            <div class="dc-contentdoctab dc-feedback-holder" id="feedback">
                                <div class="dc-feedback">
                                    <div class="dc-searchresult-head">
                                        <div class="dc-title"><h4>{{ clean($forum->answers->count()) }} {{ trans('lang.answers') }}</h4></div>
                                    </div>
                                    <div class="dc-consultation-content dc-forumcontent">
                                        @if ($forum->answers->count() > 0 && !empty($forum->answers))
                                            @foreach ($forum->answers as $answer)
                                                @php $user = App\User::find($answer->pivot->user_id); @endphp
                                                <div class="dc-consultation-details">
                                                    <figure class="dc-consultation-img ">
                                                        <img src="{{ asset(Helper::getImage('uploads/users/'.$user->id, $user->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                                    </figure>
                                                    <div class="dc-consultation-title">
                                                        <h5><a href="javascript:void(0);">{{ html_entity_decode(clean($user->profile->gender_title)) }} {{ Helper::getUserName($user->id) }}</a>{{ Helper::verifyUser($answer->pivot->user_id) }}</h5>
                                                        @if (in_array($answer->pivot->id, $liked_answers))
                                                            <a href="javascript:void(0);" class="wt-clicksave dc-btndisbaled dc-likans">
                                                                <span class="wt-clicksave dc-btndisbaled dc-likans">{{ trans('lang.liked_answer')}} <i class="far fa-thumbs-up"></i></span>
                                                            </a>
                                                        @else
                                                            <a href="javascrip:void(0);" id="answer-{{ $answer->pivot->user_id }}" @click.prevent="addLikedAnswer('answer-{{ $answer->pivot->user_id }}', '{{ $answer->pivot->id }}', 'liked_answers', '')">
                                                                <span>@{{ like_answer_text }} <i class="far fa-thumbs-up"></i></span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="dc-description">
                                                        <p>{{ html_entity_decode(clean($answer->pivot->answer)) }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ( method_exists($forum->answers,'links') )
                                                {{ $forum->answers->links('pagination.custom') }}
                                            @endif
                                        @else
                                            @include('errors.no-record')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <b-modal ref="postQuestion" hide-footer title="{{trans('lang.post_question')}}" class="la-pay-stripe">
                    <div class="modal-body">
                        {!! Form::open(['class' => 'dc-formtheme dc-formhelp', 'id' => 'post-question-form', '@submit.prevent'=>'postQuestion']) !!}
                            <fieldset>
                                <div class="form-group">
                                    <span class="dc-select">
                                        <select name = "speciality">
                                            <option value="" disabled selected>{{trans('lang.ph.select_speciality')}}</option>
                                            @foreach ($specialities as $key => $speciality)
                                                <option value="{{html_entity_decode(clean($key))}}">{{html_entity_decode(clean($speciality))}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>
                                <div class="form-group">
                                    {!! Form::text('question_title', null, ['class' => 'form-control', 'placeholder' => trans('lang.ph.question_title')]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea('question_desc', null, ['class' => 'form-control', 'placeholder' => trans('lang.ph.question_desc')]) !!}
                                </div>
                                <div class="form-group dc-btnarea">
                                    {!! Form::submit(trans('lang.ask_free_query'), ['class' => 'dc-btn']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </b-modal>
            </div>
        </div>
    </div>
@endsection
