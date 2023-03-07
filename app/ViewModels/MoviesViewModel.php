<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public function __construct(
        public Collection $popular_movies,
        public Collection $now_playing,
        public Collection $genres
    )
    {
    }

    /**
     * @return Collection
     */
    public function popular_movies(): Collection
    {
        return $this->formatMovies($this->popular_movies);
    }

    public function now_playing(): Collection
    {
        return $this->formatMovies($this->now_playing);
    }

    public function genres()
    {
        return $this->genres;
    }

    /**
     * @param Collection $movies
     * @return Collection
     */
    protected function formatMovies(Collection $movies): Collection
    {
        return $movies->map(function (array $movie) {
            return collect($movie)->merge([
                'poster_path' => movie_poster($movie['poster_path']),
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => date_create($movie['release_date'])->format('M d, Y'),
                'genres' => $this->genres->whereIn('id', $movie['genre_ids'])->implode('name', ', ')
            ])->only([
                'id',
                'title',
                'poster_path',
                'overview',
                'release_date',
                'genres',
                'vote_average'
            ]);
        });
    }
}
