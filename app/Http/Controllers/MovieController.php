<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Contracts\View\View;

class MovieController extends Controller
{
    public function __construct(protected TMDBService $TMDBService)
    {
    }

    /**
     * Index page
     *
     * @return View
     */
    public function index(): View
    {
        $popular_movies = $this->TMDBService->getPopularMoviesList();
        $now_playing = $this->TMDBService->getNowPlayingMoviesList();
        $genres = $this->TMDBService->getMovieGenresList();

        return view('movies.index', new MoviesViewModel($popular_movies, $now_playing, $genres));
    }

    /**
     * Show page
     *
     * @param int $movie
     * @return View
     */
    public function show(int $movie): View
    {
        $movie = $this->TMDBService->getMovieDetail($movie, 'credits,videos,images');

        return view('movies.show', new MovieViewModel($movie));
    }
}
