@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-white mb-1"><i class="fas fa-users text-warning me-2"></i> Manajemen Pelanggan</h3>
            <p class="text-muted small">Kelola data pelanggan dan buat reservasi manual.</p>
        </div>
        <button type="button" class="btn btn-luxury px-4 py-2 fw-bold text-uppercase tracking-wide shadow-lg" data-bs-toggle="modal" data-bs-target="#addNewUser">
            <i class="fas fa-user-plus me-1"></i> Tambah Pelanggan
        </button>
    </div>

    <!-- Tabel Data Pelanggan -->
    <div class="card card-luxury border-0 shadow-sm mb-5">
        <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-address-book text-warning me-2"></i> Daftar Penyewa / Pelanggan Aktif</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive p-4">
                <table id="dataTable" class="table table-luxury table-borderless table-hover align-middle mb-0">
                    <thead class="bg-dark text-muted small">
                        <tr>
                            <th class="ps-3">No.</th>
                            <th>Informasi Pelanggan</th>
                            <th>Kontak</th>
                            <th class="text-center">KTP</th>
                            <th class="text-center pe-3">Aksi & Manajemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyewa as $item)
                        <tr>
                            <td class="ps-3 text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold text-white mb-1">{{ $item->name }}</div>
                                <span class="badge bg-secondary text-white rounded-pill shadow-sm"><i class="fas fa-shopping-bag me-1"></i> {{ $item->payment->count() }} Transaksi</span>
                            </td>
                            <td>
                                <div class="text-white"><i class="far fa-envelope text-warning me-2"></i> {{ $item->email }}</div>
                                <div class="text-muted small"><i class="fab fa-whatsapp text-success me-2 border-0"></i> {{ $item->telepon }}</div>
                            </td>
                            <td class="text-center">
                                @if ($item->ktp_path)
                                    <a href="{{ asset('storage/'.$item->ktp_path) }}" target="_blank" class="btn btn-sm btn-outline-warning rounded-pill" title="Lihat dokumen KTP">
                                        <i class="fas fa-id-card"></i> Lihat
                                    </a>
                                @else
                                    <span class="badge bg-dark border border-secondary text-muted rounded-pill px-3 py-2"><i class="fas fa-times-circle me-1"></i> Belum Upload</span>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-luxury btn-sm rounded-pill px-3 shadow" href="{{ route('admin.buatreservasi',['userId' => $item->id]) }}" title="Buat Reservasi Manual">
                                        <i class="fas fa-calendar-plus me-1"></i> Reservasi
                                    </a>
                                    <a class="btn btn-luxury-outline btn-sm rounded-pill px-3" href="{{ route('admin.kontrak.edit', $item) }}" title="Lihat/Edit Kontrak">
                                        <i class="fas fa-file-signature me-1"></i> Kontrak
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="addNewUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-luxury border-warning">
            <div class="modal-header border-secondary bg-dark">
                <h5 class="modal-title fw-bold text-white text-uppercase tracking-wide" id="addNewUserLabel"><i class="fas fa-user-plus text-warning me-2"></i> Pendaftaran Pelanggan Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-dark">
                <form action="{{ route('user.new') }}" method="POST">
                    @csrf
                    
                    <div class="p-3 mb-4 rounded border border-secondary" style="background: var(--surface-hover);">
                        <p class="small text-warning mb-0"><i class="fas fa-info-circle me-1"></i> Setelah didaftarkan, pelanggan dapat login ke aplikasi menggunakan email dan password yang Anda tentukan di bawah ini.</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control form-luxury bg-transparent border-secondary text-white" id="floatingName" placeholder="Nama" required>
                        <label for="floatingName" class="text-muted">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control form-luxury bg-transparent border-secondary text-white" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput" class="text-muted">Alamat Email</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="telepon" class="form-control form-luxury bg-transparent border-secondary text-white" id="floatingtelp" placeholder="Nomor Telepon" required>
                        <label for="floatingtelp" class="text-muted">No WhatsApp Aktif</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control form-luxury bg-transparent border-secondary text-white" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword" class="text-muted">Password Akun</label>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-luxury px-4 fw-bold shadow-lg"><i class="fas fa-save me-1"></i> Daftarkan Pelanggan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
