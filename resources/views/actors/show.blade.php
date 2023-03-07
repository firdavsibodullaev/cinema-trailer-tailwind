@extends('layouts.app')
@section('content')
    <div class="person-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}">
                <ul class="flex items-center mt-4">
                    @foreach($actor['social'] as $social)
                        <li @class(['ml-6' => !$loop->first])>
                            <a href="{{ $social['link'] }}"
                               target="_blank"
                               title="{{ $social['title'] }}">
                                {!! $social['icon'] !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
                <div class="flex flex-wrap items center text-gray-400 text-sm">
                    <svg class="fill-current text-gray-400 hover:text-white w-4"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 296 296"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                            <path
                                d="m245.328,256.334c-14.999,0-22.952-6.559-29.342-11.828-5.753-4.744-9.909-8.172-19.162-8.172-9.251,0-13.407,3.428-19.159,8.172-6.389,5.27-14.341,11.828-29.339,11.828-14.998,0-22.95-6.559-29.34-11.828-5.753-4.744-9.908-8.172-19.16-8.172-9.25,0-13.406,3.428-19.157,8.172-6.39,5.27-14.342,11.828-29.34,11.828-14.998,0-23.366-6.559-29.755-11.828-1.932-1.594-3.574-3.032-5.574-4.249v55.743h264v-56.015c-2,1.271-3.669,2.808-5.747,4.521-6.389,5.269-13.926,11.828-28.925,11.828z"/>
                            <path
                                d="m16,181v41.599c7,2.378 11.709,6.227 15.755,9.563 5.751,4.744 10.115,8.172 19.365,8.172 9.251,0 13.511-3.428 19.263-8.172 6.389-5.27 14.393-11.828 29.39-11.828 14.998,0 22.976,6.559 29.366,11.828 5.753,4.744 9.921,8.172 19.173,8.172 9.251,0 13.414-3.428 19.166-8.172 6.389-5.27 14.344-11.828 29.342-11.828 14.999,0 22.954,6.559 29.343,11.828 5.753,4.744 9.91,8.172 19.163,8.172 9.252,0 12.993-3.428 18.746-8.172 4.216-3.477 8.926-7.502 15.926-9.848v-41.314h-263.998z"/>
                            <rect width="198" x="49" y="99" height="65"/>
                            <path
                                d="M90,47.426c5-2.816,8.665-8.219,8.665-14.426c0-9.112-16.417-33-16.417-33S65.624,23.888,65.624,33   c0,6.209,3.376,11.611,8.376,14.427V82h16V47.426z"/>
                            <path
                                d="M156,47.123c5-2.889,8.167-8.124,8.167-14.123c0-9.112-16.417-33-16.417-33s-16.625,23.888-16.625,33   c0,6.408,3.874,11.951,8.874,14.684V82h16V47.123z"/>
                            <path
                                d="M222,47.426c5-2.816,8.665-8.219,8.665-14.426c0-9.112-16.417-33-16.417-33s-16.625,23.888-16.625,33   c0,6.209,3.376,11.611,8.376,14.427V82h16V47.426z"/>
                        </g>
                    </svg>
                    <span
                        class="ml-2">{{ $actor['birthday'] }} ({{ $actor['age'] }} years old) in {{ $actor['place_of_birth'] }}</span>
                </div>
                <p class="text-gray-300 mt-8 text-justify">
                    {{ $actor['biography'] }}
                </p>
                <h4 class="font-semibold mt-12">Known For</h4>
                <div class="grid grid-cols sm:grid-cols-2 lg:grid-cols-5 gap-8">
                    @foreach($actor['known_for'] as $movie)
                        <div class="mt-4">
                            <a href="{{ $movie['movie_path'] }}">
                                <img src="{{ $movie['poster_path'] }}"
                                     class="hover:opacity-75 transition ease-in-out duration-150"
                                     alt="">
                            </a>
                            <a href="{{ $movie['movie_path'] }}"
                               class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{ $movie['title'] }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> <!-- end person-info -->

    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach($actor['credits'] as $credit)
                    <li>
                        {{ $credit['release_year'] }} &middot; <strong>{{ $credit['title'] }}</strong> as {{ $credit['character'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div> <!-- end credits-->
@endsection
