@extends('front-end.master')
@push('front_end_stylesheets')
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('includes.pre-loader')
    {!! Helper::displayBreadcrumbs('forumQuestions') !!}
    @php $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'; @endphp
    @if ($display_sidebar == 'true')
        @php 
            $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12';
        @endphp
    @endif
    <div class="dc-haslayout dc-main-section">
        <div class="container" id="forum">
            <div class="dc-preloader-section" v-if="loading" v-cloak>
                <div class="dc-preloader-holder">
                    <div class="dc-loader"></div>
                </div>
            </div>
            <div class="row">
                <div class="dc-twocolumns dc-haslayout">
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
                                        <img src="{{ asset('uploads/settings/general/'.html_entity_decode(clean($forum_banner_image))) }}" alt="{{ trans('lang.img_desc') }}">
                                    </figure>
                                @endif
                            </div>
                        </div>
                        <div class="dc-innerbanner">
                            <form class="dc-formtheme  dc-forumform" action="{{ route('searchQueryFilter') }}" method="GET">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" value="{{ !empty(request()->keyword) ? clean(request()->keyword) : ''  }}" placeholder="{{ trans('lang.type_query') }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="dc-select">
                                            <select name = "speciality">
                                                <option value="" selected>{{trans('lang.select_specialties')}}</option>
                                                @foreach ($specialities as $key => $speciality)
                                                    @php $selected = !empty(request()->speciality) && request()->speciality == clean($key) ? 'selected' : ''; @endphp
                                                    <option value="{{clean($key)}}" {{$selected}}>{{html_entity_decode(clean($speciality))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dc-btnarea">
                                        <button type="submit" class="dc-btn">{{ trans('lang.search') }}</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="dc-docsingle-holder">
                            <div class="tab-content dc-haslayout">
                                <div class="dc-contentdoctab dc-feedback-holder" id="feedback">
                                    <div class="dc-feedback">
                                        <div class="dc-searchresult-head">
                                            <div class="dc-title"><h4>{{trans('lang.health_forum_for_all') }}</h4></div>
                                            <div class="dc-rightarea">
                                                <form action="{{ route('searchQueryFilter') }}" method="GET">
                                                    <div class="dc-select">
                                                        <select name="sort_by" id="forum_sort" v-on:change="resultSortBy()">
                                                            <option value='null'>{{ trans('lang.sort_by') }}</option>
                                                            @foreach (Helper::sortByArray() as $key => $value)
                                                                <option value="{{ html_entity_decode(clean($key)) }}" {{ !empty($_GET['sort_by']) && $_GET['sort_by'] == $key ? 'selected' : ''}}>{{ html_entity_decode(clean($value)) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dc-consultation-content">
                                            @if (!empty($questions) && $questions->count() > 0)
                                                @foreach ($questions as $question)
                                                    @php
                                                        $speciality = App\Speciality::find($question->speciality_id);
                                                        $speciality_image = !empty($speciality) && !empty($speciality->image) ? $speciality->image : '';
                                                        $forum = App\Forum::findOrFail($question->id);
                                                    @endphp
                                                    <div class="dc-consultation-details">
                                                        <figure class="dc-consultation-img dc-imgcolor1">
                                                            <img src="{{ asset(Helper::getImage('uploads/specialities', $speciality_image, 'extra-small-', 'default-speciality.png')) }}" alt="{{ trans('lang.ing_desc') }}">
                                                        </figure>
                                                        <div class="dc-consultation-title">
                                                            <h5><a href="{{ route('getForumAnswers', ['slug' => clean($question->slug)]) }}">{{ html_entity_decode(clean($question->question_title)) }}</a><em>{{ Carbon\Carbon::parse(html_entity_decode(clean($question->created_at)))->format('M d, Y') }}</em></h5>
                                                            <span>{{ clean($forum->answers->count()) }} {{ trans('lang.answers') }}</span>
                                                        </div>
                                                        <div class="dc-description">
                                                            <p>{{ html_entity_decode(clean($question->question_description)) }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if (method_exists($questions,'links'))
                                                    {{ $questions->links('pagination.custom') }}
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

                    <b-modal ref="postQuestion" id="la-postquestion" hide-footer title="{{trans('lang.post_question')}}" class="la-pay-stripe">
                        <div class="modal-body">
                            {!! Form::open(['class' => 'dc-formtheme dc-formhelp', 'id' => 'post-question-form', '@submit.prevent'=>'postQuestion']) !!}
                                <fieldset>
                                    <div class="form-group">
                                        <span class="dc-select">
                                            <select name = "speciality">
                                                <option value="" disabled selected>{{trans('lang.select_specialties')}}</option>
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
    </div>
@endsection
@push('front_end_scripts')
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script>
        jQuery('.chosen-select').chosen();
    </script>
@endpush

