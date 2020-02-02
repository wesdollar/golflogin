@extends('front.layout')
@section('content')

<div id="content-container">
    <div class="container double-margin">

        <div class="row">
            <div class="col-md-12">
                <p class="center biggest-font">
                    How can we help?
                </p>
            </div>
        </div>
        <div class="row double-margin">
            <div class="col-md-4">
                <p class="squared-btn">
                    Support
                </p>
                <div class="row top-margin">
                    <div class="col-md-2 col-sm-2 col-xs-2 center">
                        <i class="fa fa-phone primaryColor"></i>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        (803) 392-4400
                    </div>
                </div>
                <div class="row half-top-margin">
                    <div class="col-md-2 col-sm-2 col-xs-2 center">
                        <i class="fa fa-envelope primaryColor"></i>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <small>Use the form below to send us an email.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <p class="big-font">
                    If you are a Golf Login subscriber or team member, and you're having any issues of any kind, we want to hear from you immediately. Please call us at the number listed. If we don't answer, please send a text with your name and school name letting us know you need help.
                </p>
            </div>
        </div>
        <div class="row double-margin">
            <div class="col-md-4">
                <p class="squared-btn">
                    Questions?
                </p>
                <p>
                    <small>
                        Be sure to check our FAQ's to see if we've already posted the answer to any questions you may have. <br>
                        <a href="{{ route("faqs") }}">click here</a> to view our FAQ's.
                    </small>
                </p>
            </div>
            <div class="col-md-8">
                <p class="big-font">
                    If anything we have said has prompted questions about Golf Login's features and functionality, please don't hesitate to get in touch with us. We offer several ways to get in touch with us almost instantly, including via the form on this page.
                </p>
            </div>
        </div>

    </div>
</div>

<div class="offwhite-container double-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="callout-block text-left">
                    <i class="fa fa-envelope"></i> Email Us
                </span>

                @include('front.partials.contactForm')

            </div>
            <div class="col-md-6">
                <span class="callout-block">
                    <i class="fa fa-mobile"></i> (803) 392-4400
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @include('front.partials.pricing')
</div>

@stop