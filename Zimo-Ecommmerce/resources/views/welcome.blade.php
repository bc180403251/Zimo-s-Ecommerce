@extends('layouts.default')

@section('title', 'Home')

@section('content')
{{--     Banner Section--}}
    <section class="banner-section">
        <div class="content">
            <h2>Casual Sports Shoes Here</h2>
            <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
            <button href="{{url('view-all')}}">Order Now</button>
        </div>
    </section>
{{--     Features Section--}}
    <section class="features-section">
        <div class="feature">
            <i class="fa fa-truck"></i>
            <h3>Fast Delivery</h3>
            <p>Get your products quickly with our fast delivery service.</p>
        </div>
        <div class="feature">
            <i class="fa fa-tags"></i>
            <h3>Special Discount</h3>
            <p>Enjoy amazing discounts on your favorite items.</p>
        </div>
        <div class="feature">
            <i class="fa fa-lock"></i>
            <h3>Secure Checkout</h3>
            <p>Shop with confidence with our secure checkout process.</p>
        </div>
        <div class="feature">
            <i class="fa fa-undo"></i>
            <h3>Money Returns</h3>
            <p>Easy returns and refunds if you're not satisfied.</p>
        </div>
    </section>
    <div class="container mt-5">

{{--         Categories Section--}}
        <h2 class="text-center mb-4">Categories</h2>
        <div id="categories-carousel" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner" id="categories-container">
                <!-- Placeholder for categories -->
            </div>
            <a class="carousel-control-prev" href="#categories-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#categories-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="available-products-header">
            <h2 class="text-center mb-4 mt-3">Available Products</h2>
            <a href="{{ url('view-all') }}" class="btn view-all-btn">{{ __('View All') }}</a>
        </div>
        <div id="message-container"></div>

        <!-- Products Carousel -->
        <div id="products-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" id="products-container">
                <!-- Placeholder for products -->
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

        <!-- Customer Reviews Section -->
        <h2 class="text-center mt-5 mb-4">Customer Reviews</h2>
        <div id="reviews-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" id="reviews-container">
                <!-- Placeholder for customer reviews -->
            </div>
            <a class="carousel-control-prev" href="#reviews-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#reviews-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            margin-bottom: 20px;
            border-radius: 20px;
            overflow: hidden;
            position: relative; /* Needed for absolute positioning */
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .carousel-item img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Allow the card body to expand */
        }
        .card-link {
            text-decoration: none;
            color: inherit;
            position: relative; /* Needed for z-index stacking */
        }
        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }
        .review-card {
            display: flex;
            align-items: center;
            margin-bottom: 70px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            height: 150px; /* Fixed height for review cards */
            overflow: hidden; /* Ensure content does not overflow */
        }
        .review-card img {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            object-fit: cover;
            margin-right: 15px;
        }
        .review-card .review-content {
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Ensure text does not overflow */
        }
        .review-card .review-content .name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Add to Cart Button Styling */
        .add-to-cart-btn {
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

        .card:hover .add-to-cart-btn {
            top: 150px; /* Show button on hover */
        }

        .banner-section .content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            color: #ffffff;
        }
        .banner-section .content h2 {
            font-size: 3rem;
            max-width: 600px;
            line-height: 70px;
        }
        .banner-section .content p {
            font-weight: 300;
            max-width: 600px;
            margin-top: 15px;
        }
        .banner-section .content button {
            padding: 12px 30px;
            border: 3px solid #3b82f6; /* Blue */
            font-size: 16px;
            border-radius: 6px;
            margin-top: 38px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s ease;
            background: #93c5fd; /* Light Blue */
            color: black;
        }
        .banner-section .content button:hover {
            color: white;
            background: #3b82f6; /* Blue */
            border-color: #3b82f6; /* Blue */
        }
        .features-section {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 40px 20px;
            background-color: #f3f4f6; /* Light Gray */
        }
        .feature {
            text-align: center;
            width: 200px;
        }
        .feature i {
            font-size: 40px;
            color: #1e3a8a; /* Dark Blue */
            margin-bottom: 10px;
        }
        .feature h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #1e3a8a; /* Dark Blue */
        }
        .feature p {
            color: #6b7280; /* Gray */
        }
        .view-all-btn {
            margin-bottom: 20px;
            margin-left: auto;
            border-radius: 50px;
            background-color: #3b82f6; /* Blue */
            color: white;
            border: none;
        }
        .available-products-header {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        /* Categories Carousel Styling */
            .category-card {
                position: relative;
                text-align: center;
                color: white;
                max-width: 250px; /* Adjusted max-width */
                height: 250px; /* Adjusted height */
                background-size: cover;
                background-position: center;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                margin-right:2px; /* Adjusted margin */
                /*display: flex;*/
            }

        .category-card .category-name {
            position: absolute;
            bottom: 5px; /* Adjusted position */
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            padding: 5px;
            font-size: 1rem; /* Adjusted font size */
            font-weight: bold;
        }

        /* Ensure images in category cards adjust */
        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .card {
            cursor: pointer;
        }

        .card h5, .card p {
            pointer-events: none;
        }

    </style>
    <script>
        $(document).ready(function() {
            function loadCategories() {
                $.ajax({
                    url: '{{ url('api/categories/parents') }}',
                    method: 'GET',
                    success: function(response) {
                        let categoriesContainer = $('#categories-container');
                        categoriesContainer.empty();

                        let categories = response.categories;
                        let numCategories = categories.length;
                        let numItems = Math.ceil(numCategories / 4); // 3 categories per carousel item

                        for (let i = 0; i < numItems; i++) {
                            let carouselItem = `
                                <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                    <div class="row">
                            `;

                            for (let j = 0; j < 4; j++) {
                                let category = categories[i * 4 + j];
                                if (!category) break; // Break if there are no more categories

                                carouselItem += `
                                    <div class="col-md-3 mb-3 ">
                                        <div class="category-card" style="background-image: url('${category.imgUrl}');">
                                            <div class="category-name">${category.name}</div>
                                        </div>
                                    </div>
                                `;
                            }

                            carouselItem += `
                                    </div>
                                </div>
                            `;
                            categoriesContainer.append(carouselItem);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load categories:', error);
                    }
                });
            }

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
                                                        <p class="card-text fw-bold color-darkorange">$${product.Price}</p>
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
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
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

            loadCategories();
            loadProducts();

            // Load customer reviews
            function loadReviews() {
                $.ajax({
                    url: '{{ url('api/users/reviews') }}',
                    method: 'GET',
                    success: function(response) {
                        let reviewsContainer = $('#reviews-container');
                        reviewsContainer.empty();

                        let numReviews = response.comments.length;
                        let numPairs = Math.ceil(numReviews / 2);

                        for (let i = 0; i < numPairs; i++) {
                            let review1 = response.comments[i * 2];
                            let review2 = response.comments[i * 2 + 1];

                            let reviewPair = `
                                <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="review-card">
                                                <img src="${review1.user.profile}" alt="Customer Image">
                                                <div class="review-content">
                                                    <div class="name">${review1.user.name}</div>
                                                    <div class="text">${review1.comments}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="review-card">
                                                <img src="${review2.user.profile}" alt="Customer Image">
                                                <div class="review-content">
                                                    <div class="name">${review2.user.name}</div>
                                                    <div class="text">${review2.comments}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            reviewsContainer.append(reviewPair);
                        }

                        $('#reviews-carousel').carousel();
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load reviews:', error);
                    }
                });
            }

            loadReviews();
        });
    </script>
@endsection


