@extends('back.layout')

@section('content')

    <div class="container-fluid">

        <h1 class="half-gutter-top">Welcome to Golf Login!</h1>
        
        <p class="half-gutter-top">
            Good to see you, {{ $user->first_name }}!

            @if ($onTrial)
                You have {{ $daysLeftInTrial }} days left in your trial.
            @endif

            @if ($user->onGenericTrial())
                Be sure to add your credit card to avoid losing access when your trial ends!
            @endif
        </p>
        
        <div class="row gutter-top">
            <div class="col-md-4 col-md-offset-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">
                            Groups
                        </strong>
                    </div>

                    @if ($user->groups->count() === 0)
                        <div class="card-body">
                            <h3 class="center">
                                You have no groups!
                            </h3>

                            <div class="half-gutter-top center">
                                <a href="{{ route('groups.createGui') }}" class="btn btn-lg btn-primary">
                                    Create Group
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            You have groups!
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div> <!-- // container -->

@endsection