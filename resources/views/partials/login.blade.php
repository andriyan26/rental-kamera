<form action="{{ url('login') }}" method="POST">
    @csrf
    <div class="form-floating mb-3">
        <input
            type="email"
            class="form-control form-luxury"
            id="email"
            name="email"
            placeholder="nama@email.com"
            autocomplete="email"
            required
        >
        <label for="email" class="text-dark">Email Address</label>
    </div>
    <div class="form-floating mb-4">
        <input
            type="password"
            class="form-control form-luxury"
            id="password"
            name="password"
            placeholder="Password"
            autocomplete="current-password"
            required
        >
        <label for="password" class="text-dark">Password</label>
    </div>
    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-luxury w-100 py-3 text-uppercase fw-bold pb-2">
            Secure Login
        </button>
    </div>
    <div class="text-center">
        <a class="text-warning text-decoration-none small transition-all" href="{{ route('forgetpassword.index') }}">Lupa password? Klik disini</a>
    </div>
</form>
