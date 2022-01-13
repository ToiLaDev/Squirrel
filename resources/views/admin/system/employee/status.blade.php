@if($status)
    <div class="badge badge-light-success">{{__('Active')}}</div>
    @else
    <div class="badge badge-light-secondary">{{__('Inactive')}}</div>
@endif