<div class="col">
    <div class="card card-luxury h-100 border-0 bg-dark shadow-sm">
        <a href="{{ route('home.detail',['id' => $item->id]) }}" class="text-decoration-none">
            <div class="position-relative overflow-hidden" style="height: {{ $compact ? '160px' : '220px' }}; border-radius: var(--radius-lg) var(--radius-lg) 0 0;">
                <img class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s;" src="{{ url('') }}/images/{{ $item->gambar }}" alt="{{ $item->nama_alat }}">
                @if($item->category)
                <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 px-3 py-2 rounded-pill shadow-sm text-uppercase fw-bold"><i class="fas fa-tag me-1"></i> {{ $item->category->nama_kategori }}</span>
                @endif
            </div>
        </a>
        <div class="card-body d-flex flex-column">
            <a href="{{ route('home.detail',['id' => $item->id]) }}" class="text-decoration-none text-white">
                <h6 class="card-title fw-bold text-break mb-3" style="line-height: 1.3;">{{ $item->nama_alat }}</h6>
            </a>
            @if (!$compact)
            <p class="text-muted small mb-3" style="min-height: 2em;">{{ Str::limit($item->deskripsi, 45) }}</p>
            @endif
            
            <div class="mt-auto">
                <div class="d-flex justify-content-between align-items-center small py-1 border-bottom border-secondary border-opacity-25">
                    <span class="text-muted">24 jam</span>
                    <span class="fw-bold text-warning">@money($item->harga24)</span>
                </div>
                <div class="d-flex justify-content-between align-items-center small py-1 border-bottom border-secondary border-opacity-25">
                    <span class="text-muted">12 jam</span>
                    <span class="fw-bold text-warning">@money($item->harga12)</span>
                </div>
                <div class="d-flex justify-content-between align-items-center small py-1 mb-3">
                    <span class="text-muted">6 jam</span>
                    <span class="fw-bold text-warning">@money($item->harga6)</span>
                </div>
                <form action="{{ route('cart.store',['id' => $item->id, 'userId' => Auth::user()->id]) }}" method="POST" class="mt-2">
                    @csrf
                    <div class="dropdown d-grid">
                        <button class="btn btn-luxury-outline rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus me-1"></i> {{ $compact ? 'Sewa' : 'Tambah ke Keranjang' }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark w-100 shadow-lg border-secondary">
                            <li><button type="submit" class="dropdown-item py-2" name="btn" value="24"><i class="far fa-clock text-warning me-2"></i> @money($item->harga24) / 24 jam</button></li>
                            <li><button type="submit" class="dropdown-item py-2" name="btn" value="12"><i class="far fa-clock text-warning me-2"></i> @money($item->harga12) / 12 jam</button></li>
                            <li><button type="submit" class="dropdown-item py-2" name="btn" value="6"><i class="far fa-clock text-warning me-2"></i> @money($item->harga6) / 6 jam</button></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
