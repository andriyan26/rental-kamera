<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pengaturan Akun | Kancil Rental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/css/kancil-theme.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Kancil Rental</a>
                <a class="nav-link ms-auto" href="{{ Auth::user()->role != 0 ? route('admin.index') : route('member.index') }}">Kembali</a>
            </div>
        </nav>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    @if (session('updated'))
                        <div class="alert alert-success">{{ session('updated') }}</div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                    @endif
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Data Profil</h4>
                            <form action="{{ route('akun.update') }}" method="POST" @if ((int) Auth::user()->role === 0) enctype="multipart/form-data" @endif>
                                @method('PATCH')
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                                    <label for="name">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="telepon" class="form-control" id="telepon" value="{{ $user->telepon }}" required>
                                    <label for="telepon">No. Telepon</label>
                                </div>
                                @if ((int) Auth::user()->role === 0)
                                    <label class="form-label fw-semibold">KTP (scan / foto)</label>
                                    @if ($user->ktp_path)
                                        <p class="small mb-2"><a href="{{ asset('storage/'.$user->ktp_path) }}" target="_blank" rel="noopener">Lihat berkas KTP saat ini</a></p>
                                    @else
                                        <p class="small text-warning mb-2">Belum ada KTP terunggah. Unggah untuk memenuhi syarat peminjaman.</p>
                                    @endif
                                    <input type="file" name="ktp" class="form-control mb-2" accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf">
                                    @error('ktp')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                                @endif
                                <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Simpan</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Ganti Password</h4>
                            <form action="{{ route('changepassword') }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="password" name="oldPassword" class="form-control" id="oldPass" required>
                                    <label for="oldPass">Password Saat Ini</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="newPassword" class="form-control" id="newPass" required>
                                    <label for="newPass">Password Baru</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2">Ganti Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
