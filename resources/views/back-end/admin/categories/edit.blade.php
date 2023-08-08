@extends('back-end.master')
@section('content')
    @include('includes.pre-loader')
    <div class="dc-categories" id="cats">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="dc-haslayout la-editcategory">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                    <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_cat') }}}</h2>
                        </div>
                        <div class="dc-dashboardboxcontent">
                            {!! Form::open(['url' => url('admin/categories/update/'.$cats->id),
                                'class' =>'dc-formtheme dc-formprojectinfo dc-formcategory', 'id' => 'categories'] )
                            !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', e($cats['title']), ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : '') ] ) !!}
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'abstract', e($cats['abstract']), ['class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                    </div>
                                    <div class="dc-settingscontent la-categoriesimg">
                                            @if (!empty($cats->image))
                                                <upload-media
                                                    :img="'{{{ $cats->image }}}'"
                                                    :img_id="'category_image'"
                                                    :img_name="'category_image'"
                                                    :img_ref="'category_image'"
                                                    :img_hidden_name="'hidden_category_image'"
                                                    img_hidden_id="'hidden_category_image'"
                                                    :existed_img="'{{ $cats->image }}'"
                                                    :url="'{{ url("media/upload-temp-image/categories/category_image/category") }}'"
                                                    :existing_img_url="'{{ url("uploads/categories/$cats->image") }}'"
                                                    >
                                                </upload-media>
                                            @else
                                                <upload-media
                                                    :img="'category_image'"
                                                    :img_id="'category_image'"
                                                    :img_name="'category_image'"
                                                    :img_ref="'category_image'"
                                                    :img_hidden_name="'hidden_category_image'"
                                                    :img_hidden_id="'hidden_category_image'"
                                                    :url="'{{ url("media/upload-temp-image/categories/category_image/category") }}'"
                                                    >
                                                </upload-media>
                                         @endif
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        {!! Form::submit(trans('lang.update_cat'), ['class' => 'dc-btn']) !!}
                                    </div>
                                </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
