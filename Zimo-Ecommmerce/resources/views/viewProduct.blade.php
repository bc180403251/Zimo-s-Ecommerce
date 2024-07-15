{{--@extends('layouts.default')--}}

{{--@section('title','View Product')--}}
{{--@section('content')--}}
{{--    <div class="container mt-5">--}}
{{--        <div class="card">--}}
{{--            @if ($product->imagUrl || $product->otherimgs)--}}
{{--                <div id="carousel-{{ $product->id }}" class="carousel slide w-50 m-auto" data-ride="carousel">--}}
{{--                    <div class="carousel-inner">--}}
{{--                        @if ($product->imagUrl)--}}
{{--                            <div class="carousel-item active">--}}
{{--                                <img src="{{ $product->imagUrl }}" class="d-block w-100" alt="{{ $product->name }}">--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        @if ($product->otherimgs)--}}
{{--                            @foreach (json_decode($product->otherimgs, true) as $index => $imgUrl)--}}
{{--                                <div class="carousel-item {{ !$product->imagUrl && $index == 0 ? 'active' : '' }}">--}}
{{--                                    <img src="{{ $imgUrl }}" class="d-block w-100" alt="{{ $product->name }} - Image {{ $index + 1 }}">--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <a class="carousel-control-prev" href="#carousel-{{ $product->id }}" role="button" data-slide="prev">--}}
{{--                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                        <span class="sr-only"></span>--}}
{{--                    </a>--}}
{{--                    <a class="carousel-control-next" href="#carousel-{{ $product->id }}" role="button" data-slide="next">--}}
{{--                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                        <span class="sr-only"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="card-body">--}}
{{--                <div class="d-flex justify-content-between align-items-center mb-3">--}}
{{--                    <h3 class="card-title mb-0">{{ $product->name }}</h3>--}}
{{--                    <h4 class="text-primary mb-0">${{ $product->Price }}</h4>--}}
{{--                </div>--}}
{{--                <p class="card-text"><strong>Category: </strong>{{ $product->category->name }}</p>--}}
{{--                <p class="card-text">{{ $product->description }}</p>--}}
{{--                <div class="d-flex">--}}
{{--                    <button type="button" class="btn btn-success w-auto add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>--}}
{{--                    <a href="{{ url('/') }}" class="btn btn-secondary mx-4">Back</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}

{{--            $('.add-to-cart-btn').on('click', function() {--}}
{{--                let productId = $(this).data('product-id');--}}
{{--                if (confirm('Product added to cart successfully! Click OK to view your cart.')) {--}}
{{--                    $.ajax({--}}
{{--                        url: '{{ url('product/addToCart') }}/' + productId,--}}
{{--                        method: 'POST',--}}
{{--                        data: {--}}
{{--                            _token: '{{ csrf_token() }}'--}}
{{--                        },--}}
{{--                        success: function(response) {--}}
{{--                            if (response.success) {--}}
{{--                                window.location.href = '{{ url('product/cartItems') }}';--}}
{{--                            } else {--}}
{{--                                alert('Failed to add product to cart.');--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function(xhr, status, error) {--}}
{{--                            console.error('Error:', error);--}}
{{--                            alert('An error occurred. Please try again.');--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

{{--@endsection--}}


@extends('layouts.default')

@section('title', 'View Product')
@section('content')
    <div class="container mt-5">
        <div class="card">
            @if ($product->imagUrl || $product->otherimgs)
                <div id="carousel-{{ $product->id }}" class="carousel slide w-50 m-auto" data-ride="carousel">
                    <div class="carousel-inner">
                        @if ($product->imagUrl)
                            <div class="carousel-item active">
                                <img src="{{ $product->imagUrl }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                        @endif

                        @if ($product->otherimgs)
                            @foreach (json_decode($product->otherimgs, true) as $index => $imgUrl)
                                <div class="carousel-item {{ !$product->imagUrl && $index == 0 ? 'active' : '' }}">
                                    <img src="{{ $imgUrl }}" class="d-block w-100" alt="{{ $product->name }} - Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carousel-{{ $product->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-{{ $product->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="card-title mb-0">{{ $product->name }}</h3>
                    <h4 class="text-primary mb-0">${{ $product->Price }}</h4>
                </div>
                <p class="card-text"><strong>Category: </strong>{{ $product->category->name }}</p>
                <p class="card-text">{{ $product->description }}</p>
                <div class="d-flex">
                    <button type="button" class="btn btn-success w-auto add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                    <a href="{{ url('/') }}" class="btn btn-secondary mx-4">Back</a>
                </div>
            </div>
        </div>

        <!-- Available Products Section -->
        <div class="available-products-header">
            <h2 class="text-center mb-4 mt-3">Available Products</h2>
            <a href="{{ url('view-all') }}" class="btn view-all-btn" style="background-color: #3b82f6; color: white; border-radius: 50px;">{{ __('View All') }}</a>

        </div>

        <div id="message-container"></div>

        <!-- Products Carousel -->
        <div id="products-carousel" class="carousel slide mt-3" data-ride="carousel">
            <div class="carousel-inner" id="products-container">
                <!-- Products will be loaded dynamically -->
            </div>
            <a class="carousel-control-prev" href="#products-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#products-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <style>
        /* Slider Cards Styling */
        .carousel-item {
            display: flex;
            justify-content: space-around;
        }

        .carousel-item .card {
            width: 100%;
            max-width: 250px; /* Adjust as needed */
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .carousel-item .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .carousel-item .card img {
            height: 150px; /* Adjust image height */
            object-fit: cover;
        }

        .carousel-item .card .card-body {
            padding: 10px;
        }

        .carousel-item .card .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .carousel-item .card .card-text {
            font-size: 0.9rem;
            color: #6b7280; /* Gray */
        }

        .carousel-item .card .btn {
            position: absolute;
            top: -60px; /* Move above the card */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%);
            display: inline-block;
            background-color: #ffc107; /* Bootstrap warning color */
            color: #fff;
            border: none;
            padding: 8px 16px; /* Adjusted padding */
            font-size: 14px; /* Adjusted font size */
            border-radius: 80px; /* Rounded corners */
            cursor: pointer;
            transition: top 0.9s ease-out; /* Smooth animation */
            z-index: 1; /* Ensure it's above the card content */
        }

        .carousel-item .card:hover .btn {
            top: 150px;
            background-color: #ffca3a; /* Lighter Yellow */
            color: #fff;
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: #000; /* Adjust carousel control icon color */
        }

        .available-products-header {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .view-all-btn {
            margin-bottom: 20px;
            margin-left: auto;
            border-radius: 50px;
            background-color: #3b82f6; /* Blue */
            color: white;
            border: none;
        }

    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {

            // Function to load products via AJAX
            function loadProducts() {
                $.ajax({
                    url: '{{ url('api/products/list') }}',
                    method: 'GET',
                    success: function(response) {
                        console.log("API Response:", response);

                        let productsContainer = $('#products-container');
                        productsContainer.empty();

                        let products = response.products;
                        let numProducts = products.length;
                        let numItems = Math.ceil(numProducts / 4); // 4 products per carousel item

                        for (let i = 0; i < numItems; i++) {
                            let carouselItem = `
                                <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                    <div class="row">
                            `;

                            for (let j = 0; j < 4; j++) {
                                let product = products[i * 4 + j];
                                if (!product) break; // Break if there are no more products

                                carouselItem += `
                                    <div class="col-md-3 mb-4">
                                        <a href="{{ url('product/view') }}/${product.id}" class="card-link">
                                            <div class="card h-100">
                                                <img src="${product.imagUrl}" class="d-block w-100" alt="Product Image">
                                                <div class="card-body d-flex flex-column">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">${product.name}</h5>
                                                        <p class="card-text fw-bold text-dark">$${product.Price}</p>
                                                    </div>
                                                    <!-- Add to Cart Button -->
                                                    <button type="button" class="btn btn-warning w-100 add-to-cart-btn" data-product-id="${product.id}">Add to Cart</button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                `;
                            }

                            carouselItem += `
                                    </div>
                                </div>
                            `;
                            productsContainer.append(carouselItem);
                        }

                        // Attach the click event to the new add-to-cart buttons
                        $('.add-to-cart-btn').on('click', function() {
                            let productId = $(this).data('product-id');
                            $.ajax({
                                url: '{{ url('product/addToCart') }}/' + productId,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log(response);
                                    let messageContainer = $('#message-container');
                                    messageContainer.empty();
                                    let alertMessage = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                        'Product added to cart successfully!' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>');
                                    if (response.success) {
                                        messageContainer.append(alertMessage);
                                        setTimeout(function() {
                                            alertMessage.alert('close');
                                        }, 5000);
                                    } else {
                                        alert('Failed to add product to cart.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Failed to add product to cart:', error);
                                    alert('Failed to add product to cart.');
                                }
                            });
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load products:', error);
                    }
                });
            }

            // Load products when document is ready
            loadProducts();

        });
    </script>
@endsection
