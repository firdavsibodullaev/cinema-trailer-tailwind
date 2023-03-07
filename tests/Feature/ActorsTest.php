<?php

namespace Tests\Feature;

use Carbon\Carbon;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ActorsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_popular_actors_list(): void
    {
        $this->withoutExceptionHandling();

        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=1' => $this->getFakePopularActorsList()
        ]);

        $this->get(route('actors.index'))
            ->assertSuccessful()
            ->assertSee('Popular Actors')
            ->assertSee('Actor Name')
            ->assertSee('Film 1, Film 2, Film 3')
            ->assertSee(movie_poster('/zF3la0KvayUV3uACYPiBgCRIQcI.jpg', 'w235_and_h235_face'));

    }

    public function test_success_popular_actors_pagination()
    {
        $this->withoutExceptionHandling();

        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=2' => $this->getFakePopularActorsListPage2()
        ]);

        $this->get(route('actors.index', ['page' => 2]))
            ->assertSuccessful()
            ->assertSee('Popular Actors')
            ->assertSee('Actor Name 2')
            ->assertSee('Film 1, Film 2, Film 3')
            ->assertSee(movie_poster('/zF3la0KvayUV3uACYPiBgCRIQcI.jpg', 'w235_and_h235_face'))
            ->assertSee('Actor Name 3')
            ->assertSee('Film 4, Film 5, Film 6')
            ->assertSee(movie_poster('/zF3la0KvayUV3uACYPiBgCRIQc1.jpg', 'w235_and_h235_face'));
    }

    public function test_success_show_actors_detail_information()
    {
        Http::fake([
            'https://api.themoviedb.org/3/person/*' => $this->getFakeActorDetailInfo()
        ]);

        $this->get(route('actors.show', 12312))
            ->assertSuccessful()
            ->assertSee(movie_poster('/pQZ5zK9sIiB6suH0YDfbxpfToQa.jpg', 'w300'))
            ->assertSee('Facebook')
            ->assertSee('https://www.facebook.com/VancityReynolds')
            ->assertSee('https://www.instagram.com/vancityreynolds')
            ->assertSee('https://twitter.com/VancityReynolds')
            ->assertSee('Actor Name')
            ->assertSee(Carbon::parse('1997-05-27')->format('M d, Y'))
            ->assertSee(Carbon::parse('1997-05-27')->age)
            ->assertSee('Wuhan，Hubei Province，China')
            ->assertSee('Actor\'s short biography')
            ->assertSee('Known For')
            ->assertSee(route('show', 1))
            ->assertSee('Movie 1')
            ->assertSee(movie_poster('/nW4yuhsWVK8xPeVupA6eoMZOFZj.jpg', 'w150_and_h225_bestv2'))
            ->assertSee(route('show', 1))
            ->assertSee('Movie 1')
            ->assertSee(movie_poster('/nW4yuhsWVK8xPeVupA6eoMZOFZj.jpg', 'w150_and_h225_bestv2'))
            ->assertSee(route('show', 2))
            ->assertSee('Movie 2')
            ->assertSee(movie_poster('/nW4yuhsWVK8xPeVupA6eoMZOFZ1.jpg', 'w150_and_h225_bestv2'))
            ->assertSee(route('show', 3))
            ->assertSee('Movie 3')
            ->assertSee(movie_poster('/nW4yuhsWVK8xPeVupA6eoMZOFZ2.jpg', 'w150_and_h225_bestv2'))
            ->assertSee('Credits')
            ->assertSee('2018')
            ->assertSee('Movie 1')
            ->assertSee('Character 1')
            ->assertSee('2017')
            ->assertSee('Movie 2')
            ->assertSee('Character 2')
            ->assertSee('2016')
            ->assertSee('Movie 3')
            ->assertSee('Character 3')
            ->assertSee('1998')
            ->assertSee('TV 1')
            ->assertSee('Character 4');
    }

    /**
     * @return PromiseInterface
     */
    protected function getFakePopularActorsList(): PromiseInterface
    {
        return Http::response([
            "page" => 1,
            "results" => [
                [
                    "adult" => false,
                    "gender" => 1,
                    "id" => 2359226,
                    "known_for" => [
                        [
                            "backdrop_path" => "/bKxiLRPVWe2nZXCzt6JPr5HNWYm.jpg",
                            "first_air_date" => "2020-12-10",
                            "genre_ids" => [
                                18,
                                9648,
                                10759,
                                10765,
                            ],
                            "id" => 110316,
                            "media_type" => "tv",
                            "name" => "Film 1",
                            "origin_country" => [
                                "JP",
                            ],
                            "original_language" => "ja",
                            "original_name" => "今際の国のアリス",
                            "overview" => "With his two friends, a video-game-obsessed young man finds himself in a strange version of Tokyo where they must compete in dangerous games to win.",
                            "poster_path" => "/uFXEoVPENgKJrkxFWlOhNMDwlEk.jpg",
                            "vote_average" => 8.2,
                            "vote_count" => 1135,
                        ],
                        [
                            "adult" => false,
                            "backdrop_path" => "/d8BfGEG89KIinlIYKYVinihaysx.jpg",
                            "genre_ids" => [
                                35,
                            ],
                            "id" => 677602,
                            "media_type" => "movie",
                            "original_language" => "ja",
                            "original_title" => "ぐらんぶる",
                            "overview" => "Iori’s only dream is to go to college on a remote island—but when he gets roped into the school’s debaucherous, alcohol-indulgent diving club his hope for a sparkling campus life is thrown into chaos.",
                            "poster_path" => "/iZGnDnstcdorT0zJRpWzSQlMNz6.jpg",
                            "release_date" => "2020-08-07",
                            "title" => "Film 2",
                            "video" => false,
                            "vote_average" => 5.4,
                            "vote_count" => 8,
                        ],
                        [
                            "backdrop_path" => "/iNpbnWI2vQWGdPC9Pbt1RnV71R5.jpg",
                            "first_air_date" => "2019-07-06",
                            "genre_ids" => [
                                10751,
                                18,
                            ],
                            "id" => 91414,
                            "media_type" => "tv",
                            "name" => "Film 3",
                            "origin_country" => [
                                "JP",
                            ],
                            "original_language" => "ja",
                            "original_name" => "ランウェイ 24",
                            "overview" => "
              Inoue Momoko admires her late father, who was a pilot. She begins work as a co-pilot at a low-cost airline. Under Captain Shinkai Kohei’s instructions, who knew her father, Inoue Momoko works hard to become a captain a
nd her boyfriend Umino Daisuke supports her dream too.\n
              \n
              One day, Inoue Momoko has a problem with a passenger complaining about the limit for carry-on baggage. At that time, Katsuki Tetsuya looks at the situation.
              ",
                            "poster_path" => "/3jmLPnWN8QfYtlB6tcxO9VivIVN.jpg",
                            "vote_average" => 6,
                            "vote_count" => 1,
                        ],
                    ],
                    "known_for_department" => "Acting",
                    "name" => "Actor Name",
                    "popularity" => 758.598,
                    "profile_path" => "/zF3la0KvayUV3uACYPiBgCRIQcI.jpg",
                ]
            ],
            "total_pages" => 2,
            "total_results" => 10
        ]);
    }

    /**
     * @return PromiseInterface
     */
    protected function getFakePopularActorsListPage2(): PromiseInterface
    {
        return Http::response([
            "page" => 1,
            "results" => [
                [
                    "adult" => false,
                    "gender" => 1,
                    "id" => 2359226,
                    "known_for" => [
                        [
                            "backdrop_path" => "/bKxiLRPVWe2nZXCzt6JPr5HNWYm.jpg",
                            "first_air_date" => "2020-12-10",
                            "genre_ids" => [
                                18,
                                9648,
                                10759,
                                10765,
                            ],
                            "id" => 110316,
                            "media_type" => "tv",
                            "name" => "Film 1",
                            "origin_country" => [
                                "JP",
                            ],
                            "original_language" => "ja",
                            "original_name" => "今際の国のアリス",
                            "overview" => "With his two friends, a video-game-obsessed young man finds himself in a strange version of Tokyo where they must compete in dangerous games to win.",
                            "poster_path" => "/uFXEoVPENgKJrkxFWlOhNMDwlEk.jpg",
                            "vote_average" => 8.2,
                            "vote_count" => 1135,
                        ],
                        [
                            "adult" => false,
                            "backdrop_path" => "/d8BfGEG89KIinlIYKYVinihaysx.jpg",
                            "genre_ids" => [
                                35,
                            ],
                            "id" => 677602,
                            "media_type" => "movie",
                            "original_language" => "ja",
                            "original_title" => "ぐらんぶる",
                            "overview" => "Iori’s only dream is to go to college on a remote island—but when he gets roped into the school’s debaucherous, alcohol-indulgent diving club his hope for a sparkling campus life is thrown into chaos.",
                            "poster_path" => "/iZGnDnstcdorT0zJRpWzSQlMNz6.jpg",
                            "release_date" => "2020-08-07",
                            "title" => "Film 2",
                            "video" => false,
                            "vote_average" => 5.4,
                            "vote_count" => 8,
                        ],
                        [
                            "backdrop_path" => "/iNpbnWI2vQWGdPC9Pbt1RnV71R5.jpg",
                            "first_air_date" => "2019-07-06",
                            "genre_ids" => [
                                10751,
                                18,
                            ],
                            "id" => 91414,
                            "media_type" => "tv",
                            "name" => "Film 3",
                            "origin_country" => [
                                "JP",
                            ],
                            "original_language" => "ja",
                            "original_name" => "ランウェイ 24",
                            "overview" => "
              Inoue Momoko admires her late father, who was a pilot. She begins work as a co-pilot at a low-cost airline. Under Captain Shinkai Kohei’s instructions, who knew her father, Inoue Momoko works hard to become a captain a
nd her boyfriend Umino Daisuke supports her dream too.\n
              \n
              One day, Inoue Momoko has a problem with a passenger complaining about the limit for carry-on baggage. At that time, Katsuki Tetsuya looks at the situation.
              ",
                            "poster_path" => "/3jmLPnWN8QfYtlB6tcxO9VivIVN.jpg",
                            "vote_average" => 6,
                            "vote_count" => 1,
                        ],
                    ],
                    "known_for_department" => "Acting",
                    "name" => "Actor Name 2",
                    "popularity" => 758.598,
                    "profile_path" => "/zF3la0KvayUV3uACYPiBgCRIQcI.jpg",
                ],
                [
                    "adult" => false,
                    "gender" => 1,
                    "id" => 2359226,
                    "known_for" => [
                        [
                            "backdrop_path" => "/bKxiLRPVWe2nZXCzt6JPr5HNWYm.jpg",
                            "first_air_date" => "2020-12-10",
                            "genre_ids" => [
                                18,
                                9648,
                                10759,
                                10765,
                            ],
                            "id" => 110316,
                            "media_type" => "tv",
                            "name" => "Film 4",
                            "origin_country" => [
                                "JP",
                            ],
                            "original_language" => "ja",
                            "original_name" => "今際の国のアリス",
                            "overview" => "With his two friends, a video-game-obsessed young man finds himself in a strange version of Tokyo where they must compete in dangerous games to win.",
                            "poster_path" => "/uFXEoVPENgKJrkxFWlOhNMDwlEk.jpg",
                            "vote_average" => 8.2,
                            "vote_count" => 1135,
                        ],
                        [
                            "adult" => false,
                            "backdrop_path" => "/d8BfGEG89KIinlIYKYVinihaysx.jpg",
                            "genre_ids" => [
                                35,
                            ],
                            "id" => 677602,
                            "media_type" => "movie",
                            "original_language" => "ja",
                            "original_title" => "ぐらんぶる",
                            "overview" => "Iori’s only dream is to go to college on a remote island—but when he gets roped into the school’s debaucherous, alcohol-indulgent diving club his hope for a sparkling campus life is thrown into chaos.",
                            "poster_path" => "/iZGnDnstcdorT0zJRpWzSQlMNz6.jpg",
                            "release_date" => "2020-08-07",
                            "title" => "Film 5",
                            "video" => false,
                            "vote_average" => 5.4,
                            "vote_count" => 8,
                        ],
                        [
                            "backdrop_path" => "/iNpbnWI2vQWGdPC9Pbt1RnV71R5.jpg",
                            "first_air_date" => "2019-07-06",
                            "genre_ids" => [
                                10751,
                                18,
                            ],
                            "id" => 91414,
                            "media_type" => "tv",
                            "name" => "Film 6",
                            "origin_country" => [
                                "JP",
                            ],
                            "original_language" => "ja",
                            "original_name" => "ランウェイ 24",
                            "overview" => "
              Inoue Momoko admires her late father, who was a pilot. She begins work as a co-pilot at a low-cost airline. Under Captain Shinkai Kohei’s instructions, who knew her father, Inoue Momoko works hard to become a captain a
nd her boyfriend Umino Daisuke supports her dream too.\n
              \n
              One day, Inoue Momoko has a problem with a passenger complaining about the limit for carry-on baggage. At that time, Katsuki Tetsuya looks at the situation.
              ",
                            "poster_path" => "/3jmLPnWN8QfYtlB6tcxO9VivIVN.jpg",
                            "vote_average" => 6,
                            "vote_count" => 1,
                        ],
                    ],
                    "known_for_department" => "Acting",
                    "name" => "Actor Name 3",
                    "popularity" => 758.598,
                    "profile_path" => "/zF3la0KvayUV3uACYPiBgCRIQc1.jpg",
                ]
            ],
            "total_pages" => 2,
            "total_results" => 10
        ]);
    }

    protected function getFakeActorDetailInfo(): PromiseInterface
    {
        return Http::response([
            "adult" => false,
            "also_known_as" => [
                "王玉雯",
                " Wang Yuwen",
                "Uvin Wang",
                "Wang Yu Wen",
            ],
            "biography" => "Actor's short biography",
            "birthday" => "1997-05-27",
            "deathday" => null,
            "gender" => 1,
            "homepage" => null,
            "id" => 1836775,
            "imdb_id" => "nm9112772",
            "known_for_department" => "Acting",
            "name" => "Actor Name",
            "place_of_birth" => "Wuhan，Hubei Province，China",
            "popularity" => 7.02,
            "profile_path" => "/pQZ5zK9sIiB6suH0YDfbxpfToQa.jpg",
            "combined_credits" => [
                "cast" => [
                    [
                        "adult" => false,
                        "backdrop_path" => "/5ZGIKYQruoPLmD0hSmDcue5hK5P.jpg",
                        "genre_ids" => [10749, 35],
                        "id" => 1,
                        "original_language" => "zh",
                        "original_title" => "遇见你真好",
                        "overview" => "Love stories of students in a re-preparing school for college entrance exams.",
                        "popularity" => 0.665,
                        "poster_path" => "/nW4yuhsWVK8xPeVupA6eoMZOFZj.jpg",
                        "release_date" => "2018-02-29",
                        "title" => "Movie 1",
                        "video" => false,
                        "vote_average" => 0.0,
                        "vote_count" => 0,
                        "character" => "Character 1",
                        "credit_id" => "5b3b6f16c3a368161c0130c8",
                        "order" => 0,
                        "media_type" => "movie",
                    ],
                    [
                        "adult" => false,
                        "backdrop_path" => "/5ZGIKYQruoPLmD0hSmDcue5hK5P.jpg",
                        "genre_ids" => [10749, 35],
                        "id" => 2,
                        "original_language" => "zh",
                        "original_title" => "遇见你真好",
                        "overview" => "Love stories of students in a re-preparing school for college entrance exams.",
                        "popularity" => 0.665,
                        "poster_path" => "/nW4yuhsWVK8xPeVupA6eoMZOFZ1.jpg",
                        "release_date" => "2017-03-22",
                        "title" => "Movie 2",
                        "video" => false,
                        "vote_average" => 0.0,
                        "vote_count" => 0,
                        "character" => "Character 2",
                        "credit_id" => "5b3b6f16c3a368161c0130c8",
                        "order" => 0,
                        "media_type" => "movie",
                    ],
                    [
                        "adult" => false,
                        "backdrop_path" => "/5ZGIKYQruoPLmD0hSmDcue5hK5P.jpg",
                        "genre_ids" => [10749, 35],
                        "id" => 3,
                        "original_language" => "zh",
                        "original_title" => "遇见你真好",
                        "overview" => "Love stories of students in a re-preparing school for college entrance exams.",
                        "popularity" => 0.665,
                        "poster_path" => "/nW4yuhsWVK8xPeVupA6eoMZOFZ2.jpg",
                        "release_date" => "2016-03-21",
                        "title" => "Movie 3",
                        "video" => false,
                        "vote_average" => 0.0,
                        "vote_count" => 0,
                        "character" => "Character 3",
                        "credit_id" => "5b3b6f16c3a368161c0130c8",
                        "order" => 0,
                        "media_type" => "movie",
                    ],
                    [
                        "adult" => false,
                        "backdrop_path" => "/4xQf8p7jjf1BW4zs8jlituUrvbr.jpg",
                        "genre_ids" => [35],
                        "id" => 75,
                        "origin_country" => ["US"],
                        "original_language" => "en",
                        "original_name" => "Two Guys and a Girl",
                        "overview" => "This story revolves around the lives of three teenagers, Berg, Pete and Sharon and how their lives are entwined. It further deals with the bonds they share with each other.",
                        "popularity" => 17.827,
                        "poster_path" => "/ulm7wLxyxDNO8kEe12oTM5efWfb.jpg",
                        "first_air_date" => "1998-03-10",
                        "name" => "TV 1",
                        "vote_average" => 7.236,
                        "vote_count" => 121,
                        "character" => "Character 4",
                        "credit_id" => "525335fd19c295794003c6f1",
                        "episode_count" => 81,
                        "media_type" => "tv",
                    ]
                ],
                "crew" => [],
            ],
            "external_ids" => [
                "freebase_mid" => "/m/036hf4",
                "freebase_id" => "/en/ryan_reynolds",
                "imdb_id" => "nm0005351",
                "tvrage_id" => 47752,
                "wikidata_id" => "Q192682",
                "facebook_id" => "VancityReynolds",
                "instagram_id" => "vancityreynolds",
                "twitter_id" => "VancityReynolds",
            ],
        ]);
    }
}
