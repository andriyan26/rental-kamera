<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar | Kancil Rental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/css/kancil-theme.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Kancil Rental</a>
                <a class="nav-link ms-auto" href="{{ route('home') }}"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            </div>
        </nav>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-1">Daftar Akun Baru</h4>
                            <p class="text-muted small mb-4">Bergabung dan mulai menyewa kamera dengan mudah.</p>
                            <form action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ old('name') }}" required>
                                    <label for="name">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                    <label for="email">Email</label>
                                </div>
                                @error('email')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                @error('password')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                                <p class="small text-muted mb-2">No. telepon disarankan terhubung WhatsApp.</p>
                                <div class="form-floating mb-4">
                                    <input type="text" name="telepon" class="form-control" id="telepon" placeholder="No. Telepon" value="{{ old('telepon') }}" required>
                                    <label for="telepon">No. Telepon</label>
                                </div>
                                @error('telepon')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                                <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
                            </form>
                            <p class="text-center text-muted small mt-4 mb-0">Sudah punya akun? <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
