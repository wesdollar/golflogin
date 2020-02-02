@extends('layout')

@section('content')

<div id="content-container">
    <div class="container double-margin">

        <div class="row">
            <div class="col-md-12">
                <p class="center biggest-font">
                    Questions are common. <br>
                    Here are a few common answers!
                </p>
            </div>
        </div>

        @include('partials.faqs')

    </div>
</div>

@include('partials.alternate.freeTrial')

<div class="container double-margin">
    @include('partials.forms.freeTrial')
</div>

@stop