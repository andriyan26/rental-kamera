@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold text-white mb-1"><i class="fas fa-file-invoice-dollar text-warning me-2"></i> Data Reservasi</h3>
        <p class="text-muted small">Kelola seluruh transaksi dan reservasi penyewaan alat.</p>
    </div>

    <!-- Tabel Data Reservasi -->
    <div class="card card-luxury border-0 shadow-sm mb-5">
        <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-list text-warning me-2"></i> Daftar Transaksi Berjalan</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive p-4">
                <table id="dataTable" class="table table-luxury table-borderless table-hover align-middle mb-0">
                    <thead class="bg-dark text-muted small">
                        <tr>
                            <th class="ps-3">No. Invoice & Status</th>
                            <th>Tanggal Reservasi</th>
                            <th>Detail Pelanggan</th>
                            <th>Total Tagihan</th>
                            <th class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyewaan as $item)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-white mb-1">#{{ $item->no_invoice }}</div>
                                    @if ($item->status == 1)
                                        <span class="badge bg-warning text-dark rounded-pill px-3 shadow-sm"><i class="fas fa-search me-1"></i> Perlu Ditinjau</span>
                                    @elseif ($item->status == 2)
                                        <span class="badge bg-danger text-white rounded-pill px-3 shadow-sm"><i class="fas fa-exclamation-circle me-1"></i> Belum Bayar</span>
                                    @elseif ($item->status == 3)
                                        <span class="badge bg-success text-white rounded-pill px-3 shadow-sm"><i class="fas fa-check-circle me-1"></i> Sudah Bayar</span>
                                    @elseif ($item->status == 4)
                                        <span class="badge bg-secondary text-white rounded-pill px-3 shadow-sm"><i class="fas fa-flag-checkered me-1"></i> Selesai</span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    <div class="fw-semibold text-white">{{ date('d M Y', strtotime($item->created_at)) }}</div>
                                    <div class="small">{{ date('H:i', strtotime($item->created_at)) }} WIB</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-white">{{ $item->user->name }}</div>
                                    <div class="text-muted small"><i class="far fa-envelope text-warning me-1"></i> {{ $item->user->email }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-warning">@money($item->total)</div>
                                    <div class="small text-muted"><span class="badge bg-dark border border-secondary text-muted rounded-pill mt-1">{{ $item->order->count() }} Item Alat</span></div>
                                </td>
                                <td class="text-center pe-3">
                                    <a href="{{ route('penyewaan.detail',['id' => $item->id]) }}" class="btn btn-luxury-outline btn-sm rounded-pill px-3 position-relative">
                                        Lihat Detail
                                        @if ($item->bukti != null && $item->status != 4 && $item->status != 3)
                                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-dark rounded-circle shadow">
                                            <span class="visually-hidden">menunggu konfirmasi</span>
                                        </span>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kalender Reservasi -->
    <div class="card card-luxury border-0 shadow-sm mb-4">
        <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="far fa-calendar-alt text-warning me-2"></i> Kalender Ketersediaan Semua Alat</h6>
        </div>
        <div class="card-body p-4 bg-white rounded-bottom" style="border-radius: 0 0 var(--radius-lg) var(--radius-lg);">
            @include('partials.kalender')
        </div>
    </div>
</div>
@endsection
