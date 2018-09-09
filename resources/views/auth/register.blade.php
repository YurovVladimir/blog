@extends('layouts.app')

@section('content')
    <div class="social text-center" style="position: relative; top: 4.5vh">
    <div class="card card-signup">

        <div class="card-body">

            <h4 class="card-title text-center">{{ __('Register') }}</h4>
            <div class="social text-center">
                <button class="btn btn-icon btn-round btn-twitter">
                    <i class="fab fa-twitter"></i>
                </button>
                <button class="btn btn-icon btn-round btn-dribbble">
                    <i class="fab fa-dribbble"></i>
                </button>
                <button class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-facebook"> </i>
                </button>
                <h5 class="card-description"> or be classical </h5>
            </div>
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                    </div>
                    <input placeholder="Name..." id="name" type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                           value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                    </div>
                    <input placeholder="Your Email..." id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="now-ui-icons text_caps-small"></i></span>
                    </div>
                    <input placeholder="Password..." id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="now-ui-icons text_caps-small"></i></span>
                    </div>
                        <input placeholder="Password-confirm..." id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-info btn-round btn-lg">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
