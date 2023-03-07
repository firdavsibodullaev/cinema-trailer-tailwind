<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Contracts\View\View;

class ActorController extends Controller
{
    public function __construct(private TMDBService $TMDBService)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $page = request('page', 1);
        $actors = $this->TMDBService->getPopularActors($page);
        abort_if(!isset($actors['total_pages']), 204);

        return view('actors.index', new ActorsViewModel($actors->get('results'), $page));
    }

    /**
     * @param int $id Movie id
     * @return View
     */
    public function show(int $id): View
    {
        $actor = $this->TMDBService->getActorDetail($id, 'combined_credits,external_ids');

        return view('actors.show', new ActorViewModel($actor));
    }
}
