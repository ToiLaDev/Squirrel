@php
    $roleNames = $model->getRoleNames();
@endphp
@if(count($roleNames) > 0)
    @foreach($roleNames as $name)
    <div class="badge badge-light-primary">{{ ucfirst($name) }}</div>
    @endforeach
@else
    <div class="badge badge-light-secondary">N/A</div>
@endif
