<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ isset($pageDesc) ? $pageDesc : 'Golf team software perfect for High School and College. Offers player statistics, rankings, score card archive, and more. Cloud-based = no install required!' }}">
    <title>{{ isset($pageTitle) ? $pageTitle : 'Golf Login' }}</title>
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div id="header-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}"
                         alt="Golf Login Team Management &amp; Statistics Software">
                </a>
            </div>
            <div class="col-md-9 text-right top-nav">
                <?php
                    $links = [
                        ['home'],
                        ['features'],
                        ['pricing'],
                        ['purchase'],
                        ['demo'],
                        ['support'],
                    ];
                ?>
                @foreach ($links as $link)
                    <a href="{{ route($link[0]) }}">{{ ucfirst($link[0]) }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>