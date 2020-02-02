<div class="alternate-section double-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="center biggest-font">
                    Try it <span>free</span> for 14 days!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="center top-margin">
                    No credit card required. Add a credit card to your account at anytime during your initial 14 days, and we'll automatically bill your account when it's time.
                </p>
                <p class="center double-margin">
                    @if (Request::path() != 'frequently-asked-questions')
                        <a href="{{ route('freeTrial') }}" class="btn btn-lg btn-primary">
                            Start your free trial!
                        </a>
                    @else
                        <span class="btn btn-lg btn-primary">
                            Get Started Below!
                        </span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>