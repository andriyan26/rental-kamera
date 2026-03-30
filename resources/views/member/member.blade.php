@extends('member.main')
@section('container')
@php $showKeranjang = request('view') == 'keranjang'; @endphp

@if (session()->has('success'))
<div class="alert alert-success bg-dark border-success text-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
    <i class="fas fa-check-circle me-2 fs-5"></i>
    <span>{{ session('success') }}</span>
    @if (!$showKeranjang)
        <a href="{{ route('member.index', ['view' => 'keranjang']) }}" class="text-success ms-2 fw-bold text-decoration-none">Lihat Keranjang <i class="fas fa-arrow-right small"></i></a>
    @endif
    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($showKeranjang)
<div class="mb-4">
    <h3 class="fw-bold text-white mb-2"><i class="fas fa-shopping-cart text-warning me-2"></i> Keranjang Sewa</h3>
    <p class="text-muted"><span class="badge bg-warning text-dark">{{ Auth::user()->cart->count() }} item</span> · Total Estimasi: <strong class="text-warning">@money($total)</strong></p>
</div>
@else
<div class="mb-4">
    <h3 class="fw-bold text-white mb-2"><i class="fas fa-layer-group text-warning me-2"></i> Katalog Eksklusif</h3>
    <p class="text-muted mb-1">Temukan armada kamera profesional sesuai kebutuhan kreatif Anda.</p>
</div>
@endif

@if (request()->get('search') != null)
<div class="mb-4 p-3 rounded" style="background: var(--surface-hover); border-left: 3px solid var(--primary-color);">
    <p class="text-muted mb-0">Menampilkan hasil untuk: <strong class="text-white">"{{ request()->get('search') }}"</strong>. 
    <a href="{{ route('member.index', $showKeranjang ? ['view' => 'keranjang'] : []) }}" class="text-warning text-decoration-none ms-2">Lihat Semua <i class="fas fa-undo small"></i></a></p>
</div>
@endif

