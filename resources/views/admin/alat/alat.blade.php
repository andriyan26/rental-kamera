@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-white mb-1"><i class="fas fa-camera text-warning me-2"></i> Manajemen Alat</h3>
            <p class="text-muted small">Kelola penambahan, pengeditan, atau penghapusan inventaris alat.</p>
        </div>
        <button type="button" class="btn btn-luxury px-4 py-2 fw-bold text-uppercase tracking-wide shadow-lg" data-bs-toggle="modal" data-bs-target="#tambahAlat">
            <i class="fas fa-plus-circle me-1"></i> Tambah Alat
        </button>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success bg-dark border-success text-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2 fs-5"></i>
        <span>{{ session('message') }}</span>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card card-luxury border-0 shadow-sm mb-4">
        <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center flex-wrap gap-3">
            <form action="" method="GET" class="d-flex w-100" style="max-width: 400px;">
                <div class="input-group">
                    <input type="text" class="form-control form-luxury bg-dark border-secondary text-white" placeholder="Cari Nama Alat..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-warning text-dark" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            
            <div class="dropdown">
                <button class="btn btn-luxury-outline dropdown-toggle" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-1"></i> Filter Kategori
                </button>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('alat.index') }}">Semua Kategori</a></li>
                    <li><hr class="dropdown-divider border-secondary"></li>
                    @foreach ($categories as $cat)
                    <li><a class="dropdown-item" href="{{ route('alat.index', ['id' => $cat->id]) }}">{{ $cat->nama_kategori }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card-body p-4 bg-transparent">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
                @forelse ($alats as $alat)
                <div class="col">
                    <div class="card card-luxury h-100 border-0 shadow-sm bg-dark">
                        <div class="position-relative overflow-hidden" style="height: 180px; border-radius: var(--radius-lg) var(--radius-lg) 0 0;">
                            <img class="w-100 h-100" style="object-fit: cover;" src="{{ url('') }}/images/{{ $alat->gambar }}" alt="{{ $alat->nama_alat }}">
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 px-3 py-1 rounded-pill shadow-sm fw-bold"><i class="fas fa-tag me-1"></i> {{ $alat->category->nama_kategori }}</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold text-white mb-3" style="line-height: 1.3;">{{ $alat->nama_alat }}</h6>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center small py-1 border-bottom border-secondary border-opacity-25">
                                    <span class="text-muted">24 Jam</span>
                                    <span class="fw-bold text-warning">@money($alat->harga24)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center small py-1 border-bottom border-secondary border-opacity-25">
                                    <span class="text-muted">12 Jam</span>
                                    <span class="fw-bold text-warning">@money($alat->harga12)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center small py-1 mb-3">
                                    <span class="text-muted">6 Jam</span>
                                    <span class="fw-bold text-warning">@money($alat->harga6)</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                            <a href="{{ route('alat.edit',['id' => $alat->id]) }}" class="btn btn-outline-warning w-100 rounded-pill"><i class="fas fa-edit me-1"></i> Edit Alat</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 py-5 text-center w-100">
                    <div class="mb-4 text-muted"><i class="fas fa-camera-slash" style="font-size: 4rem;"></i></div>
                    <h5 class="text-white fw-bold">Alat Tidak Ditemukan</h5>
                    <p class="text-muted">Silakan tambah alat baru atau ubah pencarian.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Alat -->
<div class="modal fade" id="tambahAlat" tabindex="-1" aria-labelledby="tambahAlatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content card-luxury border-warning">
        <div class="modal-header border-secondary bg-dark">
          <h5 class="modal-title fw-bold text-white text-uppercase tracking-wide" id="tambahAlatLabel"><i class="fas fa-plus-circle text-warning me-2"></i> Tambah Alat Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-dark p-4">
            <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label class="form-label text-white small fw-bold">Nama Alat <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control form-luxury bg-transparent border-secondary text-white" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label text-white small fw-bold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select form-luxury bg-dark border-secondary text-white" name="kategori" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white small fw-bold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control form-luxury bg-transparent border-secondary text-white" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="p-3 border border-secondary rounded mb-3" style="background: var(--surface-hover);">
                    <label class="form-label text-warning small fw-bold mb-2"><i class="fas fa-tags me-1"></i> Harga Sewa (Hanya Angka) <span class="text-danger">*</span></label>
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <label class="text-muted small mb-1">24 Jam</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted border-end-0">Rp</span>
                                <input type="number" name="harga24" class="form-control form-luxury bg-transparent border-secondary border-start-0 text-white" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="text-muted small mb-1">12 Jam</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted border-end-0">Rp</span>
                                <input type="number" name="harga12" class="form-control form-luxury bg-transparent border-secondary border-start-0 text-white" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="text-muted small mb-1">6 Jam</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted border-end-0">Rp</span>
                                <input type="number" name="harga6" class="form-control form-luxury bg-transparent border-secondary border-start-0 text-white" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold">Foto Alat <span class="text-danger">*</span></label>
                    <input type="file" name="gambar" class="form-control form-luxury bg-dark border-secondary text-white" accept="image/*" required>
                    <div class="form-text text-muted small mt-1">Format gambar: JPG, PNG, WEBP (Max: 2MB). Disarankan rasio kotak (1:1).</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-luxury px-4 fw-bold shadow-lg"><i class="fas fa-save me-1"></i> Simpan Alat</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
