@extends('layouts.default')

@section('title', 'Product')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Product List</h1>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if ($product->imagUrl)
                            <img src="{{ $product->imagUrl }}" class="card-img-top" alt="Product Logo">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text fw-bold">${{ $product->Price }}</p>
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100 mb-2">View Product</a>
                                <button type="button" class="btn btn-success w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-btn').on('click', function() {
                let productId = $(this).data('product-id');
                if (confirm('Product added to cart successfully! Click OK to view your cart.')) {
                    $.ajax({
                        url: '{{ url('product/addToCart') }}/' + productId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = '{{ url('product/cartItems') }}';
                            } else {
                                alert('Failed to add product to cart.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
