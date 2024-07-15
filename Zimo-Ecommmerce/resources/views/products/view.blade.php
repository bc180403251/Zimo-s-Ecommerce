@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('Product Details') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Product Image Carousel -->
                            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ $product->imagUrl }}" class="d-block w-100 carousel-image" alt="{{ $product->name }}">
                                    </div>
                                    @if ($product->otherimgs)
                                        @foreach (json_decode($product->otherimgs, true) as $index => $image)
                                            <div class="carousel-item">
                                                <img src="{{ $image }}" class="d-block w-100 carousel-image" alt="{{ $product->name }} - Image {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <!-- Product Details -->
                            <div class="mb-3">
                                <h2>{{ $product->name }}</h2>
                                <p><strong>{{ __('Price') }}:</strong> ${{ $product->Price }}</p>
                                <p><strong>{{ __('Category') }}:</strong> {{ $product->category->name }}</p>
                            </div>

                            <!-- Product Description -->
                            <div class="mb-3">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        <!-- Back to List Button -->
                        <div class="card-footer text-right">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <style>
        /* Style to constrain carousel images */
        .carousel-image {
            max-height: 500px; /* Set a maximum height for the images */
            width: auto; /* Ensure images adjust their width proportionally */
            margin: auto; /* Center the images horizontally */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product-carousel').carousel();
        });
    </script>
@endsection
