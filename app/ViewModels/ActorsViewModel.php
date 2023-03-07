<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public function __construct(private array $popular_actors, protected int $page)
    {
    }

    /**
     * @return Collection
     */
    public function popular(): Collection
    {
        return collect($this->popular_actors)->map(function (array $actor) {
            return collect($actor)->merge([
                'known_for' => collect($actor['known_for'])
                    ->implode(function (array $film) {
                        return $film['name'] ?? $film['title'];
                    }, ', '),
                'profile_path' => $actor['profile_path']
                    ? movie_poster($actor['profile_path'], 'w235_and_h235_face')
                    : 'https://ui-avatars.com/api?size=235&name=' . $actor['name']
            ])->only('id', 'name', 'profile_path', 'known_for');
        });
    }

    public function previous(): ?int
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next(): int
    {
        return $this->page + 1;
    }
}
