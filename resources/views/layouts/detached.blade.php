<!DOCTYPE html>
<html class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', config('site.description'))">
    @hasSection('image')
    <meta name="image" content="@yield('image')">
    @endif
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="@yield('author', config('site.name'))">
    @hasSection('title')
        <title>@yield('title') - {{ config('site.title')?:config('app.name') }}</title>
    @else
        <title>{{ config('site.title')?:config('app.name') }}</title>
    @endif
    <link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.ico')}}">
    @styles('page', [
        asset(mix('css/base/core/menu/menu-types/horizontal-menu.css'))
    ])
    <style>
        .header-navbar .navbar-container ul.nav-menu li > a.nav-link {
            margin-right: 0.715rem;
            padding: 0.715rem 1.25rem !important;
        }
        .header-navbar .navbar-container ul.navbar-nav li a.dropdown-user-link .user-name {
            margin: 0 !important;
        }
        .navbar-expand-lg .nav-menu .dropdown-menu {
            margin-top: 10px;
        }
        .header-navbar .navbar-container ul.nav-menu li > a.nav-link svg {
            font-size: 1.2rem;
            height: 17px;
            margin-right: 0.5rem;
            width: 17px;
        }
        .header-navbar .navbar-container ul.nav-menu > li.active > a {
            background: linear-gradient(118deg,#7367f0,rgba(115,103,240,.7));
            border-radius: 4px;
            box-shadow: 0 0 6px 1px rgba(115 103 240 0.6);
            color: #fff !important;
        }
        .app-content {
            padding-top: 7rem !important;
        }
        .brand-text {
            display: inline-block;
            color: #7367f0;
            font-size: 1.45rem;
            font-weight: 600;
            letter-spacing: .01rem;
            margin-bottom: 0;
        }
    </style>
    @include('panels.styles')
</head>
<body class="horizontal-layout horizontal-menu content-detached-right-sidebar navbar-floating  content-detached-right-sidebar footer-static"
      data-open="hover"
      data-menu="horizontal-menu"
      data-col="content-detached-right-sidebar"
      data-framework="laravel"
      data-asset-path="{{ asset('/')}}"
>
@include('panels.client-navbar')
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <!-- BEGIN: Header-->
            <div class="content-wrapper ">
                @isset($breadcrumbs)
                <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-start mb-0">@yield('title')</h2>
                                    @isset($breadcrumbs)
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                {{-- this will load breadcrumbs dynamically from controller --}}
                                                @foreach ($breadcrumbs as $breadcrumb)
                                                    <li class="breadcrumb-item">
                                                        @if(isset($breadcrumb['link']))
                                                            <a href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link']:url($breadcrumb['link']) }}">
                                                                @endif
                                                                {{$breadcrumb['name']}}
                                                                @if(isset($breadcrumb['link']))
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        @isset($withButton)
                            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                <div class="mb-1 breadcrumb-right">
                                    <a class="btn btn-gradient-primary" href="{{ $withButton['route']===true?url()->previous():route($withButton['route']) }}">
                                        <i data-feather="arrow-left"></i>
                                        {{__($withButton['title'])}}
                                    </a>
                                </div>
                            </div>
                        @endisset
                    </div>
                @endisset
                @hasSection('content-sidebar')
                <div class="sidebar-detached sidebar-right">
                    <div class="sidebar">
                        @yield('content-sidebar')
                    </div>
                </div>
                @endif
                <div class="content-detached content-left">
                    <div class="content-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Content-->
{{-- include footer --}}
@include('panels.footer')
@stack('body-end')
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
