<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='{{asset('backend')}}/assets/img/favicon.ico' />
</head>
<body>
<div class="loader"></div>
<div id="app">
    <section class="section">
        @yield('content')
    </section>
</div>
<!-- General JS Scripts -->
<script src="{{asset('backend')}}/assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="{{asset('backend')}}/assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="{{asset('backend')}}/assets/js/custom.js"></script>
@yield('js')
</body>
</html>
