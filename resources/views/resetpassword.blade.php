<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Reset Password | Kancil Rental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/css/kancil-theme.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Kancil Rental</a>
                <a class="nav-link ms-auto" href="{{ route('home') }}">Kembali</a>
            </div>
        </nav>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-1">Reset Password</h4>
                            <p class="text-muted small mb-4">Masukkan password baru Anda.</p>
                            <form action="{{ route('resetpassword') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                                    <label for="email">Email</label>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="new-password">
                                    <label for="password">Password Baru</label>
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required autocomplete="new-password">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
