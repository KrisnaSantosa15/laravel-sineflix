@extends('layouts._default.user-main')
@section('content')
    <!-- Hero section -->
    <section>
        <div class="swiper hero-swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($movies->take(5) as $movie)
                    <div class="swiper-slide">
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                        <div class="overlay absolute inset-0 top-0 bottom-0 right-0 left-0"></div>
                        <div
                            class="p-8 text-white h-full flex flex-col justify-center md:justify-end z-10 absolute w-full md:w-1/2">
                            <p class="text-sm mb-2 bg-gray-800 py-2 px-5 font-bold rounded-full" style="width: fit-content">
                                {{ $movie->type }}
                            </p>
                            <p class="md:text-4xl font-bold mb-4 text-lg">
                                {{ $movie->title }}
                            </p>
                            <p class="text-sm mb-4"> {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }} -
                                {{ $movie->genres->first()->name }}</p>
                            <p class="mb-6 truncate md:overflow-visible md:whitespace-normal">
                                {{ $movie->plot_summary }}
                            </p>
                            <div class="flex space-x-4 mb-8">
                                <a href="{{ url('movies/' . $movie->slug) }}"
                                    class="inline-flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 h-10 px-4 py-2">
                                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M8 18V6l8 6-8 6Z" />
                                    </svg>

                                    Watch Trailer
                                </a>
                                @if (Auth::check())
                                    @php
                                        $isInWatchlist = in_array($movie->id, $watchlist);
                                    @endphp
                                    <button
                                        class="toggle-watchlist-btn inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-bold text-white {{ $isInWatchlist ? 'bg-blue-700' : '' }} hover:text-white border {{ $isInWatchlist ? 'border-blue-700' : 'hover:bg-blue-800' }} focus:ring-4 focus:outline-none focus:ring-blue-300 text-center me-2 mb-2 dark:border-blue-500 dark:text-white dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 h-10 px-4 py-2"
                                        data-movie-id="{{ $movie->id }}">
                                        @if ($isInWatchlist)
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                                            </svg>
                                            Remove from Watchlist
                                        @else
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                                            </svg>
                                            Add Watchlist
                                        @endif
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Just Release Section -->
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            Just Release
        </p>
        <div class="swiper just-release-swiper">
            <div class="swiper-wrapper">
                @foreach ($movies->sortByDesc('release_date')->take(20) as $movie)
                    <div class="swiper-slide">
                        <a href="{{ url('movies/' . $movie->slug) }}">
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                            <div class="movie-info absolute left-0 bottom-0 right-0 p-3 text-white"
                                style="background: linear-gradient(to top, black, transparent)">
                                <p class="font-bold truncate text-lg">{{ $movie->title }}</p>
                                <p class="text-sm mb-4">&#9733; {{ $movie->rating }} | {{ $movie->genres->first()->name }}
                                    - {{ $movie->type }}
                                </p>
                            </div>
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

    <!-- Popular of the week Section-->
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-700 dark:text-white py-5">
            Popular of the Week
        </p>
        <div class="swiper popular-week-swiper">
            <div class="swiper-wrapper">
                @foreach ($movies->sortBy('rating')->sortBy('release_date')->take(20) as $movie)
                    <div class="swiper-slide">
                        <a href="{{ url('movies/' . $movie->slug) }}">
                            <div class="flex">
                                <p
                                    class="counter text-center text-gray-700 dark:text-white justify-center flex items-center text-4xl p-5 font-bold">
                                    {{-- iterator --}}
                                    {{ $loop->iteration }}
                                </p>
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                                <div class="pl-5 text-gray-700 dark:text-white flex justify-between"
                                    style="flex-direction: column">
                                    <p class="age border rounded-md text-sm px-2 border-gray-500 text-gray-500"
                                        style="width: fit-content">
                                        {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}
                                    </p>
                                    <p class="font-bold text-base">{{ $movie->title }}</p>
                                    <p class="text-sm genre text-gray-500">
                                    <p class="text-sm rating">
                                        &#9733; {{ $movie->rating }} |
                                        {{ $movie->genres->first()->name }}</p>
                                    <span class="type text-gray-500"> {{ $movie->type }} </span>
                                    </p>
                                </div>
                            </div>
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

    <!-- Featured Section -->
    <section class="p-5 py-5 flex md:flex-nowrap flex-wrap-reverse featured-section" style="position: relative;">
        <div class="featured-section-info flex-col justify-center flex md:w-1/2 w-ful md:p-5 z-10">
            <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
                Featured in Sineflix
            </p>
            <p class="text-white mb-5">Best featured for you today</p>
            <div class="featured-description" style="height: inherit">
                {{-- <p class="tag-badge rounded-full bg-gray-700 text-white p-1 px-3 font-bold" style="width: fit-content">
                    #1 in Australia
                </p> --}}
                <p class="text-lg md:text-4xl featured-title text-white py-2 font-bold">

                </p>
                <p class="featured-info text-white">
                    <span class="text-white"> &#9733; <span class="featured-rating"></span> | </span>
                    <span class="featured-duration"></span>
                    <span class="featured-year"></span> <span> - </span>
                    <span class="featured-genre"></span>
                </p>
                <p class="featured-plot text-gray-300 py-2">
                </p>
                <div class="block md:flex md:space-x-4 mb-8">
                    <a href="" id="trailer-link"
                        class="inline-flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 h-10 px-4 py-2">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 18V6l8 6-8 6Z" />
                        </svg>

                        Watch Trailer
                    </a>
                    {{-- <button id="watchlist-button"
                        class="toggle-watchlist-btn inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-bold text-white hover:text-white border hover:bg-blue-800 border-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 text-center me-2 mb-2 dark:border-blue-500 dark:text-white dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 h-10 px-4 py-2"
                        data-movie-id="" data-in-watchlist="">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                        </svg>
                        Add Watchlist
                    </button> --}}
                </div>
            </div>
        </div>
        <div class="swiper featured-swiper text-white">
            <div class="swiper-wrapper">
                @foreach ($movies as $movie)
                    @php
                        $isInWatchlist = in_array($movie->id, $watchlist);
                    @endphp
                    <div class="swiper-slide" data-id="{{ $movie->id }}" data-title="{{ $movie->title }}"
                        data-rating="{{ $movie->rating }}" data-plot="{{ $movie->plot_summary }}"
                        data-slug="{{ $movie->slug }}" data-duration="{{ $movie->duration }}"
                        data-genre="{{ $movie->genres->first()->name }}" data-type="{{ $movie->type }}"
                        data-releasedate="{{ $movie->release_date }}"
                        data-in-watchlist="{{ $isInWatchlist ? 'true' : 'false' }}">
                        <a href="#">
                            <img src="{{ $movie->poster_url }}" alt="" />
                            <div class="movie-info absolute left-0 bottom-0 right-0 p-3 text-white"
                                style="background: linear-gradient(to top, black, transparent)">
                                <p class="font-bold text-lg">{{ $movie->title }}</p>
                                <p class="text-sm mb-4">&#9733; {{ $movie->rating }} |
                                    {{ $movie->genres->first()->name }} - {{ $movie->type }}</p>
                            </div>
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

    <!-- Movies Section -->
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            Movies
        </p>
        <div class="swiper movies-swiper">
            <div class="swiper-wrapper">
                @foreach ($movies->take(20) as $movie)
                    @if ($movie->type == 'MOVIE')
                        <div class="swiper-slide">
                            <a href="{{ url('movies/' . $movie->slug) }}">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                                <p class="font-bold truncate movie-title text-lg text-gray-800 dark:text-white">
                                    {{ $movie->title }}
                                </p>
                                <p class="text-sm rating text-gray-800 dark:text-white">
                                    &#9733; {{ $movie->rating }} |
                                    <span class="genre text-gray-500"> {{ $movie->genres->first()->name }} </span>
                                    <span class="type text-gray-500"> - {{ $movie->type }} </span>
                                </p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- <div class="swiper-pagination"></div> -->

            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        {{-- Link load more --}}
        <div class="flex justify-center mt-5">
            <a href="{{ url('movies/type/MOVIE') }}"
                class="inline-flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 h-10 px-4 py-2">
                View All Movies
            </a>
        </div>

    </section>

    <!-- Series Section -->
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            Series
        </p>
        <div class="swiper series-swiper">
            <div class="swiper-wrapper">
                @foreach ($movies->take(20) as $movie)
                    @if ($movie->type == 'SERIES')
                        <div class="swiper-slide">
                            <a href="{{ url('movies/' . $movie->slug) }}">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                                <p class="font-bold truncate movie-title text-lg text-gray-800 dark:text-white">
                                    {{ $movie->title }}
                                </p>
                                <p class="text-sm rating text-gray-800 dark:text-white">
                                    &#9733; {{ $movie->rating }} |
                                    <span class="genre text-gray-500"> {{ $movie->genres->first()->name }} </span>
                                    <span class="type text-gray-500"> - {{ $movie->type }} </span>
                                </p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- <div class="swiper-pagination"></div> -->

            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        {{-- Link load more --}}
        <div class="flex justify-center mt-5">
            <a href="{{ url('movies/type/SERIES') }}"
                class="inline-flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 h-10 px-4 py-2">
                View All Movies
            </a>
        </div>

    </section>

    <!-- Korean Series Section -->
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            Korean Series
        </p>
        <div class="swiper korean-series-swiper">
            <div class="swiper-wrapper">
                @foreach ($movies->take(20) as $movie)
                    @if ($movie->type == 'K-SERIES')
                        <div class="swiper-slide">
                            <a href="{{ url('movies/' . $movie->slug) }}">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                                <p class="font-bold truncate movie-title text-lg text-gray-800 dark:text-white">
                                    {{ $movie->title }}
                                </p>
                                <p class="text-sm rating text-gray-800 dark:text-white">
                                    &#9733; {{ $movie->rating }} |
                                    <span class="genre text-gray-500"> {{ $movie->genres->first()->name }} </span>
                                    <span class="type text-gray-500"> - {{ $movie->type }} </span>
                                </p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- <div class="swiper-pagination"></div> -->

            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        {{-- Link load more --}}
        <div class="flex justify-center mt-5">
            <a href="{{ url('movies/type/K-SERIES') }}"
                class="inline-flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 h-10 px-4 py-2">
                View All Movies
            </a>
        </div>

    </section>

    <!-- Choose Genre -->
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            Select Your Genres
        </p>
        <div class="flex gap-8 flex-wrap justify-center bg-white dark:bg-gray-900">
            @foreach ($genres as $genre)
                <a href="{{ url('movies/genre/' . strtolower($genre->name)) }}"
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 justify-center"
                    style="width: 250px">
                    <div class="flex flex-col justify-center p-4">
                        <h4 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $genre->name }}</h4>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $genre->movies_count }} Movies
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </section>
@endsection
