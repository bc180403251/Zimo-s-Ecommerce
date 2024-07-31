@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Categories') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="{{route('categories.create')}}" class="btn btn-outline-secondary">{{ __('Add Category') }}</a>
                    <a href="{{route('categories.export')}}" class="btn btn-default">{{ __('Export') }}</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal">{{ __('Import') }}</button>
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
                                    <th>Parent Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr id="category-{{ $category->id }}">
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{$category->parent ? $category->parent->name : 'None'  }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{route('categories.view', $category->id)}}" class="btn btn-info btn-sm mx-1">{{ __('View') }}</a>
                                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning btn-sm mx-1">{{ __('Update') }}</a>
                                                <button type="button" class="btn btn-danger btn-sm mx-1 delete-btn" data-category-id="{{ $category->id }}">{{ __('Delete') }}</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">{{ __('Import Categories') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="importForm" action="{{route('categories.imports')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">{{ __('Upload Excel File') }}</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div id="progress-container" class="progress" style="display: none;">
                            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                0%
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- AJAX Script for Delete -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.delete-btn').on('click', function () {
                if (confirm('Are you sure you want to delete this category?')) {
                    let categoryId = $(this).data('category-id');

                    $.ajax({
                        url: '/categories/delete/' + categoryId,
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
                                    'Category deleted successfully!' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span></button> '+
                                    '</div>');
                                messageContainer.append(messageAlert);

                                setTimeout(function (){
                                    messageAlert.alert('close')
                                }, 5000)

                                // Remove the deleted category row from the table
                                $('#category-' + categoryId).remove();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });

            $('#importForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the default way
                let formData = new FormData(this);
                let progressContainer = $('#progress-container');
                let progressBar = $('#progress-bar');

                progressContainer.show();
                progressBar.css('width', '0%').attr('aria-valuenow', 0).text('0%');

                let interval = setInterval(function() {
                    let progress = parseInt(progressBar.attr('aria-valuenow'));
                    if (progress < 100) {
                        progress += 1;
                        progressBar.css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
                    } else {
                        clearInterval(interval);
                        progressContainer.hide();
                        $('#importModal').modal('hide');
                        location.reload(); // Reload the page
                    }
                }, 30); // Update progress every 30ms

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Import success', response);
                        // Additional actions on success can be added here
                    },

                });
            });
        });
    </script>
@endsection
