@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="page-header header-filter" filter-color="orange">
            <div class="page-header-image" style="background-image:url(/img/login.jpg)"></div>
            <div class="content">
                <div class="container">
                    <div class="col-md-5 ml-auto mr-auto">
                        <div class="card card-login card-plain">
                            <form class="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="card-header text-center">
                                    <div class="logo-container">
                                        <img src="/img/now-logo.png" alt="">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                    class="now-ui-icons users_circle-08"></i></span>
                                        </div>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                    @endif

                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                    class="now-ui-icons text_caps-small"></i></span>
                                        </div>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                    @endif
                                </div>
                                <div class="form-check" align="center">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-sign"></span>
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">{{ __('Login') }}</button>
                                </div>
                                <div class="pull-left">
                                    <h6><a href="{{ route('password.request') }}" class="link footer-link">{{ __('Forgot Your Password?') }}</a></h6>
                                </div>

                                <div class="pull-right">
                                    <h6><a href="{{ route('register') }}" class="link footer-link">{{ __('Register') }}</a></h6>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


