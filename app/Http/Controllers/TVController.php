<?php

namespace App\Http\Controllers;


use App\Services\TMDBService;
use App\ViewModels\TVsViewModel;
use App\ViewModels\TVViewModel;
use Illuminate\Contracts\View\View;

class TVController extends Controller
{
    public function __construct(private TMDBService $TMDBService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $popular_tv = $this->TMDBService->getPopularTVList();


        $top_rated = $this->TMDBService->getTopRatedTVList();
        $genres = $this->TMDBService->getTvGenresList();

        return view('tv.index', new TVsViewModel($popular_tv, $top_rated, $genres));
    }

    /**
     * Display the specified resource.
     *
     * @param int $tv_id
     * @return View
     */
    public function show(int $tv_id): View
    {
        $tv = $this->TMDBService->getTVDetail($tv_id, 'credits,videos,images');

        return view('tv.show', new TVViewModel($tv));
    }
}
