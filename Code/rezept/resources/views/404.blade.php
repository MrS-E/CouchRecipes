<!DOCTYPE html>
<!--from https://frontendshape.com/post/bootstrap-5-404-page-examples-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="a recipes app">
    <meta name="keywords" content="recipes">
    <meta name="author" content="Simeon Stix">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <title>404</title>
</head>
<body>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center row">
        <div class=" col-md-6">
            <img src="https://cdn.pixabay.com/photo/2017/03/09/12/31/error-2129569__340.jpg" alt=""
                 class="img-fluid">
        </div>
        <div class=" col-md-6 mt-5">
            <p class="fs-3"><span class="text-danger">Opps!</span> Page not found.</p>
            <p class="lead">
                The page you’re looking for doesn’t exist.
            </p>
            <a href="/" class="btn btn-primary">Go Home</a>
        </div>

    </div>
</div>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
