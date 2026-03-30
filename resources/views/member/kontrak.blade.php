@extends('member.main')
@section('container')

<div class="mb-4 d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h3 class="fw-bold text-white mb-1"><i class="fas fa-file-contract text-warning me-2"></i> Kontrak Kerjasama Penyewaan</h3>
        <p class="text-muted small mb-0">Dokumen resmi yang mengatur hak &amp; kewajiban antara Anda dan Rental Kamera Premium. <br>Halaman ini <strong class="text-white">hanya untuk dibaca</strong> — perubahan dilakukan oleh Admin.</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-warning rounded-pill px-3 btn-sm fw-bold" onclick="window.print()">
            <i class="fas fa-print me-1"></i> Cetak / PDF
        </button>
    </div>
</div>

<!-- Contract Document Card -->
<div class="card border-0 shadow-lg mb-4" style="background: var(--surface-color); border: 1px solid var(--border-color) !important;">
    <!-- Card Header: Decorative Gold Bar -->
    <div style="height: 4px; background: linear-gradient(90deg, #d4af37, #f5e19e, #d4af37); border-radius: var(--radius-lg) var(--radius-lg) 0 0;"></div>
    
    <div class="card-header bg-transparent py-4 border-secondary d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle border border-warning" style="width: 48px; height: 48px;">
                <i class="fas fa-scroll text-warning fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold text-white mb-0 tracking-wide text-uppercase">Perjanjian Sewa Menyewa Peralatan Fotografi</h6>
                <div class="small text-muted mt-1">
                    <i class="fas fa-user me-1 text-warning"></i> {{ $user->name }} &nbsp;|&nbsp;
                    <i class="far fa-envelope me-1 text-warning"></i> {{ $user->email }} &nbsp;|&nbsp;
                    <i class="far fa-calendar-alt me-1 text-warning"></i> Berlaku sejak pendaftaran akun
                </div>
            </div>
        </div>
        <span class="badge bg-success text-white px-3 py-2 rounded-pill d-none d-md-inline-flex align-items-center gap-1">
            <i class="fas fa-shield-alt"></i> Sah Secara Elektronik
        </span>
    </div>

    <!-- Actual Contract Content -->
    <div class="card-body p-4 p-lg-5">
        <div class="contract-readonly" style="
            background: #fff;
            color: #1a1a2e;
            border-radius: 12px;
            padding: 40px 48px;
            font-family: 'Times New Roman', Georgia, serif;
            font-size: 14px;
            line-height: 1.8;
            box-shadow: inset 0 0 0 1px rgba(212,175,55,0.3);
        ">
            @if ($contract->contract_text)
                {!! $contract->contract_text !!}
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-file-times" style="font-size: 3rem;"></i>
                    <p class="mt-3">Kontrak belum tersedia. Silakan hubungi Admin.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Info Footer -->
    <div class="card-footer bg-transparent border-top border-secondary py-3 px-5 d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <div class="text-muted small">
            <i class="fas fa-info-circle text-warning me-1"></i>
            Dengan melakukan pemesanan, Anda dianggap telah membaca dan menyetujui seluruh isi kontrak ini.
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-warning rounded-pill px-4 py-2 btn-sm fw-bold" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style media="print">
    .sb-topnav, #layoutSidenav_nav, .card-footer { display: none !important; }
    #layoutSidenav_content { margin: 0 !important; padding: 0 !important; }
    .card { border: none !important; box-shadow: none !important; }
    .card-header { border: none !important; }
    .contract-readonly {
        padding: 20px !important;
        box-shadow: none !important;
        font-size: 13px !important;
    }
    body { background: #fff !important; }
</style>

@endsection
