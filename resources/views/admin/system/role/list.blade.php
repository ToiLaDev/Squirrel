@extends('layouts.admin')
@section('title', __('Roles'))
@section('content')
    <div class="row">
      <div class="col-md-8 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{__('Add New Role')}}</h4>
          </div>
          <div class="card-body">
            @form(['App\Forms\RoleForm', 'create'])
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
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Actions')}}</th>
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
