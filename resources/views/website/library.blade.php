<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autohaven Motors | @yield('title')</title>

    <!-- Latest compiled and minified CSS -->

    <meta name="theme-color" content="#533063">
    <link rel="shortcut icon" href="{{ asset('web_asset/images/favicon.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('web_asset/images/favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('web_asset/images/favicon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/css/custom-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/css/jquery-ui.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/js-custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/jquery.fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</head>
