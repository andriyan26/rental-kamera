@extends('layouts.app')
@section('title', 'Rental Kamera | Beranda')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, var(--bg-color) 0%, var(--surface-hover) 100%); padding: 60px 0 80px;">
    <div class="container">
        @if (session()->has('registrasi'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('registrasi') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="text-warning text-uppercase fw-bold tracking-wide small"><i class="fas fa-star me-1"></i> Premium Camera Rental</span>
                <h1 class="display-4 fw-bold mt-2 mb-4" style="line-height: 1.15;">Tangkap Momen Terbaik Dengan <span style="color: var(--primary-color);">Lensa Pilihan</span></h1>
                <p class="fs-5 mb-4" style="color: var(--text-muted);">Temukan berbagai koleksi kamera dan lensa profesional untuk kebutuhan fotografi &amp; videografi Anda. Amanah, cepat, dan bersertifikasi.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#katalog" class="btn-luxury d-inline-flex align-items-center gap-2 fw-bold" style="padding: 0.6rem 1.6rem; border-radius: 50px;">
                        <i class="fas fa-th-large"></i> Jelajahi Katalog
                    </a>
                    @if (!Auth::check())
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn-luxury-outline d-inline-flex align-items-center gap-2 fw-bold" style="padding: 0.6rem 1.6rem; border-radius: 50px;">
                            <i class="fas fa-sign-in-alt"></i> Member Login
                        </a>
                    @else
                        <a href="{{ Auth::user()->role == 0 ? route('member.index') : route('admin.index') }}" class="btn-luxury-outline d-inline-flex align-items-center gap-2 fw-bold" style="padding: 0.6rem 1.6rem; border-radius: 50px;">
                            <i class="fas fa-tachometer-alt"></i> Dashboard {{ Auth::user()->role == 0 ? 'Member' : 'Admin' }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-end">
                <div class="position-relative">
                    <div style="position:absolute; width:80%; height:80%; top:50%; left:50%; transform:translate(-50%,-50%); background: var(--primary-color); filter: blur(80px); opacity: 0.15; border-radius: 50%; z-index: 0;"></div>
                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=2000&auto=format&fit=crop"
                         class="img-fluid rounded-4 shadow-lg position-relative"
                         style="z-index:1; border: 1px solid var(--border-color);" alt="Camera Setup">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<div style="background: var(--surface-color); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
    <div class="container py-3">
        <div class="row text-center g-0">
            <div class="col-4 d-flex align-items-center justify-content-center gap-2" style="border-right: 1px solid var(--border-color);">
                <i class="fas fa-camera" style="color: var(--primary-color); font-size: 1.3rem;"></i>
                <div class="text-start d-none d-sm-block">
                    <div class="fw-bold small" style="color: #fff;">{{ $alats->count() }}+ Alat</div>
                    <div style="font-size: 10px; color: var(--text-muted);">Koleksi Premium</div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center gap-2" style="border-right: 1px solid var(--border-color);">
                <i class="fas fa-shield-alt" style="color: var(--primary-color); font-size: 1.3rem;"></i>
                <div class="text-start d-none d-sm-block">
                    <div class="fw-bold small" style="color: #fff;">Terjamin</div>
                    <div style="font-size: 10px; color: var(--text-muted);">Kondisi Terawat</div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-bolt" style="color: var(--primary-color); font-size: 1.3rem;"></i>
                <div class="text-start d-none d-sm-block">
                    <div class="fw-bold small" style="color: #fff;">Cepat &amp; Mudah</div>
                    <div style="font-size: 10px; color: var(--text-muted);">Pesan Online</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =================== KATALOG SECTION =================== -->
<section id="katalog" style="background: var(--bg-color); padding: 64px 0;">
    <div class="container">

        <!-- Section Title -->
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold tracking-wide small" style="color: var(--primary-color);"><i class="fas fa-th-large me-1"></i> Katalog Alat</span>
            <h2 class="fw-bold mt-2 mb-3">Eksplorasi Perangkat <span style="color: var(--primary-color);">Kreatif</span></h2>
            <p style="color: var(--text-muted); max-width: 480px; margin: 0 auto;">Sewa kamera, lensa, lighting, dan aksesori fotografi profesional untuk semua kebutuhan dan budget.</p>
        </div>

        <!-- Filter + Search Bar -->
        <div class="catalogue-filter-bar d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
            <!-- Category Pills -->
            <div class="d-flex flex-wrap gap-2">
                <a class="cat-pill {{ (request('kategori') == null) ? 'active' : '' }}"
                   href="{{ route('home') }}{{ request('search') ? '?search='.request('search') : '' }}">
                   <i class="fas fa-th me-1"></i> Semua
                </a>
                @foreach ($categories as $cat)
                <a class="cat-pill {{ (request('kategori') == $cat->id) ? 'active' : '' }}"
                   href="?kategori={{ $cat->id }}{{ request('search') ? '&search='.request('search') : '' }}">
                    {{ $cat->nama_kategori }}
                </a>
                @endforeach
            </div>

            <!-- Search Input -->
            <form action="" method="GET" style="min-width: 260px; width: 100%; max-width: 360px;">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="input-group">
                    <span class="input-group-text" style="background: var(--surface-hover); border: 1px solid var(--border-color); border-right: none; color: var(--text-muted);">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text"
                        class="form-control"
                        placeholder="Cari nama alat..."
                        name="search"
                        value="{{ request('search') }}"
                        style="background: var(--surface-hover); border: 1px solid var(--border-color); border-left: none; color: #fff; border-radius: 0;">
                    <button class="btn-luxury fw-bold px-3" type="submit" style="border-radius: 0 8px 8px 0; font-size: 13px;">Cari</button>
                </div>
            </form>
        </div>

        <!-- Active Filter Info -->
        @if(request('search') || request('kategori'))
        <div class="d-flex align-items-center justify-content-between mb-4 p-3 rounded-3 flex-wrap gap-2" style="background: var(--surface-color); border: 1px solid var(--border-color);">
            <div class="small" style="color: var(--text-muted);">
                <i class="fas fa-filter me-1" style="color: var(--primary-color);"></i>
                Menampilkan <strong style="color:#fff;">{{ $alats->count() }}</strong> hasil
                @if(request('search')) untuk "<strong style="color: var(--primary-color);">{{ request('search') }}</strong>"@endif
                @if(request('kategori'))
                    di kategori
                    @foreach($categories as $c)
                        @if($c->id == request('kategori'))<strong style="color: var(--primary-color);">{{ $c->nama_kategori }}</strong>@endif
                    @endforeach
                @endif
            </div>
            <a href="{{ route('home') }}" class="btn btn-sm btn-luxury-outline px-3 py-1 rounded-pill" style="font-size: 12px;">
                <i class="fas fa-times me-1"></i> Reset
            </a>
        </div>
        @endif

        <!-- Product Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
            @forelse ($alats as $alat)
            <div class="col">
                <div class="product-card h-100">
                    <!-- Image Container -->
                    <div class="position-relative overflow-hidden" style="height: 205px; background: #111827;">
                        <img class="product-img w-100 h-100"
                             style="object-fit: cover;"
                             src="{{ url('') }}/images/{{ $alat->gambar }}"
                             alt="{{ $alat->nama_alat }}"
                             loading="lazy">
                        <!-- Category Badge -->
                        <div style="position: absolute; top: 10px; left: 10px;">
                            <span style="background: rgba(212,175,55,0.92); color:#000; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; padding: 4px 12px; border-radius: 50px; display: inline-block;">
                                {{ $alat->category->nama_kategori }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-3" style="background: var(--surface-color) !important;">
                        <h6 class="fw-bold mb-3" style="font-size: 14px; line-height: 1.4; color: #fff !important;">{{ $alat->nama_alat }}</h6>

                        <!-- Prices -->
                        <div class="mb-3">
                            <div class="price-row"><span class="price-label">6 Jam</span><span class="price-value">@money($alat->harga6)</span></div>
                            <div class="price-row"><span class="price-label">12 Jam</span><span class="price-value">@money($alat->harga12)</span></div>
                            <div class="price-row" style="border:none;"><span class="price-label">24 Jam</span><span class="price-value">@money($alat->harga24)</span></div>
                        </div>

                        <!-- CTA Button -->
                        <a href="{{ route('home.detail',['id' => $alat->id]) }}"
                           class="btn-luxury d-flex align-items-center justify-content-center gap-2 fw-bold w-100"
                           style="padding: 0.55rem 1rem; border-radius: 50px; font-size: 13px; text-align: center;">
                            <i class="fas fa-camera"></i> Lihat Detail & Sewa
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="mb-4" style="font-size: 4.5rem; opacity: 0.25;">📷</div>
                <h4 class="fw-bold mb-2" style="color: #fff;">Alat Tidak Ditemukan</h4>
                <p style="color: var(--text-muted);" class="mb-4">Coba cari dengan kata kunci atau kategori yang berbeda.</p>
                <a href="{{ route('home') }}" class="btn-luxury rounded-pill px-4 py-2 fw-bold" style="border-radius: 50px;">
                    <i class="fas fa-undo me-1"></i> Lihat Semua Koleksi
                </a>
            </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
