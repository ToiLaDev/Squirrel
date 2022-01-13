<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow"
     data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none ps-2 pe-2" style="left: 8px;">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="{{url('/')}}">
          <span>
            <x-images.logo size="32"/>
          </span>
                    <h2 class="brand-text">{{ config('site.name') }}</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        @widget('menus-horizontal', 'Top Menu')
        <ul class="nav navbar-nav align-items-center ms-auto">
            @isset($my)
                @if(1)
                    <li class="nav-item dropdown dropdown-notification me-25">
                        <a class="nav-link" href="javascript:void(0);"
                           data-bs-toggle="dropdown"><i class="ficon"
                                                        data-feather="bell"></i><span
                                class="badge rounded-pill bg-danger badge-up">0</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                    <div class="badge badge-pill badge-light-primary">0 New</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block"
                                                                href="javascript:void(0)">Read
                                    all notifications</a></li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                       data-bs-toggle="dropdown" aria-haspopup="true">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $my->full_name }}</span>
                            {{--              <span class="user-status">Admin</span>--}}
                        </div>
                        <span class="avatar">
              <img class="round" src="{{ $my->avatar }}" alt="avatar" height="40" width="40">
              <span class="avatar-status-online"></span>
            </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="#">
                            <i class="mr-50" data-feather="user"></i> {{ __('Account') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i> {{ __('Logout') }}
                        </a>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ route('login') }}">
                        <span>{{ __('Login') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                        <span>{{ __('Register, free!') }}</span>
                    </a>
                </li>
            @endisset
        </ul>
    </div>
</nav>
