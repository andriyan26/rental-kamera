@extends('member.main')
@section('container')
<div class="mb-4">
    <h3 class="fw-bold text-white mb-2"><i class="fas fa-file-invoice-dollar text-warning me-2"></i> Reservasi &amp; Transaksi</h3>
    <p class="text-muted">Pantau status penyewaan dan riwayat transaksi alat Anda.</p>
</div>

<!-- Aktif -->
<div class="card card-luxury mb-5 border-0 shadow-lg">
    <div class="card-header bg-transparent pt-4 pb-3 border-secondary text-uppercase tracking-wide fw-bold d-flex align-items-center">
        <i class="fas fa-tasks text-warning me-2"></i> Sedang Berjalan
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-luxury table-borderless table-hover mb-0 align-middle">
                <thead class="bg-dark text-muted small">
                    <tr>
                        <th class="ps-4">No. Invoice</th>
                        <th>Tgl Pengambilan</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasi as $item)
                        @php $firstOrder = $item->order->first(); @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-white small">#{{ $item->no_invoice }}</div>
                                <div class="text-muted" style="font-size: 11px;">{{ date('d M Y', strtotime($item->created_at)) }}</div>
                            </td>
                            <td class="text-white fw-bold">
                                @if ($firstOrder)
                                    <i class="far fa-calendar-alt text-warning me-2"></i> {{ date('d M Y', strtotime($firstOrder->starts)) }}
                                    <div class="text-muted small ms-4">{{ date('H:i', strtotime($firstOrder->starts)) }} WIB</div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-warning">@money($item->total)</div>
                                <div class="small text-muted"><i class="fas fa-camera text-secondary me-1"></i> {{ $item->order->count() }} Alat</div>
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="fas fa-hourglass-half me-1"></i> Ditinjau</span>
                                @elseif ($item->status == 2)
                                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill"><i class="fas fa-exclamation-circle me-1"></i> Belum Bayar</span>
                                @elseif ($item->status == 3)
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill"><i class="fas fa-check-circle me-1"></i> Sudah Dibayar</span>
                                @endif
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-luxury-outline btn-sm rounded-pill px-3" href="{{ route('order.detail',['id' => $item->id]) }}">Detail</a>
                                    @if ($item->status == 3)
                                        <a class="btn btn-luxury btn-sm rounded-pill px-3" href="{{ route('invoice.download', $item->id) }}" title="Unduh Invoice PDF"><i class="fas fa-file-pdf"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center py-5" colspan="5">
                                <i class="fas fa-receipt text-muted mb-3" style="font-size: 3rem;"></i>
                                <h6 class="text-white">Belum ada reservasi aktif.</h6>
                                <p class="text-muted small">Pesanan yang Anda buat akan muncul di sini.</p>
                                <a href="{{ route('member.index') }}" class="btn btn-luxury btn-sm rounded-pill mt-2">Mulai Reservasi <i class="fas fa-arrow-right ms-1"></i></a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Riwayat -->
<div class="card card-luxury border-0 shadow-sm">
    <div class="card-header bg-transparent pt-4 pb-3 border-secondary text-uppercase tracking-wide fw-bold">
        <i class="fas fa-history text-secondary me-2"></i> Riwayat Selesai
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="dataTable" class="table table-luxury table-borderless table-hover mb-0 align-middle">
                <thead class="bg-dark text-muted small">
                    <tr>
                        <th class="ps-4">No. Invoice</th>
                        <th>Tgl Pengambilan</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat as $r)
                        @php $firstROrder = $r->order->first(); @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-white small">#{{ $r->no_invoice }}</div>
                                <div class="text-muted" style="font-size: 11px;">{{ date('d M Y', strtotime($r->created_at)) }}</div>
                            </td>
                            <td class="text-white fw-bold">
                                @if ($firstROrder)
                                    {{ date('d M Y', strtotime($firstROrder->starts)) }}
                                    <div class="text-muted small">{{ date('H:i', strtotime($firstROrder->starts)) }} WIB</div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-white fw-bold">@money($r->total)</div>
                                <div class="small text-muted">{{ $r->order->count() }} Alat</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill"><i class="fas fa-check-double me-1"></i> Selesai</span>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-outline-secondary btn-sm rounded-pill px-3 text-white" href="{{ route('order.detail',['id' => $r->id]) }}">Detail</a>
                                    <a class="btn btn-luxury btn-sm rounded-pill px-3" href="{{ route('invoice.download', $r->id) }}" title="Unduh Invoice PDF">
                                        <i class="fas fa-file-pdf me-1"></i> Invoice
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center py-5 text-muted" colspan="5">
                                <i class="fas fa-history" style="font-size: 2rem;"></i>
                                <p class="mt-2 small">Belum ada riwayat selesai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
