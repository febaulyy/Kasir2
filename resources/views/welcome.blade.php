<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee Shop App</title>

    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #E7D4BB;
            color: #29281E;
        }

        /* NAVBAR */
        .navbar {
            background: #29281E;
        }
        .navbar-brand {
            font-weight: 800;
            color: #E7D4BB !important;
            letter-spacing: 1px;
        }
        .nav-link {
            font-weight: 600;
            color: #E7D4BB !important;
            opacity: 0.85;
        }
        .nav-link:hover {
            opacity: 1;
        }

        /* HERO */
        .hero {
            min-height: calc(100vh - 80px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            text-align: center;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 15px;
        }
        .hero-desc {
            max-width: 620px;
            margin-bottom: 35px;
            color: #48252F;
            font-size: 1.1rem;
        }

        /* BUTTON */
        .btn-main {
            background: #48252F;
            color: #E7D4BB;
            font-weight: 700;
            padding: 12px 34px;
            border-radius: 30px;
            transition: 0.25s;
            border: none;
        }
        .btn-main:hover {
            background: #29281E;
        }

        .btn-outline-main {
            border: 2px solid #48252F;
            color: #48252F;
            font-weight: 700;
            padding: 12px 34px;
            border-radius: 30px;
            transition: 0.25s;
            background: transparent;
        }
        .btn-outline-main:hover {
            background: #48252F;
            color: #E7D4BB;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                COFFEE CORNER
            </a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <h1 class="hero-title">Nikmati Kopi Favoritmu</h1>

        <p class="hero-desc">
            Aplikasi coffee shop sederhana untuk mengelola pesanan dan akses dashboard sesuai peran pengguna.  
            Silakan masuk untuk melanjutkan pengalaman ngopi digitalmu.
        </p>

        <div class="d-flex gap-3 mt-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-main">Masuk</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-main">Daftar Akun</a>
                @endif
            @else
                @php
                    $role = auth()->user()->role ?? 'user';
                    $dashboardUrl = $role === 'admin' ? url('/admin/dashboard') : url('/user/dashboard');
                @endphp
                <a href="{{ $dashboardUrl }}" class="btn btn-main">Buka Dashboard</a>
            @endguest
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
