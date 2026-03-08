<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
        <link href="/css/adminstyles.css" rel="stylesheet" />
        <link href="/css/kancil-theme.css" rel="stylesheet" />
        <style>
            .sb-topnav .navbar-nav .dropdown-menu { right: 0 !important; left: auto !important; }
            #layoutSidenav_content { background: #f8f9fc; }
            .sb-sidenav .nav-link { padding: 0.6rem 1rem !important; }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <title>Member Area</title>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="{{ route('member.index') }}">Member Area</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ms-auto me-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end position-absolute end-0" style="left: auto !important;" aria-labelledby="navbarDropdown">
                        <li><span class="dropdown-item-text small text-muted">{{ Auth::user()->name }}</span></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('akun.pengaturan') }}">Pengaturan Akun</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Katalog</div>
                            <a class="nav-link {{ (Route::is('member.index') && request('view') != 'keranjang') ? 'active' : '' }}" href="{{ route('member.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                                Explore
                            </a>
                            <div class="sb-sidenav-menu-heading">Keranjang & Reservasi</div>
                            <a class="nav-link {{ (Route::is('member.index') && request('view') == 'keranjang') ? 'active' : '' }}" href="{{ route('member.index', ['view' => 'keranjang']) }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Keranjang Anda
                                <span class="badge bg-secondary ms-1">{{ Auth::user()->cart->count() }}</span>
                            </a>
                            <a class="nav-link {{ Route::is('order.show') || Route::is('order.detail') ? 'active' : '' }}" href="{{ route('order.show') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-journal-bookmark"></i></div>
                                Reservasi Anda
                                <span class="badge bg-secondary ms-1">{{ Auth::user()->payment->count() }}</span>
                            </a>
                            <a class="nav-link {{ Route::is('member.kalender') ? 'active' : '' }}" href="{{ route('member.kalender') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-week"></i></div>
                                Kalender
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login sebagai:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 py-4 pb-5 pb-lg-4 member-content">
                        @yield('container')
                    </div>
                </main>
                <!-- Bottom Navbar (mobile only) -->
                <nav class="navbar navbar-dark bg-dark navbar-expand d-lg-none fixed-bottom">
                    <ul class="navbar-nav nav-justified w-100">
                        <li class="nav-item">
                            <a class="nav-link {{ (Route::is('member.index') && request('view') != 'keranjang') ? 'active': '' }}" href="{{ route('member.index') }}">
                                <i class="fas fa-search"></i>
                                <span class="small d-block">Explore</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Route::is('member.index') && request('view') == 'keranjang') ? 'active': '' }}" href="{{ route('member.index', ['view' => 'keranjang']) }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="small d-block">Keranjang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('order.show') || Route::is('order.detail') ? 'active': '' }}" href="{{ route('order.show') }}">
                                <i class="fas fa-journal-bookmark"></i>
                                <span class="small d-block">Reservasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('member.kalender') ? 'active': '' }}" href="{{ route('member.kalender') }}">
                                <i class="fas fa-calendar-week"></i>
                                <span class="small d-block">Kalender</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <script src="/js/datatables.js"></script>
        <script src="/js/adminscripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
