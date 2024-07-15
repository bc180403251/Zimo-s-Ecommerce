{{--@extends('layouts.default')--}}

{{--@section('title', 'Search Results')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h1>Search Results for "<span id="search-query">{{ $query }}</span>"</h1>--}}
{{--        <input type="hidden" id="hidden-query" value="{{ $query }}">--}}
{{--        <div id="search-results" class="row"></div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            let query = $('#hidden-query').val();--}}
{{--            $('#search-input').val(query);--}}

{{--            $.ajax({--}}
{{--                url: '{{ route('ajax.search') }}',--}}
{{--                type: 'GET',--}}
{{--                data: { query: query },--}}
{{--                success: function(products) {--}}
{{--                    let resultsContainer = $('#search-results');--}}
{{--                    resultsContainer.empty();--}}

{{--                    if (products.length === 0) {--}}
{{--                        resultsContainer.append('<p>No products found.</p>');--}}
{{--                    } else {--}}
{{--                        products.forEach(function(product) {--}}
{{--                            let productCard = `--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card mb-4">--}}
{{--                                    <img src="${product.imagUrl}" class="card-img-top" alt="${product.name}">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">${product.name}</h5>--}}
{{--                                        <p class="card-text">${product.description.substring(0, 100)}</p>--}}
{{--                                        <a href="{{ url('product/view') }}/${product.id}" class="btn btn-primary">View Product</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        `;--}}
{{--                            resultsContainer.append(productCard);--}}
{{--                        });--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}

@extends('layouts.default')

@section('title', 'Search Results')

@section('content')
    <div class="container">
        <h1>Search Results for "<span id="search-query">{{ $query }}</span>"</h1>
        <input type="hidden" id="hidden-query" value="{{ $query }}">
        <div id="search-results" class="row"></div>
    </div>

    <script>
        $(document).ready(function() {
            let query = $('#hidden-query').val();
            $('#search-input').val(query);

            $.ajax({
                url: '{{ route('ajax.search') }}',
                type: 'GET',
                data: { query: query },
                success: function(products) {
                    let resultsContainer = $('#search-results');
                    resultsContainer.empty();

                    if (products.length === 0) {
                        resultsContainer.append('<p>No products found.</p>');
                    } else {
                        products.forEach(function(product) {
                            let images = product.imagUrl ? [product.imagUrl] : [];
                            if (product.otherimgs) {
                                images = images.concat(JSON.parse(product.otherimgs));
                            }

                            let carouselItems = images.map((image, index) => {
                                return `
                                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                        <img src="${image}" class="d-block w-100" alt="${product.name}">
                                    </div>
                                `;
                            }).join('');

                            let productCard = `
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div id="carousel-${product.id}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                ${carouselItems}
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
                                        <div class="card-body">
                                            <h5 class="card-title">${product.name}</h5>
                                            <p class="card-text">${product.description.substring(0, 100)}</p>
                                            <a href="{{ url('product/view') }}/${product.id}" class="btn btn-primary">View Product</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            resultsContainer.append(productCard);
                        });
                    }
                }
            });
        });
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection

