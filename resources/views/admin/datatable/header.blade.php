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
@isset($filters)
    <script type="text/javascript">
        $(function () {
            $('.dt_adv_search').on('submit', function (event) {
                event.preventDefault();
                var inputElms = $(this).find('.dt-input');
                inputElms.each(function () {
                    var colIndex = $(this).data('column-index'),
                        seachVal = $(this).val()
                    ;
                    window.LaravelDataTables["{{ $dataTableId }}"].column(colIndex).search(seachVal, false, true);

                });
                window.LaravelDataTables["{{ $dataTableId }}"].draw();
            });
            $('.dt_adv_search').on('reset', function (event) {
                $('.select2').val(null).trigger("change");
                window.LaravelDataTables["{{ $dataTableId }}"].columns().search('').draw();
            });
        });
    </script>
    @endisset
@endpush
@push('page-styles')
    <style>
        /*.dataTable th {*/
        /*    white-space: nowrap;*/
        /*}*/
    </style>
@endpush
