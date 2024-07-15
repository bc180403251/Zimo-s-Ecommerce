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
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
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

        $('#category-form').on('submit', async function(e) {
            e.preventDefault();

            $('#progress-container').show();

            const file = document.getElementById('image').files[0];
            const storageRef = ref(storage, 'categories/' + file.name);
            const uploadTask = uploadBytesResumable(storageRef, file);

            let imgUrl = '';

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
                    imgUrl = await getDownloadURL(uploadTask.snapshot.ref);

                    const data = {
                        imgUrl: imgUrl,
                        name: document.getElementById('name').value,
                        description: document.getElementById('description').value,
                        parent_id: document.getElementById('parent_id').value,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    $.ajax({
                        url: '{{ route("categories.store") }}',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
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
                            $('#progress-container').hide();
                            $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            );
        });
    </script>
@endsection
