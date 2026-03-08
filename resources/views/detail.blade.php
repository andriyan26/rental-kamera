<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Detail - {{ $detail->nama_alat }} | Kancil Rental</title>
        <link rel="stylesheet" href="/js/fullcalendar/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/css/kancil-theme.css" rel="stylesheet" />
        <script src="/js/fullcalendar/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Kancil Rental</a>
                <div class="navbar-nav ms-auto">
                    @if (Auth::guest())
                        <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                    @elseif (Auth::user()->role == 0)
                        <a class="nav-link" href="{{ route('member.index') }}"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                    @else
                        <a class="nav-link" href="{{ url()->previous() }}"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                    @endif
                </div>
            </div>
        </nav>

        <div class="container py-5">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card product-card">
                        <img class="card-img-top" src="{{ url('') }}/images/{{ $detail->gambar }}" alt="{{ $detail->nama_alat }}" style="height: 280px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-warning text-dark">{{ $detail->category->nama_kategori }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom"><span>24 Jam</span><strong>@money($detail->harga24)</strong></div>
                            <div class="d-flex justify-content-between py-2 border-bottom"><span>12 Jam</span><strong>@money($detail->harga12)</strong></div>
                            <div class="d-flex justify-content-between py-2"><span>6 Jam</span><strong>@money($detail->harga6)</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h3 fw-bold mb-2">{{ $detail->nama_alat }}</h1>
                            <p class="text-muted mb-4">{{ $detail->deskripsi }}</p>
                            @if (Auth::check() && Auth::user()->role == 0)
                                <form action="{{ route('cart.store',['id' => $detail->id, 'userId' => Auth::user()->id]) }}" method="POST" class="mb-4">
                                    @csrf
                                    <p class="small text-muted mb-2">Pilih durasi sewa:</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary" name="btn" value="24"><i class="fas fa-shopping-cart me-1"></i> @money($detail->harga24) / 24 jam</button>
                                        <button type="submit" class="btn btn-primary" name="btn" value="12"><i class="fas fa-shopping-cart me-1"></i> @money($detail->harga12) / 12 jam</button>
                                        <button type="submit" class="btn btn-primary" name="btn" value="6"><i class="fas fa-shopping-cart me-1"></i> @money($detail->harga6) / 6 jam</button>
                                    </div>
                                    <p class="small text-muted mt-2">Login sebagai <b>{{ Auth::user()->name }}</b></p>
                                </form>
                            @endif
                            <hr>
                            <h6 class="fw-bold mb-3">Ketersediaan Mendatang</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead><tr><th>Tanggal Keluar</th><th>Tanggal Kembali</th></tr></thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                            @if ($item->payment->status == 3)
                                            <tr>
                                                <td>{{ date('d M Y H:i', strtotime($item->starts)) }} <span class="badge bg-secondary">{{ $item->durasi }} Jam</span></td>
                                                <td>{{ date('d M Y H:i', strtotime($item->ends)) }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var endpoint = "/api/kalender-alat/";
            var param = {!! $detail->id !!};
            var withParam = endpoint+param;
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 400,
                    selectable: true,
                    navLinks: true,
                    eventSources: [{ url: withParam, color: '#c9a227', textColor: '#1a1a2e' }],
                    eventTimeFormat: { hour: 'numeric', minute: '2-digit', hour12: false },
                    headerToolbar: { left: 'dayGridMonth,timeGridDay', center: 'title' }
                });
                calendar.render();
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
