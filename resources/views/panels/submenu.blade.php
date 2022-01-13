{{-- For submenu --}}
<ul class="menu-content">
  @isset($menu)
  @foreach($menu as $submenu)
      @if(!isset($submenu->permission) || $admin->hasAnyPermission((array)$submenu->permission))
  <li class="{{ isset($submenu->active) ? (isset($submenu->children)?'open':'active') : '' }}">
    <a href="{{isset($submenu->route) ? route($submenu->route):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($submenu->newTab) ? '_blank':'_self'}}">
      @isset($submenu->icon)
      <i data-feather="{{$submenu->icon}}"></i>
      @endisset
      <span class="menu-item text-truncate">{{ __($submenu->title) }}</span>
    </a>
    @isset($submenu->children))
    @include('panels/submenu', ['menu' => $submenu->children])
    @endisset
  </li>
      @endif
  @endforeach
  @endisset
</ul>
