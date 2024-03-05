        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src">
                    <a href="{{route('home')}}"><img src="{{asset('img/logo.png')}}" alt="Logo" style="width: 100%;"></a>
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Tìm kiếm">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            @if (Auth::user()->avatar == null)
                                                <img src="{{ asset('avatars/no_image.png') }}" alt="Avatar" class="rounded-circle" width="50">
                                            @else
                                                <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" width="50">
                                            @endif
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner">
                                                    <div class="menu-header-image opacity-2"
                                                        style="background-image: url('#');">
                                                    </div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    @if (Auth::user()->avatar == null)
                                                                        <img src="{{ asset('avatars/no_image.png') }}" alt="Avatar" class="rounded-circle" width="50">
                                                                    @else
                                                                        <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" width="50">
                                                                    @endif
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading" style="color: #1E1F29;">{{Auth::user()->name}}</div>
                                                                    <div class="widget-subheading opacity-8" style="color: #1E1F29;">{{Auth::user()->email}}</div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <a class="btn-pill btn-shadow btn-shine btn btn-focus" href="{{ route('logout') }}"
                                                                        onclick="event.preventDefault();
                                                                                    document.getElementById('logout-form').submit();">
                                                                        Đăng xuất
                                                                    </a>

                                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Hoạt động</li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Chat
                                                                <!-- <div class="ml-auto badge badge-pill badge-info">8</div> -->
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Lấy lại mật khẩu</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">{{Auth::user()->name}}</div>
                                    <div class="widget-subheading">{{Auth::user()->email}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>