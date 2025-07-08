@extends('layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">
    <h2 class="mb-4">🧾 Checkout</h2>

    <div class="row">
        {{-- Checkout Form --}}
        <div class="col-md-7">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3">Shipping Information</h5>
                <form action="{{ route('place.order') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="text" name="phone" class="form-control" placeholder="+90..." required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Street, City, Country" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Place Order</button>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3">🛒 Your Cart</h5>
                <ul class="list-group mb-3">
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->product->name }}</strong><br>
                                <small>{{ $item->quantity }} × ${{ number_format($item->product->price, 2) }}</small>
                            </div>
                            <span class="text-end">${{ number_format($subtotal, 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between">
                    <strong>Total:</strong>
                    <strong>${{ number_format($total, 2) }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
