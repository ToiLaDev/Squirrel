<script src="{{asset(mix('vendors/js/vendors.min.js'))}}" ></script>
@scripts('vendor', [
    asset(mix('vendors/js/ui/jquery.sticky.js')),
    asset(mix('vendors/js/extensions/sweetalert2.all.min.js')),
    asset(mix('vendors/js/extensions/toastr.min.js'))
])
@scripts('vendor')
@stack('vendor-scripts')
<script src="{{asset(mix('js/core/app-menu.js'))}}" ></script>
<script src="{{asset(mix('js/core/app.js'))}}" ></script>
@scripts('page')
<script type="text/javascript">
    const textDirection =  $('html').data('textdirection');
    const isRtl = textDirection === 'rtl';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( document ).ajaxSuccess(function( event, xhr, settings ) {
        if(xhr.responseJSON !== undefined && xhr.responseJSON.toast !== undefined) {
            showToast(xhr.responseJSON.toast);
        }
    });
    $( document ).ajaxError(function( event, xhr, settings ) {
        if(xhr.responseJSON !== undefined && xhr.responseJSON.message !== undefined) {
            showToast({
                message: xhr.responseJSON.message,
                title: xhr.responseJSON.exception,
                type: 'error'
            });
        }
    });

    const confirmAction = (callback, text, title) => {
        if (text === undefined) {
            text = `{!! __('Maybe You won\'t be able to revert this!') !!}`;
        }
        if (title === undefined) {
            title = `{!! __('Are you sure?') !!}`;
        }
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: `{{ __('Yes') }}`,
            cancelButtonText: `{{ __('Cancel') }}`,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                callback();
            }
        });
    };

    const showToast = (toast) => {
        if (toast !== undefined) {
            const type = toast.type ?? 'success',
                options = {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                    ...toast.options
                };
            let title = toast.title;

            console.log(title);
            if(title == null) {
                switch (type) {
                    case 'success':
                        title = '{{ __('Success!') }}';
                        break;
                    case 'info':
                        title = '{{ __('Info!') }}';
                        break;
                    case 'warning':
                        title = '{{ __('Warning!') }}';
                        break;
                    case 'error':
                        title = '{{ __('Error!') }}';
                        break;
                }
            }

            toastr[type](toast.message, title, options);
        }
    };
</script>
@stack('page-scripts')
