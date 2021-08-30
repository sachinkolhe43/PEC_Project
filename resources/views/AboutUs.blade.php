<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC@SPIT</title>
</head>
<body>
@extends('Layout')

@section('content')
    <div id="content">
        <div class="post-wrap">
            <div class="post-heading">
                <h2>
                    <b> About Us</b>
                </h2>
                <hr>
            </div><!-- End Post Heading -->
            <div class="post-content">

                <p>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset('images/b1.png')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images2/p2.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images2/p3.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images2/p4.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images2/p5.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                </p>






            </div><!-- End Post Content -->
        </div><!-- End Post Wrap-->
    </div><!-- End Content -->


    <div class="clear"></div>
@endsection
</body>
</html>
