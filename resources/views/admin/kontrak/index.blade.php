@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold text-white mb-1"><i class="fas fa-file-contract text-warning me-2"></i> Manajemen Kontrak Penyewa</h3>
            <p class="text-muted small">Edit kontrak sewa-menyewa untuk setiap pelanggan terdaftar.</p>
        </div>
    </div>

    <div class="card card-luxury border-0 shadow-sm mb-5">
        <div class="card-header bg-transparent pt-4 pb-3 border-secondary">
            <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-users text-warning me-2"></i> Daftar Pelanggan &amp; Kontrak</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive p-4">
                <table id="dataTable" class="table table-luxury table-borderless table-hover align-middle mb-0">
                    <thead class="bg-dark text-muted small">
                        <tr>
                            <th class="ps-3">Pelanggan</th>
                            <th>Email</th>
                            <th class="text-center">Status Kontrak</th>
                            <th class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penyewa as $user)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=d4af37&color=000&size=36" alt="Avatar" class="rounded-circle" width="36" height="36">
                                    <div>
                                        <div class="fw-bold text-white">{{ $user->name }}</div>
                                        <div class="text-muted small">ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td class="text-center">
                                @if ($user->loanContract)
                                    <span class="badge bg-success text-white rounded-pill px-3 py-2 shadow-sm"><i class="fas fa-check-circle me-1"></i> Kontrak Tersedia</span>
                                @else
                                    <span class="badge bg-secondary text-white rounded-pill px-3 py-2"><i class="fas fa-clock me-1"></i> Belum Dibuat</span>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <a href="{{ route('admin.kontrak.edit', $user) }}" class="btn btn-luxury btn-sm rounded-pill px-3 fw-bold shadow">
                                    <i class="fas fa-edit me-1"></i> Edit Kontrak
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-users-slash" style="font-size: 2.5rem;"></i>
                                <p class="mt-2">Belum ada pelanggan terdaftar.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
