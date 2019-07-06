@extends('auth.layout')

@section('content')

    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    Logo Goes Here
                </a>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success btn-flat m-b-30 half-gutter-top">Sign in</button>

                    <div class="register-link m-t-15 text-center">
                        <p style="margin-top: 30px;">Don't have account ? <a href="{{ route('register') }}"> Sign Up Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
