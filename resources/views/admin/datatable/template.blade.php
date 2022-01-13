@include('Admin::datatable.header')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{$dataTable->table()}}
            </div>
        </div>
    </div>
@endsection
