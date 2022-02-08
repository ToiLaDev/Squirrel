<?php

namespace App\DataTables;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{

    protected $filters = [];
    protected $order = [];

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
                $datatables = $datatables->addColumn($name, is_array($column)?$this->rawFormat($name, $column):$column);
            }
            $datatables = $datatables->rawColumns(array_keys($rawColumns));
        }

        return $datatables;
    }

    public function render($view, $data = [], $mergeData = [])
    {
        $attributes = [
            'dataTableId' => $this->getTableId()
        ];
        $render = parent::render($view, array_merge($attributes, $data), $mergeData);

        if ($this->hasFilter() && $render instanceof View) {
            $render = $render->with('filters', $this->filters);
        }

        return $render;
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
                    'text' => '<i class="fa fa-plus"></i>'//__('Add New')
                ]);
            }
            if (in_array('excel', $this->showButtons)) {
                $buttons[] = Button::make([
                    'extend' => 'excel',
                    'className' => 'btn-success',
                    'text' => '<i class="fa fa-download"></i>'//__('Export')
                ]);
            }
            if (in_array('reload', $this->showButtons)) {
                $buttons[] = Button::make([
                    'extend' => 'reload',
                    'className' => 'btn-secondary',
                    'text' => '<i class="fa fa-sync"></i>'//__('Reload')
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
                'infoFiltered' => __('(filtered from _MAX_ total entries)'),
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

        if (!empty($this->order)) {
            $builder = $builder->parameters(['order' => [$this->order['index'], $this->order['type']]]);
        }

        if ($this->hasFilter()) {
            $builder = $builder->dom('<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' .
                '<"col-lg-12 col-xl-3"l>' .
                '<"col-lg-12 col-xl-9 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap me-1"<"me-1">B>>' .
                '>t' .
                '<"d-flex justify-content-between mx-2 row mb-1"' .
                '<"col-sm-12 col-md-6"i>' .
                '<"col-sm-12 col-md-6"p>' .
                '>'
            );
        } else {
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
        $index = 0;
        foreach ($this->columns as $name => $column) {
            if (isset($column['raw']['type']) && in_array($column['raw']['type'], ['action', 'acast'])) {
                if (empty($column['width'])) {
                    $column['width'] = 80;
                }
                if (empty($column['addClass'])) {
                    $column['addClass'] = 'text-center';
                }
            }

            $col = Column::make($name);

            if (isset($column['data'])) {
                $col = $col->data($column['data']);
            } elseif(isset($column['raw'])) {
                $col = $col->data("_{$name}");
            }
            if (isset($column['search'])) {
                $col = $col->searchable($column['search']);
            }
            if (!isset($column['title'])) {
                $column['title'] = Str::headline($name);
            }

            $col = $col->title(__($column['title']));

            if (isset($column['width'])) {
                $col = $col->width($column['width']);
            }
            if (isset($column['addClass'])) {
                $col = $col->addClass($column['addClass']);
            }
            if (isset($column['hide'])) {
                $col = $col->hidden();
            }
            if (isset($column['filter'])) {
                $filter = [
                    'name' => $name,
                    'datas' => [
                        'column' => $index+1,
                        'column-index' => $index,
                    ],
                    'class' => 'dt-input',
                    'type' => 'text'
                ];
                if (is_string($column['filter'])) {
                    $filter['type'] = $column['filter'];
                } elseif(is_array($column['filter'])) {
                    $filter = array_merge($column['filter'], $filter);
                }

                if (empty($filter['title'])) {
                    $filter['title'] = __($column['title']);
                }

                $this->filters[$name] = $filter;
                unset($filter);
            }
            if (isset($column['order'])) {
                $this->order = [
                    'index' => $index,
                    'type' => $column['order']
                ];
            }

            $columns[] = $col;
            unset($col);
            $index++;
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
                $columns[$column['data']??"_{$name}"] = is_array($column['raw'])?array_merge(['name'=>$name], $column['raw']):$column['raw'];
            }
        }

        return $columns;
    }

    protected function hasFilter() {
        return !empty($this->filters);
    }

    protected function rawFormat($name, $data) {
        $data = array_merge([
            'name' => $name,
            'type' => 'date',
            'format' => 'Y-m-d H:i:s'
        ], $data);

        if (Str::contains($data['name'], '.')) {
            $splitName = explode('.', $data['name']);
            $rawName = "\${$splitName[0]}";
            for ($i=1; $i< count($splitName); $i++) {
                $rawName .= "['{$splitName[$i]}']";
            }
        } else {
            $rawName = "\${$data['name']}";
        }

        $return = '';

        switch ($data['type']) {
            case 'date':
                $return = "{{datetime_format({$rawName}, '{$data['format']}')}}";//"{{Date::parse(\${$data['name']})->tz(config('app.timezone'))->format(__('{$data['format']}'))}}";
                break;
            case 'number':
                $return = "{{number_format({$rawName})}}";
                break;
            case 'id':
                $return = "<a class=\"font-weight-bold\" href=\"javascript:void(0);\">#{{ \$id }}</a>";
                break;
            case 'image':
                $return = "<div class=\"ratio ratio-16x9\"><div class=\"bg-cover rounded\" style=\"background-image: url('{{ {$rawName} }}')\"></div></div>";
                break;
            case 'action':
                $return = "Admin::datatable.action";
                break;
            case 'acast':
                $return = "Admin::datatable.action-cast";
                break;
        }
        return $return;
    }
}
