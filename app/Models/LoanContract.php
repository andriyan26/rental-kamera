<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanContract extends Model
{
    protected $fillable = [
        'user_id',
        'contract_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function defaultContractText(): string
    {
        return <<<'HTML'
<h3 style="text-align:center; text-transform:uppercase; letter-spacing:2px; margin-bottom:4px;">PERJANJIAN SEWA MENYEWA</h3>
<h4 style="text-align:center; text-transform:uppercase; letter-spacing:1px; margin-top:0; margin-bottom:4px;">PERALATAN FOTOGRAFI &amp; VIDEOGRAFI</h4>
<p style="text-align:center; font-size:12px; color:#888; margin-bottom:24px;">Rental Kamera Premium — Dokumen Resmi Penyewaan</p>

<hr style="border-color:#d4af37; margin-bottom:20px;">

<p>Perjanjian Sewa Menyewa ini (<strong>"Kontrak"</strong>) dibuat dan ditandatangani secara elektronik oleh dan antara:</p>

<table style="width:100%; margin: 16px 0; border-collapse: collapse;">
  <tr>
    <td style="width:140px; vertical-align:top; padding:6px 8px; font-weight:600;">Pihak Pertama</td>
    <td style="vertical-align:top; padding:6px 8px;">: <strong>Rental Kamera Premium</strong>, selaku penyedia jasa penyewaan peralatan fotografi dan videografi profesional, yang selanjutnya disebut <strong>"Pihak Penyewa"</strong>.</td>
  </tr>
  <tr>
    <td style="width:140px; vertical-align:top; padding:6px 8px; font-weight:600;">Pihak Kedua</td>
    <td style="vertical-align:top; padding:6px 8px;">: Pelanggan yang telah terdaftar dan menyetujui ketentuan layanan pada platform ini, yang selanjutnya disebut <strong>"Penyewa"</strong>.</td>
  </tr>
</table>

<p>Kedua belah pihak telah sepakat untuk mengikatkan diri dalam perjanjian sewa-menyewa peralatan fotografi/videografi dengan ketentuan-ketentuan sebagai berikut:</p>

<hr style="border-color:#e0e0e0; margin: 20px 0;">

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">Pasal 1 — Objek Perjanjian</h5>
<ol>
  <li>Pihak Pertama menyewakan kepada Pihak Kedua peralatan fotografi dan/atau videografi sebagaimana tercantum dalam Invoice/Bukti Pemesanan resmi yang diterbitkan oleh sistem.</li>
  <li>Spesifikasi, merek, tipe, dan harga sewa masing-masing peralatan tercantum secara rinci dalam Invoice yang merupakan bagian tidak terpisahkan dari Kontrak ini.</li>
  <li>Seluruh peralatan adalah milik sah Pihak Pertama dan hanya dipinjamkan kepada Pihak Kedua selama periode sewa yang telah disepakati.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 2 — Periode &amp; Jadwal Sewa</h5>
<ol>
  <li>Periode sewa dimulai sejak Penyewa mengambil peralatan secara langsung di lokasi Rental Kamera Premium sesuai jadwal yang tertera pada Invoice.</li>
  <li>Peralatan wajib dikembalikan paling lambat pada waktu yang tercantum dalam Invoice sebagai <em>batas waktu pengembalian</em>.</li>
  <li>Penjemputan atau pengiriman peralatan ke/dari lokasi Penyewa di luar tanggung jawab Pihak Pertama, kecuali ada perjanjian tertulis tambahan.</li>
  <li>Pihak Kedua wajib menunjukkan Invoice (cetak atau digital) saat pengambilan peralatan.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 3 — Pembayaran &amp; Biaya Sewa</h5>
<ol>
  <li>Biaya sewa dihitung berdasarkan durasi sewa (6 jam, 12 jam, atau 24 jam) sesuai pilihan Penyewa pada saat pemesanan.</li>
  <li>Pembayaran dilakukan penuh di muka (<em>full payment in advance</em>) sebelum atau pada saat pengambilan peralatan.</li>
  <li>Metode pembayaran yang diterima: Transfer Bank, QRIS, Virtual Account, dan metode lain yang tersedia pada platform pembayaran Midtrans.</li>
  <li><strong>Denda keterlambatan pembayaran:</strong> Apabila Penyewa belum menyelesaikan pembayaran hingga batas waktu yang ditetapkan, Penjual berhak membatalkan pemesanan dan Penyewa dikenakan denda administrasi sebesar <strong>Rp 50.000,-</strong> serta kehilangan hak prioritas pemesanan.</li>
  <li>Harga yang tertera dalam Invoice bersifat final dan tidak dapat diubah setelah pemesanan dikonfirmasi.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 4 — Keterlambatan Pengembalian</h5>
<ol>
  <li>Keterlambatan pengembalian peralatan akan dikenakan biaya sewa tambahan sebesar <strong>1,5× (satu koma lima kali)</strong> tarif normal per jam keterlambatan.</li>
  <li>Penyewa wajib menginformasikan keterlambatan kepada Pihak Pertama sesegera mungkin melalui kontak yang tersedia.</li>
  <li>Jika keterlambatan melebihi <strong>24 jam</strong> tanpa pemberitahuan, Pihak Pertama berhak melaporkan peralatan sebagai barang hilang/dicuri kepada pihak berwajib.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 5 — Tanggung Jawab &amp; Kerusakan</h5>
<ol>
  <li>Penyewa bertanggung jawab penuh atas keamanan, keselamatan, dan kondisi peralatan selama masa sewa berlangsung.</li>
  <li>Apabila terjadi kerusakan, baik sebagian maupun keseluruhan, Penyewa wajib menanggung biaya perbaikan atau penggantian peralatan sesuai nilai pasar yang berlaku.</li>
  <li>Peralatan yang hilang atau dicuri selama masa sewa wajib diganti dengan peralatan serupa atau sejumlah uang senilai harga pasar peralatan tersebut.</li>
  <li>Penyewa dilarang keras menyewakan kembali, meminjamkan, atau mengalihkan peralatan kepada pihak ketiga tanpa izin tertulis dari Pihak Pertama.</li>
  <li>Pihak Pertama tidak bertanggung jawab atas kehilangan data, kerusakan tidak langsung, atau kerugian yang dialami Penyewa akibat kerusakan peralatan.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 6 — Kondisi Peralatan</h5>
<ol>
  <li>Setiap peralatan telah diperiksa dan dipastikan dalam kondisi baik dan berfungsi sebelum diserahkan kepada Penyewa.</li>
  <li>Penyewa wajib memeriksa kondisi peralatan saat pengambilan dan melaporkan kerusakan atau ketidaksesuaian yang ditemukan <strong>sebelum meninggalkan lokasi</strong>. Setelah Penyewa meninggalkan lokasi, segala kerusakan menjadi tanggung jawab Penyewa.</li>
  <li>Peralatan dikembalikan dalam kondisi yang sama seperti saat diterima, bersih, dan lengkap dengan semua aksesori yang disertakan.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 7 — Pembatalan Pesanan</h5>
<ol>
  <li>Pembatalan yang dilakukan lebih dari <strong>24 jam sebelum jadwal pengambilan</strong>: Uang kembali 100% (refund penuh).</li>
  <li>Pembatalan yang dilakukan kurang dari 24 jam sebelum jadwal pengambilan: Dikenakan biaya administrasi sebesar <strong>20%</strong> dari total nilai sewa.</li>
  <li>Tidak ada refund untuk pembatalan yang dilakukan pada hari H atau setelah peralatan diambil.</li>
  <li>Pihak Pertama berhak membatalkan pesanan sewaktu-waktu jika ditemukan indikasi penipuan atau penyalahgunaan platform.</li>
</ol>

<h5 style="text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; margin-top:20px;">Pasal 8 — Ketentuan Umum</h5>
<ol>
  <li>Penyewa menyatakan bahwa data diri yang didaftarkan adalah benar dan dapat dipertanggungjawabkan.</li>
  <li>Perjanjian ini tunduk pada hukum yang berlaku di Republik Indonesia.</li>
  <li>Segala perselisihan yang timbul akan diselesaikan secara musyawarah untuk mufakat. Jika tidak tercapai, perselisihan diselesaikan melalui pengadilan yang berwenang.</li>
  <li>Dengan melakukan pemesanan dan pembayaran pada platform ini, Penyewa dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan dalam Kontrak ini.</li>
  <li>Kontrak ini berlaku sejak tanggal konfirmasi pemesanan dan berakhir setelah peralatan dikembalikan dalam kondisi baik.</li>
</ol>

<hr style="border-color:#d4af37; margin: 24px 0;">

<table style="width:100%; margin-top:16px;">
  <tr>
    <td style="width:50%; text-align:center; padding:8px;">
      <p style="margin-bottom:60px; font-weight:600;">Pihak Pertama,</p>
      <p style="border-top:1px solid #ccc; display:inline-block; min-width:180px; padding-top:6px; font-weight:600;">Rental Kamera Premium</p>
    </td>
    <td style="width:50%; text-align:center; padding:8px;">
      <p style="margin-bottom:60px; font-weight:600;">Pihak Kedua (Penyewa),</p>
      <p style="border-top:1px solid #ccc; display:inline-block; min-width:180px; padding-top:6px; font-weight:600;">___________________________</p>
    </td>
  </tr>
</table>

<p style="text-align:center; font-size:11px; color:#aaa; margin-top:24px;"><em>Dokumen ini dibuat secara elektronik dan sah tanpa tanda tangan basah sebagaimana diatur dalam UU ITE No. 11 Tahun 2008.</em></p>
HTML;
    }
}
