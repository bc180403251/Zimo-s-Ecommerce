@extends('layouts.app')

{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">min--}}
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
                                    <label for="otherimgs">{{ __('Other Images') }}</label>
                                    <input type="file" name="otherimgs" class="form-control" id="otherimgs" accept="image/*" multiple required>
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
                                    <div id="progress-container" class="progress" style="display: none;">
                                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    $('#product-form').on('submit', async function(e) {
        e.preventDefault();

        $('#progress-container').show();

        const file = document.getElementById('image').files[0];
        const otherImages = document.getElementById('otherimgs').files;
        const storageRef = ref(storage, 'images/' + file.name);
        const uploadTask = uploadBytesResumable(storageRef, file);

        let imageUrl = '';
        let otherImageUrls = [];

        function updateProgress(progress) {
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.innerText = Math.round(progress) + '%';
        }

        let progressInterval;

        uploadTask.on('state_changed',
            function(snapshot) {
                // Progress handling (optional)
                clearInterval(progressInterval);
                progressInterval = setInterval(() => {
                    const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    updateProgress(progress);
                }, 300);
            },
            function(error) {
                // Handle error
                clearInterval(progressInterval);
                console.error('Upload failed:', error);
            },
            async function() {
                clearInterval(progressInterval);
                updateProgress(100);
                imageUrl = await getDownloadURL(uploadTask.snapshot.ref);

                // Iterate and upload other images
                for (let i = 0; i < otherImages.length; i++) {
                    const otherImageRef = ref(storage, 'otherimages/' + otherImages[i].name);
                    const otherUploadTask = uploadBytesResumable(otherImageRef, otherImages[i]);

                    await new Promise((resolve, reject) => {
                        let otherProgressInterval;
                        otherUploadTask.on('state_changed',
                            function(snapshot) {
                                // Progress handling (optional)
                                clearInterval(otherProgressInterval);
                                otherProgressInterval = setInterval(() => {
                                    const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                    updateProgress(progress);
                                }, 100);
                            },
                            function(error) {
                                // Handle error
                                clearInterval(otherProgressInterval);
                                console.error('Upload failed:', error);
                                reject(error);
                            },
                            async function() {
                                clearInterval(otherProgressInterval);
                                updateProgress(100);
                                const otherImageUrl = await getDownloadURL(otherUploadTask.snapshot.ref);
                                otherImageUrls.push(otherImageUrl);
                                resolve();
                            }
                        );
                    });
                }

                const data = {
                    imagUrl: imageUrl,
                    name: document.getElementById('name').value,
                    Price: document.getElementById('price').value,
                    description: document.getElementById('description').value,
                    category_id: document.getElementById('category').value,
                    otherimgs: JSON.stringify(otherImageUrls),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'POST'
                };

                $.ajax({
                    url: '{{ route('products.store') }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        window.location.href = '{{ route('products.index') }}';
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        );
    });
</script>
