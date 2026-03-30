@extends('layouts.app')
@section('title', 'Kancil Rental Kamera | Premium Service')

@section('content')
<!-- Custom Styles for Home2 Video Hero -->
<style>
    .hero-premium {
        position: relative;
        height: 80vh;
        min-height: 500px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }
    #hero-video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        transform: translate(-50%, -50%);
        object-fit: cover;
    }
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(11, 15, 25, 0.7) 0%, rgba(11, 15, 25, 0.9) 100%);
        z-index: 1;
    }
    .hero-content-wrap {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        padding: 0 20px;
    }
    .hero-badge {
        background: rgba(212, 175, 55, 0.15);
        color: var(--primary-color);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 24px;
        border: 1px solid rgba(212, 175, 55, 0.3);
    }
</style>

<!-- Hero Section with Video -->
<section class="hero-premium">
    <video autoplay muted loop id="hero-video">
        <source src="{{ asset('/assets/video/kameravideo.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>
    <div class="hero-content-wrap">
        <span class="hero-badge" data-aos="fade-up"><i class="fas fa-certificate me-2"></i> Professional Gear Rental</span>
        <h1 class="display-3 fw-bold mb-4 tracking-tight" data-aos="fade-up" data-aos-delay="100">
            Kreativitas Tanpa <span class="text-gold">Batas</span>
        </h1>
        <p class="fs-5 text-muted mb-5 mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="200">
            Temukan perlengkapan fotografi dan videografi kelas dunia untuk menangkap setiap momen berharga Anda dengan kualitas terbaik.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up" data-aos-delay="300">
            <a href="#katalog" class="btn-luxury px-5 py-3 fs-6">
                <i class="fas fa-camera-retro me-2"></i> Jelajahi Katalog
            </a>
            @if (!Auth::check())
                <a href="{{ route('daftar') }}" class="btn-luxury-outline px-5 py-3 fs-6">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </a>
            @endif
        </div>
    </div>
</section>

<!-- Stats Bar -->
<div class="border-top border-bottom border-luxury py-4 bg-surface">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4 border-end border-luxury border-opacity-50">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="bg-surface-hover p-3 rounded-circle text-gold fs-4"><i class="fas fa-check-circle"></i></div>
                    <div class="text-start">
                        <div class="fw-bold text-white small text-uppercase tracking-wider">100% Terawat</div>
                        <div class="text-muted small">Quality control ketat</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 border-end border-luxury border-opacity-50">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="bg-surface-hover p-3 rounded-circle text-gold fs-4"><i class="fas fa-shield-halved"></i></div>
                    <div class="text-start">
                        <div class="fw-bold text-white small text-uppercase tracking-wider">Aman Tersertifikasi</div>
                        <div class="text-muted small">Peralatan standar industri</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="bg-surface-hover p-3 rounded-circle text-gold fs-4"><i class="fas fa-clock"></i></div>
                    <div class="text-start">
                        <div class="fw-bold text-white small text-uppercase tracking-wider">Booking Cepat</div>
                        <div class="text-muted small">Proses sewa instan 24/7</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =================== KATALOG SECTION =================== -->
