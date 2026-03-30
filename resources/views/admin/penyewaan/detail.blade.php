@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div>
            <a href="{{ route('penyewaan.index') }}" class="btn btn-outline-light rounded-pill btn-sm mb-2"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
            <h4 class="fw-bold text-white mb-0"><i class="fas fa-file-invoice text-warning me-2"></i> Detail Reservasi Pelanggan</h4>
        </div>
        <div class="text-end">
            <span class="d-block text-muted small text-uppercase tracking-wide mb-1">Status Transaksi</span>
            @if ($status == 1)
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm fs-6"><i class="fas fa-hourglass-half me-1"></i> Perlu Ditinjau Admin</span>
            @elseif ($status == 2)
                <span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm fs-6"><i class="fas fa-exclamation-circle me-1"></i> Menunggu Pembayaran</span>
            @elseif ($status == 3)
                <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm fs-6"><i class="fas fa-check-circle me-1"></i> Sudah Dibayar</span>
            @elseif ($status == 4)
                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill shadow-sm fs-6"><i class="fas fa-flag-checkered me-1"></i> Selesai Dikembalikan</span>
            @endif
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Informasi Peminjam -->
        <div class="col-lg-4">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary text-uppercase tracking-wide fw-bold">
                    <i class="fas fa-user-circle text-warning me-2"></i> Informasi Penyewa
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($payment->user->name ?? 'User') }}&background=d4af37&color=000&size=80" alt="Avatar" class="rounded-circle shadow-sm border border-warning border-2 p-1">
                        <h5 class="fw-bold text-white mt-3 mb-0">{{ $payment->user->name ?? 'Pelanggan' }}</h5>
                        <p class="text-muted small">{{ $payment->user->email ?? '-' }}</p>
                    </div>
                    <ul class="list-group list-group-flush border-top border-secondary border-opacity-25 pt-2">
                        <li class="list-group-item bg-transparent text-white px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small"><i class="fas fa-file-invoice me-2"></i> No. Invoice</span>
                            <strong>#{{ $payment->no_invoice }}</strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small"><i class="fab fa-whatsapp me-2"></i> Telepon</span>
                            <strong>{{ $payment->user->telepon ?? '-' }}</strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white px-0 d-flex flex-column pb-0">
                            <span class="text-muted small mb-1"><i class="far fa-calendar-alt me-2"></i> Jadwal Pengambilan</span>
                            <strong class="text-warning">
                                <i class="fas fa-clock me-1"></i> 
                                @if($detail->first())
                                    {{ date('d M Y, H:i', strtotime($detail->first()->starts)) }} WIB
                                @else
                                    -
                                @endif
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Daftar Alat Disewa -->
        <div class="col-lg-8">
            <div class="card card-luxury border-0 shadow-sm h-100">
                <div class="card-header bg-transparent pt-4 pb-3 border-secondary text-uppercase tracking-wide fw-bold">
                    <i class="fas fa-boxes text-warning me-2"></i> Detail Item Sewa
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('acc',['paymentId' => $payment->id]) }}" method="POST" id="accForm">
                        @method('PATCH')
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-luxury table-borderless table-hover align-middle mb-0">
                                <thead class="bg-dark text-muted small">
                                    <tr>
                                        <th class="ps-4">No.</th>
                                        @if ($status == 1) <th class="text-center">Tolak</th> @endif
                                        <th>Item Alat</th>
                                        <th>Jadwal Kembali</th>
                                        <th class="text-end pe-4">Harga Sewa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail as $item)
                                    <tr class="{{ ($item->status == 3) ? 'opacity-50 text-decoration-line-through' : '' }} border-bottom border-secondary border-opacity-25">
                                        <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                        @if ($status == 1)
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input border-secondary" type="checkbox" name="order[]" value="{{ $item->id }}" style="width: 20px; height: 20px; cursor: pointer;" title="Centang untuk menolak alat ini">
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <a class="text-decoration-none fw-bold text-white d-block" href="{{ route('home.detail',['id' => $item->alat->id]) }}">{{ $item->alat->nama_alat }}</a>
                                            <div class="mt-1">
                                                <span class="badge bg-warning text-dark me-1">{{ $item->alat->category->nama_kategori }}</span>
                                                <span class="badge bg-secondary me-1">{{ $item->durasi }} Jam</span>
                                                @if ($item->status === 3)
                                                    <span class="badge bg-danger shadow-sm">Ditolak</span>
                                                @elseif ($item->status === 2)
                                                    <span class="badge bg-success shadow-sm">Disetujui (ACC)</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-muted small">
                                            {{ date('d M Y', strtotime($item->ends)) }}
                                            <br><strong class="text-white">{{ date('H:i', strtotime($item->ends)) }} WIB</strong>
                                        </td>
                                        <td class="text-end pe-4 fw-bold text-warning">
                                            @money($item->harga)
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ $status == 1 ? '5' : '4' }}" class="text-center py-5 text-muted">
                                            <i class="fas fa-exclamation-triangle mb-2" style="font-size: 2rem;"></i>
                                            <p class="mb-0 small">Data item sewa tidak ditemukan atau telah dihapus.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                    <tr class="bg-dark bg-opacity-50">
                                        <td colspan="{{ $status == 1 ? '4' : '3' }}" class="text-end fw-bold text-uppercase tracking-wide small text-muted pt-3 pb-3">Total Estimasi Harga:</td>
                                        <td class="text-end pe-4 fw-bold text-warning fs-5 pt-3 pb-3">@money($total)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent border-top border-secondary p-4 d-flex justify-content-end gap-3 flex-wrap">
                    @if ($status == 1 && $detail->isNotEmpty())
                        <button type="button" onclick="document.getElementById('accForm').submit()" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-lg"><i class="fas fa-check-double me-2"></i> Konfirmasi Pesanan (ACC)</button>
                    @endif
                    
                    @if ($status == 1 || $status == 2)
                        <form action="{{ route('admin.penyewaan.cancel',['id' => $payment->id]) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="javascript: return confirm('Perhatian: Anda yakin akan membatalkan seluruh reservasi ini?');" class="btn btn-outline-danger px-4 py-2 rounded-pill fw-bold"><i class="fas fa-ban me-2"></i> Batalkan Reservasi</button>
                        </form>
                    @endif
                    
                    @if ($status == 3)
                    <form action="{{ route('selesai',['id' => $payment->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-lg w-100 w-sm-auto" onclick="javascript: return confirm('Konfirmasi: Pastikan SEMUA alat telah dikembalikan dalam kondisi baik. Lanjutkan?');"><i class="fas fa-handshake me-2"></i> Tandai Selesai (Alat Kembali)</button>
                    </form>
                    @endif

                    @if ($status == 3 || $status == 4)
                        <a href="{{ route('admin.invoice.preview', $payment->id) }}" target="_blank" class="btn btn-outline-warning px-4 py-2 rounded-pill fw-bold">
                            <i class="fas fa-eye me-2"></i> Lihat Invoice
                        </a>
                        <a href="{{ route('admin.invoice.download', $payment->id) }}" class="btn btn-luxury px-4 py-2 rounded-pill fw-bold shadow">
                            <i class="fas fa-file-pdf me-2"></i> Unduh Invoice PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bukti Pembayaran Manual (Fallback) -->
    @if ($status != 1 && !empty($payment->bukti))
    <div class="card card-luxury border-0 shadow-sm mb-5">
        <a class="card-header bg-dark pt-4 pb-3 border-secondary text-uppercase tracking-wide fw-bold text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseBukti" role="button" aria-expanded="true" aria-controls="collapseBukti">
            <span><i class="fas fa-receipt text-warning me-2"></i> Bukti Pembayaran Manual (Transfer)</span>
            <i class="fas fa-chevron-down text-muted"></i>
        </a>
        <div class="collapse show" id="collapseBukti">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        <img src="{{ url('') }}/images/evidence/{{ $payment->bukti }}" alt="Bukti Transfer" class="img-fluid rounded shadow border border-secondary" style="max-height: 400px; cursor: pointer;" onclick="window.open(this.src,'_blank');" title="Klik untuk memperbesar">
                        <div class="small text-muted mt-2"><i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar</div>
                    </div>
                    <div class="col-md-7 border-start border-secondary ps-md-4">
                        <h6 class="fw-bold text-white mb-3">Verifikasi Pembayaran Manual</h6>
                        <p class="text-muted small mb-4">Pelanggan telah mengunggah bukti transfer manual. Admin harus melakukan pengecekan mutasi pada rekening tujuan sebelum menyetujui transaksi ini. Jika menggunakan Midtrans, proses ini tidak diperlukan dan status akan "Sudah Dibayar" secara otomatis.</p>
                        
                        <form action="{{ route('accbayar',['id' => $payment->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow" onclick="javascript: return confirm('Yakin akan mengkonfirmasi pembayaran ini?');" {{ ($status == 3 || $status == 4) ? 'disabled' : '' }}>
                                <i class="fas fa-check-circle me-2"></i> Konfirmasi Pembayaran Valid
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
