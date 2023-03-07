<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cinema</title>
    @livewireStyles
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
</head>
<body class="font-sans bg-gray-900 text-white">
<nav class="border-b border-gray-800">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-4 py-6">
        <ul class="flex items-center flex-col md:flex-row">
            <li>
                <a href="{{ route('index') }}">
                    <svg fill="#ffffff" width="50px" height="50px" viewBox="0 0 36 36" version="1.1"
                         preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path class="clr-i-solid clr-i-solid-path-1"
                              d="M30,4H6A2,2,0,0,0,4,6V30a2,2,0,0,0,2,2H30a2,2,0,0,0,2-2V6A2,2,0,0,0,30,4ZM20,7h2v3H20ZM14,7h2v3H14ZM10,29H8V26h2Zm0-19H8V7h2Zm6,19H14V26h2Zm6,0H20V26h2Zm3.16-10.16L15.39,23.2A1,1,0,0,1,14,22.28V13.57a1,1,0,0,1,1.41-.91L25.16,17A1,1,0,0,1,25.16,18.84ZM28,29H26V26h2Zm0-19H26V7h2Z"></path>
                        <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
                    </svg>
                </a>
            </li>
            <li class="md:ml-16 mt-3 md:mt-0">
                <a href="{{ route('index') }}" class="hover:text-gray-300">Movies</a>
            </li>
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="{{ route('tv.index') }}" class="hover:text-gray-300">TV Shows</a>
            </li>
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
            </li>
        </ul>
        <div class="flex flex-col md:flex-row items-center">
            <livewire:search-dropdown/>
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="#">
                    <img class="rounded-full w-8 h-8"
                         src="{{ asset('assets/img/avatar.png') }}"
                         alt="avatar">
                </a>
            </div>
        </div>
    </div>
</nav>
@yield('content')
@livewireScripts
@stack('scripts')
</body>
</html>
