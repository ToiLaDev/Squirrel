<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{url('/')}}">
          <span class="brand-logo">
            <x-images.logo size="34" />
          </span>
                    <h2 class="brand-text">{{config('app.name')}}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link text-primary modern-nav-toggle pe-0" data-toggle="collapse">
                    <i class="d-block d-xl-none toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @foreach(Squirrel::getAdminMenu() as $menu)
      @isset($menu->icon)
          {{-- Add Custom Class with nav-item --}}
          @include('panels/menu', ['menu' => $menu])
      @else
          @isset($menu->children)
          <li class="navigation-header">
            <span>{{ __($menu->title) }}</span>
            <i data-feather="more-horizontal"></i>
          </li>
            @foreach($menu->children as $child)
              @include('panels/menu', ['menu' => $child])
            @endforeach
          @endisset
      @endisset
      @endforeach
      {{-- Foreach menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
