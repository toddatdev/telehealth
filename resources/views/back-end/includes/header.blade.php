@section('header')
    @php 
        $locations = App\Location::all(); 
        $roles     = Spatie\Permission\Models\Role::all()->toArray();
    @endphp
    <header id="dc-header" class="dc-header dc-haslayout dc-header-dashboard">
        <div class="dc-navigationarea">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <strong class="dc-logo"><a href="{{ url('/') }}"><img src="{{ asset(Helper::getGeneralSettings('site_logo')) }}" alt="{{ trans('lang.site_logo') }}"></a></strong>
                        <div class="dc-rightarea">
                            <nav id="dc-nav" class="dc-nav navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="lnr lnr-menu"></i>
                                </button>
                                <div class="collapse navbar-collapse dc-navigation" id="navbarNav">
                                    @include('includes.navigation')
                                </div>
                            </nav>
                            @auth
                                @include('includes.profile-menu')
                            @endauth
                            @guest
                                <div class="dc-loginarea">
                                    <div class="dc-loginoption">
                                        <a href="javascript:void(0);" id="dc-loginbtn" class="dc-loginbtn">{{ trans('lang.login') }}</a>
                                        <div class="dc-loginformhold">
                                            <div class="dc-loginheader">
                                                <span>{{ trans('lang.login') }}</span>
                                                <a href="javascript:;"><i class="fa fa-times"></i></a>
                                            </div>
                                            <form method="POST" action="{{ route('login') }}" class="dc-formtheme dc-loginform do-login-form">
                                                @csrf
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ trans('lang.ph_email') }}" required autofocus>
                                                        @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red; font-size: 13px">{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ trans('lang.ph_pass') }}" required>
                                                        @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="dc-logininfo">
                                                        <span class="dc-checkbox">
                                                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label for="remember">{{{ trans('lang.remember') }}}</label>
                                                        </span>
                                                        <button type="submit" class="dc-btn do-login-button">{{{ trans('lang.login') }}}</button>
                                                    </div>
                                                </fieldset>
                                                <div class="dc-loginfooterinfo">
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="dc-forgot-password">{{{ trans('lang.forget_pass') }}}</a>
                                                    @endif
                                                    <a href="{{{ route('register') }}}">{{{ trans('lang.create_account') }}}</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="{{{ route('register') }}}" class="dc-btn">{{{ trans('lang.join_now') }}}</a>
                                </div>
                            @endguest
                        </div>
                        <div class="dc-headerform-holder" style="display: none;">
                            <div class="dc-search-headerform">
                                <div class="closeform-holder">
                                    <a href="javascript:void(0);" class="dc-removeform">{{ trans('lang.cancel') }}</a>
                                    <a href="javascript:void(0);" class="dc-removeform"> <i class="fa fa-close"></i></a>
                                </div>
                                {!! Form::open(['url' => url('search-results'), 'method' => 'get', 'id' =>'dc_search_bar', 'class' => 'dc-formtheme dc-form-advancedsearch dc-headerform']) !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="search" value="{{ !empty(request()->search) ? request()->search : '' }}" class="form-control" placeholder="{{ trans('lang.ph.hospitals_clinic_etc') }}">
                                        </div>
                                        <div class="form-group">
                                            <div class="dc-select">
                                                <select class="locations" data-placeholder="{{ trans('lang.select_country') }}" name="locations">
                                                    <option value="">{{ trans('lang.select_country') }}</option>
                                                    @foreach ($locations as $key => $location)
                                                        <option value="{{{$location->id}}}">{{{$location->title}}}*</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="dc-formbtn">
                                            {{ Form::button('<i class="ti-arrow-right"></i>', ['type' => 'submit', 'class' => 'btn-sm'] )  }}
                                        </div>
                                    </fieldset>
                                {!! form::close(); !!}
                            </div>
                            <a href="javascript:void(0);" class="dc-searchbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
