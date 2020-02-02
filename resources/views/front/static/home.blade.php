@extends('front.layout')
@section('content')
<div id="hp-container">
    <div class="container">
        <div class="row">

            <?php
                $features = [
                    ['Total Team Management', 'Send players notifications, keep track of their scorecards, see how they rank amongst the team and more from any computer instantly!', 'totalteam'],
                    ['Player Rankings', 'Players are ranked against each other in over 15 categories, including FIR, GIR, Putts Per Green, and more exposing areas for improvements and serving as constant motivation.', 'playerranks'],
                    ['Statistics Tracking', 'Players and coaches will get instant feedback after each round with statistics in over 20 different categories just like the Pros!', 'statanalysis'],
                    ['Scorecard Archives', 'All rounds are stored in the system for the duration of the player\'s playing career, providing the ability to see the rewards of their practice and efforts!', 'scorecard'],
                    ['Designed to Impress', 'We developed Golf Login to be flexible enough to the meet the individual needs of each team and user. To save coaches time, players can manage every aspect of their data entry, but we understand not all players have the time nor do all coaches want their players controlling their data. Options are great to have!', 'teamcustomize'],
                    ['Stay in the Know', 'You\'ll no longer have to wait to collect scorecards! Each player enters their round from their own computer, iPad, or tablet. Receive notifications each time a player posts a round and immediately see problem areas within their game.', 'stayintheknow'],
                ];

                $i = 1;
            ?>

            @foreach ($features as $feature)
                <div class="col-md-4">
                    <p class="center">
                        <img src="{{ asset('img/hp-features/' . $feature[2] . '.png') }}"
                             alt="{{ $feature[0] }}">
                    </p>
                    <h2 class="center">{{ $feature[0] }}</h2>
                    <p class="top-margin hp-top-feature-block">
                        {{ $feature[1] }}
                    </p>
                    <p class="center double-margin">
                        <a href="{{ route('features') }}" class="btn btn-lg btn-primary">View All Features</a>
                    </p>
                </div>

                <?php
                    if ($i === 3) {
                        echo '</div><div class="row double-margin">';
                        $i = 0;
                    }

                    $i++;
                ?>
            @endforeach

        </div>
    </div>
</div>

<div class="break-callout-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Golf Team Management Made <span class="secondary-color">Easy</span></h3>
                <p>Get your players to the next level by analyzing every aspect of the their game.</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('features') }}" class="btn btn-lg btn-primary">View All Features</a>
            </div>
        </div>
    </div>
</div>

<div class="content double-margin">
    <div class="container">
        <div class="row">

            <?php
                $features = [
                    ['Complete State Analysis', 'Players can see their lifetime stats with the click of a button providing valuable feedback to their game by exposing weaknesses and verifying strengths.', 'features', null],
                    ['Player Rankings', 'Each player is able to see how they rank amongst their teammates in every stat category, including an overall ranking, fueling their competitive natures.', 'features', null],
                    ['Easy on the Coach', 'Golf Login allows your players to enter in their round info and update their profiles on their own. No more waiting to get scorecards or updating profile sheets. You and your players may optionally receive notifications when new rounds are added.', 'features', null],
                ];
            ?>

            @foreach ($features as $feature)
                <div class="col-md-4">
                    <h3>{{ $feature[0] }}</h3>
                    <p class="hp-feature-block">
                        {{ $feature[1] }}
                    </p>
                    <p>
                        <a href="{{ route($feature[2]) }}" class="btn btn-lg btn-primary">
                            Learn More
                        </a>
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</div>
@stop