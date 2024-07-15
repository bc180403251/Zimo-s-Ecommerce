@extends('layouts.default')

@section('title', 'Product')

@section('content')
    <div class="container mt-5">

        @if(session('success'))
            {{session('success')}}
        @endif

        <div id="message-container"></div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Available Products</h1>
            <select id="category-select" class="form-select w-25">
                <option value="">All categories</option>
            </select>
        </div>
        <div id="products-container" class="row"></div>
    </div>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
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

        .card-body:hover .add-to-cart-btn {
            top: 150px;
        }


        .card {
            cursor: pointer;
        }

        .card h5, .card p {
            pointer-events: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadProducts(categoryName = '') {
                $.ajax({
                    url: '{{ url('api/products/list') }}',
                    method: 'GET',
                    data: {
                        name: categoryName
                    },
                    success: function(response) {
                        let productsContainer = $('#products-container');
                        let categorySelect = $('#category-select');
                        productsContainer.empty();
                        categorySelect.empty();

                        // Populate category dropdown
                        categorySelect.append('<option value="">All Categories</option>');
                        response.categories.forEach(function(category) {
                            categorySelect.append(`<option value="${category.name}">${category.name}</option>`);
                        });

                        categorySelect.val(categoryName);
                        let selectedCategoryName = categoryName ? categorySelect.find('option:selected').text() : 'All categories';
                        $('.d-flex h1').text(`Available Products - ${selectedCategoryName}`);

                        function createProductCard(product) {
                            let productCard = `
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100" data-product-id="${product.id}">
                                        <div id="carousel-${product.id}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="${product.imagUrl}" class="d-block w-100" alt="Product Image">
                                                </div>
                            `;

                            let otherImgsArray = [];
                            if (product.otherimgs) {
                                try {
                                    otherImgsArray = JSON.parse(product.otherimgs);
                                } catch (e) {
                                    console.error("Error parsing otherimgs:", e);
                                }
                            }

                            otherImgsArray.forEach(function(imgUrl, index) {
                                productCard += `
                                    <div class="carousel-item">
                                        <img src="${imgUrl.trim()}" class="d-block w-100" alt="Product Image ${index + 1}">
                                    </div>
                                `;
                            });

                            productCard += `
                                            </div>
                                            <a class="carousel-control-prev" href="#carousel-${product.id}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-${product.id}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">${product.name}</h5>
                                                <p class="card-text fw-bold">$${product.Price}</p>
                                            </div>
                                            <div class="mt-auto">
                                                <button type="button" class="btn btn-success w-100 add-to-cart-btn" data-product-id="${product.id}">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            return productCard;
                        }

                        if (categoryName) {
                            response.products.forEach(function(category) {
                                category.products.forEach(function(product) {
                                    productsContainer.append(createProductCard(product));
                                });
                            });
                        } else {
                            response.products.forEach(function(product) {
                                productsContainer.append(createProductCard(product));
                            });
                        }

                        // Attach the click event to the new add-to-cart buttons
                        $('.add-to-cart-btn').on('click', function(event) {
                            event.stopPropagation();
                            let productId = $(this).data('product-id');
                            $.ajax({
                                url: '{{ url('product/addToCart') }}/' + productId,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
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
                                        console.error('Failed to add product to cart.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    alert('An error occurred. Please try again.');
                                }
                            });
                        });

                        // Make the entire card clickable
                        $('.card').on('click', function() {
                            let productId = $(this).data('product-id');
                            window.location.href = '{{ url('product/view') }}/' + productId;
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while fetching the products. Please try again.');
                    }
                });
            }

            $('#category-select').on('change', function() {
                let selectedCategoryName = $(this).val();
                localStorage.setItem('selected_category', selectedCategoryName);
                loadProducts(selectedCategoryName);
            });

            let savedName = localStorage.getItem('selected_category');
            if (savedName) {
                $('#category-select').val(savedName);
                loadProducts(savedName);
            } else {
                loadProducts();
            }

            $('#category-select').on('change', function() {
                let selectedCategoryName = $(this).val();
                if (selectedCategoryName === "") {
                    localStorage.removeItem('selected_category');
                } else {
                    localStorage.setItem('selected_category', selectedCategoryName);
                }
                loadProducts(selectedCategoryName);
            });
        });
    </script>
@endsection
