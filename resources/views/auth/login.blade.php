@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4" style="background:#E7D4BB;">
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
                            <label for="email" class="form-label fw-semibold">
                                Email
                            </label>
                            <input id="email" type="email"
                                class="form-control rounded-3 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                Password
                            </label>
                            <input id="password" type="password"
                                class="form-control rounded-3 @error('password') is-invalid @enderror"
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
                            <label class="form-check-label">
                                Ingat saya
                            </label>
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

            <p class="text-center mt-3" style="color:#48252F;font-size:0.9rem;">
                © Coffee Corner — Brew your day better
            </p>
        </div>
    </div>
</div>
@endsection
