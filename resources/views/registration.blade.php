@extends('layouts.app')
@section('title', 'Daftar Akun | Rental Kamera Premium')

@section('content')
<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-luxury border-0 shadow-lg">
                <div class="card-header bg-transparent border-0 pt-4 pb-0 text-center">
                    <h3 class="fw-bold text-white mb-1"><i class="fas fa-user-plus text-warning me-2"></i> Daftar Akun</h3>
                    <p class="text-muted small">Bergabunglah untuk menikmati kemudahan sewa gear profesional</p>
                </div>
                <div class="card-body p-4 p-md-5 pt-3">
                    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control form-luxury" id="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                            <label for="name" class="text-dark">Nama Lengkap</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control form-luxury" id="email" placeholder="Email" value="{{ old('email') }}" required>
                            <label for="email" class="text-dark">Alamat Email</label>
                            @error('email')<div class="text-danger small mt-1 ms-1"><i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}</div>@enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control form-luxury" id="password" placeholder="Password" required>
                            <label for="password" class="text-dark">Password Keamanan</label>
                            @error('password')<div class="text-danger small mt-1 ms-1"><i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}</div>@enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="telepon" class="form-control form-luxury" id="telepon" placeholder="No. Telepon" value="{{ old('telepon') }}" required>
                            <label for="telepon" class="text-dark">No. WhatsApp Aktif</label>
                            @error('telepon')<div class="text-danger small mt-1 ms-1"><i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}</div>@enderror
                        </div>

                        <div class="p-3 mb-4 rounded" style="background: var(--surface-hover); border: 1px dashed var(--border-color);">
                            <label class="form-label fw-bold text-white mb-2"><i class="far fa-id-card text-warning me-2"></i>Verifikasi Identitas (KTP) <span class="text-danger">*</span></label>
                            <p class="small text-muted mb-2">Unggah foto KTP asli sebagai syarat wajib peminjaman. (JPG/PNG/PDF maks 5MB)</p>
                            <input type="file" name="ktp" class="form-control form-control-sm bg-dark text-white border-secondary" accept=".jpg,.jpeg,.png,.pdf" required>
                            @error('ktp')<div class="text-danger small mt-1"><i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-luxury py-3 text-uppercase fw-bold tracking-wide">Buat Akun Sekarang</button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">Sudah punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-warning text-decoration-none fw-bold">Login Disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
