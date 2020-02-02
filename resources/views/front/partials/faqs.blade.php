<?php
$faqs = [
        ['[Stats] How is your overall ranking calculated?',
                'We developed an algorithm years ago that we continue to tweak and refine as we quest for the perfect mix of data! It\'s truly a nerds dream job. The easiest way to explain it is that we look at each players scoring average on each hole type (ie: par 3 / 4 / 5). We take those numbers, throw them into an equation or two, and get our first number. We then look at the player\'s overall scoring in relation to par for both non-tournament and tournament rounds. Tournament rounds get a special multiplier to add weight. If you are still with me, we then start looking at players\' individual stat rankings, do some more fancy math, and get our fourth number. So to recap — first number = scoring average / hole types, second number = relation to par non-tournament, third round = relation to par tournament, fourth number = aggregated stats. I know, it\'s not exactly straight forward, but it works, and we are always making it better!'
        ],
        ['[Stats] How do you calculate the USGA handicap?',
                'We actually use the USGA\'s official handicap algorithm. Unfortunately, we can not call our handicap official because, well, it\'s not possible, but it is calculated the exact same way!'
        ],
        ['What payment methods do you accept?',
                'We accept all major credit cards securely through our website right when you sign up! Then, we will automatically charge your card at the renewal interval you choose — either monthly or annual renewal. If you decide you would like to cancel or suspend your account during the off-season, simply login to your account and do so within your profile. It takes less time to complete than most companies take to guide you through their automative phone system. If you\'d like to cancel by phone, for whatever reason, please call (803) 392-4400.'
        ],
        ['My school / club will only pay with a purchase order!',
                'Have no fear! We\'re very flexible. Simply sign up for our trial trial and email us with the purchase order issued by the school. All we ask is that you do your best to get it to us within 14 days. We understand it can sometimes take up to 30. We\'re flexible.'
        ],
        ['My team / club only plays part of the year. How does that work?',
                'We never hold you to any contracts or specific terms. You are free to suspend or cancel your account at any time. Most seasonal users simply suspend their account during the off-season. When they are ready to start back up, all they have to do is login to their account and press one button. We make cancelling your account just as easy, but we hope you love us enough to never leave!'
        ],
        ['Do you require a contract for service?',
            'Absolutely not! You are free to suspend or cancel your subscription at any time. All of your data will be kept. Reactivating your account only takes a few simple clicks. As usual, we tried to make it as easy as possible to start and stop your subscription at any time.'
        ],
        ['Do you have a mobile app in the app store?',
                'Our system is currently mobile friendly and can be accessed via the default browser of any mobile device with internet access. We are currently in the process of developing a more advanced, mobile specific platform that will ship Summer 2015.'
        ],
        ['Is your system compatible with my iPad or tablet?',
                'Yep! Sure is! Any tablet with internet access, whether WiFi or 3G / 4G can connect and use our system on the go. This is great for keeping score during a round. All you have to do is hit enter when your round is over, and your scorecard is saved in the system and states compiled!'
        ],
        ['How easy is the software to install?',
                'Super easy - <strong>no installation is required</strong>. Your system is a cloud-based (web-based) software allowing easy access from any computer or device with internet access. As such, we handle everything for you at no additional cost. No installations. No software to keep updated. Simple.'
        ],
        ['Is there an additional fee each time you up the system?',
                'Absolutely not! We are constantly improving Golf Login. While we do have our own internal version numbers just to keep things tidy, it\'s not something we even use publicly. You\'ll notice small changes here and there — every now and then a big change — but your system will always be available and running bug free and lightning fast!'
        ],
        ['Do you offer a free trial?',
                'We sure do. Just '.link_to_route('freeTrial', 'click here').'!'
        ],
];
?>

<div class="row faq">

    <?php
    $i = 1;
    ?>
    @foreach ($faqs as $question)
        <div class="col-md-6">
            <h3>{{ $question[0] }}</h3>
            <p>
                {!! $question[1] !!}
            </p>
        </div>

        <?php
        if ($i == 2) {

            echo '</div><div class="row faq">';

            $i = 0;
        }

        $i++;
        ?>

    @endforeach

</div>