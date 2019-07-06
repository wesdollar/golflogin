@extends('layouts.auth')

@section('content')

    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    Logo Goes Here
                </a>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label id="email" for="email">Email address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">
                        Send Password Reset Link
                    </button>

                </form>
            </div>
        </div>
    </div>

@endsection