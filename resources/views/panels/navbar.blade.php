<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-us"></i>
                    <span class="selected-language">English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{url('lang/en')}}" data-language="en">
                        <i class="flag-icon flag-icon-us"></i> English
                    </a>
                    <a class="dropdown-item" href="{{url('lang/vi')}}" data-language="vi">
                        <i class="flag-icon flag-icon-vn"></i> Tiếng Việt
                    </a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <span class="badge rounded-pill bg-danger badge-up">5</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            <div class="badge rounded-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar">
                                        <img src="{{ asset('images/portrait/small/avatar-s-15.jpg') }}" alt="avatar" width="32"
                                             height="32">
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p>
                                    <small class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar">
                                        <img src="{{ asset('images/portrait/small/avatar-s-3.jpg') }}" alt="avatar" width="32" height="32">
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p>
                                    <small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p>
                                    <small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="list-item d-flex align-items-center">
                            <h6 class="fw-bolder me-auto mb-0">System Notifications</h6>
                            <div class="form-check form-check-primary form-switch">
                                <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                                <label class="form-check-label" for="systemNotification"></label>
                            </div>
                        </div>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Server down</span>&nbsp;registered</p>
                                    <small class="notification-text"> USA Server is down due to hight CPU usage</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Sales report</span>&nbsp;generated</p><small
                                        class="notification-text"> Last month sales report generated</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage</p><small
                                        class="notification-text"> BLR Server using high memory</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer">
                        <a class="btn btn-primary w-100" href="javascript:void(0)">Read all notifications</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ $admin->full_name }}</span>
                        @php
                            $roleNames = $admin->getRoleNames();
                        @endphp
                        @if(count($roleNames)>0)
                        <span class="user-status">{{ ucfirst($roleNames[0]) }}</span>
                        @endif
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ $admin->avatar }}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('admin.account.profile')}}">
                        <i class="me-50" data-feather="user"></i> {{ __('Account') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('admin.logout')}}">
                        <i class="me-50" data-feather="power"></i> {{ __('Logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
