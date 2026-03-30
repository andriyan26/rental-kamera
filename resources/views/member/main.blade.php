<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Area | Rental Kamera Premium</title>

    <!-- Bootstrap CSS & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="/css/adminstyles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Design CSS -->
    <link href="/css/design.css?v={{ time() }}" rel="stylesheet" />
    
    <style>
        body.sb-nav-fixed {
            background-color: var(--bg-color);
            color: var(--text-main);
        }
        #layoutSidenav_content { background: var(--bg-color); }
        .sb-topnav {
            background: rgba(11, 15, 25, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
        }
        .sb-sidenav {
            background-color: var(--surface-color) !important;
            border-right: 1px solid var(--border-color);
        }
        .sb-sidenav-dark .sb-sidenav-menu .nav-link {
            color: var(--text-muted);
            transition: var(--transition);
        }
        .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover,
        .sb-sidenav-dark .sb-sidenav-menu .nav-link.active {
            color: var(--primary-color);
            background: rgba(212, 175, 55, 0.05);
            border-right: 3px solid var(--primary-color);
        }
        .sb-sidenav-dark .sb-sidenav-menu .nav-link .sb-nav-link-icon {
            color: inherit;
        }
        .sb-sidenav-dark .sb-sidenav-footer {
            background-color: var(--surface-hover);
            border-top: 1px solid var(--border-color);
        }
        .card {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .card-header {
            background: var(--surface-hover);
            border-bottom: 1px solid var(--border-color);
            font-weight: bold;
        }
        .table {
            color: var(--text-main);
        }
        .table-hover tbody tr:hover {
            color: var(--text-main);
            background-color: var(--surface-hover);
        }
        .dropdown-menu-dark {
            background-color: var(--surface-color);
            border: 1px solid var(--border-color);
        }
    </style>
    @stack('styles')
</head>
<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
        <a class="navbar-brand ps-3 fw-bold tracking-wide" href="{{ route('member.index') }}"><i class="fas fa-camera-retro text-warning me-2"></i> Rental<span class="text-warning">Kamera</span></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('home') }}" title="Ke Beranda Public"><i class="fas fa-globe"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=d4af37&color=000" alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow-lg" aria-labelledby="navbarDropdown">
                    <li class="dropdown-item-text text-muted small pb-2">Login sebagai: <br><strong class="text-white">{{ Auth::user()->name }}</strong></li>
                    <li><hr class="dropdown-divider border-secondary" /></li>
                    <li><a class="dropdown-item" href="{{ route('akun.pengaturan') }}"><i class="fas fa-cog text-warning me-2"></i> Pengaturan Akun</a></li>
                    <li><hr class="dropdown-divider border-secondary" /></li>
                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav pt-3">
                        <div class="sb-sidenav-menu-heading text-uppercase text-muted">Katalog</div>
                        <a class="nav-link {{ (Route::is('member.index') && request('view') != 'keranjang') ? 'active' : '' }}" href="{{ route('member.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                            Explore Kamera
                        </a>
                        
                        <div class="sb-sidenav-menu-heading text-uppercase text-muted">Aktivitas</div>
                        <a class="nav-link {{ (Route::is('member.index') && request('view') == 'keranjang') ? 'active' : '' }}" href="{{ route('member.index', ['view' => 'keranjang']) }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Keranjang Saya
                            @if(Auth::user()->cart->count() > 0)
                                <span class="badge bg-warning text-dark ms-auto rounded-pill">{{ Auth::user()->cart->count() }}</span>
                            @endif
                        </a>
                        <a class="nav-link {{ Route::is('order.show') || Route::is('order.detail') ? 'active' : '' }}" href="{{ route('order.show') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Reservasi Saya
                        </a>
                        <a class="nav-link {{ Route::is('member.kalender') ? 'active' : '' }}" href="{{ route('member.kalender') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                            Kalender Sewa
                        </a>
                        
                        @if ((int) Auth::user()->role === 0)
                        <div class="sb-sidenav-menu-heading text-uppercase text-muted">Dokumen</div>
                        <a class="nav-link {{ Route::is('member.kontrak') ? 'active' : '' }}" href="{{ route('member.kontrak') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                            Kontrak Kerjasama
                        </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4 pb-5 member-content">
                    @yield('container')
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/js/adminscripts.js"></script>
    @stack('scripts')
</body>
</html>
