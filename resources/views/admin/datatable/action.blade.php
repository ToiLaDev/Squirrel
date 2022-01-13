<div class="text-nowrap item-actions" data-id="{{$id}}">
    @isset($extend)
        @include($extend)
    @endisset
    @isset($preview)
    <button class="item-preview btn btn-sm btn-icon btn-flat-info" data-preview="{{$preview}}">
        <i class="fa fa-eye"></i>
    </button>
    @endisset
    @if(empty($hide) || !in_array('view', $hide))
    <button
        class="item-view btn btn-sm btn-icon btn-flat-primary"
        @isset($url)
        data-url="{{$url}}"
        @endisset
        data-toggle="tooltip" title="{{ __('View') }}"
    >
        <i class="fa fa-eye"></i>
    </button>
    @endif
    @if(empty($hide) || !in_array('edit', $hide))
    <button
        class="item-edit btn btn-sm btn-icon btn-flat-success"
        @isset($url)
        data-url="{{$url}}/edit"
        @endisset
        data-toggle="tooltip" title="{{ __('Edit') }}"
    >
        <i class="fa fa-edit"></i>
    </button>
    @endif
    @if(empty($hide) || !in_array('delete', $hide))
    <button class="item-delete btn btn-sm btn-icon btn-flat-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
        <i class="fa fa-trash-alt"></i>
    </button>
    @endif
</div>
