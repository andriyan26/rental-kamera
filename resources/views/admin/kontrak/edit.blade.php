@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div>
            <a href="{{ route('admin.kontrak.index') }}" class="btn btn-outline-light rounded-pill btn-sm mb-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <h3 class="fw-bold text-white mb-0"><i class="fas fa-file-contract text-warning me-2"></i> Edit Kontrak — {{ $targetUser->name }}</h3>
            <p class="text-muted small mb-0"><i class="far fa-envelope text-warning me-1"></i> {{ $targetUser->email }}</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($targetUser->name) }}&background=d4af37&color=000&size=60" alt="Avatar" class="rounded-circle border border-warning border-2 p-1 shadow">
        </div>
    </div>

    @if (session('success'))
        <div class="alert bg-dark border-success text-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle fs-5"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert bg-dark border-danger text-danger alert-dismissible fade show d-flex flex-column gap-1 mb-4" role="alert">
            <div class="fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Kontrak tidak valid:</div>
            <ul class="mb-0 ps-3">@foreach ($errors->all() as $e)<li class="small">{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close btn-close-white ms-auto mt-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Info Panel -->
        <div class="col-lg-4">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary fw-bold text-uppercase tracking-wide">
                    <i class="fas fa-info-circle text-warning me-2"></i> Panduan Edit Kontrak
                </div>
                <div class="card-body">
                    <div class="p-3 rounded mb-3" style="background: rgba(212,175,55,0.08); border: 1px solid rgba(212,175,55,0.2);">
                        <p class="text-warning fw-bold small mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Ketentuan Wajib</p>
                        <p class="text-muted small mb-0">Isi kontrak <strong class="text-white">wajib</strong> mengandung kata: <code class="text-warning">denda</code>, <code class="text-warning">terlambat</code>, dan <code class="text-warning">pembayaran</code>. Sistem akan menolak jika salah satu tidak ada.</p>
                    </div>

                    <ul class="list-unstyled text-muted small">
                        <li class="mb-2"><i class="fas fa-code text-warning me-2"></i> HTML diperbolehkan (<code>&lt;b&gt;</code>, <code>&lt;ol&gt;</code>, <code>&lt;table&gt;</code>, dll)</li>
                        <li class="mb-2"><i class="fas fa-eye text-warning me-2"></i> Pelanggan akan melihat kontrak ini tepat seperti yang Anda tulis</li>
                        <li class="mb-2"><i class="fas fa-print text-warning me-2"></i> Pelanggan dapat mencetak/menyimpan kontrak sebagai PDF</li>
                        <li class="mb-2"><i class="fas fa-history text-warning me-2"></i> Kontrak baru akan langsung aktif setelah disimpan</li>
                    </ul>

                    <hr class="border-secondary">
                    <p class="text-muted small mb-0"><i class="fas fa-undo text-warning me-1"></i> Untuk reset ke teks default, kosongkan textarea lalu simpan, kemudian update kembali.</p>
                </div>
            </div>
        </div>

        <!-- Editor Panel -->
        <div class="col-lg-8">
            <div class="card card-luxury border-0 shadow-sm">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary fw-bold text-uppercase tracking-wide">
                    <i class="fas fa-edit text-warning me-2"></i> Isi Kontrak (HTML)
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.kontrak.update', $targetUser) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label text-white small fw-bold">Teks Kontrak <span class="text-danger">*</span></label>
                            <textarea 
                                name="contract_text" 
                                class="form-control font-monospace border-secondary text-white" 
                                rows="24" 
                                required
                                style="background: #0d1117; resize: vertical; font-size: 12px; line-height: 1.6;"
                            >{{ old('contract_text', $contract->contract_text) }}</textarea>
                            <div class="form-text text-muted small mt-2">
                                <i class="fas fa-lightbulb text-warning me-1"></i> 
                                Gunakan tag HTML untuk format teks. Contoh: <code class="text-warning">&lt;h4&gt;Judul&lt;/h4&gt;</code>, <code class="text-warning">&lt;strong&gt;tebal&lt;/strong&gt;</code>, <code class="text-warning">&lt;ol&gt;&lt;li&gt;item&lt;/li&gt;&lt;/ol&gt;</code>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 pt-2">
                            <a href="{{ route('admin.kontrak.index') }}" class="btn btn-outline-secondary px-4 fw-bold rounded-pill">Batal</a>
                            <button type="submit" class="btn btn-luxury px-5 fw-bold shadow-lg rounded-pill">
                                <i class="fas fa-save me-2"></i> Simpan Kontrak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
