@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('Update Product') }}</h1>
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
                        <div class="card-body">
                            <!-- Product Image -->
                            <div class="text-center mb-4">
                                @if ($product->imagUrl)
                                    <img src="{{$product->imagUrl}}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 300px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>

                            <!-- Update Form -->
                            <form id="update-product-form">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />

                                <!-- Product Image Upload -->
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image" class="form-control-file" id="image" accept="image/*">
                                </div>

                                <!-- Product Name -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
                                </div>

                                <!-- Product Price -->
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price" value="{{ $product->Price }}" required>
                                </div>

                                <!-- Product Category -->
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control" id="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Product Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" rows="4" required>{{ $product->description }}</textarea>
                                </div>

                                <!-- Progress Bar -->
                                <div class="form-group">
                                    <div id="progress-container" class="progress" style="display: none;">
                                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="update-product-btn">{{ __('Update Product') }}</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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

    <!-- Firebase and AJAX Script -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-app.js";
        import { getStorage, ref, uploadBytesResumable, getDownloadURL } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-storage.js";

        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBTm4SmqiK639teAdxi8lA4Bsv9PS9G3ok",
            authDomain: "zimo-ecomerce.firebaseapp.com",
            projectId: "zimo-ecomerce",
            storageBucket: "zimo-ecomerce.appspot.com",
            messagingSenderId: "565335075487",
            appId: "1:565335075487:web:5482725261c94eabaf10aa",
            measurementId: "G-7RE4QRY6E8"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const storage = getStorage(app);

        $(document).ready(function() {
            $('#update-product-btn').on('click', function () {
                // Gather form values
                let name = $('#name').val();
                let price = $('#price').val();
                let category = $('#category').val();
                let description = $('#description').val();
                let imagUrl = '{{ $product->imagUrl }}';

                // Check if a new image file is selected
                let file = $('#image')[0].files[0];
                if (file) {
                    // Show progress bar
                    $('#progress-container').show();

                    // Upload image to Firebase Storage
                    const storageRef = ref(storage, 'images/' + file.name);
                    const uploadTask = uploadBytesResumable(storageRef, file);

                    // Update progress bar
                    uploadTask.on('state_changed',
                        function(snapshot) {
                            const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                            $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(Math.round(progress) + '%');
                        },
                        function(error) {
                            // Handle upload error
                            console.error('Error uploading image:', error);
                            alert('An error occurred while uploading the image. Please try again.');
                        },
                        async function() {
                            // Upload completed successfully
                            const downloadURL = await getDownloadURL(uploadTask.snapshot.ref);

                            // Send AJAX request with all form data including the image URL
                            let data = {
                                name: name,
                                Price: price,
                                category_id: category,
                                description: description,
                                imagUrl: downloadURL,
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                _method: 'PATCH'
                            };

                            $.ajax({
                                url: '{{ route('products.update', $product->id) }}',
                                method: 'POST',
                                data: data,
                                success: function (response) {
                                    displaySuccessMessage();
                                },
                                error: function (xhr, status, error) {
                                    handleAjaxError(xhr);
                                }
                            });
                        }
                    );
                } else {
                    // Send AJAX request without a new image
                    let data = {
                        name: name,
                        Price: price,
                        category_id: category,
                        description: description,
                        imagUrl: imagUrl,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'PATCH'
                    };

                    $.ajax({
                        url: '{{ route('products.update', $product->id) }}',
                        method: 'POST',
                        data: data,
                        success: function (response) {
                            displaySuccessMessage();
                        },
                        error: function (xhr, status, error) {
                            handleAjaxError(xhr);
                        }
                    });
                }
            });

            function displaySuccessMessage() {
                let messageContainer = $('#message-container');
                messageContainer.empty();
                let messageAlert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    'Product updated successfully!' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
                messageContainer.append(messageAlert);

                setTimeout(function () {
                    messageAlert.alert('close');
                    window.location.href = '{{ route('products.index') }}'; // Redirect to product list page
                }, 3000); // 3 seconds delay before redirecting
            }

            function handleAjaxError(xhr) {
                console.error('Error:', xhr);
                let errors = xhr.responseJSON?.errors;
                let message = 'An error occurred. Please try again.';
                if (errors) {
                    message = '<ul>';
                    $.each(errors, function (key, error) {
                        message += '<li>' + error + '</li>';
                    });
                    message += '</ul>';
                }
                let messageContainer = $('#message-container');
                messageContainer.empty();
                let messageAlert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
                messageContainer.append(messageAlert);
            }
        });
    </script>
@endsection
