@extends('layouts.app')

@section('content')

<style>
    .login-bg {
        min-height: 100vh;
        background-image:
            linear-gradient(
                rgba(16,18,17,0.65),
                rgba(16,18,17,0.65)
            ),
            url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* CARD LOGIN TRANSPARAN */
    .login-card {
        background: rgba(231, 212, 187, 0.65); /* lebih transparan */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.35);
    }

    /* Input biar nyatu */
    .login-card .form-control {
        background: rgba(255,255,255,0.85);
        border-radius: 14px;
        border: 1px solid #cbb89f;
    }
</style>

<div class="login-bg d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">

                <div class="card border-0 rounded-4 login-card">
                    <div class="card-header text-center border-0 rounded-top-4" style="background:#29281E;">
                        <h4 class="mb-0 fw-bold" style="color:#E7D4BB;">
                            Masuk ke Coffee Corner
                        </h4>
                        <small style="color:#cfc2a8;">Nikmati pengalaman ngopi digital</small>
                    </div>

                    <div class="card-body px-4 py-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- EMAIL --}}
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- PASSWORD --}}
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>

                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- REMEMBER --}}
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label">Ingat saya</label>
                            </div>

                            {{-- BUTTON --}}
                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn fw-bold rounded-pill"
                                    style="background:#48252F;color:#E7D4BB;">
                                    Masuk
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="text-center mt-2 text-decoration-none"
                                       style="color:#48252F;"
                                       href="{{ route('password.request') }}">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-3" style="color:#E7D4BB;font-size:0.9rem;">
                    © Coffee Corner — Brew your day better
                </p>

            </div>
        </div>
    </div>
</div>

@endsection
