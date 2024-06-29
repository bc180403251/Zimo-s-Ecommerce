<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-commerce Site')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar {
            padding-top: 20px;
            padding-bottom: 30px;
            background-color: lightgray; /* Dark background color */
        }
        .navbar-brand, .nav-link {
            color: black !important; /* White text color */
        }
        .nav-link:hover {
            color: #cccccc !important; /* Lighter color on hover */
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('/')}}">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
{{--                    <a href="{{ route('cart.list') }}" class="btn btn-outline-primary position-relative">--}}
{{--                        Cart--}}
{{--                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">--}}
{{--                {{ $cart_count }}--}}
{{--            </span>--}}

{{--                    </a>--}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.list') }}">
                            Cart
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                    {{ $cart_count ?? 0 }}
                                </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container mt-5">
    @yield('content')
</div>
</body>
</html>
