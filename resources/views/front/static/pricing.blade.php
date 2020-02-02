@extends('front.layout')
@section('content')

<div id="content-container">
    <div class="container double-margin">

        <div class="row">
            <div class="col-md-12">
                <p class="center biggest-font">
                    Simple pricing to make your decision easier.
                </p>
            </div>
        </div>

        <div class="row double-margin">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6">
                    <h2 class="squared-title">
                        Monthly Subscription
                    </h2>
                    <p class="center price biggest-font double-margin">
                        $12 <sup class="smaller-font">/ month</sup>
                    </p>
                    <p class="double-margin">
                        Suspend or cancel your account at any time. No contract or term required. When you're ready to resume, simply reactivate your account. All of your data will still be there, and you'll be back in business!
                    </p>
                </div>
                <div class="col-md-6">
                    <h2 class="squared-title">
                        Annual Subscription
                    </h2>
                    <p class="center price biggest-font double-margin">
                        $120 <sup class="smaller-font">/ year</sup>
                    </p>
                    <p class="double-margin">
                        <strong>Two months free with an annual subscription!</strong>
                    </p>
                    <p>
                        Give your team or group year-round access to Golf Login for use during the off-season. Your account will automatically renew each year, but we'll give you plenty of heads up before renewing in case you would like to cancel.
                    </p>
                </div>
            </div>
        </div>
        <div class="row double-margin center">
            <p class="center top-margin">
                <a href="{{ route('buy') }}" class="btn btn-lg btn-primary big-btn">
                    Get started now!
                </a>
            </p>
        </div>
        <div class="row double-margin center smaller-font">
            <div class="col-md-8 col-md-offset-2">
                <p>
                    Golf Login is a subscription based software available directly through your web browser. If you like buzz words, it's a cloud-based SaaS (Software as a Service) for the tech savvy. Basically, all that means is there's no software to install and keep updated. Your system will remain active and up to date for as long as your subscription is active. You may cancel anytime! We never require a contract, and we even offer a 14 day free period to see if it's right for you. We retain all of your data if you ever want to take a break from us, such as during the off season.
                </p>
            </div>
        </div>

    </div>
</div>

@include('front.partials.alternate.freeTrial')

<div class="container double-margin" id="photo-section">
    <div class="row">
        <div class="col-md-6">
            <h1 class="primaryColor">Golf Login on the Course</h1>
            <p class="double-margin">
                Golf Login is available on any device with internet, including cell phones and tablets with cellular data. You and your team will have full access to and full control of your system no matter where you are.
            </p>
            <p>
                Golf Login was originally developed specifically for high school and college golf teams. However, we have hundreds of golf academies, leagues, country clubs, and local groups using Golf Login to rank everyone amongst each other and to keep track of scorecards and handicaps. The communication tools built into Golf Login make communicating with your entire group extremely quick and easy.
            </p>
            <p class="center double-margin">
                <a href="{{ route('purchase') }}" class="btn btn-lg btn-primary">Sign Up Now!</a>
            </p>
        </div>
        <div class="col-md-6 center">
            <img src="{{ asset('img/screen-shot-ipad.jpg') }}" alt="Golf Login Cloud Software">
        </div>
    </div>
</div>

@stop