<section id="katalog" class="py-5" style="background: var(--bg-color);">
    <div class="container py-4">
        
        <!-- Alerts -->
        @if (session()->has('registrasi'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-lg mb-4" role="alert" style="background: rgba(46, 213, 115, 0.15); color: #2ed573;">
                <i class="fas fa-check-circle me-2"></i> {{ session('registrasi') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-lg mb-4" role="alert" style="background: rgba(255, 71, 87, 0.15); color: #ff4757;">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Member Quick Action -->
        @if (Auth::check())
            <div class="card card-luxury border-luxury border-opacity-50 mb-5 overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=d4af37&color=000" class="rounded-circle shadow" width="48">
                        <div>
                            <h5 class="mb-1 text-white">Selamat Datang, {{ Auth::user()->name }}!</h5>
                            <p class="mb-0 text-muted small">Ingin mulai menyewa hari ini? Silakan jelajahi katalog di bawah.</p>
                        </div>
                    </div>
                    <a href="{{ Auth::user()->role == 0 ? route('member.index') : route('admin.index') }}" class="btn-luxury">
                        <i class="fas fa-tachometer-alt me-2"></i> Ke Dashboard
                    </a>
                </div>
            </div>
        @endif

        <!-- Filter + Search Bar -->
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Eksplorasi Katalog <span class="text-gold">Kreatif</span></h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Pilih kategori alat yang Anda butuhkan atau cari spesifikasi tertentu secara cepat.</p>
        </div>

        <div class="catalogue-filter-bar d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-4 mb-4">
            <!-- Category Pills -->
            <div class="d-flex flex-wrap gap-2">
                <a class="cat-pill {{ (request('kategori') == null) ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="fas fa-th-large me-2"></i> Semua
                </a>
                @foreach ($categories as $cat)
                    <a class="cat-pill {{ (request('kategori') == $cat->id) ? 'active' : '' }}" href="?kategori={{ $cat->id }}">
                        {{ $cat->nama_kategori }}
                    </a>
                @endforeach
            </div>

            <!-- Search Input -->
            <form action="" method="GET" style="min-width: 300px; width: 100%; max-width: 400px;">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-surface-hover"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari tipe kamera atau lensa..." name="search" value="{{ request()->get('search') }}">
                    <button class="btn-luxury px-4 rounded-start-0" type="submit">Cari</button>
                </div>
            </form>
        </div>

        <!-- Result Info -->
        @if(request('search') || request('kategori'))
            <div class="d-flex align-items-center justify-content-between mb-4 p-3 rounded-lg border border-luxury border-dashed bg-surface-hover">
                <div class="small text-muted">
                    Menampilkan <span class="text-white fw-bold">{{ $alats->count() }}</span> hasil 
                    @if(request('search')) untuk "<span class="text-gold">{{ request('search') }}</span>"@endif
                </div>
                <a href="{{ route('home') }}" class="btn btn-sm btn-luxury-outline py-1 small rounded-pill">Reset Filter</a>
            </div>
        @endif

        <!-- Grid Produk -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 mt-2">
            @forelse ($alats as $alat)
            <div class="col">
                <div class="product-card h-100 shadow-lg">
                    <!-- Image Area -->
                    <div class="position-relative overflow-hidden" style="height: 220px; background: #111822;">
                        <img class="product-img w-100 h-100" style="object-fit: cover;" src="{{ url('') }}/images/{{ $alat->gambar }}" alt="{{ $alat->nama_alat }}" loading="lazy"/>
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-luxury shadow-sm px-3 py-2 text-dark fw-bold rounded-pill" style="font-size: 10px;">{{ $alat->category->nama_kategori }}</span>
                        </div>
                    </div>

                    <!-- Details Area -->
                    <div class="card-body p-4 bg-surface">
                        <h6 class="fw-bold text-white mb-3 tracking-tight" style="line-height: 1.4; min-height: 2.8rem;">{{ $alat->nama_alat }}</h6>
                        
                        <div class="price-list mb-4">
                            <div class="price-row">
                                <span class="price-label">24 Jam</span>
                                <span class="price-value">@money($alat->harga24)</span>
                            </div>
                            <div class="price-row">
                                <span class="price-label">12 Jam</span>
                                <span class="price-value">@money($alat->harga12)</span>
                            </div>
                            <div class="price-row">
                                <span class="price-label">6 Jam</span>
                                <span class="price-value">@money($alat->harga6)</span>
                            </div>
                        </div>

                        <a href="{{ route('home.detail',['id' => $alat->id]) }}" class="btn-luxury-outline w-100 py-2 fs-6 d-flex align-items-center justify-content-center gap-2">
                            <i class="fas fa-info-circle me-1"></i> Detail & Sewa
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="mb-4" style="font-size: 5rem; opacity: 0.15;"><i class="fas fa-camera-slash"></i></div>
                <h4 class="text-white fw-bold mb-2">Ops, Alat Tidak Ditemukan</h4>
                <p class="text-muted">Coba cari dengan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="{{ route('home') }}" class="btn-luxury py-2 px-4 shadow mt-3">Reset Pencarian</a>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection