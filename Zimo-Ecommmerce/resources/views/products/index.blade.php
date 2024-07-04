@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Products') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="{{route('products.create')}}" class="btn btn-outline-secondary">{{ __('Add Product') }}</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div id="message-container"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr id="product-{{ $product->id }}">
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>${{ $product->Price }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm mx-1">{{ __('View') }}</a>
                                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning btn-sm mx-1">{{ __('Update') }}</a>
                                                <button type="button" class="btn btn-danger btn-sm mx-1 delete-btn" data-product-id="{{ $product->id }}">{{ __('Delete') }}</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- AJAX Script for Delete -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function () {
                if (confirm('Are you sure you want to delete this product?')) {
                    let productId = $(this).data('product-id');

                    $.ajax({
                        url: '/products/delete/' + productId,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                // Display success message
                                let messageContainer = $('#message-container');
                                messageContainer.empty();
                                let messageAlert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    'Product deleted successfully!' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span></button> '+
                                    '</div>');
                                messageContainer.append(messageAlert);

                                setTimeout(function (){
                                    messageAlert.alert('close')
                                }, 5000)

                                // Remove the deleted product row from the table
                                $('#product-' + productId).remove();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
