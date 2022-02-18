@extends('layouts.admin')
@section('title', __('Employee Edit'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <!-- users edit account form start -->
                @form(['App\Forms\EmployeeForm', 'edit'], $employee)
                <!-- users edit account form ends -->
            </div>
        </div>
        </div>
    </div>
@endsection
