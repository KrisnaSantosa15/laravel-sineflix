@extends('layouts._default.user-main')
@section('content')
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            {{ $genre->name }}
        </p>
        <div class="swiper series-swiper">
            <div class="swiper-wrapper">
                @foreach ($movies as $movie)
                    <div class="swiper-slide">
                        <a href="{{ url('movies/' . $movie->slug) }}">
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                            <p class="font-bold movie-title text-lg text-white">
                                {{ $movie->title }}
                            </p>
                            <p class="text-sm rating text-white">
                                &#9733; {{ $movie->rating }} |
                                <span class="genre text-gray-500"> {{ $movie->genres->pluck('name')->implode(' - ') }}
                                </span>
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- <div class="swiper-pagination"></div> -->

            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
@endsection
