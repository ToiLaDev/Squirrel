@extends('layouts.admin')
@section('title', __('Add New Employee'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <!-- users edit account form start -->
                <form class="form-validate" method="post" action="{{route('admin.employees.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <x-forms.input name="username" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input name="first_name" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input name="last_name" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input name="email" type="email" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input name="phone" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.select name="status" :options="[['value'=>1,'title'=>__('Active')],['value'=>0,'title'=>__('Inactive')]]" />
                        </div>
                        <div class="col-md-4">
                            <x-role.select2 name="role" :disabled="$admin->cannot('employee.permission')" :multiple="true" placeholder="-- Choose Role --" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input name="password" type="password" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input name="password_confirmation" type="password" />
                        </div>
                        @can('employee.permission')
                        <div class="col-12">
                            <div class="table-responsive border rounded mt-1" >
                                <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                    <i data-feather="lock" class="font-medium-3 me-25"></i>
                                    <span class="align-middle">{{__('Direct Permission')}}</span>
                                </h6>
                                <table class="table table-striped table-borderless">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{__('Module')}}</th>
                                        <th>{{__('Permissions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($modules as $module => $permissions)
                                        <tr>
                                            <td>{{ __(ucfirst($module)) }}</td>
                                            <td>
                                                @foreach($permissions as $permission => $name)
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="{{$module}}-{{$permission}}" value="{{$module}}.{{$permission}}" />
                                                        <label class="form-check-label" for="{{$module}}-{{$permission}}">{{ __($name) }}</label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endcan
                        <div class="col-12 mt-2">
                            <x-forms.action />
                        </div>
                    </div>
                </form>
                <!-- users edit account form ends -->
            </div>
        </div>
        </div>
    </div>
@endsection
