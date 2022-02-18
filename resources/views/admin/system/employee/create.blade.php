@extends('layouts.admin')
@section('title', __('Add New Employee'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <!-- users edit account form start -->
                @form(['App\Forms\EmployeeForm', 'create'])
                <!-- users edit account form ends -->
            </div>
        </div>
        </div>
    </div>
@endsection
