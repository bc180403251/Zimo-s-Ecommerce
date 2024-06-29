@extends('layouts.default')

@section('title','View Product')
@section('content')
<div class="container mt-5">
    <div class="card">
        @if ($product->imagUrl)
            <img src="{{ $product->imagUrl }}" class="card-img-top w-50 m-auto" alt="{{ $product->name }}">
        @endif
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="card-title mb-0">{{ $product->name }}</h3>
                <h4 class="text-primary mb-0">${{ $product->Price }}</h4>
            </div>
            <p class="card-text">{{ $product->description }}</p>
            <div class="d-flex">
                <button type="button" class="btn btn-success w-auto add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                <a href="{{ url('/') }}" class="btn btn-secondary mx-4">Back</a>
            </div>
        </div>
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

{{--{{ route('cart.add', $product->id) }}--}}

