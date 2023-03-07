@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Popular movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popular_movies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
        </div>
        <div class="now-playing-movies mt-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Now playing movies
            </h2>
            <div class="grid grid-cols-1 justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($now_playing as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
