<ul class="nav nav-pills mb-2">
    <!-- Account -->
    @foreach(Squirrel::getAdminSettingMenu() as $menu)
    <li class="nav-item">
        <a class="nav-link @isActive($menu['route'])" href="{{ route($menu['route']) }}">
            @isset($menu['icon'])
            <i data-feather="{{ $menu['icon'] }}" class="font-medium-3 me-50"></i>
            @endisset
            <span class="fw-bold">{{ __($menu['title']) }}</span>
        </a>
    </li>
    @endforeach
</ul>
