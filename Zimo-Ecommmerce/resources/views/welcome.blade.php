<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Product List</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
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
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{----}}
{{--{{ route('cart.add', $product->id) }}--}}
