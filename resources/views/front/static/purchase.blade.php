@extends('front.layout')
@section('content')

<div id="content-container">
    <div class="container double-margin">

        <div class="row">
            <div class="col-md-12">
                <p class="center biggest-font">
                    Create Your Golf Login Today!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="center">
                    Getting started is simple and only takes a minute! Select if you would like to renew monthly or annually. The monthly subscription is $12 a month. If you sign up for the year, we basically give you two months free, which comes out to $120. No matter which you select, your account will be setup <em>instantly</em>, and you'll be on your way to compiling your rankings in no time!
                </p>
            </div>
        </div>

        <div class="row double-margin">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-6">
                        <p class="bigger-font">
                            Select your plan:
                        </p>
                        <p class="top-margin">
                            <small>
                                Looking for the 14 day free sign up form? <br>
                                <a href="{{ route("freeTrial") }}">Click here</a> to get started today for free!
                            </small>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <button class="squared-btn center plan-btn" data-plan="monthly">
                                <strong>Monthly</strong> <br>
                                $12 / month
                            </button>
                        </p>
                        <p>
                            <button class="squared-btn center no-bottom-margin plan-btn" data-plan="annual">
                                <strong>Annual</strong> <br>
                                $120 / year <br>
                            </button>
                            <small class="block-right">* equates to two free months!</small>
                        </p>
                    </div>
                </div>

                @include('front.partials.forms.personalInfo')

                <div class="row double-margin">
                    <div class="col-md-6">
                        <p class="bigger-font">
                            Payment information:
                        </p>
                        <p>
                            <i class="fa fa-cc-visa fa-2x primaryColor"></i>
                            <i class="fa fa-cc-mastercard fa-2x primaryColor"></i>
                            <i class="fa fa-cc-amex fa-2x primaryColor"></i>
                        </p>
                        <p class="top-margin">
                            <small>
                                The credit card you place on file will be automatically charged on your renewal date based on the billing term you choose (monthly or annually). You can change your credit card at any time. And, of course, you're free to suspend or cancel your account if you need.
                            </small>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <label for="billing_name">Name on Card</label>
                            <input type="text" name="billing_name" id="billing_name" class="form-control">
                        </p>
                        <p>
                            <label class="control-label" for="cc">Credit Card Number</label>
                            <input type="text" name="cc" id="cc" class="form-control"">
                        </p>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="exp_month">Expiration Month</label>
                            </div>
                            <div class="col-md-6">
                                <label for="exp_year">Expiration Year</label>
                            </div>
                        </div>

                        <p class="half-top-margin">
                            <label for="cvc">CVC Security Code</label>
                            <input type="password" name="cvc" id="cvc" class="form-control">
                        </p>

                        <p class="double-margin text-right">
                            <button class="btn btn-lg btn-primary">Sign Up!</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('front.partials.alternate.golfSoftwarePromo')

<div class="container">

    @include('front.partials.featureSection')

    <div class="row double-margin center">
        <p class="center top-margin">
            <a href="{{ route('freeTrial') }}" class="btn btn-lg btn-primary big-btn">
                Try It for Free Today!
            </a>
        </p>
    </div>
    <div class="row double-margin center smaller-font">
        <div class="col-md-8 col-md-offset-2">
            <p>
                Golf Login is a subscription based software available directly through your web browser. If you like buzz words, it's a cloud-based SaaS (Software as a Service) for the tech savvy. Basically, all that means is there's no software to install and keep updated. Your system will remain active and up to date for as long as your subscription is active. You may cancel anytime! We never require a contract, and we even offer a 14 day free period to see if it's right for you.
            </p>
        </div>
    </div>

</div>
@stop