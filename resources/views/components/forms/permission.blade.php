<div class="col-12">
    <div class="table-responsive border rounded mt-1" >
        <h6 class="py-1 mx-1 mb-0 font-medium-2">
            <i data-feather="lock" class="font-medium-3 me-25"></i>
            <span class="align-middle">{{__($title)}}</span>
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
                                <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="{{$name}}[]"
                                        id="{{$module}}-{{$permission}}"
                                        value="{{$module}}.{{$permission}}"
                                        @if(
                                            ($model instanceof \App\Models\Employee && $model->hasDirectPermission("{$module}.{$permission}"))
                                            || ($model instanceof \Spatie\Permission\Models\Role && $model->hasPermissionTo("{$module}.{$permission}"))
                                        )
                                        checked
                                        @endif
                                />
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