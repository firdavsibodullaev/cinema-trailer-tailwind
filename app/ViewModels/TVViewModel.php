<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TVViewModel extends ViewModel
{
    public function __construct(protected Collection $tv)
    {
    }

    /**
     * @return Collection
     */
    public function tv(): Collection
    {
        return $this->tv->merge([
            'poster_path' => movie_poster($this->tv['poster_path']),
            'vote_average' => $this->tv['vote_average'] * 10 . '%',
            'first_air_date' => date_create($this->tv['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tv['genres'])->implode('name', ', '),
            'crew' => collect($this->tv['credits']['crew'])->take(4)->toArray(),
            'cast' => collect($this->tv['credits']['cast'])->take(5)->toArray(),
            'trailer' => $this->getTrailerVideo($this->tv['videos']['results']),
            'images' => $this->getImages($this->tv['images']['backdrops'])
        ])->only([
            'id',
            'poster_path',
            'name',
            'vote_average',
            'first_air_date',
            'genres',
            'crew',
            'cast',
            'trailer',
            'images',
            'overview'
        ]);
    }

    /**
     * @param array $videos
     * @return string
     */
    protected function getTrailerVideo(array $videos): string
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

    /**
     * @param array $images
     * @return array
     */
    protected function getImages(array $images): array
    {
        return collect($images)->take(9)->toArray();
    }
}
