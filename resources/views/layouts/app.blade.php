<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Rental Kamera | Premium Service')</title>
    <meta name="description" content="Platform penyewaan kamera elit dan profesional.">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Design CSS -->
    <link rel="stylesheet" href="{{ asset('css/design.css') }}?v={{ time() }}">
    @stack('styles')
</head>
<body id="page-top">
    @include('partials.navbar')
    
    <main style="min-height: 80vh;">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-luxury" style="border: 1px solid var(--primary-color);">
                <div class="modal-header border-0 shadow-sm" style="background: var(--surface-hover);">
                    <h5 class="modal-title fw-bold text-white text-uppercase tracking-wide" id="loginModalLabel"><i class="fas fa-sign-in-alt text-warning me-2"></i> Member Login</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-dark">
                    @include('partials.login')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
