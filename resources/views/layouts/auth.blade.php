<!DOCTYPE html>
<html class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', config('site.description'))">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="@yield('author', config('site.name'))">
    @hasSection('title')
        <title>@yield('title') - {{ config('site.title')?:config('app.name') }}</title>
    @else
        <title>{{ config('site.title')?:config('app.name') }}</title>
    @endif
    <link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.ico')}}">
    @styles('page', asset(mix('css/base/pages/authentication.css')))
    {{-- Include core + vendor Styles --}}
    @include('panels.styles')
</head>
<body class="vertical-layout vertical-menu-modern blank-page"
      data-menu="vertical-menu-modern"
      data-col="blank-page"
      data-framework="laravel"
      data-asset-path="{{ asset('/')}}">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            {{-- Include Startkit Content --}}
            @yield('content')
        </div>
    </div>
</div>
<!-- End: Content-->
{{-- include default scripts --}}
@include('panels.scripts')
<script type="text/javascript">
    $(window).on('load', function() {
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    })
</script>
</body>
</html>
