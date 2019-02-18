# Demo GraphQL API for ngx-lighthouse

This is a demo, that can be used while testing the [ngx-buoy](https://ngx-buoy.com) library.

# Methods

Endpoint: [https://demo.ngx-buoy.com/graph](https://demo.ngx-buoy.com/graph)

## Movies

You can fetch movies with following query.

````graphql
query Movies {
    movies(count: 5, page: 1) {
        data {
            id
            name
            overview
        }
    }
}
````

## Actors
You can fetch actors with following query.
````graphql
query Actors {
    actors(count: 5, page: 1) {
        data {
            id
            name
        }
    }
}
````


## Adding movies

You can add movies to the database, with following mutation.

This will also fetch all the actors that are connected to the movie.

````graphql
mutation AddMovie {
    addMovie(tmdb_id: 700) {
        name
        overview
    }
}
````

_All data is provided by [themoviedb.com](https://themoviedb.com) free of charge._