<form action="login" method="POST">
    @csrf
    <div class="form-floating mb-3">
        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="nama@email.com"
            autocomplete="email"
        >
        <label for="email">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Password"
            autocomplete="current-password"
        >
        <label for="password">Password</label>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">
            Masuk
        </button>
        <a class="btn btn-link text-decoration-none" href="{{ route('forgetpassword.index') }}">Lupa password?</a>
    </div>
</form>
