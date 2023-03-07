<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TMDBService
{
    /** @var PendingRequest */
    private PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::withToken(config('services.tmdb.token'))
            ->baseUrl(config('services.tmdb.base_url'));
    }

    /**
     * Get Popular movies list
     *
     * @return Collection
     */
    public function getPopularMoviesList(): Collection
    {
        return $this->http
            ->get($this->getUrl('/movie/popular'))
            ->collect('results');
    }

    /**
     * Get now playing movies list
     *
     * @return Collection
     */
    public function getNowPlayingMoviesList(): Collection
    {
        return $this->http
            ->get($this->getUrl('/movie/now_playing'))
            ->collect('results');
    }

    /**
     * Get movie genres list
     *
     * @return Collection
     */
    public function getMovieGenresList(): Collection
    {
        return $this->http
            ->get($this->getUrl("/genre/movie/list"))
            ->collect('genres');
    }

    /**
     * Get movie details
     *
     * @param int $id
     * @param string|null $append_to_response
     * @return Collection
     */
    public function getMovieDetail(int $id, ?string $append_to_response = null): Collection
    {
        return $this->http
            ->get($this->getUrl('/movie/' . $id), [
                'append_to_response' => $append_to_response,
            ])->collect();
    }

    /**
     * Search movies
     *
     * @param string $query
     * @return Collection
     */
    public function searchMovies(string $query = ''): Collection
    {
        return $this->http
            ->get($this->getUrl('/search/movie'), compact('query'))
            ->collect('results')
            ->take(7);
    }

    /**
     * @param int $page
     * @return Collection
     */
    public function getPopularActors(int $page): Collection
    {
        return $this->http
            ->get($this->getUrl('/person/popular'), compact('page'))
            ->collect();
    }

    /**
     * @param int $person_id
     * @param string $append_to_response
     * @return Collection
     */
    public function getActorDetail(int $person_id, string $append_to_response = ''): Collection
    {
        return $this->http
            ->get($this->getUrl('/person/' . $person_id), compact('append_to_response'))
            ->collect();
    }

    /**
     * @return Collection
     */
    public function getPopularTVList(): Collection
    {
        return $this->http->get($this->getUrl('tv/popular'))->collect();
    }

    /**
     * @return Collection
     */
    public function getTopRatedTVList(): Collection
    {
        return $this->http->get($this->getUrl('/tv/top_rated'))->collect();
    }

    /**
     * @return array
     */
    public function getTvGenresList(): array
    {
        return $this->http->get($this->getUrl('/genre/tv/list'))->json('genres');
    }

    /**
     * @param int $tv_id
     * @param string $append_to_response
     * @return Collection
     */
    public function getTVDetail(int $tv_id, string $append_to_response = ''): Collection
    {
        return $this->http
            ->get($this->getUrl('/tv/' . $tv_id), compact('append_to_response'))
            ->collect();
    }

    /**
     * Get Full url to API
     *
     * @param string $uri
     * @return string
     */
    protected function getUrl(string $uri): string
    {
        return ltrim($uri, "/");
    }
}
