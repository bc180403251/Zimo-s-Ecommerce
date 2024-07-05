@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('Create Category') }}</h1>
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
                            <form id="category-form">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter category description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">{{ __('Parent Category') }}</label>
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="">{{ __('None') }}</option>
                                        @foreach($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </form>
                            <div id="message-container"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- AJAX Script for Form Submission -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category-form').on('submit', function(event) {
                event.preventDefault();

                let data = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $('#name').val(),
                    description: $('#description').val(),
                    parent_id: $('#parent_id').val()
                };

                $.ajax({
                    url: '{{ route("categories.store") }}',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        // Display success message
                        let messageContainer = $('#message-container');
                        messageContainer.empty();
                        let messageAlert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            'Category added successfully!' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button>' +
                            '</div>');
                        messageContainer.append(messageAlert);

                        setTimeout(function (){
                            messageAlert.alert('close');
                        }, 5000);

                        // Reset the form
                        $('#category-form')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
