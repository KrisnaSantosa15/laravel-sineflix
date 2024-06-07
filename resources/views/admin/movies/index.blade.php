@extends('layouts._default.main')
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    {{-- Breadcrumb --}}
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200  dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/admin') }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                    </savg>
                                    Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                    aria-current="page">Movies</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All movies</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="flex items-center mb-4 sm:mb-0">
                    <form class="sm:pr-3" method="GET">
                        <label for="movies-search" class="sr-only">Search</label>
                        <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                            <input type="text" name="keyword" id="movies-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search for movies" value="{{ request('keyword') }}">
                            <button type="submit"
                                class="absolute top-0 right-0 flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-50 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <button type="button" data-modal-target="add-movie-modal" data-modal-toggle="add-movie-modal"
                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Add movie
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Title
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Genres
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Type
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            {{-- show 'no results' when there's no result --}}
                            @if ($movies->isEmpty())
                                <tr>
                                    <td colspan="4"
                                        class="p-4 text-base font-medium text-gray-900 dark:text-white text-center">
                                        No results found
                                    </td>
                                </tr>
                            @endif
                            @foreach ($movies as $movie)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                        <img class="w-10 h-10 rounded-full" src="{{ $movie->poster_url }}"
                                            alt="{{ $movie->title }} avatar">
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                {{ $movie->title }}</div>
                                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                {{ $movie->release_date }}</div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @foreach ($movie->genres as $genre)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-gray-700 rounded-full dark:bg-gray-600">
                                                {{ $genre->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $movie->type }}
                                    </td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button type="button" id="viewMovieButton"
                                            data-modal-target="modal-view-movie-{{ $movie->slug }}"
                                            data-modal-toggle="modal-view-movie-{{ $movie->slug }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-900">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 2a8 8 0 100 16 8 8 0 000-16zM4 10a6 6 0 1112 0 6 6 0 01-12 0z"
                                                    clip-rule="evenodd"></path>
                                                <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            View
                                        </button>
                                        <button type="button" data-modal-target="edit-movie-modal-{{ $movie->slug }}"
                                            data-modal-toggle="edit-movie-modal-{{ $movie->slug }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Edit movie
                                        </button>
                                        <button type="button" data-modal-target="delete-movie-modal-{{ $movie->slug }}"
                                            data-modal-toggle="delete-movie-modal-{{ $movie->slug }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Delete movie
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- if there's a keyword, show 'results for "{keyword}"' --}}
                            @if (request()->has('keyword') && request()->keyword != '')
                                <tr>
                                    <td colspan="4"
                                        class="p-4 text-base font-medium text-gray-900 dark:text-white text-center">
                                        Showing results for "{{ request()->keyword }}"
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div
        class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center mb-4 sm:mb-0">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing
                <span class="font-semibold text-gray-900 dark:text-white">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ $movies->firstItem() }}-{{ $movies->lastItem() }}
                        </span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ $movies->total() }}
                        </span>
                    </span>
                </span>
            </span>
        </div>
        <div class="flex items-center space-x-3">
            @if ($movies->onFirstPage())
                <span
                    class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-300 cursor-not-allowed dark:bg-gray-700">
                    <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Previous
                </span>
            @else
                <a href="{{ $movies->previousPageUrl() . '&' . http_build_query(request()->except(['page', 'keyword'])) }}"
                    class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Previous
                </a>
            @endif
            @if ($movies->hasMorePages())
                <a href="{{ $movies->nextPageUrl() . '&' . http_build_query(request()->except(['page', 'keyword'])) }}"
                    class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Next
                    <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            @else
                <span
                    class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-300 cursor-not-allowed dark:bg-gray-700">
                    Next
                    <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endif
        </div>

    </div>

    {{-- Add Movies Modal --}}
    <div id="add-movie-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New Movie
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="add-movie-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" action="{{ url('admin/movies') }}">
                    @csrf
                    @method('POST')
                    <div class="grid gap-4 mb-4 grid-cols-6">
                        <div class="col-span-6">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type movie title" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="release_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Release Date</label>
                            <input type="date" name="release_date" id="release_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>
                        {{-- Type Select --}}
                        <div class="col-span-2">
                            <label for="type"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select name="type" id="type" style="width: 100%"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                                @foreach ($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="rating"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                            <input type="number" name="rating" id="rating"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="4.5" required="" min="0" max="5" step="0.1">
                        </div>
                        {{-- Genre Select --}}
                        <div class="col-span-6">
                            <label for="genres"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genres</label>
                            <select name="genres[]" id="genres" style="width: 100%" multiple="multiple"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                                {{-- <option value="movie">Movie</option>
                                <option value="series">Series</option> --}}
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Actor Select --}}
                        <div class="col-span-6">
                            <label for="stars"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Actors</label>
                            <select name="stars[]" id="stars" style="width: 100%" multiple="multiple"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                                @foreach ($stars as $star)
                                    <option value="{{ $star->id }}">{{ $star->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-3">
                            <label for="director"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Director</label>
                            <input type="text" name="director" id="director"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type movie director" required="">
                        </div>
                        <div class="col-span-3">
                            <label for="trailer_url"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trailer URL</label>
                            <input type="url" name="trailer_url" id="trailer_url"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type movie trailer URL" required="">
                        </div>
                        <div class="col-span-3">
                            <label for="poster_banner"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Banner URL</label>
                            <input type="url" name="poster_banner" id="poster_banner"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type movie banner URL" required="">
                        </div>
                        <div class="col-span-3">
                            <label for="poster_url"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poster URL</label>
                            <input type="url" name="poster_url" id="poster_url"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type movie poster URL" required="">
                        </div>
                        <div class="col-span-6">
                            <label for="plot_summary"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plot Summary</label>
                            <textarea name="plot_summary" id="plot_summary"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type movie plot summary" required=""></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new movie
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Movie Modal --}}
    @foreach ($movies as $movie)
        <div id="edit-movie-modal-{{ $movie->slug }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Movie
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="edit-movie-modal-{{ $movie->slug }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" method="POST" action="{{ url('admin/movies/' . $movie->slug) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-6">
                            <div class="col-span-6">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" name="title" id="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type movie title" required="" value="{{ $movie->title }}">
                            </div>
                            <div class="col-span-2">
                                <label for="release_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Release
                                    Date</label>
                                <input type="date" name="release_date" id="release_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required="" value="{{ $movie->release_date }}">
                            </div>
                            {{-- Type Select --}}
                            <div class="col-span-2">
                                <label for="edit-type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select name="type" id="edit-type-{{ $movie->id }}" style="width: 100%"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required="">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}"
                                            @if ($type == $movie->type) selected @endif>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="rating"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                                <input type="number" name="rating" id="rating"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="4.5" required="" min="0" max="5" step="0.1"
                                    value="{{ $movie->rating }}">
                            </div>
                            {{-- Genre Select --}}
                            <div class="col-span-6">
                                <label for="edit-genres"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genres</label>
                                <select name="genres[]" id="edit-genres-{{ $movie->id }}" style="width: 100%"
                                    multiple="multiple"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required="">
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            {{ in_array($genre->id, $movie->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Actor Select --}}
                            <div class="col-span-6">
                                <label for="edit-stars"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Actors</label>
                                <select name="stars[]" id="edit-stars-{{ $movie->id }}" style="width: 100%"
                                    multiple="multiple"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required="">
                                    @foreach ($stars as $star)
                                        <option value="{{ $star->id }}"
                                            {{ in_array($star->id, $movie->stars->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $star->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-3">
                                <label for="director"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Director</label>
                                <input type="text" name="director" id="director"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type movie director" required="" value="{{ $movie->director }}">
                            </div>
                            <div class="col-span-3">
                                <label for="trailer_url"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trailer
                                    URL</label>
                                <input type="url" name="trailer_url" id="trailer_url"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type movie trailer URL" required=""
                                    value="{{ $movie->trailer_url }}">
                            </div>
                            <div class="col-span-3">
                                <label for="poster_banner"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Banner URL</label>
                                <input type="url" name="poster_banner" id="poster_banner"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type movie banner URL" required="" value="{{ $movie->poster_banner }}">
                            </div>
                            <div class="col-span-3">
                                <label for="poster_url"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poster URL</label>
                                <input type="url" name="poster_url" id="poster_url"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type movie poster URL" required="" value="{{ $movie->poster_url }}">
                            </div>
                            <div class="col-span-6">
                                <label for="plot_summary"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plot
                                    Summary</label>
                                <textarea name="plot_summary" id="plot_summary"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type movie plot summary" required="">{{ $movie->plot_summary }}</textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit movie
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- View Movie modal -->
    @foreach ($movies as $movie)
        <div id="modal-view-movie-{{ $movie->slug }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Viewing {{ $movie->title }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="modal-view-movie-{{ $movie->slug }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4 whitespace-normal" style="overflow-wrap: anywhere">
                        <div class="block md:flex">
                            <div class="w-full md:w-1/4 justify-center flex py-3">
                                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}"
                                    class="w-1/2 md:w-full h-auto rounded-md">
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
                                    <p class="text-lg text-gray-500">Rating: <span class="dark:text-white">
                                            {{ $movie->rating }} </span>
                                    </p>
                                    <p class="text-lg text-gray-500">Type: <span class="dark:text-white">
                                            {{ $movie->type }} </span> </p>
                                    <p class="text-lg text-gray-500">Director: <span
                                            class="dark:text-white">{{ $movie->director }}</span>
                                    </p>
                                    <p class="text-lg text-gray-500">Genres: <span class="dark:text-white">
                                            {{ $movie->genres->pluck('name')->implode(', ') }} </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="grid gap-4 grid-cols-6">
                            <div class="col-span-6">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->title }}</p>
                            </div>
                            <div class="col-span-2">
                                <label for="release_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Release
                                    Date</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->release_date }}</p>
                            </div>
                            <div class="col-span-2">
                                <label for="type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->type }}</p>
                            </div>
                            <div class="col-span-2">
                                <label for="rating"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->rating }}</p>
                            </div>
                            <div class="col-span-6">
                                <label for="genres"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genres</label>
                                <p class="text-gray-900 dark:text-white">
                                    @foreach ($movie->genres as $genre)
                                        {{ $genre->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-span-6">
                                <label for="stars"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Actors</label>
                                <p class="text-gray-900 dark:text-white">
                                    @foreach ($movie->stars as $star)
                                        {{ $star->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-span-2">
                                <label for="director"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Director</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->director }}</p>
                            </div>
                            <div class="col-span-2">
                                <label for="trailer_url"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trailer
                                    URL</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->trailer_url }}</p>
                            </div>
                            <div class="col-span-2">
                                <label for="poster_url"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poster
                                    URL</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->poster_url }}</p>
                            </div>
                            <div class="col-span-6">
                                <label for="plot_summary"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plot
                                    Summary</label>
                                <p class="text-gray-900 dark:text-white">{{ $movie->plot_summary }}</p>
                            </div>
                        </div> --}}
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="modal-view-movie-{{ $movie->slug }}" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($movies as $movie)
        <div id="delete-movie-modal-{{ $movie->slug }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-hide="delete-movie-modal-{{ $movie->slug }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 pt-0 text-center">
                        <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to delete this
                            data?</h3>
                        <form action="{{ url('admin/movies', $movie->slug) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                                Yes, I'm sure
                            </button>
                        </form>
                        <a href="#"
                            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                            data-modal-hide="delete-movie-modal-{{ $movie->slug }}">
                            No, cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#type').select2({
                width: 'resolve',
            });

            $('#genres').select2({
                width: 'resolve',
            });

            $('#stars').select2({
                width: 'resolve',
            });
            $('select[id^="edit-type"]').each(function() {
                $(this).select2({
                    width: 'resolve',
                });
            });
            $('select[id^="edit-genres"]').each(function() {
                $(this).select2({
                    width: 'resolve',
                });
            });
            $('select[id^="edit-stars"]').each(function() {
                $(this).select2({
                    width: 'resolve',
                });
            });
        });
    </script>
@endsection
