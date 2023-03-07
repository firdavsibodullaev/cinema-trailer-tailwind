<?php
if (!function_exists('movie_poster')) {
    /**
     * @param string|null $poster_path
     * @param string $size
     * @return string
     */
    function movie_poster(?string $poster_path, string $size = 'w500'): string
    {
        $poster_path = ltrim($poster_path, '/');

        return $poster_path
            ? sprintf('https://image.tmdb.org/t/p/%s/%s', $size, $poster_path)
            : asset('assets/img/placeholder.jpg');
    }
}
