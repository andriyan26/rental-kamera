@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1"><i class="fas fa-chart-pie text-warning me-2"></i> Dashboard Statistik</h3>
            <p class="text-muted small">Ringkasan aktivitas penyewaan dan pelanggan</p>
        </div>
        <div class="text-end text-muted small">
            <i class="far fa-calendar-alt text-warning me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card card-luxury border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25" style="transform: translate(20%, 20%);"><i class="fas fa-file-invoice-dollar text-warning" style="font-size: 6rem;"></i></div>
                <div class="card-body p-4 position-relative z-1">
                    <p class="text-muted text-uppercase tracking-wide small mb-1 fw-bold">Total Reservasi</p>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $total_penyewaan }}</h2>
                </div>
                <div class="card-footer bg-transparent border-top border-secondary p-0 position-relative z-1">
                    <a class="d-flex align-items-center justify-content-between text-warning text-decoration-none p-3 small fw-bold" href="{{ route('penyewaan.index') }}">
                        Lihat Data Reservasi <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card card-luxury border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25" style="transform: translate(20%, 20%);"><i class="fas fa-users text-warning" style="font-size: 6rem;"></i></div>
                <div class="card-body p-4 position-relative z-1">
                    <p class="text-muted text-uppercase tracking-wide small mb-1 fw-bold">Total Penyewa</p>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $total_user }}</h2>
                </div>
                <div class="card-footer bg-transparent border-top border-secondary p-0 position-relative z-1">
                    <a class="d-flex align-items-center justify-content-between text-warning text-decoration-none p-3 small fw-bold" href="{{ route('admin.user') }}">
                        Kelola Penyewa <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card card-luxury border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25" style="transform: translate(20%, 20%);"><i class="fas fa-camera-retro text-warning" style="font-size: 6rem;"></i></div>
                <div class="card-body p-4 position-relative z-1">
                    <p class="text-muted text-uppercase tracking-wide small mb-1 fw-bold">Koleksi Alat</p>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $total_alat }}</h2>
                </div>
                <div class="card-footer bg-transparent border-top border-secondary p-0 position-relative z-1">
                    <a class="d-flex align-items-center justify-content-between text-warning text-decoration-none p-3 small fw-bold" href="{{ route('alat.index') }}">
                        Kelola Inventaris <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card card-luxury border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25" style="transform: translate(20%, 20%);"><i class="fas fa-tags text-warning" style="font-size: 6rem;"></i></div>
                <div class="card-body p-4 position-relative z-1">
                    <p class="text-muted text-uppercase tracking-wide small mb-1 fw-bold">Kategori Alat</p>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $total_kategori }}</h2>
                </div>
                <div class="card-footer bg-transparent border-top border-secondary p-0 position-relative z-1">
                    <a class="d-flex align-items-center justify-content-between text-warning text-decoration-none p-3 small fw-bold" href="{{ route('kategori.index') }}">
                        Kelola Kategori <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Tables -->
    <div class="row g-4 mb-4">
        <!-- Calendar Widget -->
        <div class="col-lg-7">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="far fa-calendar-alt text-warning me-2"></i> Jadwal Reservasi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="bg-white p-3 rounded h-100" style="min-height: 450px;">
                        @include('partials.kalender')
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Stats Widget -->
        <div class="col-lg-5">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-trophy text-warning me-2"></i> Statistik Teratas</h6>
                </div>
                <div class="card-body p-0">
                    
                    <!-- Top 5 Users -->
                    <div class="p-4 border-bottom border-secondary border-opacity-50">
                        <h6 class="fw-bold text-white mb-3 small"><i class="fas fa-crown text-warning me-2"></i> 5 Penyewa Paling Aktif</h6>
                        <div class="table-responsive">
                            <table class="table table-luxury table-borderless table-sm mb-0">
                                <tbody>
                                    @foreach ($top_user as $user)
                                    <tr>
                                        <td class="text-muted" style="width: 30px;">#{{ $loop->iteration }}</td>
                                        <td class="text-white fw-semibold">{{ $user->name }}</td>
                                        <td class="text-end"><span class="badge bg-warning text-dark rounded-pill">{{ $user->payment_count }} Transaksi</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Top 5 Products -->
                    <div class="p-4">
                        <h6 class="fw-bold text-white mb-3 small"><i class="fas fa-fire text-danger me-2"></i> 5 Alat Terfavorit</h6>
                        <div class="table-responsive">
                            <table class="table table-luxury table-borderless table-sm mb-0">
                                <tbody>
                                    @foreach ($top_products as $product)
                                    <tr>
                                        <td class="text-muted" style="width: 30px;">#{{ $loop->iteration }}</td>
                                        <td class="text-white fw-semibold">{{ $product->nama_alat }}</td>
                                        <td class="text-end"><span class="badge bg-danger text-white rounded-pill">{{ $product->order_count }} Reservasi</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
