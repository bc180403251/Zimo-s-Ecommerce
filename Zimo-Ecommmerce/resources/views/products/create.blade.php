@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('Create Product') }}</h1>
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
                            <form id="product-form">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="image">{{ __('Product Image') }}</label>
                                    <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter product name" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">{{ __('Price') }}</label>
                                    <input type="number" name="price" class="form-control" id="price" placeholder="Enter product price" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter product description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category">{{ __('Category') }}</label>
                                    <select name="category_id" class="form-control" id="category" required>
                                        <option value="">{{ __('Select Category') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
@endsection

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

    $('#product-form').on('submit', function(e) {
        e.preventDefault();

        // const formData = new FormData(this);
        const file = document.getElementById('image').files[0];
        const storageRef = ref(storage, 'images/' + file.name);
        const uploadTask = uploadBytesResumable(storageRef, file);

        uploadTask.on('state_changed',
            function(snapshot) {
                // Progress handling (optional)
            },
            function(error) {
                // Handle error
                console.error('Upload failed:', error);
            },
            function() {
                // Upload completed successfully
                getDownloadURL(uploadTask.snapshot.ref).then(function(downloadURL) {
                    const data={
                        // _token:document.querySelector('input[name="_token"]').value,
                        imagUrl: downloadURL,
                        name:document.getElementById('name').value,
                        Price: document.getElementById('price').value,
                        description: document.getElementById('description').value,
                        category_id: document.getElementById('category').value,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'POST'
                    }
                    // console.log(data)

                    $.ajax({
                        url: '{{ route('products.store') }}',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            console.log(response);
                            window.location.href = '{{ route('products.index') }}';
                        },
                        error: function(error) {
                            console.log(error)
                            // console.error('Submission failed:', error);
                        }
                    });
                });
            }
        );
    });
</script>
