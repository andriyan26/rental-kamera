<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lupa Password | Kancil Rental</title>
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
                            <h4 class="fw-bold mb-1">Lupa Password</h4>
                            <p class="text-muted small mb-4">Masukkan email Anda, kami akan mengirim link reset password.</p>
                            @if (session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            <form action="{{ route('forgetpassword.sendlink') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2">Kirim Link Reset</button>
                            </form>
                            <p class="text-center text-muted small mt-4 mb-0"><a href="{{ route('home') }}" class="text-decoration-none">Kembali ke halaman utama</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
