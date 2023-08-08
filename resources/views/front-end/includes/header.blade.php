@if (!(Schema::hasTable('site_managements'))) 
    @php 
        echo trans('lang.table_missing'); 
        die; 
    @endphp
@else
    @php 
    $registration = 'true';
    if (Schema::hasTable('site_managements')) {
        $settings = !empty(App\SiteManagement::getMetaValue('general_settings')) ? App\SiteManagement::getMetaValue('general_settings') : array();
        $registration = !empty($settings) && !empty($settings['display_registration']) ? $settings['display_registration'] : 'true';
    }
    @endphp
@endif
@section('header')
    <header id="dc-header" class="dc-header dc-haslayout">
        @if (Helper::getTopBarSettings('enable_topbar') == 'true')
            <div class="dc-topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="dc-helpnum">
                                <span>{{ Helper::getTopBarSettings('title') }}</span>
                                <a href="tel:{{ clean(Helper::getTopBarSettings('number')) }}">{{ clean(Helper::getTopBarSettings('number')) }}</a>
                            </div>
                            @if (Helper::getTopBarSettings('enable_socials') === 'true')
                                <div class="dc-rightarea">
                                    @php Helper::displaySocials('topbar'); @endphp
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="dc-navigationarea">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <strong class="dc-logo"><a href="{{ url('/') }}"><img src="{{ asset(Helper::getGeneralSettings('site_logo')) }}" alt="{{ trans('lang.site_logo') }}"></a></strong>
                        <div class="dc-rightarea" style="margin-top: 13px;">
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
                                                        <input
                                                                id="email"
                                                                type="email"
                                                                name="email"
                                                                class="form-control @error('email') is-invalid' @enderror"
                                                                placeholder="{{ trans('lang.ph_email') }}"
                                                                required
                                                                autofocus
                                                        />

                                                        @error('email')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong style="color: red; font-size: 13px" >{{ $errors->first('email') }}</strong>
                                                            </span>

                                                            <script>
                                                                setTimeout(()=>{
                                                                    document.getElementById('dc-loginbtn').click()
                                                                },500)

                                                            </script>

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
                                    @if ($registration == 'true')
                                        <a href="{{{ route('register') }}}" class="dc-btn">{{{ trans('lang.join_now') }}}</a>
                                    @endif
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
