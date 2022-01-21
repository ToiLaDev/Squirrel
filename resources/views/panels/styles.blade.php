<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600">
<link rel="stylesheet" href="{{asset(mix('vendors/css/vendors.min.css'))}}">
@styles('vendor', [
    asset(mix('fonts/font-awesome/css/font-awesome.min.css')),
    asset(mix('vendors/css/extensions/sweetalert2.min.css')),
    asset(mix('vendors/css/extensions/toastr.min.css'))
])
@styles('vendor')
@stack('vendor-styles')
<link rel="stylesheet" href="{{asset(mix('css/core.css'))}}">
@styles('page', [
    asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')),
    asset(mix('css/base/plugins/extensions/ext-component-toastr.css'))
])
<style>
    .avatar [class*=avatar-status-] {
        width: 30% !important;
        height: 30% !important;
    }
</style>
@styles('page')
@stack('page-styles')
