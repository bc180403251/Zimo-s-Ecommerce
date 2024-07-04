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
                            <!-- Product Image -->
                            <div class="text-center mb-4">
                                <img src="{{ $product->imagUrl }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 300px;">
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
@endsection
