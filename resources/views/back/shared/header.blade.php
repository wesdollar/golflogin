<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <title>{{ config('app.name', '') }}</title>

    {{--<link rel="apple-touch-icon" href="apple-icon.png">--}}
    {{--<link rel="shortcut icon" href="favicon.ico">--}}

    <link rel="stylesheet" href="{{ asset('css/sufee/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sufee/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sufee/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sufee/themify-icons.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('css/sufee/flag-icon.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/sufee/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sufee/style.css') }}">

    {{--<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>--}}
    <!-- todo: uncomment when online -->

    <link href='{{ asset('/css/app.css') }}' rel='stylesheet' type='text/css'>

</head>
<body @if (isset($bodyClass)) class="{{ $bodyClass }}" @endif>