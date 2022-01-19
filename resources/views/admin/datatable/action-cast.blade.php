@include('Admin::datatable.action', [
    'id' => $model->id,
    'hide' => ['view'],
    'preview' => $model->cast->url
])