@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('Create banner') }}</h1>
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
                            <form id="banner-form">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Banner name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('details') }}</label>
                                    <textarea name="details" class="form-control" id="details" rows="4" placeholder="Enter Banner Details" required></textarea>
                                </div>

                                <div class="form-group">
                                    <div id="progress-container" class="progress" style="display: none;">
                                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    <a href="{{ route('banners.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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

        function checkImageDimensions(file) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                const reader = new FileReader();

                reader.onload = function(event) {
                    img.src = event.target.result;
                };

                img.onload = function() {
                    if (img.width < 1920 || img.height < 800) {
                        reject('Image is too small. Please upload an image with at least 1920x800 dimensions.');
                    } else if (img.width > 1920 || img.height > 800) {
                        reject('Image is too big. Please upload an image with a maximum of 1920x800 dimensions.');
                    } else {
                        resolve();
                    }
                };

                img.onerror = function() {
                    reject('Invalid image file.');
                };

                reader.readAsDataURL(file);
            });
        }

        // Form submission
        $('#banner-form').on('submit', async function(e){
            e.preventDefault();

            // Show the progress bar container
            $('#progress-container').show();

            const file = document.getElementById('image').files[0];

            // Validate image dimensions
            try {
                await checkImageDimensions(file);

                const storageRef = ref(storage, 'banners/' + file.name);
                const uploadTask = uploadBytesResumable(storageRef, file);

                let imgUrl = '';

                function updateProgress(progress) {
                    const progressBar = document.getElementById('progress-bar');
                    progressBar.style.width = progress + '%';
                    progressBar.setAttribute('aria-valuenow', progress);
                    progressBar.innerText = Math.round(progress) + '%';
                }

                uploadTask.on('state_changed',
                    function(snapshot) {
                        const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        updateProgress(progress);
                    },
                    function(error) {
                        // Handle error
                        console.error('Upload failed:', error);
                    },
                    async function() {
                        updateProgress(100);
                        imgUrl = await getDownloadURL(uploadTask.snapshot.ref);

                        const data = {
                            imgUrl: imgUrl,
                            name: document.getElementById('name').value,
                            details: document.getElementById('details').value,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url: '{{ route('banners.store') }}',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify(data),
                            success: function(response) {
                                console.log(response);
                                window.location.href = '{{ route('banners.index') }}';
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                );

            } catch (error) {
                $('#progress-container').hide(); // Hide progress bar on error
                $('#message-container').html(`<div class="alert alert-danger">${error}</div>`);
            }
        });
    </script>


@endsection
