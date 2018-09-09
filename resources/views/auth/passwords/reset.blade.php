@extends('layouts.app')

@section('content')
    <div class="social text-center" style="position: relative; top: 4.5vh">
        <div class="card card-signup">

            <div class="card-body">

                <h4 class="card-title text-center">{{ __('Reset Password') }}</h4>
                <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                        </div>
                        <input placeholder="Your Email..." id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


