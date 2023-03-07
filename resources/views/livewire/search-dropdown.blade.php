<div class="relative mt-3 md:mt-0"
     x-data="{ isOpen: true }"
     @click.away="isOpen = false">
    <input type="text"
           wire:model.debounce.500ms="search"
           class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
           placeholder='Search (Press "/" to focus)'
           x-ref="search"
           @keydown.window="if (event.keyCode === 191) { event.preventDefault(); $refs.search.focus(); }"
           @focus="isOpen = true"
           @keydown="isOpen = true"
           @keydown.escape.window="isOpen = false"
           @keydown.shift.tab="isOpen=false">
    <div class="absolute top-0">
        <svg class="fill-current text-gray-500 w-4 mt-2 ml-2"
             xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 30 30">
            <path
                d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"/>
        </svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>
    @if(mb_strlen($search) > 2)
        <div x-show="isOpen"
             x-transition
             class="z-50 absolute text-sm bg-gray-800 rounded w-64 mt-4">
            <ul>
                @forelse($results as $result)
                    <li class="border-b border-gray-700">
                        <a class="hover:bg-gray-700 px-3 py-3 flex items-center"
                           href="{{ route('show', $result['id']) }}"
                           @if($loop->last) @keydown.tab="isOpen = false" @endif>
                            <img class="w-8" src="{{ movie_poster($result['poster_path']) }}"
                                 alt="{{ $result['title'] }}">
                            <span class="ml-4">{{ $result['title'] }}</span>
                        </a>
                    </li>
                @empty
                    <li class="px-3 py-3">
                        No results for "{{$search}}"
                    </li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
