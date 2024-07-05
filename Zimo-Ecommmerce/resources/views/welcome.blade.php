'@extends('layouts.default')

@section('title', 'Product')

@section('content')
    <div class="container mt-5">

        @if(session('success'))
            {{session('success')}}
        @endif

        <div id="message-container"></div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Product List</h1>
            <select id="category-select" class="form-select w-25">
                <option value="">All categories</option>
            </select>
        </div>
        <div id="products-container" class="row"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        console.log(response);

                        // Populate category dropdown
                        categorySelect.append('<option value="">All Categories</option>');
                        response.categories.forEach(function(category) {
                            categorySelect.append(`<option value="${category.name}">${category.name}</option>`);
                        });

                        categorySelect.val(categoryName);
                        let selectedCategoryName = categoryName ? categorySelect.find('option:selected').text() : 'All categories';
                        $('.d-flex h1').text(`Product List - ${selectedCategoryName}`);

                        if (categoryName) {
                            response.products.forEach(function(category) {
                                category.products.forEach(function(product) {
                                    let productCard = `
                                        <div class="col-md-3 mb-4">
                                            <div class="card h-100">
                                                <img src="${product.imagUrl}" class="card-img-top" alt="Product Logo">
                                                <div class="card-body d-flex flex-column">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">${product.name}</h5>
                                                        <p class="card-text fw-bold">$${product.Price}</p>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <a href="{{ url('product/view') }}/${product.id}" class="btn btn-primary w-100 mb-2">View Product</a>
                                                        <button type="button" class="btn btn-success w-100 add-to-cart-btn" data-product-id="${product.id}">Add to Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    productsContainer.append(productCard);
                                });
                            });
                        } else {
                            response.products.forEach(function(product) {
                                let productCard = `
                                    <div class="col-md-3 mb-4">
                                        <div class="card h-100">
                                            <img src="${product.imagUrl}" class="card-img-top" alt="Product Logo">
                                            <div class="card-body d-flex flex-column">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title">${product.name}</h5>
                                                    <p class="card-text fw-bold">$${product.Price}</p>
                                                </div>
                                                <div class="mt-auto">
                                                    <a href="{{ url('product/view') }}/${product.id}" class="btn btn-primary w-100 mb-2">View Product</a>
                                                    <button type="button" class="btn btn-success w-100 add-to-cart-btn" data-product-id="${product.id}">Add to Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                productsContainer.append(productCard);
                            });
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
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while fetching the products. Please try again.');
                    }
                });
            }

            function storeVisitor(visitorId = null) {
                let data = visitorId ? { visitor_id: visitorId } : {};
                $.ajax({
                    url: '{{ url('api/users/storeVisitor') }}',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.visitor_id) {
                            localStorage.setItem('visitor_id', response.visitor_id);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }



            // check for visitor in local storage
            let storedVisitorId= localStorage.getItem('visitor_id');
            if(storedVisitorId){
                storeVisitor(storedVisitorId)
            }else{
                storeVisitor();
            }

            // Load products on page load
            $('#category-select').on('change', function() {
                let selectedCategoryName = $(this).val();
                localStorage.setItem('selected_category', selectedCategoryName)
                loadProducts(selectedCategoryName);
            });
            let savedName=localStorage.getItem('selected_category')
            if(savedName){
                $('#category-select').val(savedName);
                loadProducts(savedName);
            }else{
              loadProducts();
             }
            // Save category filter value in local storage when changed
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
'
