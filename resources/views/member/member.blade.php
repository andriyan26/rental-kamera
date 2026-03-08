@extends('member.main')
@section('container')
@php $showKeranjang = request('view') == 'keranjang'; @endphp

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    <span>{{ session('success') }}</span>
    @if (!$showKeranjang)
        <a href="{{ route('member.index', ['view' => 'keranjang']) }}" class="alert-link ms-2 fw-semibold">Lihat Keranjang</a>
    @endif
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($showKeranjang)
<div class="member-page-header">
    <h4><i class="fas fa-shopping-cart me-2"></i>Keranjang Anda</h4>
    <p>{{ Auth::user()->cart->count() }} item · Total @money($total)</p>
</div>
@else
<div class="member-page-header">
    <h4><i class="fas fa-th-large me-2"></i>Explore Katalog</h4>
    <p>Temukan kamera & perlengkapan foto yang Anda butuhkan</p>
    <small class="d-block mt-1 opacity-75"><i class="fas fa-info-circle me-1"></i> Klik nama alat untuk melihat detail</small>
</div>
@endif

@if (request()->get('search') != null)
<p class="text-muted mb-3">Hasil pencarian <b>"{{ request()->get('search') }}"</b>. <a href="{{ route('member.index', $showKeranjang ? ['view' => 'keranjang'] : []) }}" class="text-decoration-none">Tampilkan semua</a></p>
@endif

<div class="row">
    @if ($showKeranjang)
        {{-- Halaman Keranjang --}}
        <div class="col-lg-8 col-12 order-2 order-lg-1">
            <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                <div class="filter-pills d-flex flex-wrap gap-2">
                    <a class="btn {{ (request('kategori') == null) ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('member.index', ['view' => 'keranjang']) }}">Semua</a>
                    @foreach ($kategori as $cat)
                        <a class="btn {{ (request('kategori') == $cat->id) ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('member.index', ['view' => 'keranjang', 'kategori' => $cat->id]) }}">{{ $cat->nama_kategori }}</a>
                    @endforeach
                </div>
                <form action="{{ route('member.index') }}" method="GET" class="member-search d-flex">
                    <input type="hidden" name="view" value="keranjang">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="text" class="form-control" placeholder="Cari alat..." name="search" value="{{ request('search') }}" style="min-width: 200px;">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        @foreach ($alat as $item)
                        @include('member.partials.product-card', ['item' => $item, 'compact' => true])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 order-1 order-lg-2 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm sticky-top" id="keranjang">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-shopping-bag me-2"></i>Keranjang</h6>
                    <span class="badge bg-primary rounded-pill">{{ Auth::user()->cart->count() }}</span>
                </div>
                <div class="card-body">
                    @forelse ($carts as $item)
                    <div class="d-flex justify-content-between align-items-start py-3 border-bottom">
                        <div class="flex-grow-1 pe-2">
                            <h6 class="mb-0 text-break">{{ $item->alat->nama_alat }}</h6>
                            <small class="text-muted">{{ $item->durasi }} Jam · @money($item->harga)</small>
                        </div>
                        <form action="{{ route('cart.destroy',['id' => $item->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Keranjang kosong</p>
                        <a href="{{ route('member.index') }}" class="btn btn-sm btn-outline-primary mt-2">Tambah dari Explore</a>
                    </div>
                    @endforelse
                </div>
                @if (Auth::user()->cart->count() > 0)
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">Total</span>
                        <span class="h5 mb-0 text-primary">@money($total)</span>
                    </div>
                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label small fw-semibold">Tanggal Pengambilan</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Jam Pengambilan</label>
                            <input type="time" name="start_time" class="form-control form-control-sm" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            <i class="fas fa-credit-card me-1"></i> Checkout
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    @else
        {{-- Halaman Explore --}}
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <div class="filter-pills d-flex flex-wrap gap-2">
                    <a class="btn {{ (request('kategori') == null) ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('member.index') }}">Semua</a>
                    @foreach ($kategori as $cat)
                        <a class="btn {{ (request('kategori') == $cat->id) ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('member.index', ['kategori' => $cat->id]) }}">{{ $cat->nama_kategori }}</a>
                    @endforeach
                </div>
                <form action="{{ route('member.index') }}" method="GET" class="member-search d-flex">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="text" class="form-control" placeholder="Cari alat..." name="search" value="{{ request('search') }}" style="min-width: 220px;">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Cari</button>
                </form>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                        @foreach ($alat as $item)
                        @include('member.partials.product-card', ['item' => $item, 'compact' => false])
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 py-3">
                <a href="{{ route('member.index', ['view' => 'keranjang']) }}" class="btn btn-outline-primary px-4">
                    <i class="fas fa-shopping-cart me-2"></i>Lihat Keranjang ({{ Auth::user()->cart->count() }})
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
