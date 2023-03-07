<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TVsViewModel extends ViewModel
{
    public function __construct(
        protected Collection $popular,
        protected Collection $top_rated,
        protected array      $genres
    )
    {
    }

    public function popular(): Collection
    {
        return collect($this->popular->get('results'))->map(function (array $item) {
            return $this->formatData($item);
        });
    }

    /**
     * @return Collection
     */
    public function topRated(): Collection
    {
        return collect($this->top_rated->get('results'))->map(function (array $item) {
            return $this->formatData($item);
        });
    }

    /**
     * @return Collection
     */
    protected function genres(): Collection
    {
        return collect($this->genres);
    }

    /**
     * @param array $item
     * @return Collection
     */
    protected function formatData(array $item): Collection
    {
        return collect($item)->merge([
            'poster_path' => movie_poster($item['poster_path']),
            'vote_average' => $item['vote_average'] * 10 . '%',
            'first_air_date' => date_create($item['first_air_date'])->format('M d, Y'),
            'genres' => $this->genres()->whereIn('id', $item['genre_ids'])->implode('name', ', ')
        ])->only([
            'id',
            'name',
            'poster_path',
            'vote_average',
            'first_air_date',
            'genres'
        ]);
    }
}
