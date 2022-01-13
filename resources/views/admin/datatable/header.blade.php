@styles('vendor', [
    asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')),
    asset(mix('vendors/css/tables/datatable/select.dataTables.min.css')),
    asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')),
    asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css'))
])
@scripts('vendor', [
    asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')),
    asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')),
    asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')),
    asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')),
    asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')),
    asset(mix('vendors/js/tables/datatable/buttons.bootstrap5.min.js')),
    asset(mix('vendors/js/tables/datatable/buttons.server-side.js'))
])
@push('page-scripts')
    {{$dataTable->scripts()}}
@endpush
