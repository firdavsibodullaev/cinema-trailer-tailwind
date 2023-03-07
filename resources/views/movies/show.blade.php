@extends('layouts.app')
@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-column md:flex-row">
            <div class="flex-none">
                <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-64 md:w-96">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="16"
                         height="16"
                         fill="#ffcc00"
                         viewBox="0 0 16 16">
                        <path
                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $movie['genres'] }}
                    </span>
                </div>
                <p class="text-gray-300 mt-8 text-justify">
                    {{ $movie['overview'] }}
                </p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach($movie['crew'] as $crew)
                            <div class="mr-8 flex-wrap">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div x-data="{ isOpen: false }">
                    @if($trailer = $movie['trailer'])
                        <div class="mt-12">
                            <button @click="isOpen = true"
                                    class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-play-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path
                                        d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                        <div x-show="isOpen"
                             x-transition
                             style="background-color: rgba(0,0,0,.5);"
                             class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            @click="isOpen = false"
                                            @keydown.escape.window="isOpen = false"
                                            class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative"
                                             style="padding-top: 56.25%;">
                                            <iframe src="{{ $trailer }}"
                                                    width="560"
                                                    height="315"
                                                    style="border:0"
                                                    allow="autoplay; encrypted-media"
                                                    allowfullscreen
                                                    class="responsive-iframe absolute top-0 left-0 w-full h-full"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- end movie-info -->

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($movie['cast'] as $cast)
                    <div class="mt-8 hover:opacity-75 transition ease-in-out duration-150">
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            <img src="{{ movie_poster($cast['profile_path']) }}"
                                 alt="{{ $cast['name'] }}">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $cast['id']) }}"
                               class="text-lg mt-2">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">{{ $cast['character'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end movie-cast -->

    <div class="movie-images border-b border-gray-800" x-data="{ isOpen: false, image: null }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semicolon">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($movie['images'] as $image)
                    <div class="mt-8">
                        <a href="javascript:void(0)"
                           @click.prevent="
                            isOpen = true
                            image='{{ movie_poster($image['file_path'], 'original') }}'
                           ">
                            <img src="{{ movie_poster($image['file_path']) }}"
                                 alt="{{ $movie['title'] . "-" . $loop->iteration }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div x-show="isOpen"
                 x-transition
                 style="background-color: rgba(0,0,0,.5);"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end movie-images -->
@endsection
