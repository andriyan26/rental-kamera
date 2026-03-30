@extends('member.main')

@push('scripts')
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>
@if ($payment->snap_token)
<script type="text/javascript">
  var payButton = document.getElementById('pay-button');
  if (payButton) {
      payButton.addEventListener('click', function () {
        window.snap.pay('{{ $payment->snap_token }}', {
          onSuccess: function(result){ alert("Pembayaran Berhasil!"); window.location.reload(); },
          onPending: function(result){ alert("Menunggu pembayaran Anda!"); window.location.reload(); },
          onError: function(result){ alert("Pembayaran gagal!"); },
          onClose: function(){ console.log('User closed the popup'); }
        })
      });
  }
</script>
@endif
@endpush

@section('container')
<div class="mb-4 d-flex align-items-center justify-content-between">
    <a href="{{ route('order.show') }}" class="btn btn-outline-light rounded-pill btn-sm"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
    <span class="badge bg-dark border border-secondary text-white px-3 py-2 tracking-wide"><i class="fas fa-hashtag text-warning me-1"></i> {{ $payment->no_invoice }}</span>
</div>

<div class="card card-luxury border-0 shadow-lg">
    <div class="card-header bg-transparent pt-4 pb-3 border-secondary d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold d-flex align-items-center"><i class="fas fa-file-invoice text-warning me-2"></i> Detail Reservasi</h4>
        <div>
            @if ($paymentStatus == 1)
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-hourglass-half me-1"></i> Sedang Ditinjau</span>
            @elseif ($paymentStatus == 2)
                <span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-exclamation-circle me-1"></i> Belum Dibayar</span>
            @elseif ($paymentStatus == 3)
                <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-check-circle me-1"></i> Sudah Dibayar</span>
            @elseif ($paymentStatus == 4)
                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-flag-checkered me-1"></i> Selesai</span>
            @endif
        </div>
    </div>
    
    <div class="card-body p-4 p-lg-5">
        @if ($paymentStatus == 3)
            <div class="alert bg-dark border-success text-success d-flex align-items-center gap-3 mb-4 p-3 rounded-3">
                <i class="fas fa-check-circle fs-3 text-success"></i>
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-1">Pembayaran Terkonfirmasi!</h6>
                    <small class="text-muted">Silakan ambil alat di toko sesuai jadwal. Tunjukkan invoice ini kepada staf kami.</small>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('invoice.preview', $paymentId) }}" target="_blank" class="btn btn-outline-warning btn-sm rounded-pill px-3 fw-bold" title="Lihat Invoice di tab baru">
                        <i class="fas fa-eye me-1"></i> Lihat Invoice
                    </a>
                    <a href="{{ route('invoice.download', $paymentId) }}" class="btn btn-luxury btn-sm rounded-pill px-3 fw-bold shadow" title="Unduh Invoice PDF">
                        <i class="fas fa-file-pdf me-1"></i> Unduh PDF
                    </a>
                </div>
            </div>
        @elseif ($paymentStatus == 4)
            <div class="alert bg-dark border-secondary text-muted d-flex align-items-center gap-3 mb-4 p-3 rounded-3">
                <i class="fas fa-flag-checkered fs-3 text-secondary"></i>
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-1 text-white">Penyewaan Telah Selesai</h6>
                    <small>Alat telah dikembalikan. Terima kasih telah menggunakan layanan kami!</small>
                </div>
                <a href="{{ route('invoice.download', $paymentId) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold">
                    <i class="fas fa-file-pdf me-1"></i> Unduh Invoice
                </a>
            </div>
        @endif

        <div class="row mb-5">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <p class="text-muted small text-uppercase tracking-wide mb-1">Jadwal Pengambilan</p>
                <h5 class="fw-bold text-white"><i class="far fa-calendar-check text-warning me-2"></i> 
                    @if($detail->first())
                        {{ date('d F Y', strtotime($detail->first()->starts)) }}
                    @else
                        -
                    @endif
                </h5>
                <p class="text-muted"><i class="far fa-clock text-warning me-2"></i> 
                    @if($detail->first())
                        {{ date('H:i', strtotime($detail->first()->starts)) }}
                    @else
                        -
                    @endif
                    WIB
                </p>
            </div>
            <div class="col-sm-6 text-sm-end">
                <p class="text-muted small text-uppercase tracking-wide mb-1">Total Tagihan</p>
                <h3 class="fw-bold text-warning mb-0">@money($total)</h3>
                @if ($paymentStatus == 1 || $paymentStatus == 2)
                    @if ($payment->snap_token)
                        <button id="pay-button" class="btn btn-luxury px-4 py-2 mt-3 rounded-pill fw-bold shadow-lg"><i class="fas fa-wallet me-2"></i> Bayar Sekarang</button>
                    @endif
                @endif
            </div>
        </div>

        <h5 class="fw-bold text-white mb-3 text-uppercase tracking-wide small border-bottom border-secondary pb-2">Item Disewa</h5>
        
        <div class="table-responsive mb-4">
            <table class="table table-borderless table-luxury align-middle">
                <tbody>
                    @forelse($detail as $item)
                        <tr class="{{ ($item->status == 3) ? 'opacity-50' : '' }} bg-dark rounded">
                            <td style="width: 50px;" class="fw-bold text-muted text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a class="text-decoration-none fw-bold text-white fs-6 d-block mb-1" href="{{ route('home.detail',['id' => $item->alat->id]) }}">{{ $item->alat->nama_alat }}</a>
                                <span class="badge bg-warning text-dark me-2">{{ $item->alat->category->nama_kategori }}</span>
                                <span class="badge bg-secondary"><i class="far fa-clock"></i> {{ $item->durasi }} Jam</span>
                            </td>
                            <td class="text-muted small">
                                <div>Kembali Pukul:</div>
                                <div class="text-white fw-semibold"><i class="fas fa-history text-warning me-1"></i> {{ date('d M Y H:i', strtotime($item->ends)) }}</div>
                            </td>
                            <td class="text-end fw-bold text-warning pe-4">
                                @money($item->harga)
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-exclamation-triangle mb-2" style="font-size: 2rem;"></i>
                                <p class="mb-0">Tidak ada item sewa yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($paymentStatus == 1 || $paymentStatus == 2)
            <div class="d-flex justify-content-end border-top border-secondary pt-4">
                <form action="{{ route('cancel',['id' => $payment->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="javascript: return confirm('Status pembayaran akan dibatalkan, yakin?');" class="btn btn-outline-danger btn-sm rounded-pill px-4"><i class="fas fa-ban me-1"></i> Batalkan Reservasi</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
