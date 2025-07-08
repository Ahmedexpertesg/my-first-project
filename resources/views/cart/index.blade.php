@extends('Layouts.master')


@section('content')

@php
    $grandTotal = 0;
    foreach ($cartItems as $item) {
        $grandTotal += $item->product->price * $item->quantity;
    }
@endphp

<!-- Header-->
<header class="bg-secondary py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">السلة</h1>
        </div>
    </div>
</header>

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr class="table-body-row">
                                        {{-- Remove product --}}
                                        <td class="product-remove">
                                            <form action="{{ route('cart.remove') }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                <button type="submit"
                                                    style="border: none; background: none; cursor: pointer;">
                                                    <i class="far fa-window-close"></i>
                                                </button>
                                            </form>
                                        </td>

                                        {{-- Product image --}}
                                        <td class="product-image">
                                            <img src="{{ asset( $item->product->imagepath) }}"
                                                alt="{{ $item->product->name }}">
                                        </td>

                                        {{-- Product name --}}
                                        <td class="product-name">{{ $item->product->name }}</td>

                                        {{-- Product price --}}
                                        <td class="product-price">${{ $item->product->price }}</td>

                                        {{-- Product quantity input --}}
                                        <td class="product-quantity">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1">
                                                <button type="submit" style="display:none;"></button>
                                            </form>
                                        </td>

                                        {{-- Total price for this item --}}
                                        <td class="product-total">${{ $item->product->price * $item->quantity }}</td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>${{ number_format($grandTotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="{{route('checkout')}}" class="boxed-btn black">Check Out</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
