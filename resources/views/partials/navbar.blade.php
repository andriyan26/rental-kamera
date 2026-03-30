<nav class="navbar navbar-expand-lg navbar-luxury">
    <div class="container">
        <a class="navbar-brand text-uppercase" href="{{ url('/') }}">
            <i class="fas fa-camera-retro"></i> Rental<span>Kamera</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white" style="font-size:1.5rem"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                @guest
                    <li class="nav-item">
                        <a class="nav-link luxury-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-luxury-outline rounded-pill w-100" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-luxury rounded-pill w-100" href="{{ route('daftar') }}">Daftar</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link luxury-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown ms-lg-3 text-center">
                        <a class="nav-link dropdown-toggle text-white fw-bold d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=d4af37&color=000" alt="Avatar" class="rounded-circle me-2" width="35" height="35">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" style="background-color: var(--surface-color); border: 1px solid var(--border-color);" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role == 0)
                                <li><a class="dropdown-item" href="{{ route('member.index') }}"><i class="fas fa-tachometer-alt me-2 text-warning"></i> Member Area</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('admin.index') }}"><i class="fas fa-chart-pie me-2 text-warning"></i> Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider" style="border-color: var(--border-color);"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
