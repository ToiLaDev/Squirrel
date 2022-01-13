@extends('layouts.admin')
@section('title', __('Roles'))
@section('content')
    <div class="row">
      <div class="col-md-8 col-12">
        <form method="post" action="{{route('admin.roles.update', $role->id)}}">
          @csrf
          @method('PUT')
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{__('Edit Role:')}} {{$role->name}}</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                  <x-forms.input name="name" :value="$role->name" placeholder="Role Name" />
              </div>
              <div class="col-12">
                <div class="table-responsive border rounded mt-1" >
                  <h6 class="py-1 mx-1 mb-0 font-medium-2">
                    <i data-feather="lock" class="font-medium-3 me-25"></i>
                    <span class="align-middle">{{__('Permission')}}</span>
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
                              <input type="checkbox" class="form-check-input" name="permissions[]" id="{{$module}}-{{$permission}}" value="{{$module}}.{{$permission}}" @if($role->hasPermissionTo("{$module}.{$permission}")) checked @endif />
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
              <div class="col-12 mt-2">
                <x-forms.action />
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="col-md-4 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{__('Roles List')}}</h4>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              @foreach($roles as $role)
              <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>
                  @if($role->id != 1)
                    <a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-icon btn-sm btn-flat-success">
                      <i data-feather="edit"></i>
                    </a>
                    <button type="button" class="btn btn-icon btn-sm btn-flat-danger" data-id="{{ $role->id }}">
                      <i data-feather="trash-2"></i>
                    </button>
                  @endif
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
