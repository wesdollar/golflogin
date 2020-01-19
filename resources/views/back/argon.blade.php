<!DOCTYPE html>
<html lang="en" class="perfect-scrollbar-off nav-open">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="theme-color" content="#000000"/>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
        rel="stylesheet"
    />
    <title>{{ config('app.name', '') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<noscript> You need to enable JavaScript to run this app.</noscript>
<div id="root"></div>
@include('footer')
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
