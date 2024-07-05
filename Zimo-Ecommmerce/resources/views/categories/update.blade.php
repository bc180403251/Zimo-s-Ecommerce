@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('Update Category') }}</h1>
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
                            <div id="message-container"></div>
                            <form id="category-form" method="POST">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                {{-- @csrf --}}
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" placeholder="Enter category name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter category description" required>{{ $category->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">{{ __('Parent Category') }}</label>
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="">{{ __('None') }}</option>
                                        @foreach($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}" @if($category->parent_id == $parentCategory->id) selected @endif>{{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </form>

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
        $(document).ready(function () {
            $('#category-form').submit(function (e) {
                e.preventDefault();

                let data = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $('#name').val(),
                    description: $('#description').val(),
                    parent_id: $('#parent_id').val()
                };

                $.ajax({
                    url: '{{ route("categories.update", $category->id) }}',
                    method: 'POST',
                    data: data,
                    success: function (response) {
                        $('#message-container').html('<div class="alert alert-success">' + response.success + '</div>');
                        setTimeout(function (){
                            $('#message-container').alert('close')
                        }, 4000)


                    },
                    error: function (error) {

                        console.log('error', error);
                        let errors = error.responseJSON.errors;
                        let message = '';
                        for (let field in errors) {
                            message += errors[field][0] + '<br>';
                        }
                        $('#message-container').html('<div class="alert alert-danger">' + message + '</div>');
                    }
                });
            });
        });
    </script>
@endsection
