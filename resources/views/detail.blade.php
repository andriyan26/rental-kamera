@extends('layouts.app')
@section('title', 'Detail - ' . $detail->nama_alat . ' | Rental Kamera')

@push('styles')
<link rel="stylesheet" href="/js/fullcalendar/main.css">
<style>
    .product-img-container {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--border-color);
        background: var(--surface-color);
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    }
    .product-img-container img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: contain;
    }
    .price-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        transition: var(--transition);
        cursor: pointer;
    }
    .price-card:hover {
        border-color: var(--primary-color);
        background: rgba(212, 175, 55, 0.05);
    }
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: var(--border-color);
    }
    .fc .fc-button-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #000;
        font-weight: bold;
    }
    .fc .fc-button-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #000;
    }
    .fc-daygrid-day-number {
        color: var(--text-main);
    }
</style>
@endpush

@section('content')
<div class="container py-5 mt-4">
    <!-- Breadcrumb / Back Button -->
    <div class="mb-4">
        @if (Auth::guest())
            <a href="{{ route('home') }}" class="text-muted text-decoration-none hover-text-warning"><i class="fas fa-arrow-left me-2"></i> Kembali ke Katalog</a>
        @elseif (Auth::user()->role == 0)
            <a href="{{ route('member.index') }}" class="text-muted text-decoration-none hover-text-warning"><i class="fas fa-arrow-left me-2"></i> Kembali ke Member Area</a>
        @else
            <a href="{{ url()->previous() }}" class="text-muted text-decoration-none hover-text-warning"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
        @endif
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible bg-dark border-success text-success fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-5">
        <!-- Image Section -->
        <div class="col-lg-5">
            <div class="product-img-container p-3 p-lg-4 d-flex align-items-center justify-content-center">
                <img src="{{ url('') }}/images/{{ $detail->gambar }}" alt="{{ $detail->nama_alat }}" class="img-fluid rounded">
            </div>
        </div>

        <!-- Detail Section -->
        <div class="col-lg-7">
            <div class="d-flex align-items-center mb-2 gap-3">
                <span class="badge bg-warning text-dark text-uppercase tracking-wide px-3 py-2"><i class="fas fa-tag me-1"></i> {{ $detail->category->nama_kategori }}</span>
                <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2"><i class="fas fa-check-circle me-1"></i> Tersedia</span>
            </div>
            
            <h1 class="display-5 fw-bold text-white mb-4">{{ $detail->nama_alat }}</h1>
            
            <div class="p-4 rounded mb-4" style="background: var(--surface-hover); border-left: 4px solid var(--primary-color);">
                <h5 class="fw-bold mb-2">Deskripsi Alat</h5>
                <p class="text-muted mb-0" style="line-height: 1.8;">{{ $detail->deskripsi }}</p>
            </div>

            <!-- Rent Options -->
            <div class="mb-5">
                <h5 class="fw-bold mb-3 d-flex align-items-center"><i class="far fa-clock text-warning me-2"></i> Pilih Durasi Sewa</h5>
                @if (Auth::check() && Auth::user()->role == 0)
                    <form action="{{ route('cart.store',['id' => $detail->id, 'userId' => Auth::user()->id]) }}" method="POST">
                        @csrf
                        <div class="row g-3 mb-4">
                            <!-- 24 Hours -->
                            <div class="col-sm-4">
                                <button type="submit" name="btn" value="24" class="btn p-0 w-100 text-start text-white">
                                    <div class="price-card p-3 text-center h-100">
                                        <div class="text-muted small mb-1">24 Jam</div>
                                        <div class="fs-4 fw-bold text-warning mb-2">@money($detail->harga24)</div>
                                        <div class="btn btn-sm btn-outline-warning rounded-pill w-100"><i class="fas fa-shopping-cart"></i> Pilih</div>
                                    </div>
                                </button>
                            </div>
                            <!-- 12 Hours -->
                            <div class="col-sm-4">
                                <button type="submit" name="btn" value="12" class="btn p-0 w-100 text-start text-white">
                                    <div class="price-card p-3 text-center h-100">
                                        <div class="text-muted small mb-1">12 Jam</div>
                                        <div class="fs-4 fw-bold text-warning mb-2">@money($detail->harga12)</div>
                                        <div class="btn btn-sm btn-outline-warning rounded-pill w-100"><i class="fas fa-shopping-cart"></i> Pilih</div>
                                    </div>
                                </button>
                            </div>
                            <!-- 6 Hours -->
                            <div class="col-sm-4">
                                <button type="submit" name="btn" value="6" class="btn p-0 w-100 text-start text-white">
                                    <div class="price-card p-3 text-center h-100">
                                        <div class="text-muted small mb-1">6 Jam</div>
                                        <div class="fs-4 fw-bold text-warning mb-2">@money($detail->harga6)</div>
                                        <div class="btn btn-sm btn-outline-warning rounded-pill w-100"><i class="fas fa-shopping-cart"></i> Pilih</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="row g-3 mb-4">
                        <div class="col-sm-4">
                            <div class="price-card p-3 text-center">
                                <div class="text-muted small mb-1">24 Jam</div>
                                <div class="fs-4 fw-bold text-white mb-2">@money($detail->harga24)</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="price-card p-3 text-center">
                                <div class="text-muted small mb-1">12 Jam</div>
                                <div class="fs-4 fw-bold text-white mb-2">@money($detail->harga12)</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="price-card p-3 text-center">
                                <div class="text-muted small mb-1">6 Jam</div>
                                <div class="fs-4 fw-bold text-white mb-2">@money($detail->harga6)</div>
                            </div>
                        </div>
                    </div>
                    <div class="alert bg-dark border-secondary text-muted d-flex align-items-center">
                        <i class="fas fa-lock text-warning me-3 fs-3"></i>
                        <div>Anda harus <b><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-warning text-decoration-none">Login</a></b> sebagai member untuk melakukan penyewaan alat ini secara online.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Available Schedules -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card card-luxury border-0">
                <div class="card-header border-0 bg-transparent pt-4 pb-0">
                    <h4 class="fw-bold mb-0 d-flex align-items-center"><i class="far fa-calendar-alt text-warning me-2"></i> Jadwal Ketersediaan</h4>
                </div>
                <div class="card-body">
                    <div id="calendar" class="text-dark bg-white rounded p-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="/js/fullcalendar/main.js"></script>
<script type="text/javascript">
    var endpoint = "/api/kalender-alat/";
    var param = {!! $detail->id !!};
    var withParam = endpoint+param;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 600,
            selectable: true,
            navLinks: true,
            eventSources: [{ url: withParam, color: '#d4af37', textColor: '#000' }],
            eventTimeFormat: { hour: 'numeric', minute: '2-digit', hour12: false },
            headerToolbar: { left: 'dayGridMonth,timeGridDay', center: 'title' }
        });
        calendar.render();
    });
</script>
@endpush
