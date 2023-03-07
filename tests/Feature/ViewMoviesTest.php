<?php

namespace Tests\Feature;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_main_page_shows_correct_info(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->getFakePopularMoviesList(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->getFakeNowPlayingMoviesList(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->getFakeGenresList(),
        ]);

        $this->get(route('index'))
            ->assertSuccessful()
            ->assertSee('Popular movies')
            ->assertSee('Fake Movie')
            ->assertSee('Now playing movies')
            ->assertSee('Now Playing Fake Movie')
            ->assertSee('Action, Adventure, Animation');
    }

    public function test_show_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->getFakeMovieDetail(),
        ]);

        $this->get(route('show', 12345))
            ->assertSuccessful()
            ->assertSee("Test Narnia")
            ->assertSee("Fake Overview")
            ->assertSee("Crew Name")
            ->assertSee("Director of Photography")
            ->assertSee("Adventure, Family, Fantasy")
            ->assertSee("Cast Name")
            ->assertSee("Fake Character")
            ->assertSee(movie_poster("/yUgFJ3A9IwDy7KhjvIxfUTeNeXO.jpg"))
            ->assertSee(movie_poster("/tuDhEdza074bA497bO9WFEPs6O6.jpg"));
    }

    public function test_the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchMovies()
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('jumanji')
            ->set('search', 'jumanji')
            ->assertSee('Jumanji');
    }

    /**
     * @return PromiseInterface
     */
    protected function getFakePopularMoviesList(): PromiseInterface
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/bQXAqRx2Fgc46uCVWgoPz5L5Dtr.jpg",
                    "genre_ids" => [
                        28,
                        12,
                        16,
                    ],
                    "id" => 436270,
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "overview" => "Nearly 5,000 years after he was bestowed with the almighty powers of the Egyptian gods—and imprisoned just as quickly—Black Adam is freed from his earthly tomb, read
y to unleash his unique form of justice on the modern world.",
                    "popularity" => 3581.64,
                    "poster_path" => "/pFlaoHTZeyNkG83vxsAJiGzfSsa.jpg",
                    "release_date" => "2022-10-19",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 7.2,
                    "vote_count" => 3331,
                ],
            ]
        ]);
    }

    /**
     * @return PromiseInterface
     */
    protected function getFakeNowPlayingMoviesList(): PromiseInterface
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/s16H6tpK2utvwDtzZ8Qy4qm5Emw.jpg",
                    "genre_ids" => [
                        28,
                        12,
                        16,
                    ],
                    "id" => 76600,
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "overview" => "Set more than a decade after the events of the first film, learn the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.",
                    "popularity" => 10226.166,
                    "poster_path" => "/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg",
                    "release_date" => "2022-12-14",
                    "title" => "Now Playing Fake Movie",
                    "video" => false,
                    "vote_average" => 7.9,
                    "vote_count" => 1918,
                ]
            ]
        ]);
    }

    /**
     * @return PromiseInterface
     */
    protected function getFakeGenresList(): PromiseInterface
    {
        return Http::response([
            'genres' => [
                [
                    "id" => 28,
                    "name" => "Action",
                ],
                [
                    "id" => 12,
                    "name" => "Adventure",
                ],
                [
                    "id" => 16,
                    "name" => "Animation",
                ],
            ]
        ]);
    }

    /**
     * @return PromiseInterface
     */
    protected function getFakeMovieDetail(): PromiseInterface
    {
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/tuDhEdza074bA497bO9WFEPs6O6.jpg",
            "belongs_to_collection" => [
                "id" => 420,
                "name" => "The Chronicles of Narnia Collection",
                "poster_path" => "/sh6Kn8VBfXotJ6qsvJkdfscxXKR.jpg",
                "backdrop_path" => "/ojjzZUQlqKTsN1T7s5OAVZSjYMH.jpg",
            ],
            "budget" => 180000000,
            "genres" => [
                [
                    "id" => 12,
                    "name" => "Adventure",
                ],
                [
                    "id" => 10751,
                    "name" => "Family",
                ],
                [
                    "id" => 14,
                    "name" => "Fantasy",
                ],
            ],
            "homepage" => "",
            "id" => 411,
            "imdb_id" => "tt0363771",
            "original_language" => "en",
            "original_title" => "Test Narnia",
            "overview" => "Fake Overview",
            "popularity" => 5338.201,
            "poster_path" => "/yUgFJ3A9IwDy7KhjvIxfUTeNeXO.jpg",
            "production_companies" => [
                [
                    "id" => 2,
                    "logo_path" => "/wdrCwmRnLFJhEoH8GSfymY85KHT.png",
                    "name" => "Walt Disney Pictures",
                    "origin_country" => "US",
                ],
                [
                    "id" => 10221,
                    "logo_path" => "/99VfWRgKasZoyK9UVB39gnYvFrZ.png",
                    "name" => "Walden Media",
                    "origin_country" => "US",
                ],
                [
                    "id" => 79503,
                    "logo_path" => null,
                    "name" => "C.S. Lewis Company",
                    "origin_country" => "",
                ],
            ],
            "production_countries" => [
                [
                    "iso_3166_1" => "GB",
                    "name" => "United Kingdom",
                ],
                [
                    "iso_3166_1" => "US",
                    "name" => "United States of America",
                ],
            ],
            "release_date" => "2005-12-07",
            "revenue" => 745013115,
            "runtime" => 143,
            "spoken_languages" => [
                [
                    "english_name" => "English",
                    "iso_639_1" => "en",
                    "name" => "English",
                ],
                [
                    "english_name" => "German",
                    "iso_639_1" => "de",
                    "name" => "Deutsch",
                ],
            ],
            "status" => "Released",
            "tagline" => "Evil Has Reigned For 100 Years...",
            "title" => "Test Narnia",
            "video" => false,
            "vote_average" => 7.105,
            "vote_count" => 9048,
            "credits" => [
                "cast" => [
                    [
                        "adult" => false,
                        "gender" => 2,
                        "id" => 5527,
                        "known_for_department" => "Acting",
                        "name" => "Cast Name",
                        "original_name" => "Cast Name",
                        "popularity" => 20.497,
                        "profile_path" => "/pIdgY16c6AzmCD31pXlCR9SjLlM.jpg",
                        "cast_id" => 4,
                        "character" => "Fake Character",
                        "credit_id" => "52fe4240c3a36847f800fccd",
                        "order" => 0,
                    ]
                ],
                "crew" => [
                    [
                        "adult" => false,
                        "gender" => 2,
                        "id" => 1095,
                        "known_for_department" => "Camera",
                        "name" => "Crew Name",
                        "original_name" => "Crew Name",
                        "popularity" => 1.465,
                        "profile_path" => "/eZg5UnYR62y6iiyLPt6XC0vsWdV.jpg",
                        "credit_id" => "52fe4240c3a36847f800fd4f",
                        "department" => "Camera",
                        "job" => "Director of Photography",
                    ]
                ]
            ],
            "images" => [
                "backdrops" => [
                    [
                        "aspect_ratio" => 1.778,
                        "height" => 1080,
                        "iso_639_1" => null,
                        "file_path" => "/tuDhEdza074bA497bO9WFEPs6O6.jpg",
                        "vote_average" => 5.318,
                        "vote_count" => 3,
                        "width" => 1920,
                    ]
                ],
                "logos" => [
                    [
                        "aspect_ratio" => 3.049,
                        "height" => 492,
                        "iso_639_1" => "es",
                        "file_path" => "/iENpLLnQw6J35cejyGATK6EJRW9.png",
                        "vote_average" => 5.312,
                        "vote_count" => 1,
                        "width" => 1500,
                    ]
                ],
                "posters" => [
                    [
                        "aspect_ratio" => 0.667,
                        "height" => 3000,
                        "iso_639_1" => "pt",
                        "file_path" => "/2rElTfcZ09mfiDtD1wdE9EyXcUs.jpg",
                        "vote_average" => 5.388,
                        "vote_count" => 4,
                        "width" => 2000,
                    ]
                ]
            ],
            "videos" => [
                "results" => [
                    [
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "name" => "The Chronicles of Narnia: The Lion, the Witch and the Wardrobe (2005) Trailer",
                        "key" => "3mKPrxjwF7A",
                        "site" => "YouTube",
                        "size" => 480,
                        "type" => "Trailer",
                        "official" => false,
                        "published_at" => "2019-04-07T18:34:08.000Z",
                        "id" => "5caa451f0e0a264c69f4e116",
                    ]
                ]
            ]
        ]);
    }

    /**
     * @return PromiseInterface
     */
    protected function fakeSearchMovies(): PromiseInterface
    {
        return Http::response([
            "page" => 1,
            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/7RyHsO4yDXtBv1zUU3mTpHeQ0d5.jpg",
                    "genre_ids" => [
                        12,
                        878,
                        28,
                    ],
                    "id" => 299534,
                    "original_language" => "en",
                    "original_title" => "Jumanji",
                    "overview" => "After the devastating events of Avengers: Infinity War, the universe is in ruins due to the efforts of the Mad Titan, Thanos. With the help of remaining allies, the Avengers must assemble once more in order to undo Thanos' actions and restore order to the universe once and for all, no matter what consequences may be in store.",
                    "popularity" => 112.501,
                    "poster_path" => "/or06FN3Dka5tukK1e9sl16pB3iy.jpg",
                    "release_date" => "2019-04-24",
                    "title" => "Jumanji",
                    "video" => false,
                    "vote_average" => 8.3,
                    "vote_count" => 22313,
                ]
            ],
            "total_pages" => 1,
            "total_results" => 1,
        ]);
    }
}