<div class="row g-4">
    @if ($showKeranjang)
        {{-- Halaman Keranjang --}}
        <div class="col-lg-8 order-2 order-lg-1">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div class="d-flex overflow-auto gap-2 pb-2 pb-md-0" style="white-space: nowrap;">
                    <a class="btn {{ (request('kategori') == null) ? 'btn-luxury' : 'btn-luxury-outline' }} rounded-pill px-4" href="{{ route('member.index', ['view' => 'keranjang']) }}">Semua Alat</a>
                    @foreach ($kategori as $cat)
                        <a class="btn {{ (request('kategori') == $cat->id) ? 'btn-luxury' : 'btn-luxury-outline' }} rounded-pill px-4" href="{{ route('member.index', ['view' => 'keranjang', 'kategori' => $cat->id]) }}">{{ $cat->nama_kategori }}</a>
                    @endforeach
                </div>
                <form action="{{ route('member.index') }}" method="GET" class="d-flex" style="min-width: 250px;">
                    <input type="hidden" name="view" value="keranjang">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <div class="input-group">
                        <input type="text" class="form-control form-luxury bg-dark border-secondary text-white" placeholder="Cari di keranjang..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-warning text-dark" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse ($alat as $item)
                    @include('member.partials.product-card', ['item' => $item, 'compact' => true])
                @empty
                    <div class="col-12 py-5 text-center">
                        <i class="fas fa-boxes text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-white">Tidak ada alat di keranjang untuk kategori ini.</h5>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="col-lg-4 order-1 order-lg-2">
            <div class="card card-luxury sticky-top" style="top: 90px;">
                <div class="card-header bg-transparent border-bottom border-secondary pt-4 pb-3">
                    <h5 class="mb-0 fw-bold d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-clipboard-list text-warning me-2"></i> Ringkasan</span>
                        <span class="badge bg-warning text-dark rounded-pill shadow-sm">{{ Auth::user()->cart->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div style="max-height: 400px; overflow-y: auto;" class="p-3">
                        @forelse ($carts as $item)
                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary border-opacity-25">
                            <div class="flex-grow-1 pe-3">
                                <h6 class="mb-1 text-white fw-bold lh-sm">{{ $item->alat->nama_alat }}</h6>
                                <div class="text-muted small"><i class="far fa-clock text-warning"></i> {{ $item->durasi }} Jam &nbsp;&bull;&nbsp; <strong class="text-warning">@money($item->harga)</strong></div>
                            </div>
                            <form action="{{ route('cart.destroy',['id' => $item->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" style="width: 32px; height: 32px; padding:0;" type="submit" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <div class="bg-dark rounded-circle d-inline-flex justify-content-center align-items-center mb-3 border border-secondary" style="width: 60px; height: 60px;">
                                <i class="fas fa-shopping-cart fa-lg text-muted"></i>
                            </div>
                            <p class="text-muted mb-0">Keranjang masih kosong</p>
                            <a href="{{ route('member.index') }}" class="btn btn-luxury-outline btn-sm rounded-pill mt-3 px-3">Eksplor Katalog <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                @if (Auth::user()->cart->count() > 0)
                <div class="card-footer bg-transparent border-top border-secondary p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted fw-semibold text-uppercase tracking-wide small">Total Pembayaran</span>
                        <span class="h4 fw-bold text-warning mb-0">@money($total)</span>
                    </div>
                    
                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <div class="p-3 rounded mb-4" style="background: var(--surface-hover); border: 1px solid var(--border-color);">
                            <h6 class="fw-bold text-white mb-3 border-bottom border-secondary pb-2"><i class="far fa-calendar-check text-warning me-1"></i> Jadwal Pengambilan</h6>
                            <div class="mb-3">
                                <label class="form-label small text-muted">Tanggal</label>
                                <input type="date" name="start_date" class="form-control form-luxury bg-dark border-secondary text-white" required>
                            </div>
                            <div>
                                <label class="form-label small text-muted">Waktu (Jam)</label>
                                <input type="time" name="start_time" class="form-control form-luxury bg-dark border-secondary text-white" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-luxury w-100 py-3 fw-bold text-uppercase tracking-wide shadow-lg">
                            <i class="fas fa-lock me-2"></i> Checkout Aman
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    @else
        {{-- Halaman Explore --}}
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div class="d-flex overflow-auto gap-2 pb-2 pb-md-0" style="white-space: nowrap;">
                    <a class="btn {{ (request('kategori') == null) ? 'btn-luxury' : 'btn-luxury-outline' }} rounded-pill px-4" href="{{ route('member.index') }}">Semua Kategori</a>
                    @foreach ($kategori as $cat)
                        <a class="btn {{ (request('kategori') == $cat->id) ? 'btn-luxury' : 'btn-luxury-outline' }} rounded-pill px-4" href="{{ route('member.index', ['kategori' => $cat->id]) }}">{{ $cat->nama_kategori }}</a>
                    @endforeach
                </div>
                <form action="{{ route('member.index') }}" method="GET" class="d-flex" style="min-width: 250px;">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <div class="input-group">
                        <input type="text" class="form-control form-luxury bg-dark border-secondary text-white" placeholder="Cari perlengkapan..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-warning text-dark" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
                @forelse ($alat as $item)
                    @include('member.partials.product-card', ['item' => $item, 'compact' => false])
                @empty
                    <div class="col-12 py-5 text-center w-100">
                        <div class="mb-4 text-muted"><i class="fas fa-folder-open" style="font-size: 4rem;"></i></div>
                        <h4 class="text-white fw-bold">Alat Tidak Ditemukan</h4>
                        <p class="text-muted">Kategori atau kata kunci yang Anda cari tidak tersedia.</p>
                    </div>
                @endforelse
            </div>

            @if(Auth::user()->cart->count() > 0)
            <div class="text-center mt-5">
                <a href="{{ route('member.index', ['view' => 'keranjang']) }}" class="btn btn-luxury-outline rounded-pill px-4 py-2">
                    <i class="fas fa-shopping-cart me-2"></i> Lanjutkan ke Keranjang ({{ Auth::user()->cart->count() }}) <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            @endif
        </div>
    @endif
</div>
@endsection
