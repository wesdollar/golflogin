@extends('layout')

@section('content')

    <div class="content double-margin">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <p class="biggest-font center">
                        The Story Behind Golf Login <br>
                        Team Management Software
                    </p>
                    <p class="double-margin">
                        Like most college golfers, I came up through the ranks in the typical fashion: shagging balls for my dad on the weekend as a kid, to getting my own set of clubs that, which, at the time, were cut down perfect for my size, to filling the roster of a middle school golf program desperate to just have five players, to high school stardom when competitive golf got real, and then onto college golf where I had several top tens, a handful of T2's, but one title. That culminated into a few years spent playing the mini's. To my count, that's at least 17+ years of competitive golf under my belt. During which time, it would have been nice to have a system that allowed me to archive my scorecards, see how I ranked amongst my teammates, and ultimately, help me gain either a college scholarship or a few more press releases to secure that coveted PGA Tour invite. That system, software, website, or even Excel spreadsheet never came along.
                    </p>
                    <p>
                        Well, now you're here, at <strong>Golf Login</strong>, a <strong>total golf team management software</strong> and system that allows your players to enter their own scorecards and keep track of their own stats while you're able to track their progression, ensure they're practicing, and managing your team so that it can reach its fullest potential. As an avid golfer, a lover of the game, accomplished on the high school and college level, and, as luck would have it, a web/software developer, I decided to fill a need that was long overdue. Golf Login is the culmination of what I wish I would have had as a golfer in high school and in college. It would have provided even more motivation and seeing how I ranked amongst my teammates would have given me that extra push to really exhaust every ounce of energy I had to ensure I was the best.
                    </p>
                    <p>
                        <strong>Golf Login Golf Team Management Software</strong> can help take your high school or college golf team to the next level. As a coach, you're able to see all of your players' phone numbers, email addresses, shirt/shoes/pants sizes, birthdays, and more from one screen. You also receive notifications via email anytime a new round is added by one of your players. As a player, you receive instant feedback on how your game is progressing through the stats that are compiled in more than <strong>20 golf stat categories</strong>. Each player will know how they rank against their teammates giving them incentive to practice better and really focus on the trouble areas. Every round is saved in the system for the player's entire career so that they can go back and see their improvement or which holes gave them troubles in the past. Overall, it will motivate every player and enhance their experience as a high school or college golfer.
                    </p>
                    <p>
                        Thanks for taking the time to get know <strong>Golf Login</strong>. My name is Wes Dollar, founder and developer of Golf Login. I have been developing software since the age of 12, but I spent every sunny moment on the golf course as a junior and collegiate golfer. Golf Login is the exact system I needed as captain of my college team, but the guys I play with now out at my local club get a ton of value out of the system, too! It's truly my pride and joy!
                    </p>
                    <p>
                        If there's anything I can do for you, please don't hesitate to contact me directly. Our {!!  link_to_route('contact', 'contact page') !!} lists every method by which you can reach us. Our response times are quick and service friendly. I look forward to hearing from you!
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="alternate-section double-margin">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <p class="bigger-font darkest-primary">
                        This is the golf software you've been looking for!
                    </p>
                    <p>
                        Golf Login is also perfect for local club groups, such as dogfights and men's leagues.
                        <br>
                        Give it a try for 14 days, no strings attached. We know you'll love it!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="double-margin feature-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Team Management</h2>
                    <ul>
                        <?php
                        $features = [
                                'Each golfer\'s info is stored in one place, accessible by any computer or device with internet access.',
                                'Quickly &amp; easily add players to your team or group.',
                                'Easily communicate with all players on via email automatically from within the system.',
                                'Players and coaches receive instant notifications via email when a new round is posted.',
                                'One screen shows the coach all of the players\' important information, such as email, phone number, shoe size, glove size, and more!',
                                'An estimated USGA Handicap Rating is generated for every player.',
                        ];
                        ?>

                        @foreach ($features as $feature)

                            <li>{{ $feature }}</li>

                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2>Stats &amp; Rankings</h2>
                    <ul>
                        <?php
                        $features = [
                                'All players are ranked amongst each member of the team in every stat category.',
                                'Stats are computed and immediately updated when a new round is posted.',
                                'Easily see a players strengths and weaknesses.',
                                ['Stats kept include:', [
                                        'Scoring Average',
                                        'Tournament Scoring Average',
                                        'Fairways in Regulation',
                                        'Greens in Regulation',
                                        'Putts per Green',
                                        'Putts per Round',
                                        'Par Saves',
                                        'Sand Saves',
                                        'Par Breakers',
                                        'Par 3/4/5 Scoring Averages',
                                        'Total Eagles, Birdies, Pars, Bogies, Double Bogies, and Others'
                                ]],
                                'Easily set your roster based on the rankings.',
                        ];
                        ?>

                        @foreach ($features as $feature)

                            <li>

                                @if (is_array($feature))
                                    {{ $feature[0] }}

                                    <ul>
                                        @foreach ($feature[1] as $stat)
                                            <li>{{ $stat }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $feature }}
                                @endif

                            </li>

                        @endforeach

                    </ul>
                </div>
                <div class="col-md-4">
                    <h2>More Features</h2>
                    <ul>
                        <?php
                        $features = [
                                'Total Eagles, Birdies, Pars, Bogies, Double Bogies, and Others',
                                'No software to install.',
                                'Free lifetime software updates with your subscription.',
                                'Make your system available to the public with a touch of a button, or keep it strictly private for your team\'s eyes only. If you choose private, GoLo allows you to create special profiles that allows the user to view your front-end without the ability to post rounds and add courses.',
                                'Signup for free for 14 days, no credit card required. We know you\'ll love your system!'
                        ];
                        ?>

                        @foreach ($features as $feature)

                            <li>{{ $feature }}</li>

                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

@stop