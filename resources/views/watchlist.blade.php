@extends('layouts._default.user-main')
@section('content')
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl font-bold text-gray-800 dark:text-white py-5">
            My Watchlist
        </p>
        {{-- if not logged in, says login first to save your watchlist --}}
        @guest
            <p class="text-2xl text-center font-medium text-gray-800 dark:text-white py-5">
                Your watchlist is empty. <a href="{{ url('login') }}"
                    class="text-blue-500 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-500">Login</a> to
                save your watchlist.
            </p>
        @endguest
        {{-- if logged in but watchlist is empty --}}
        @auth
            @if (count($myWatchlist) == 0)
                <p class="text-2xl text-center font-medium text-gray-800 dark:text-white py-5">
                    Your watchlist is empty. <a href="{{ url('/') }}"
                        class="text-blue-500 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-500">Browse
                        movies</a> to add to your watchlist.
                </p>
            @endif
        @endauth
        <div class="swiper series-swiper">
            <div class="swiper-wrapper">
                @foreach ($myWatchlist as $movie)
                    <div class="swiper-slide">
                        <a href="{{ url('movies/' . $movie->slug) }}">
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" />
                            <p class="font-bold movie-title truncate text-lg text-gray-800 dark:text-white">
                                {{ $movie->title }}
                            </p>
                            <p class="text-sm rating text-gray-800 dark:text-white">
                                &#9733; {{ $movie->rating }} |
                                <span class="genre text-gray-500"> {{ $movie->genres }}
                                </span>
                            </p>
                        </a>

                        <form action="{{ url('watchlist/' . $movie->watchlist_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="movie_id" value="{{ $movie->movie_id }}">
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to remove this movie from your watchlist?')"
                                class="mt-3 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-bold text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 bg-red-700 text-center me-2 mb-2 dark:border-red-500 dark:text-white dark:hover:text-white dark:hover:bg-red-500 dark:focus:ring-red-800 h-10 px-4 py-2">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                                Remove
                            </button>
                        </form>
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
