{!! Form::open(['url' => '', 'class' => 'dc-formtheme dc-socials-form', 'id'=>'social-settings-form', '@submit.prevent'=>'submitSocialSettings']) !!}
    <fieldset class="social-icons-content dc-socialiconscontent">
        @if (!empty($socials_array))
            @php $counter = 0 @endphp
            @foreach ($socials_array as $unserializeKey =>$unserializevalue)
                <div class="wrap-social-icons dc-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            <span class="dc-select dc-select-half">
                                <select name="social[{{{$counter}}}][title]" class="form-control">
                                    <option value="null" selected>{{{trans('lang.select_social_icons')}}}</option>
                                    @foreach ($social_list as $key => $value)
                                        @php
                                            $selected = 'selected';
                                            $selected_value = $unserializevalue['title'] === $key ? $selected : '';
                                        @endphp
                                        <option value="{{{$key}}}" {{{$selected_value}}}>{{{ html_entity_decode(clean($value['title'])) }}}</option>
                                    @endforeach
                                </select>
                            </span>
                            {!! Form::text('social['.$counter.'][url]', $unserializevalue['url'],
                                ['class' => 'form-control dc-social-url-half'])
                            !!}
                        </div>
                        <div class="form-group dc-rightarea">
                            @if ($unserializeKey == 0 )
                                <span class="dc-addinfobtn" @click="addSocial"><i class="fa fa-plus"></i></span> @else
                                <span class="dc-addinfobtn dc-deleteinfo delete-social" data-check="{{{$counter}}}">
                                    <i class="fa fa-trash"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            <div class="wrap-social-icons dc-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        <span class="dc-select dc-select-half">
                            <select name="social[0][title]" class="form-control">
                                <option value="null" selected>{{ trans('lang.select_social_icons') }}</option>
                                @foreach($social_list as $key => $value)
                                    <option value="{{{$key}}}">{{{ html_entity_decode(clean($value['title'])) }}}</option>
                                @endforeach
                            </select>
                        </span>
                        {!! Form::text('social[0][url]', null, ['class' => 'form-control dc-social-url-half',
                            'placeholder' => trans('lang.ph.social_url'),'v-model' => 'first_social_url'])
                        !!}
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-addinfobtn" @click="addSocial"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
            </div>
        @endif
            <div v-for="(social, index) in socials" v-cloak>
                <div class="wrap-social-icons dc-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            <span class="dc-select dc-select-half">
                                <select class="form-control" v-bind:name="'social['+[social.count]+'][title]'">
                                    <option>{{{trans('lang.select_social_icons')}}}</option>
                                    @foreach($social_list as $key => $value)
                                        <option value="{{{$key}}}">{{{ html_entity_decode(clean($value['title'])) }}}</option>
                                    @endforeach
                                </select>
                            </span>
                            <input placeholder="{{{trans('lang.ph.social_url')}}}" v-bind:name="'social['+[social.count]+'][url]'" type="text"
                                class="form-control dc-social-url-half" v-model="social.social_url">
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeSocial(index)"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
    </fieldset>
    <div class="dc-updatall la-updateall-holder">
        {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
    </div>
{!! Form::close() !!}
