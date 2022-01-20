<!DOCTYPE html>
<html class="loading" lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{config('app.locale')}}@endif">
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
    @styles('page', [
        asset(mix('css/base/themes/dark-layout.css')),
        asset(mix('css/base/core/menu/menu-types/vertical-menu.css'))
    ])
    @include('panels.styles')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static"
      data-menu="vertical-menu-modern"
      data-open="click"
      data-framework="laravel"
      data-asset-path="{{ asset('/')}}">
<!-- BEGIN: Header-->
@include('panels.navbar')
<!-- END: Header-->
<!-- BEGIN: Main Menu-->
@include('panels.sidebar')
<!-- END: Main Menu-->
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        @include('panels.breadcrumb')
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- End: Content-->
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
{{-- include footer --}}
@include('panels.footer')
<div class="modal fade" id="fullModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content"></div>
    </div>
</div>
<div class="modal fade modal-danger text-start" id="modalPlayer" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
{{-- include default scripts --}}
<script>
</script>
@include('panels.scripts')
<script type="text/javascript">
    $(function() {
        const modalPlayer = new bootstrap.Modal(document.getElementById('modalPlayer'));
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        const fullModal = new bootstrap.Modal(document.getElementById('fullModal'));

        $(document).on('click', '#fullModal .modal-content .btn-success', function (e) {
            $('#fullModal iframe')[0].contentWindow.location.reload(true);
        });
        $(document).on('click', '.dataTable .item-actions .btn', function (e) {
            const rowElm = $(this).parents('tr'),
                itemId = $(this).parents('.item-actions').data('id'),
                itemUrl = $(this).data('url');
            if ($(this).hasClass('item-view')) {
                window.location.href = itemUrl??`${window.location.href}/${itemId}`;
            } else if($(this).hasClass('item-preview')) {
                const preview = $(this).data('preview');
                $('#fullModal .modal-content').html(`<iframe style="width: 100%;height: 100%;" src="${preview}"></iframe><div style="position: absolute;bottom:10px;right:10px;"><button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{ __('Close') }}</button><button type="button" class="btn ms-1 btn-sm btn-success">{{ __('Reload') }}</button></div>`);
                fullModal.show();
            }  else if($(this).hasClass('item-edit')) {
                window.location.href = itemUrl??`${window.location.href}/${itemId}/edit`;
            } else if($(this).hasClass('item-delete')) {
                confirmAction(function () {
                    $.ajax({
                        url: itemUrl??`${window.location.href}/${itemId}`,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function () {
                            rowElm.remove();
                        }
                    });
                });
            }
        });
        $(document).on('click', '.item-video', function (e) {
            const video = $(this).data('video');
            const title = $(this).data('title');
            $('#modalPlayer .modal-title').text(title??'{{__('Player')}}');
            $('#modalPlayer .modal-body').html(`<video width="100%" autoplay controls><source src="${video}" type="video/mp4"></video>`);
            modalPlayer.show();
        });
        document.getElementById('modalPlayer').addEventListener('hide.bs.modal', function (event) {
            $('#modalPlayer .modal-body').html('');
        });

        $(document).on('click', '.item-document', function (e) {
            const document = $(this).data('document');
            $('#fullModal .modal-content').html(`<iframe style="width: 100%;height: 100%;" src="https://docs.google.com/gview?url=${document}&embedded=true"></iframe><div style="position: absolute;bottom:10px;right:10px;"><button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{ __('Close') }}</button><button type="button" class="btn ms-1 btn-sm btn-success">{{ __('Reload') }}</button></div>`);
            fullModal.show();
        });
        document.getElementById('fullModal').addEventListener('hide.bs.modal', function (event) {
            $('#fullModal .modal-content').html('');
        });
        @if (session('toast'))
        showToast({!! json_encode(session('toast')) !!})
        @endif
    });
</script>
</body>
</html>
