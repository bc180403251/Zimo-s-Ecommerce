{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>@yield('title', 'E-commerce Site')</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            min-height: 100vh;--}}
{{--        }--}}
{{--        .navbar {--}}
{{--            padding-top: 10px;--}}
{{--            padding-bottom: 30px;--}}
{{--            background-color: #ff9800; /* Dark Orange background color */--}}
{{--        }--}}
{{--        .navbar-brand {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--        }--}}
{{--        .navbar-brand strong {--}}
{{--            margin-right: 10px;--}}
{{--        }--}}
{{--        .nav-link {--}}
{{--            margin-top: 20px;--}}
{{--            color: #ffffff !important; /* White text color */--}}
{{--        }--}}
{{--        .navbar-brand, .nav-link {--}}
{{--            color: #ffffff !important; /* White text color */--}}
{{--        }--}}
{{--        .nav-link:hover {--}}
{{--            color: black !important; /* Black color on hover */--}}
{{--        }--}}
{{--        .content-wrapper {--}}
{{--            flex: 1;--}}
{{--        }--}}
{{--        footer {--}}
{{--            background-color: #343a40;--}}
{{--            color: #ffffff;--}}
{{--            padding: 20px 0;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        footer a {--}}
{{--            color: #ff9800;--}}
{{--            text-decoration: none;--}}
{{--        }--}}
{{--        footer a:hover {--}}
{{--            color: #ffa726;--}}
{{--        }--}}
{{--        .btn:hover {--}}
{{--            background-color: gray;--}}
{{--            color: white;--}}
{{--            border-color: gray;--}}
{{--        }--}}
{{--        /*.navbar-center {*/--}}
{{--        /*    position: absolute;*/--}}
{{--        /*    left: 50%;*/--}}
{{--        /*    transform: translateX(-50%);*/--}}
{{--        /*}*/--}}
{{--    </style>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--</head>--}}
{{--<body>--}}
{{--<header>--}}
{{--    <nav class="navbar navbar-expand-lg navbar-dark">--}}
{{--        <div class="container-fluid">--}}
{{--            <a class="navbar-brand" href="{{url('/')}}">--}}
{{--                <strong>E-COM</strong>--}}
{{--                <i class="fa fa-shopping-cart" style="font-size:25px;"></i>--}}
{{--            </a>--}}
{{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
{{--            <div class="collapse navbar-collapse" id="navbarNav">--}}

{{--                <ul class="navbar-nav ms-auto">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Products</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">About</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mt-4">--}}

{{--                        <form class="form-inline d-flex" id="search-form">--}}
{{--                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query" id="search-input">--}}
{{--                            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>--}}
{{--                        </form>--}}

{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="fa fa-shopping-cart nav-link position-relative" style="font-size:30px;" href="{{ route('cart.list') }}">--}}
{{--                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">--}}
{{--                                {{ $cart_count ?? 0 }}--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--</header>--}}

{{--<div class="content-wrapper">--}}
{{--    <div class="container mt-5">--}}
{{--        @yield('content')--}}
{{--    </div>--}}
{{--</div>--}}

{{--<footer>--}}
{{--    <div class="container">--}}
{{--        <p>&copy; 2024 E-commerce Site. All Rights Reserved.</p>--}}
{{--        <p>Follow us on--}}
{{--            <a href="https://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>--}}
{{--            <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>--}}
{{--            <a href="https://instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>--}}
{{--        </p>--}}
{{--    </div>--}}
{{--</footer>--}}

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#search-form').submit(function(event) {--}}
{{--            event.preventDefault();--}}
{{--            let query = $('#search-input').val();--}}

{{--            // Redirect to the search results page--}}
{{--            window.location.href = "{{ route('search') }}?query=" + query;--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-commerce Site')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        header {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: #1e3a8a; /* Dark Blue */
            z-index: 1000;
        }
        header .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }
        .navbar .logo {
            color: #60a5fa; /* Light Blue */
            font-weight: 600;
            font-size: 2.1rem;
            text-decoration: none;
        }
        .navbar .logo span {
            color: darkblue;
        }
        .navbar .nav-item {
            display: flex;
            list-style: none;
            gap: 35px;
        }
        .navbar a {
            color: #93c5fd; /* Light Blue */
            text-decoration: none;
            transition: 0.2s ease;
        }
        .navbar a:hover {
            color: #ffffff;
        }
        .banner-section {
            height: 100vh;
            background-image: linear-gradient(to right, rgba(0,0,0,0.9), rgba(0,0,0,0.7)), url('/shoes pics/banner.jpg');
            background-position: center;
            background-size: cover;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        footer {
            background-color: #1e3a8a; /* Dark Blue */
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }
        footer a {
            color: #60a5fa; /* Light Blue */
            text-decoration: none;
        }
        footer a:hover {
            color: #93c5fd; /* Lighter Blue */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header>
    <nav class="navbar">
        <a href="{{url('/')}}" class="logo"> E-COM<span>.</span></a>
        <ul class="nav-item">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{url('/')}}">Products</a></li>
            <li>
                <a class="fa fa-shopping-cart nav-link position-relative" style="font-size:20px;" href="{{ route('cart.list') }}">
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                        {{ $cart_count ?? 0 }}
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</header>

{{-- Content section --}}
{{--<div class="content-wrapper">--}}
{{--    <div class="container mt-5">--}}
        @yield('content')
{{--    </div>--}}
{{--</div>--}}
{{-- Footer section --}}
<footer>
    <div class="container">
        <p>&copy; 2024 E-commerce Site. All Rights Reserved.</p>
        <p>Follow us on
            <a href="https://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
        </p>
    </div>
</footer>
<script>
    $(document).ready(function() {
        $('#search-form').submit(function(event) {
            event.preventDefault();
            let query = $('#search-input').val();

            // Redirect to the search results page
            window.location.href = "{{ route('search') }}?query=" + query;
        });
    });
</script>
</body>
</html>
