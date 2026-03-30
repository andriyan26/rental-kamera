<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $payment->no_invoice }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #1a1a2e;
            background: #fff;
        }

        /* ===== Header / Brand Bar ===== */
        .header-bar {
            background: #0b0f19;
            padding: 28px 40px;
            margin-bottom: 0;
        }
        .header-bar .brand {
            font-size: 22px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header-bar .brand span { color: #d4af37; }
        .header-bar .tagline {
            font-size: 10px;
            color: #888;
            margin-top: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .gold-divider {
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #f5e19e, #d4af37);
        }

        /* ===== Invoice Title Row ===== */
        .invoice-title-row {
            padding: 24px 40px 16px 40px;
            display: table;
            width: 100%;
        }
        .invoice-title-cell { display: table-cell; vertical-align: top; }
        .invoice-title-cell h2 {
            font-size: 28px;
            font-weight: 900;
            color: #0b0f19;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .invoice-title-cell .invoice-no {
            font-size: 11px;
            color: #999;
            margin-top: 4px;
            letter-spacing: 1px;
        }
        .invoice-meta { text-align: right; display: table-cell; vertical-align: top; }
        .badge-status {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .badge-paid { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .badge-done { background: #d6d8db; color: #383d41; border: 1px solid #c8cbcf; }

        /* ===== Info Section ===== */
        .info-section {
            padding: 0 40px 24px 40px;
            display: table;
            width: 100%;
        }
        .info-cell { display: table-cell; vertical-align: top; width: 50%; }
        .info-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 16px 20px;
            margin-right: 12px;
        }
        .info-box-right {
            background: #fffbef;
            border: 1px solid #f0d060;
            border-radius: 8px;
            padding: 16px 20px;
        }
        .info-label {
            font-size: 9px;
            font-weight: 700;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 6px;
        }
        .info-row { margin-bottom: 8px; }
        .info-row .key {
            font-size: 10px;
            color: #888;
            display: block;
        }
        .info-row .val {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a2e;
            display: block;
        }
        .info-row .val-gold {
            font-size: 13px;
            font-weight: 700;
            color: #b8860b;
            display: block;
        }

        /* ===== Items Table ===== */
        .table-section { padding: 0 40px 24px 40px; }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }
        .items-table thead tr {
            background: #0b0f19;
        }
        .items-table thead th {
            padding: 12px 16px;
            font-size: 10px;
            font-weight: 700;
            color: #d4af37;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .items-table tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }
        .items-table tbody tr:nth-child(even) {
            background: #fafafa;
        }
        .items-table tbody td {
            padding: 12px 16px;
            font-size: 12px;
            color: #333;
            vertical-align: middle;
        }
        .items-table tfoot tr {
            background: #0b0f19;
        }
        .items-table tfoot td {
            padding: 14px 16px;
            font-size: 13px;
            font-weight: 700;
            color: #d4af37;
        }
        .category-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            background: #fff3cd;
            color: #856404;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 4px;
        }
        .duration-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            background: #e9ecef;
            color: #555;
            font-size: 9px;
            font-weight: 600;
            margin-left: 4px;
        }
        .item-name { font-weight: 700; color: #0b0f19; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* ===== Notes / Footer ===== */
        .notes-section {
            padding: 0 40px 24px 40px;
        }
        .notes-box {
            background: #fffbef;
            border-left: 4px solid #d4af37;
            padding: 14px 18px;
            border-radius: 0 6px 6px 0;
        }
        .notes-title {
            font-size: 10px;
            font-weight: 700;
            color: #b8860b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .notes-text {
            font-size: 11px;
            color: #555;
            line-height: 1.6;
        }

        .page-footer {
            background: #0b0f19;
            padding: 16px 40px;
            display: table;
            width: 100%;
            margin-top: 8px;
        }
        .footer-left { display: table-cell; vertical-align: middle; }
        .footer-right { display: table-cell; vertical-align: middle; text-align: right; }
        .footer-text { font-size: 10px; color: #888; }
        .footer-brand { font-size: 11px; font-weight: 700; color: #d4af37; letter-spacing: 1px; }
    </style>
</head>
<body>

    <!-- Header Bar -->
    <div class="header-bar">
        <div class="brand">Rental<span>Kamera</span> Premium</div>
        <div class="tagline">Studio & Photography Equipment Rental</div>
    </div>
    <div class="gold-divider"></div>

    <!-- Invoice Title Row -->
    <div class="invoice-title-row">
        <div class="invoice-title-cell">
            <h2>Invoice</h2>
            <div class="invoice-no">No. Referensi: {{ $payment->no_invoice }}</div>
            <div class="invoice-no">Tanggal Cetak: {{ date('d F Y', time()) }}</div>
        </div>
        <div class="invoice-meta">
            @if ($payment->status == 3)
                <div class="badge-status badge-paid">&#10003; Sudah Dibayar</div>
            @elseif ($payment->status == 4)
                <div class="badge-status badge-done">&#9873; Selesai / Returned</div>
            @endif
        </div>
    </div>

    <!-- Info Section: Customer & Booking -->
    <div class="info-section">
        <div class="info-cell">
            <div class="info-box">
                <div class="info-label">&#128100; Data Pelanggan</div>
                <div class="info-row">
                    <span class="key">Nama Lengkap</span>
                    <span class="val">{{ $payment->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="key">Email</span>
                    <span class="val">{{ $payment->user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="key">No. Telepon</span>
                    <span class="val">{{ $payment->user->telepon ?? '-' }}</span>
                </div>
            </div>
        </div>
        <div class="info-cell">
            <div class="info-box-right">
                <div class="info-label">&#128197; Detail Pesanan</div>
                <div class="info-row">
                    <span class="key">No. Invoice</span>
                    <span class="val">{{ $payment->no_invoice }}</span>
                </div>
                <div class="info-row">
                    <span class="key">Tanggal Transaksi</span>
                    <span class="val">{{ date('d M Y, H:i', strtotime($payment->created_at)) }} WIB</span>
                </div>
                <div class="info-row">
                    <span class="key">Jadwal Pengambilan</span>
                    <span class="val-gold">{{ date('d M Y, H:i', strtotime($detail->first()->starts ?? now())) }} WIB</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-section">
        <table class="items-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 40px;">No.</th>
                    <th>Nama Alat</th>
                    <th class="text-center">Durasi</th>
                    <th>Batas Pengembalian</th>
                    <th class="text-right">Harga Sewa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <span class="item-name">{{ $item->alat->nama_alat }}</span>
                        <span class="category-badge">{{ $item->alat->category->nama_kategori }}</span>
                    </td>
                    <td class="text-center">
                        <span class="duration-badge">{{ $item->durasi }} Jam</span>
                    </td>
                    <td>{{ date('d M Y, H:i', strtotime($item->ends)) }} WIB</td>
                    <td class="text-right" style="font-weight: 700; color: #b8860b;">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right" style="letter-spacing: 1px; font-size: 11px; text-transform: uppercase;">Total Pembayaran</td>
                    <td class="text-right" style="font-size: 15px;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Notes -->
    <div class="notes-section">
        <div class="notes-box">
            <div class="notes-title">&#9888; Penting — Perhatikan Ketentuan Penyewaan</div>
            <div class="notes-text">
                1. Tunjukkan invoice ini (cetak / digital) kepada staf kami saat pengambilan alat.<br>
                2. Pastikan alat dikembalikan tepat waktu sesuai batas pengembalian di atas. Keterlambatan dikenakan <strong>denda sesuai tarif berlaku</strong>.<br>
                3. Pelanggan bertanggung jawab atas kerusakan atau kehilangan alat selama masa sewa.<br>
                4. Invoice ini adalah bukti sah transaksi sewa di Rental Kamera Premium.
            </div>
        </div>
    </div>

    <!-- Page Footer -->
    <div class="page-footer">
        <div class="footer-left">
            <div class="footer-text">Dicetak pada {{ date('d F Y H:i') }} WIB &nbsp;|&nbsp; Dokumen ini sah tanpa tanda tangan</div>
        </div>
        <div class="footer-right">
            <div class="footer-brand">RENTAL KAMERA PREMIUM</div>
            <div class="footer-text">Powered by Midtrans Payment Gateway</div>
        </div>
    </div>

</body>
</html>
