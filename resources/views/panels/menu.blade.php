{{-- For menu --}}
@if(!isset($menu->permission) || $admin->hasAnyPermission((array)$menu->permission))
  <li class="nav-item {{ isset($menu->active) ? (isset($menu->children)?'open':'active') : '' }} {{ isset($menu->classlist)?$menu->classlist:'' }}">
    <a href="{{isset($menu->route)? route($menu->route):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
      @isset($menu->icon)
        @if(is_string($menu->icon))
        <i data-feather="{{ $menu->icon }}"></i>
        @elseif($menu->icon->type == 'image')
        <img src="{{$menu->icon->data}}" />
        @elseif($menu->icon->type == 'class')
        <i class="{{$menu->icon->data}}"></i>
        @elseif($menu->icon->type == 'html')
        {!! $menu->icon->data !!}
        @endif
      @endisset
      <span class="menu-title text-truncate">{{ __($menu->title) }}</span>
      @isset($menu->badge)
        <span class="badge badge-pill ms-auto me-1 {{ isset($menu->badgeClass) ?$menu->badgeClass: "badge-primary" }}">{{number_format($menu->badge)}}</span>
        @endisset
    </a>
    @isset($menu->children)
      @include('panels/submenu', ['menu' => $menu->children])
    @endisset
  </li>
@endif
