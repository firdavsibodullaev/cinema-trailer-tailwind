<?php

namespace App\Http\Livewire;

use App\Services\TMDBService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchDropdown extends Component
{
    public string $search = "";
    /**
     * @var TMDBService
     */
    private TMDBService $http;

    public function __construct($id = null)
    {
        $this->http = app(TMDBService::class);
        parent::__construct($id);
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $results = mb_strlen($this->search) > 2
            ? $this->http->searchMovies($this->search)
            : collect();

        return view('livewire.search-dropdown', compact('results'));
    }
}
