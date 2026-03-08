<!DOCTYPE html>
<html lang="id">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Kancil Rental - Sewa kamera & perlengkapan foto profesional di Purwokerto" />
    <title>Kancil Rental Kamera</title>
    
    <!-- Ganti favicon dengan ikon kamera anime berbasis SVG -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/camera-anime-icon.svg') }}" />
    
    <link href="/css/styles.css" rel="stylesheet" />
    <link href="/css/kancil-theme.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            /* Style untuk Navbar */
            .navbar {
                background-color: #2c3e50;
            }

            /* Hero Section */
            .hero-elegant {
                position: relative;
                height: 600px; /* Meningkatkan tinggi agar lebih proporsional */
            }

            /* Video Background */
            #hero-video {
                object-fit: cover;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            /* Overlay Text untuk memperjelas teks */
            .hero-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 2;
                color: #fff;
                text-align: center;
                padding: 0 15px;
            }

            .hero-content h1 {
                font-size: 3rem;
                font-weight: bold;
                animation: fadeIn 2s ease-in-out;
            }

            .hero-content p {
                font-size: 1.5rem;
                animation: fadeIn 3s ease-in-out;
            }

            .hero-content button {
                animation: fadeIn 4s ease-in-out;
                margin-top: 20px;
                padding: 12px 35px;
                font-size: 1.1rem;
                background-color: #f39c12;
                border: none;
                color: white;
                border-radius: 5px;
            }

            /* Animasi FadeIn untuk teks dan tombol */
            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            /* Style untuk Overlay */
            .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <!-- Navbar 
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Kancil Rental Kamera</a> 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto">
                        @if (!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('daftar') }}">Daftar</a>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        -->

        <!-- Hero Section dengan Video Background -->
        <div class="hero-elegant">
            <!-- Video Background -->
            <video autoplay muted loop id="hero-video">
                <source src="{{ asset('/assets/video/kameravideo.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Overlay untuk Video -->
            <div class="overlay"></div>

            <!-- Overlay Text -->
            <div class="hero-content">
                <h1>Kancil Rental Online</h1>
                <p class="lead">Cek Ketersediaan · Reservasi · Bayar · Ambil · Kembalikan</p>
                @if (!Auth::check())
                    <button type="button" class="btn btn-hero" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login / Daftar
                    </button>
                @endif
            </div>
        </div>

        <!-- Container untuk Konten -->
        <div class="container py-5">
            @if (session()->has('registrasi'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('registrasi') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('success_reset_password'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_reset_password') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Auth::check() && Auth::user()->role == 0)
                <div class="alert alert-info d-flex align-items-center justify-content-between flex-wrap gap-2" role="alert">
                    <span>Hai <b>{{ Auth::user()->name }}</b>, siap menyewa?</span>
                    <a class="btn btn-primary btn-sm" href="{{ route('member.index') }}">Mulai Menyewa</a>
                </div>
            @elseif (Auth::check() && Auth::user()->role != 0)
                <div class="alert alert-info d-flex align-items-center justify-content-between flex-wrap gap-2" role="alert">
                    <span>Login sebagai Admin <b>{{ Auth::user()->name }}</b></span>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.index') }}">Halaman Admin</a>
                </div>
            @endif

            <!-- Kategori dan Pencarian Produk -->
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    @if (request()->get('search') == null)
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <a class="btn {{ (request('kategori') == null) ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('home') }}">Semua</a>
                            @foreach ($categories as $cat)
                                <a class="btn {{ (request('kategori') == $cat->id) ? 'btn-primary' : 'btn-outline-secondary' }}" href="?kategori={{ $cat->id }}">{{ $cat->nama_kategori }}</a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">Hasil pencarian <b>{{ request()->get('search') }}</b>. <a href="{{ route('home') }}" class="text-decoration-none">Tampilkan semua</a></p>
                    @endif
                </div>
                <div class="col-md-4">
                    <form action="" class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Cari alat..." name="search" value="{{ request()->get('search') }}"/>
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>
                </div>
            </div>

            <!-- Grid Produk -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
                @foreach ($alats as $alat)
                <div class="col">
                    <div class="card product-card h-100">
                        <div class="overflow-hidden">
                            <img class="card-img-top" src="{{ url('') }}/images/{{ $alat->gambar }}" alt="{{ $alat->nama_alat }}"/>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-warning text-dark mb-2">{{ $alat->category->nama_kategori }}</span>
                            <h6 class="card-title">{{ $alat->nama_alat }}</h6>
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span>@money($alat->harga24)</span>
                                <span>24 Jam</span>
                            </div>
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span>@money($alat->harga12)</span>
                                <span>12 Jam</span>
                            </div>
                            <div class="d-flex justify-content-between text-muted small">
                                <span>@money($alat->harga6)</span>
                                <span>6 Jam</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <a href="{{ route('home.detail',['id' => $alat->id]) }}" class="btn btn-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <footer class="py-4 bg-dark">
            <div class="container text-center text-white">
                <p class="m-0">&copy; {{ date('Y') }} Kancil Rental Kamera</p>
            </div>
        </footer>

        <!-- Modal Login -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Masuk ke Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small mb-4">Nikmati kemudahan reservasi kamera secara online.</p>
                        <a href="{{ route('daftar') }}" class="btn btn-primary w-100 mb-4">Daftar Sekarang</a>
                        <p class="small text-muted mb-2">Sudah punya akun? Login di bawah.</p>
                        @include('partials.login')
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>