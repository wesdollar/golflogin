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