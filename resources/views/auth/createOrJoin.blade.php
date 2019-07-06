@extends('auth.layout')

@section('content')

    <div class="container">

        <div class="login-logo gutter-top">
            <a href="index.html">
                Logo Goes Here
            </a>
        </div>

        <form method="POST" action="{{ route('joinOrCreateGroup') }}">

            {{ csrf_field() }}

            <div class="row justify-content-center">
                <div class="col-md-3 center background-white">

                    <h4 class="half-gutter-top">Create Group</h4>

                    <p class="small-gutter-top">
                        If you're not joining an existing group, you need to create one.
                    </p>

                    <div class="form-group half-gutter-top">
                        <label for="title">
                            Group Name
                        </label>
                        <input type="text" id="title" name="title" class="form-control center">
                    </div>

                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 center background-white">

                    <h4 class="half-gutter-top">Join Group</h4>

                    <p class="small-gutter-top">
                        If you're joining an existing group, enter the group code here.
                    </p>

                    <div class="form-group half-gutter-top">
                        <label for="group-code">
                            Group Code
                        </label>
                        <input type="text" id="group-code" name="group_code" class="form-control center">
                    </div>

                </div>
            </div>

            <div class="row justify-content-center gutter-top">
                <div class="col-md-2 center">
                    <button type="submit" class="btn btn-primary btn-flat m-b-30">Let's Go!</button>
                </div>
            </div>

        </form>

    </div>

@endsection
