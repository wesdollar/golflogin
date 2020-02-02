@extends('front.layout')
@section('content')

<div id="content-container">
    <div class="container double-margin">

        <div class="row">
            <div class="col-md-12">
                <p class="center biggest-font">
                    First dates don't scare us!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="center">
                    We're just excited to show our system off to you! This is one test drive that seriously comes with no strings attached. We don't ask for a credit card, we won't call you in six months, and we definitely won't hit you with crazy hidden fees or annoying up-sales!
                </p>
            </div>
        </div>

        <input type="hidden" name="plan" value="trial" id="subscriptionPlan">

        <div class="row double-margin">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-6">
                        <p class="bigger-font">
                            Select your plan:
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <button class="squared-btn active center">
                                <strong>Free Trial!</strong> <br>
                                14 Days, No Strings
                            </button>
                        </p>
                    </div>
                </div>

                @include('front.partials.forms.personalInfo')

                <div class="row double-margin">
                    <div class="col-md-6">
                        <p class="bigger-font">
                            <i class="fa fa-rocket secondaryColor"></i> Get started:
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="center">
                            <button class="btn btn-lg btn-primary big-btn">Sign Up!</button>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-break" style="margin-bottom: 0; padding-bottom: 0; padding-top: 0;">&nbsp;</div>
        </div>
    </div>
</div>

<div class="container">

    @include('front.partials.pricing')

    <div class="row double-margin center smaller-font">
        <div class="col-md-8 col-md-offset-2">
            <p>
                Golf Login is a subscription based software available directly through your web browser. If you like buzz words, it's a cloud-based SaaS (Software as a Service) for the tech savvy. Basically, all that means is there's no software to install and keep updated. Your system will remain active and up to date for as long as your subscription is active. You may cancel anytime! We never require a contract, and we even offer a 14 day free period to see if it's right for you.
            </p>
        </div>
    </div>
</div>

@stop