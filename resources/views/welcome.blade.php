<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoolnwRun</title>
    <link rel="icon" href="{{ asset('images/logo2.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ3QFJhR6vHY9t9mZW0GdFT9zV8HqzS8IoFS4e3i6GpPms9PpPRhGvZkrmVn" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        .carousel-inner .carousel-item img {
            width: 100%;
            height: 500px;
            min-height: 500px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://wallpapers.com/images/featured/running-wl9pg3zeygysq0ps.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://wallpaperset.com/w/full/4/8/7/198061.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img.goodfon.com/wallpaper/big/0/c8/devushka-beg-sport-5578.webp" class="d-block w-100"
                    alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endsection
</body>

</html>