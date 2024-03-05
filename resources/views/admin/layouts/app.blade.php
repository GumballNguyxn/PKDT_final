<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin - PKDT Store</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description"
        content="This is an example dashboard (CodeLean) created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/my_style.css')}}" rel="stylesheet">
    <!-- Các thư viện Swal -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <header>
            @include('admin.layouts.header')
        </header>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner" ></span>
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
                        <button type="button" class="btn-icon btn-icon-only btn btn-danger btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                                </svg>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="{{ Request::is('admin*') ? 'mm-active' : '' }}">
                                <a href="{{route('admin')}}" class="d-flex align-items-center gap-1 font-weight-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-data" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V9a1 1 0 0 0-1-1"/>
                                    </svg>
                                    Thống kê
                                </a>
                            </li>
                            <li class="mm-active">
                                <a href="#" class="d-flex align-items-center gap-1 font-weight-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
                                    </svg>
                                    Dữ liệu
                                </a>
                                <ul>
                                    <li>

                                        <a href="{{ route('users.index') }}" class="{{ Request::is('users*') ? 'mm-active' : '' }}">

                                            <i class="metismenu-icon"></i>Nguời dùng
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.order.index') }}" class="{{ Request::is('admin/order*') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Đơn hàng
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.products.index')}}" class="{{ Request::is('admin/products*') ? 'mm-active' : '' }}">

                                            <i class="metismenu-icon"></i>Sản phẩm
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.category.index')}}" class="{{ Request::is('admin/category*') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Danh mục
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('brand.index') }}" class="{{ Request::is('admin/brand*') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Hãng
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="app-main__outer">

                @yield('main')

                
    
    <!-- <div class="app-drawer-overlay d-none animated fadeIn"></div> -->
    @include('admin.layouts.dialog')
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/main-admin.js')}}"></script>
    <script src="{{asset('js/ajax_script.js')}}"></script>
</body>

</html>