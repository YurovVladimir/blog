@extends('layouts.app')

@section('content')
    <div class="social text-center" style="position: relative; top: 4.5vh">
        <div class="card card-signup">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h4 class="card-title text-center">{{ __('Reset Password') }}</h4>
                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf

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

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-info btn-round btn-lg">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
