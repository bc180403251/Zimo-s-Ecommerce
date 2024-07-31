{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--    <!-- Content Header (Page header) -->--}}
{{--    <div class="content-header">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row mb-2">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <h1>{{ __('Banners') }}</h1>--}}
{{--                </div><!-- /.col -->--}}
{{--                <div class="col-sm-6 text-right">--}}
{{--                    <a href="{{route('banners.create')}}" class="btn btn-outline-secondary">{{ __('Add Banner') }}</a>--}}
{{--                </div><!-- /.col -->--}}
{{--            </div><!-- /.row -->--}}
{{--        </div><!-- /.container-fluid -->--}}
{{--    </div>--}}
{{--    <!-- /.content-header -->--}}
{{--    @if(Session::has('message'))--}}
{{--        <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--            {{ Session::get('message') }}--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                <span aria-hidden="true">&times;</span>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--        <script>--}}
{{--            setTimeout(function() {--}}
{{--                $('.alert').alert('close');--}}
{{--            }, 3000);--}}
{{--        </script>--}}
{{--    @endif--}}
{{--    <div id="progress-container" class="progress" style="display: none;">--}}
{{--        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"--}}
{{--             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">--}}
{{--            0%--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Main content -->--}}
{{--    <div id="message-container"></div>--}}
{{--    <div class="content">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body p-0">--}}
{{--                            <table class="table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Name</th>--}}
{{--                                    <th>details</th>--}}
{{--                                    <th>status</th>--}}
{{--                                    <th class="text-center">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($banners as $banner)--}}
{{--                                    <tr id="banner-{{ $banner->id }}">--}}
{{--                                        <td>{{ $banner->name }}</td>--}}
{{--                                        <td>{{ $banner->details }}</td>--}}


{{--                                        <td>--}}

{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-body -->--}}

{{--                        <div class="card-footer clearfix">--}}
{{--                            {{ $banners->links() }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /.row -->--}}
{{--        </div><!-- /.container-fluid -->--}}
{{--    </div>--}}
{{--    <!-- AJAX Script for Delete -->--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
{{--    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.delete-btn').on('click', function () {--}}
{{--                if (confirm('Are you sure you want to delete this product?')) {--}}
{{--                    let bannerId = $(this).data('banner-id');--}}
{{--                    let progressContainer = $('#progress-container');--}}
{{--                    let progressBar = $('#progress-bar');--}}

{{--                    progressContainer.show();--}}
{{--                    progressBar.css('width', '0%').attr('aria-valuenow', 0).text('0%');--}}

{{--                    let interval = setInterval(function() {--}}
{{--                        let progress = parseInt(progressBar.attr('aria-valuenow'));--}}
{{--                        if (progress < 100) {--}}
{{--                            progress += 10;--}}
{{--                            progressBar.css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');--}}
{{--                        } else {--}}
{{--                            clearInterval(interval);--}}
{{--                            progressContainer.hide();--}}

{{--                            $.ajax({--}}
{{--                                url: '/banners/delete/' + bannerId,--}}
{{--                                method: 'DELETE',--}}
{{--                                data: {--}}
{{--                                    _token: '{{ csrf_token() }}'--}}
{{--                                },--}}
{{--                                success: function (response) {--}}
{{--                                    if (response.success) {--}}
{{--                                        // Display success message--}}
{{--                                        let messageContainer = $('#message-container');--}}
{{--                                        messageContainer.empty();--}}
{{--                                        let messageAlert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +--}}
{{--                                            'Product deleted successfully!' +--}}
{{--                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +--}}
{{--                                            '<span aria-hidden="true">&times;</span></button>' +--}}
{{--                                            '</div>');--}}
{{--                                        messageContainer.append(messageAlert);--}}

{{--                                        setTimeout(function () {--}}
{{--                                            messageAlert.alert('close');--}}
{{--                                        }, 5000);--}}

{{--                                        // Remove the deleted product row from the table--}}
{{--                                        $('#banner-' + bannerId).remove();--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                error: function (xhr, status, error) {--}}
{{--                                    console.error('Error:', error);--}}
{{--                                    alert('An error occurred. Please try again.');--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    }, 300); // Update progress every 100ms--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    @endsection--}}



@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Banners') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="{{ route('banners.create') }}" class="btn btn-outline-secondary">{{ __('Add Banner') }}</a>
                    <a href="{{route('banners.export')}}" class="btn btn-default">{{ __('Export') }}</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal">{{ __('Import') }}</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        </script>
    @endif
    <div id="progress-container" class="progress" style="display: none;">
        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            0%
        </div>
    </div>

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
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr id="banner-{{ $banner->id }}">
                                        <td>{{ $banner->name }}</td>
                                        <td>{{ $banner->details }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input toggle-status"
                                                       id="toggle-status-{{ $banner->id }}" {{ $banner->status ? 'checked' : '' }}
                                                       data-banner-id="{{ $banner->id }}">
                                                <label class="custom-control-label" for="toggle-status-{{ $banner->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{route('banners.show', $banner->id)}}" class="btn btn-info btn-sm mx-1">{{ __('View') }}</a>
                                                <a href="{{route('banners.edit', $banner->id)}}" class="btn btn-warning btn-sm mx-1">{{ __('Update') }}</a>
                                                <button type="button" class="tn btn-danger btn-sm mx-1 delete-btn" data-banner-id="{{ $banner->id }}">{{ __('Delete') }}</button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $banners->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

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
                <form id="importForm" action="{{route('banners.imports')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">{{ __('Upload Excel File') }}</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div id="modal-progress-container" class="progress" style="display: none;">
                            <div id="modal-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX request to toggle banner status
            $('.toggle-status').on('change', function () {
                let bannerId = $(this).data('banner-id');
                let newStatus = $(this).prop('checked') ? 1 : 0; // 1 for true, 0 for false

                $.ajax({
                    url: '/banner/status/' + bannerId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function (response) {
                        // Optionally update UI or show feedback
                        console.log(response); // Log the response for debugging
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // AJAX request to delete banner
            $('.delete-btn').on('click', function () {
                if (confirm('Are you sure you want to delete this banner?')) {
                    let bannerId = $(this).data('banner-id');
                    let progressContainer = $('#progress-container');
                    let progressBar = $('#progress-bar');

                    progressContainer.show();
                    progressBar.css('width', '0%').attr('aria-valuenow', 0).text('0%');

                    let interval = setInterval(function() {
                        let progress = parseInt(progressBar.attr('aria-valuenow'));
                        if (progress < 100) {
                            progress += 10;
                            progressBar.css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
                        } else {
                            clearInterval(interval);
                            progressContainer.hide();

                            $.ajax({
                                url: '/banners/delete/' + bannerId,
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
                                            'Banner deleted successfully!' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                            '<span aria-hidden="true">&times;</span></button>' +
                                            '</div>');
                                        messageContainer.append(messageAlert);

                                        setTimeout(function () {
                                            messageAlert.alert('close');
                                        }, 5000);

                                        // Remove the deleted banner row from the table
                                        $('#banner-' + bannerId).remove();
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error('Error:', error);
                                    alert('An error occurred. Please try again.');
                                }
                            });
                        }
                    }, 300); // Update progress every 100ms
                }
            });
            $('#importForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the default way
                let formData = new FormData(this);
                let progressContainer = $('#modal-progress-container');
                let progressBar = $('#modal-progress-bar');

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
