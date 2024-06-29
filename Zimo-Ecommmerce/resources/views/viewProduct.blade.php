

<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                <form action="{{route('products.addToCart', $product->id)}}" method="POST" class="me-2">
                    @csrf
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
                <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{--{{ route('cart.add', $product->id) }}--}}

