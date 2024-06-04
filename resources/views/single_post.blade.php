@extends('layouts.master')

@section('title', 'Offer Details')

@section('head_css')
    <style>
        /* Full-width hero section */
        .hero-section {
            position: relative;
            width: 80%;
            height: 60vh;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hero-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-indicators span {
            width: 12px;
            height: 12px;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            cursor: pointer;
        }

        .carousel-indicators span.active {
            background-color: #fff;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 2em;
            transition: 0.3s;
            user-select: none;
        }

        .prev {
            left: 10px;
            border-radius: 3px 0 0 3px;
        }

        .next {
            right: 10px;
            border-radius: 0 3px 3px 0;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .offer-details {
            margin-top: 5vh;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 5vh auto;
        }

        .offer-details h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .offer-details p {
            color: #666;
            line-height: 1.6;
        }

        .offer-details .btn-chat {
            background-color: #2a81b2;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .offer-details .btn-chat:hover {
            background-color: #236a8a;
            text-decoration: none;
            color: #fff;
        }

        .offer-details .btn-chat i {
            margin-right: 5px;
        }

        .details-list {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .details-list li {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="hero-section">
        @foreach ($post['images'] as $index => $image)
            <img src="{{ asset($image['image_path']) }}" alt="Offer Image" class="{{ $loop->first ? 'active' : '' }}"
                style="display: {{ $loop->first ? 'block' : 'none' }};">
        @endforeach
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
        <div class="carousel-indicators">
            @foreach ($post['images'] as $index => $image)
                <span class="{{ $loop->first ? 'active' : '' }}" onclick="currentSlide({{ $index }})"></span>
            @endforeach
        </div>
    </div>

    <div class="offer-details">
        <h2>{{ $post['title'] }}</h2>
        <ul class="details-list">
            <li><strong>Location:</strong> {{ $post['location'] }}</li>
            <li><strong>Price:</strong> €{{ number_format($post['price'], 0, ',', '.') }}</li>
            <li><strong>Rooms:</strong> {{ $post['rooms'] }}</li>
        </ul>
        <p>{{ $post['description'] }}</p>
        <a href="mailto:info@example.com" class="btn-chat"><i class="fa fa-envelope"></i> Contact Us</a>
    </div>
@endsection

@section('additional_scripts')
    <script>
        let currentSlideIndex = 0;

        function changeSlide(n) {
            const slides = document.querySelectorAll('.hero-section img');
            const indicators = document.querySelectorAll('.carousel-indicators span');
            slides[currentSlideIndex].style.display = 'none';
            indicators[currentSlideIndex].classList.remove('active');
            currentSlideIndex = (currentSlideIndex + n + slides.length) % slides.length;
            slides[currentSlideIndex].style.display = 'block';
            indicators[currentSlideIndex].classList.add('active');
        }

        function currentSlide(index) {
            const slides = document.querySelectorAll('.hero-section img');
            const indicators = document.querySelectorAll('.carousel-indicators span');
            slides[currentSlideIndex].style.display = 'none';
            indicators[currentSlideIndex].classList.remove('active');
            currentSlideIndex = index;
            slides[currentSlideIndex].style.display = 'block';
            indicators[currentSlideIndex].classList.add('active');
        }
    </script>
@endsection
