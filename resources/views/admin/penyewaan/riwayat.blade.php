@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold text-white mb-1"><i class="fas fa-history text-warning me-2"></i> Riwayat Reservasi</h3>
        <p class="text-muted small">Semua transaksi yang telah selesai &amp; alat sudah dikembalikan.</p>
    </div>

    <div class="alert bg-dark border-warning text-warning d-flex align-items-center gap-3 mb-4 p-3 rounded-3" role="alert">
        <i class="fas fa-info-circle fs-5"></i>
        <span class="small">Halaman ini menampilkan seluruh reservasi berstatus <strong>Selesai</strong> (alat sudah dikembalikan). Admin &amp; Superuser dapat mengunduh Invoice PDF dari setiap transaksi.</span>
    </div>

    <div class="card card-luxury border-0 shadow-sm mb-5">
        <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-uppercase tracking-wide"><i class="fas fa-flag-checkered text-warning me-2"></i> Daftar Reservasi Selesai</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive p-4">
                <table id="dataTable" class="table table-luxury table-borderless table-hover align-middle mb-0">
                    <thead class="bg-dark text-muted small">
                        <tr>
                            <th class="ps-3">No. Invoice</th>
                            <th>Tanggal Reservasi</th>
                            <th>Pelanggan</th>
                            <th>Total Tagihan</th>
                            <th class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyewaan as $item)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-white mb-1">#{{ $item->no_invoice }}</div>
                                    <span class="badge bg-secondary text-white rounded-pill px-3"><i class="fas fa-flag-checkered me-1"></i> Selesai</span>
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
                                    <div class="small text-muted"><span class="badge bg-dark border border-secondary text-muted rounded-pill mt-1">{{ $item->order->count() }} Item</span></div>
                                </td>
                                <td class="text-center pe-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('penyewaan.detail',['id' => $item->id]) }}" class="btn btn-luxury-outline btn-sm rounded-pill px-3">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        <a href="{{ route('admin.invoice.download', $item->id) }}" class="btn btn-luxury btn-sm rounded-pill px-3 shadow" title="Unduh Invoice PDF">
                                            <i class="fas fa-file-pdf me-1"></i> Invoice
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
@endsection
