@extends('Layouts.master')

@section('content')
<!-- products -->
<div class="product-section mt-150 mb-150">
    <div class="container">

        <!-- Category Filter -->
        <div class="row">
            <div class="col-md-12">
                <div class="product-filters">
                    <ul>
                        <li class="active" data-filter="*">الكل</li>
                        @foreach ($categories as $item)
                            <li data-filter="._{{ $item->id }}">{{ $item->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row product-lists">
            @foreach ($products as $item)
                <div class="col-lg-4 col-md-6 text-center strawberry _{{ $item->category_id }}">
                    <div class="single-product-item" style="min-height: 480px; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div class="product-image" style="height: 250px; overflow: hidden;">
                                <a href="{{ route('products.show', ['id' => $item->id]) }}">
                                    <img src="{{ asset($item->imagepath) }}" alt="{{ $item->name }}" style="height: 100%; width: auto; max-width: 100%; object-fit: contain;">
                                </a>
                            </div>
                            <h3 class="mt-3">{{ $item->name }}</h3>
                            <h6>${{ $item->price }}</h6>
                        </div>

                        {{-- Add to Cart Form --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <button type="submit" class="cart-btn mt-2">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap">
                    <div style="text-align: center; margin: 0px auto;">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end products -->

<!-- logo carousel -->
<div class="logo-carousel-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-carousel-inner">
                    <div class="single-logo-item">
                        <img src="{{ asset('assets/img/company-logos/1.png') }}" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="{{ asset('assets/img/company-logos/2.png') }}" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="{{ asset('assets/img/company-logos/3.png') }}" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="{{ asset('assets/img/company-logos/4.png') }}" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="{{ asset('assets/img/company-logos/5.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end logo carousel -->

<style>
    svg {
        height: 50px !important;
    }
</style>
@endsection
