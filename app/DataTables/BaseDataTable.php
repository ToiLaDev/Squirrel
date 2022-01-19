<?php

namespace App\DataTables;

use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $datatables = datatables()
            ->eloquent($query)
        ;

        $rawColumns = $this->rawColumns();

        if (!empty($rawColumns)) {
            foreach ($rawColumns as $name => $column) {
                $datatables = $datatables->addColumn($name, $column);
            }
            $datatables = $datatables->rawColumns(array_keys($rawColumns));
        }

        return $datatables;
    }

    public function getTableId() {
        return Str::slug($this->name??class_basename($this)).'-table';
    }

    public function html()
    {
        $buttons = [];

        if (empty($this->showButtons)) {
            $buttons[] = Button::make([
                'extend' => 'reload',
                'className' => 'btn-secondary',
                'text' => __('Reload')
            ]);
        }
        else {
            if (in_array('create', $this->showButtons)) {
                $buttons[] = Button::make([
                    'extend' => 'create',
                    'className' => 'btn-primary',
                    'text' => __('Add New')
                ]);
            }
            if (in_array('excel', $this->showButtons)) {
                $buttons[] = Button::make([
                    'extend' => 'excel',
                    'className' => 'btn-success',
                    'text' => __('Export')
                ]);
            }
            if (in_array('reload', $this->showButtons)) {
                $buttons[] = Button::make([
                    'extend' => 'reload',
                    'className' => 'btn-secondary',
                    'text' => __('Reload')
                ]);
            }
        }

        $builder = $this->builder()
            ->setTableId($this->getTableId())
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->language([
                'emptyTable' => __('No data available in table'),
                'info' => __('Showing _START_ to _END_ of _TOTAL_ entries'),
                'infoEmpty' => __('Showing 0 to 0 of 0 entries'),
                'loadingRecords' => __('Loading...'),
                'processing' => __('Processing...'),
                'search' => __('Search:'),
                'paginate' => [
                    'first' => __('First'),
                    'last' => __('Last'),
                    'next' => ' ',//__('Next'),
                    'previous' => ' ',//__('Previous'),
                ],
                'lengthMenu' => __('Show _MENU_ entries')
            ])
            ->buttons($buttons)
        ;
        if (empty($this->filters)) {
            $builder = $builder->dom('<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' .
                '<"col-lg-12 col-xl-3"l>' .
                '<"col-lg-12 col-xl-9 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap me-1"<"me-1"f>B>>' .
                '>t' .
                '<"d-flex justify-content-between mx-2 row mb-1"' .
                '<"col-sm-12 col-md-6"i>' .
                '<"col-sm-12 col-md-6"p>' .
                '>'
            );
        }

        return $builder;
    }

    protected function getColumns()
    {
        $columns = [];

        foreach ($this->columns as $name => $column) {
            $col = Column::make($name);

            if (isset($column['data'])) {
                $col = $col->data($column['data']);
            }
            if (isset($column['title'])) {
                $col = $col->title(__($column['title']));
            } else {
                $col = $col->title(__(Str::headline($name)));
            }
            if (isset($column['width'])) {
                $col = $col->width($column['width']);
            }
            if (isset($column['addClass'])) {
                $col = $col->addClass($column['addClass']);
            }
            if (isset($column['hidden'])) {
                $col = $col->hidden();
            }

            $columns[] = $col;
            unset($col);
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return Str::headline($this->name??class_basename($this)) . '_' . date('YmdHis');
    }

    protected function rawColumns() {
        $columns = [];

        foreach ($this->columns as $name => $column) {
            if (isset($column['raw'])) {
                $columns[$column['data']??$name] = $column['raw'];
            }
        }

        return $columns;
    }
}
