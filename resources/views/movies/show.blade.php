@extends('layouts._default.user-main')
@section('content')
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <div class="block md:flex">
            <div class="w-full md:w-1/4 justify-center flex py-3">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-1/2 md:w-full h-auto rounded-md">
            </div>
            <div class="w-full md:w-2/4 md:pl-5">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $movie->title }}</h1>
                {{-- Youtube Embed --}}
                {{-- change watch: https://www.youtube.com/watch?v=_pK1lKnV5XU, to embed: https://www.youtube.com/embed/_pK1lKnV5XU --}}
                <div class="video-container py-3 flex justify-center">
                    <div class="video-container w-5/6 h-auto max-w-full">
                        <div class="aspect-video">
                            <iframe class="aspect-video w-full"
                                src="{{ str_replace('watch?v=', 'embed/', $movie->trailer_url) }}"
                                title="{{ $movie->title }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-full"></iframe>
                        </div>
                    </div>
                </div>
                <p class="text-gray-800 dark:text-white uppercase font-bold">Storyline</p>
                <p class="text-lg text-gray-500">{{ $movie->plot_summary }}</p>
                <p class="text-lg text-gray-500">{{ $movie->duration }}</p>
            </div>
            <div class="w-full md:w-1/4 py-3">
                <div class="row mr-5">
                    <p class="text-lg text-gray-500">Rating: <span class="dark:text-white"> {{ $movie->rating }} </span>
                    </p>
                    <p class="text-lg text-gray-500">Type: <span class="dark:text-white"> {{ $movie->type }} </span> </p>
                    <p class="text-lg text-gray-500">Director: <span class="dark:text-white">{{ $movie->director }}</span>
                    </p>
                    <p class="text-lg text-gray-500">Genres: <span class="dark:text-white">
                            {{ $movie->genres->pluck('name')->implode(', ') }} </span>
                    </p>
                    {{-- average rating --}}
                    @if ($averageRating[0]->avg_rating != null)
                        <p class="text-lg text-gray-500">User Rating:
                            <span class="dark:text-white">{{ $averageRating[0]->avg_rating }}</span>
                        </p>
                    @else
                        <p class="text-lg text-gray-500">No User ratings available</p>
                    @endif
                    {{-- add to watchlist button --}}
                    @if (Auth::check())
                        @php
                            $isInWatchlist = in_array($movie->id, $watchlist);
                        @endphp
                        <button
                            class="toggle-watchlist-btn inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-bold text-white {{ $isInWatchlist ? 'bg-blue-700' : '' }} hover:text-white border {{ $isInWatchlist ? 'border-blue-700' : 'hover:bg-blue-800' }} focus:ring-4 focus:outline-none focus:ring-blue-300 text-center me-2 mb-2 dark:border-blue-500 dark:text-white dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 h-10 px-4 py-2"
                            data-movie-id="{{ $movie->id }}">
                            @if ($isInWatchlist)
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                                </svg>
                                Remove from Watchlist
                            @else
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
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
    </section>
    <section class="p-5 bg-white dark:bg-gray-900">
        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
    </section>
    {{-- Reviews Section --}}
    <section class="p-5 bg-white dark:bg-gray-900">
        <div class="block">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Reviews</h1>
            <div class="py-3">
                @foreach ($movie->reviews as $review)
                    <div class="py-3">
                        <div class="flex justify-between">
                            <p class="text-lg text-gray-500">{{ $review->user->name }}</p>
                            <p class="text-lg text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $review->title }}</h2>
                        <p class="text-lg text-gray-500">{{ $review->content }}</p>
                        <p class="text-lg text-gray-500">Rating: {{ $review->rating }}</p>
                    </div>
                @endforeach
            </div>
            <div class="py-3">
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Your comment title" required="">
                    <textarea name="content" id="content" cols="30" rows="5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 my-3"
                        placeholder="Your comments..." required=""></textarea>
                    <input type="number" name="rating" id="rating"
                        class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Rating (0 - 5)" required="" min="0" max="5" step="0.1">
                    @if (Auth::check())
                        <button type="submit"Good Movie
                            class="w-full p-3 bg-blue-500 text-white rounded-md mt-3 hover:bg-blue-600">Submit
                            Review</button>
                    @else
                        <button type="button"
                            class="w-full text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed font-medium mt-3 rounded-lg text-sm px-5 p-3 text-center"
                            disabled>Login First</button>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection
