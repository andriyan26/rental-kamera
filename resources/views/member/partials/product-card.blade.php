<div class="col">
    <div class="card product-card h-100 border">
        <a href="{{ route('home.detail',['id' => $item->id]) }}" class="text-decoration-none text-dark">
            <div class="position-relative overflow-hidden">
                <img class="card-img-top" src="{{ url('') }}/images/{{ $item->gambar }}" style="height: {{ $compact ? '160px' : '220px' }}; object-fit: cover;" alt="{{ $item->nama_alat }}">
                @if($item->category)
                <span class="badge position-absolute top-0 start-0 m-2">{{ $item->category->nama_kategori }}</span>
                @endif
            </div>
        </a>
        <div class="card-body">
            <a href="{{ route('home.detail',['id' => $item->id]) }}" class="text-decoration-none text-dark">
                <h6 class="card-title text-break mb-2">{{ $item->nama_alat }}</h6>
            </a>
            @if (!$compact)
            <p class="text-muted small mb-2" style="min-height: 2em;">{{ Str::limit($item->deskripsi, 45) }}</p>
            @endif
            <div class="d-flex justify-content-between align-items-center small mb-1">
                <span class="text-muted">24 jam</span>
                <span class="fw-semibold">@money($item->harga24)</span>
            </div>
            <div class="d-flex justify-content-between align-items-center small mb-1">
                <span class="text-muted">12 jam</span>
                <span class="fw-semibold">@money($item->harga12)</span>
            </div>
            <div class="d-flex justify-content-between align-items-center small">
                <span class="text-muted">6 jam</span>
                <span class="fw-semibold">@money($item->harga6)</span>
            </div>
        </div>
        <div class="card-footer bg-transparent border-0 pt-0">
            <form action="{{ route('cart.store',['id' => $item->id, 'userId' => Auth::user()->id]) }}" method="POST">
                @csrf
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-plus me-1"></i> {{ $compact ? 'Tambah' : 'Tambah ke Keranjang' }}
                    </button>
                    <ul class="dropdown-menu w-100">
                        <li><button type="submit" class="dropdown-item" name="btn" value="24"><i class="fas fa-clock me-2"></i> @money($item->harga24) / 24 jam</button></li>
                        <li><button type="submit" class="dropdown-item" name="btn" value="12"><i class="fas fa-clock me-2"></i> @money($item->harga12) / 12 jam</button></li>
                        <li><button type="submit" class="dropdown-item" name="btn" value="6"><i class="fas fa-clock me-2"></i> @money($item->harga6) / 6 jam</button></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>
