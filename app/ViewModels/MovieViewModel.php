<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public function __construct(protected Collection $movie)
    {
    }

    /**
     * Get movie
     *
     * @return Collection
     */
    public function movie(): Collection
    {
        return $this->movie->merge([
            'poster_path' => movie_poster($this->movie['poster_path']),
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => date_create($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->implode('name', ', '),
            'crew' => collect($this->movie['credits']['crew'])->take(4)->toArray(),
            'cast' => collect($this->movie['credits']['cast'])->take(5)->toArray(),
            'images' => collect($this->movie['images']['backdrops'])->take(9)->toArray(),
            'trailer' => $this->getTrailer($this->movie['videos']['results'])
        ])->only([
            'id',
            'title',
            'overview',
            'poster_path',
            'vote_average',
            'release_date',
            'genres',
            'crew',
            'cast',
            'images',
            'trailer'
        ]);
    }

    /**
     * Get Movie trailer
     *
     * @param array $videos
     * @return string
     */
    protected function getTrailer(array $videos): string
    {
        $trailers = collect($videos)
            ->where('type', '=', 'Trailer');

        $key = '';

        if ($official = $trailers->where('official', '=', true)->first()) {

            $key = $official['key'];

        } else {

            if ($unofficial = $trailers->where('official', '=', false)->first()) {
                $key = $unofficial['key'];
            }

        }

        return sprintf('https://www.youtube.com/embed/%s', $key);
    }
}
