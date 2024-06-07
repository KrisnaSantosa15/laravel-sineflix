@extends('layouts._default.user-main')
@section('content')
    {{-- {{ dd($myWatchlist) }} --}}
    <section class="p-5 py-5 bg-white dark:bg-gray-900">
        <p class="text-2xl text-center font-medium text-gray-800 dark:text-white py-5">
            Hi {{ Auth::user()->name }}, welcome to your dashboard!
        </p>
        <p class="text-lg text-center font-medium text-gray-800 dark:text-white py-5">
            Ready to start watching?
        </p>
        <div class="flex justify-center items-center">
            <a href="{{ route('movies.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Browse Movies
            </a>
        </div>


    </section>
@endsection

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')"
            onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
