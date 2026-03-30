@extends('admin.main')
@section('content')
<div class="container-fluid px-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-white mb-1"><i class="fas fa-user-shield text-warning me-2"></i> Manajemen Akses Admin</h3>
            <p class="text-muted small">Kelola hak akses administrator dan superadmin.</p>
        </div>
        <button type="button" class="btn btn-luxury px-4 py-2 fw-bold text-uppercase tracking-wide shadow-lg" data-bs-toggle="modal" data-bs-target="#addNewUser">
            <i class="fas fa-plus-circle me-1"></i> Tambah User Baru
        </button>
    </div>

    <div class="row g-4">
        <!-- Tabel User Biasa -->
        <div class="col-xl-6">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex align-items-center">
                    <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-users text-warning me-2"></i> Daftar Pelanggan (User)</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-3">
                        <table id="dataTable" class="table table-luxury table-borderless table-hover align-middle mb-0">
                            <thead class="bg-dark text-muted small">
                                <tr>
                                    <th class="ps-3">Pengguna</th>
                                    <th>Kontak</th>
                                    <th class="text-center pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&background=d4af37&color=000&size=36" class="rounded-circle" width="32">
                                            <div>
                                                <div class="fw-bold text-white mb-0">{{ $item->name }}</div>
                                                <span class="badge bg-secondary text-white small px-2" style="font-size: 9px;">{{ $item->payment->count() }} Transaksi</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-white">{{ $item->email }}</div>
                                        <div class="small text-muted">{{ $item->telepon }}</div>
                                    </td>
                                    <td class="text-center pe-3">
                                        <form action="{{ route('user.promote', ['id' => $item->id]) }}" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" onclick="return confirm('Promosikan {{ $item->name }} menjadi Admin?')">
                                                <i class="fas fa-arrow-up me-1"></i> Promote
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Admin -->
        <div class="col-xl-6">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex align-items-center">
                    <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-shield-alt text-warning me-2"></i> Administrator Aktif</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-3">
                        <table class="table table-luxury table-borderless table-hover align-middle mb-0">
                            <thead class="bg-dark text-muted small">
                                <tr>
                                    <th class="ps-3">Admin</th>
                                    <th>Status</th>
                                    <th class="text-center pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $item)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&background=22c55e&color=fff&size=36" class="rounded-circle" width="32">
                                            <div>
                                                <div class="fw-bold text-white mb-0">{{ $item->name }}</div>
                                                <div class="small text-muted" style="font-size: 11px;">{{ $item->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success text-white px-3 py-2 rounded-pill small" style="font-size: 10px;">
                                            <i class="fas fa-check-circle me-1"></i> Active Admin
                                        </span>
                                    </td>
                                    <td class="text-center pe-3">
                                        @if ($item->id != Auth::user()->id && $item->role != 2)
                                            <form action="{{ route('user.demote',['id' => $item->id]) }}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="return confirm('Cabut hak akses admin {{ $item->name }}?')">
                                                    <i class="fas fa-arrow-down me-1"></i> Revoke
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small italic">Default Access</span>
                                        @endif
                                    </td>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-luxury border-warning">
            <div class="modal-header border-secondary bg-dark">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="exampleModalLabel"><i class="fas fa-user-plus text-warning me-2"></i> Pendaftaran User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-dark">
                <form action="{{ route('user.new') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-luxury text-white" placeholder="Masukkan nama..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Alamat Email</label>
                        <input type="email" name="email" class="form-control form-luxury text-white" placeholder="email@contoh.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Password Akun</label>
                        <input type="password" name="password" class="form-control form-luxury text-white" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small">Nomor Telepon/WA</label>
                        <input type="text" name="telepon" class="form-control form-luxury text-white" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="d-grid pt-2">
                        <button type="submit" class="btn btn-luxury py-2 fw-bold shadow-lg text-uppercase tracking-wide">
                            <i class="fas fa-save me-2"></i> Simpan User Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
