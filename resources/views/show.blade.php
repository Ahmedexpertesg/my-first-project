@extends('Layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .main-image {
        width: 100%;
        max-width: 400px;
        height: auto;
        object-fit: contain;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .thumb-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 1px solid #ddd;
        margin-right: 10px;
        cursor: pointer;
        transition: 0.3s;
    }

    .thumb-img:hover {
        border-color: #f39c12;
    }

    .product-info h2 {
        font-size: 28px;
    }

    .desc-section {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        margin-top: 50px;
    }
</style>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">تفاصيل المنتج</h1>
        </div>
    </div>
</header>

<div class="container mt-5 mb-5">
    <div class="row">
        {{-- Left Column - Main Image & Thumbnails --}}
        <div class="col-md-6">
            <div class="text-center mb-3">
                <img id="mainPreview" src="{{ asset($product->imagepath) }}" class="main-image" alt="{{ $product->name }}">
            </div>

            {{-- Thumbnails --}}
            <div class="d-flex flex-wrap justify-content-start">
                <img src="{{ asset($product->imagepath) }}" class="thumb-img" onclick="document.getElementById('mainPreview').src = this.src;">
                @foreach ($product->images as $img)
                    <img src="{{ asset($img->image_path) }}" class="thumb-img" onclick="document.getElementById('mainPreview').src = this.src;">
                @endforeach
            </div>
        </div>

        {{-- Right Column - Product Info --}}
        <div class="col-md-6 product-info">
            <h2 class="mb-3">{{ $product->name }}</h2>
            <h4 class="text-success mb-3">${{ number_format($product->price, 2) }}</h4>
            <p><strong>Available Quantity:</strong> {{ $product->quantity }}</p>
            <p><strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>

            {{-- Add to Cart --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-warning btn-lg">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>

    {{-- Description Section --}}
    <div class="desc-section mt-5">
        <h4 class="mb-3">Product Description</h4>
        <p>{{ $product->description }}</p>
    </div>
</div>
@endsection
