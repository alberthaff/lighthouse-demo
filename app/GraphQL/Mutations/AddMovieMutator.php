<?php namespace App\GraphQL\Mutations;

use App\GraphQL\Exceptions\ValidationException;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Role;
use Tmdb\Laravel\Facades\Tmdb;

class AddMovieMutator
{
    public function add($root, array $args, $context)
    {

        $movieData = $this->fetchMovie($args["tmdbId"]);

        if(is_null($movieData)) {
            Throw new ValidationException("Movie with id \"{$args["tmdbId"]}\" was not found in The Movie Database.");
        }
        
        // Create movie in database
        $movie = Movie::updateOrCreate(
            [
                "tmdb_id"       => $args["tmdbId"]
            ],
            [
                "title"         => $movieData["title"],
                "imdb_id"       => $movieData["imdb_id"],
                "status"        => $movieData["status"],
                "release_date"  => $movieData["release_date"],
                "overview"      => $movieData["overview"],
                "runtime"       => $movieData["runtime"],
                "poster"        => $movieData["poster_path"]
            ]
        );

        $this->fetchMovieCast($args["tmdbId"], $movie);

        return $movie;
    }

    private function fetchMovie(Int $tmdbId) {
        try {
            return  Tmdb::getMoviesApi()->getMovie($tmdbId);

        } catch (\Exception $exception) {
            // Do nothing
        }

        return null;
    }

    private function fetchMovieCast(Int $tmdbId, Movie $movie) {
        collect(Tmdb::getMoviesApi()->getCredits($tmdbId)["cast"])->each(function ($role) use ($movie) {

            // Update or create actor
            $actor = Actor::updateOrCreate(
                [
                    "tmdb_id"   => $role["id"]
                ],
                [
                    "name"      => $role["name"],
                    "profile"   => $role["profile_path"]
                ]
            );

            // Update or create role
            Role::updateOrCreate(
                [
                    "actor_id"  => $actor->id,
                    "movie_id"  => $movie->id
                ],
                [
                    "character" => $role["character"]
                ]
            );
        });
    }
}