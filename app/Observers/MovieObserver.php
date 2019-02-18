<?php

namespace App\Observers;

use App\Models\Movie;
use Tmdb\ApiToken;
use Tmdb\Client;

class MovieObserver
{
    /**
     * Handle the movie "creating" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return boolean
     */
    public function creating(Movie $movie)
    {
        return $this->fetchMovieFromTmdb($movie);
    }

    private function fetchMovieFromTmdb(Movie $movie): bool {
        $token  = new ApiToken(env('TMDB_API_KEY'));
        $client = new Client($token);

        try {
            $data = $client->getMoviesApi()->getMovie($movie->tmdb_id);

            $movie->title = $data['title'];
            $movie->imdb_id = $data['imdb_id'];
            $movie->status = $data['status'];
            $movie->release_date = $data['release_date'];
            $movie->overview = $data['overview'];
            $movie->runtime = $data['runtime'];
            $movie->is_adult = $data['adult'];

        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }
}
