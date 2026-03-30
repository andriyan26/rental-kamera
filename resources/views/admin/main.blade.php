<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Area | Rental Kamera Premium</title>

    <!-- Bootstrap CSS & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
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
        .sb-sidenav-dark .sb-sidenav-menu .nav-link .sb-nav-link-icon { color: inherit; }
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
        table.dataTable-table { color: var(--text-main); }
        .dataTable-wrapper .dataTable-top, .dataTable-wrapper .dataTable-bottom { color: var(--text-muted); }
        .dropdown-menu-dark {
            background-color: var(--surface-color);
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
        <a class="navbar-brand ps-3 fw-bold tracking-wide" href="{{ route('admin.index') }}">
            <i class="fas fa-camera-retro text-warning me-2"></i> Admin<span class="text-warning">Panel</span>
        </a>
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
                        <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading text-uppercase text-muted">Reservasi</div>
                        <a class="nav-link {{ Route::is('penyewaan.index') ? 'active' : '' }}" href="{{ route('penyewaan.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Sedang Berjalan
                        </a>
                        <a class="nav-link {{ Route::is('riwayat-reservasi') ? 'active' : '' }}" href="{{ route('riwayat-reservasi') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                            Riwayat Reservasi
                        </a>
                        <button type="button" class="nav-link text-start text-warning border-0 bg-transparent w-100 mt-2" data-bs-toggle="modal" data-bs-target="#cetakLaporanModal">
                            <div class="sb-nav-link-icon text-warning"><i class="fas fa-print"></i></div>
                            Cetak Laporan
                        </button>

                        <div class="sb-sidenav-menu-heading text-uppercase text-muted">Manajemen User</div>
                        <a class="nav-link {{ Route::is('admin.user') ? 'active' : '' }}" href="{{ route('admin.user') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Daftar Pelanggan
                        </a>
                        <a class="nav-link {{ Route::is('admin.kontrak.*') ? 'active' : '' }}" href="{{ route('admin.kontrak.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                            Kontrak Sewa
                        </a>

                        @if (Auth::user()->role == 2)
                        <div class="sb-sidenav-menu-heading text-uppercase text-muted">Superadmin</div>
                        <a class="nav-link {{ Route::is('superuser.admin') ? 'active' : '' }}" href="{{ route('superuser.admin') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                            Manajemen Admin
                        </a>
                        <a class="nav-link {{ Route::is('alat.index') ? 'active' : '' }}" href="{{ route('alat.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-camera"></i></div>
                            Kelola Alat
                        </a>
                        <a class="nav-link {{ Route::is('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Kategori Alat
                        </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main class="py-4 px-4 bg-transparent border-0 h-100">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Modal Cetak Laporan -->
    <div class="modal fade" id="cetakLaporanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-luxury border-warning">
                <div class="modal-header border-secondary bg-dark">
                    <h5 class="modal-title text-white fw-bold"><i class="fas fa-print text-warning me-2"></i> Cetak Laporan Pemasukan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-dark">
                    <form action="{{ route('cetak') }}" method="GET" target="_blank">
                        <div class="mb-3">
                            <label class="form-label text-muted small tracking-wide text-uppercase">Dari Tanggal</label>
                            <input type="date" class="form-control form-luxury bg-dark border-secondary text-white" name="dari" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small tracking-wide text-uppercase">Sampai Tanggal</label>
                            <input type="date" class="form-control form-luxury bg-dark border-secondary text-white" name="sampai" required>
                        </div>
                        <button type="submit" class="btn btn-luxury w-100 fw-bold py-2"><i class="fas fa-print me-2"></i> Cetak Laporan PDF / Print</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/adminscripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script src="/js/datatables.js"></script>
</body>
</html>
