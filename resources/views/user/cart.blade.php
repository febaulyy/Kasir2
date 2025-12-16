@extends('layouts.user')
@section('title', 'Keranjang Belanja')

@section('content')

@if(session('error'))
<div class="alert alert-warning">
    {{ session('error') }}
</div>
@endif

<style>
    body {
        background: #f2f2f7 !important; /* abu lembut */
    }

    .cart-wrapper {
        background: #f2f2f7;
        padding: 10px 0;
    }

    .cart-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        display: flex;
        gap: 16px;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 16px;
        border: 1px solid #ececec; /* biar lebih terpisah */
    }

    .cart-img {
        width: 110px;
        height: 110px;
        border-radius: 10px;
        object-fit: cover;
    }

    .cart-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cart-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
        height: 110px;
    }

    .qty-box {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #f6f6f6;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background: #fff;
    }

    .total-price {
        font-weight: bold;
        color: #28a745;
    }
</style>

<div class="cart-wrapper">

    <div class="container py-4">

        <h4 class="fw-bold mb-4">Keranjang Belanja</h4>

        @if(empty($cart) || count($cart) === 0)

            <div class="alert alert-info text-center py-4 rounded-4">
                <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
                Keranjang kamu masih kosong.
            </div>

        @else

            @foreach($cart as $id => $item)

            <div class="cart-card">

                <img src="{{ asset('storage/'.$item['foto']) }}" class="cart-img">

                <div class="cart-info">
                    <div class="fw-semibold mb-1">{{ $item['nama'] }}</div>
                    <div class="text-muted mb-2">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>

                    <div class="qty-box">
                        <form action="{{ route('user.cart.update', $id) }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="action" value="minus">
                            <button class="qty-btn">−</button>
                        </form>

                        <span class="fw-bold">{{ $item['qty'] }}</span>

                        <form action="{{ route('user.cart.update', $id) }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="action" value="plus">
                            <button class="qty-btn">+</button>
                        </form>
                    </div>
                </div>

                <div class="cart-actions">
                    <div class="total-price">
                        Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                    </div>

                    <form action="{{ route('user.cart.remove', $id) }}" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>

            </div>

            @endforeach

            <div class="d-flex justify-content-between align-items-center mt-3 p-3 bg-white rounded-4 shadow-sm border">
                <h5 class="fw-bold m-0">
                    Total Bayar:
                    <span class="text-primary">
                        Rp {{ number_format(collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']), 0, ',', '.') }}
                    </span>
                </h5>

                <form action="{{ route('user.checkout') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="bi bi-credit-card me-1"></i> Checkout
                    </button>
                </form>

            </div>

        @endif

    </div>
</div>

@endsection
