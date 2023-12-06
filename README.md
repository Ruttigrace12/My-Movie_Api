# Module 4 Project - Movie details API
### Develop a CRUD REST Movie details API using the Slim PHP framework. The API should adhere to RESTful principles, utilize Composer for package management, and integrate Swagger for API documentation.

## Requirements (mandatory):

Setup and Environment:
Use Composer to manage project dependencies.
Utilize the Slim Framework as the foundation for building the REST API.
Set up a MySQL database for storing data.

```bash
    API Endpoints:
    GET /v1/movies - get list of all existing movies
    POST /v1/movies - add new movie to collection
    PUT /v1/movies/{id} - updates movie by {id}
    DELETE /v1/movies/{id} - deletes movie by {id}
    PATCH /v1/movies/{id} - updates particular data of movie by {id}
    GET /v1/movies/{numberPerPage} - get list of {numberPerPage} existing movies
    GET /v1/movies/{numberPerPage}/sort/{fieldToSort} - get list of {numberPerPage} existing movies sorted by {fieldToSort}
```

## Database Interaction:
Use PDO or an ORM (such as Eloquent) to interact with the database.
Handle database connection, queries, and transactions appropriately.


## Validation and Error Handling:
Implement validation for incoming data (request parameters and body) to ensure data integrity.
Return appropriate HTTP status codes for different scenarios (e.g., 200 for success, 404 for not found, 400 for bad request).
Provide meaningful error messages in response bodies for error situations.

## API Documentation with Swagger:
Integrate Swagger (OpenAPI) for automatic API documentation generation.
Document each endpoint's usage, input parameters, response formats, and example requests/responses.

## Middleware:
Use middleware for request/response logging (mandatory), authentication(not mandatory), or any additional cross-cutting concerns (not mandatory).

## JSON schema of response for (a, f, g):

```bash
    {
    "uid": "1",
    "title": "Die Hard",
    "year": "1988",
    "released": "20 Jul 1988",
    "runtime": "132 min",
    "genre": "Action, Thriller",
    "director": "John McTiernan",
    "actors": "Bruce Willis, Alan Rickman, Bonnie Bedelia",
    "country": "United States",
    "poster": "https://m.media-amazon.com/images/M/MV5BZjRlNDUxZjAtOGQ4OC00OTNlLTgxNmQtYTBmMDgwZmNmNjkxXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg",
    "imdb": "8.2",
    "type": "movie"
    }
```



## JSON schema of response for (b - e):
```bash
    {
    "status": "200/400/404/500",
    "message": "some kind of informative message bla bla bla…"
    }
```


## Requirements  (not mandatory):

Unit Testing:
Write unit tests for different API endpoints and functionality.
Utilize testing frameworks PHPUnit to ensure code correctness and reliability.
Integrate caching mechanisms to improve performance
Implement pagination for retrieving large collections of resources
Add support for querying resources with filtering, sorting, and searching capabilities


## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application. You will require PHP 7.4 or newer.

```bash
composer create-project slim/slim-skeleton [my-app-name]
```

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

To run the application in development, you can run these commands 

```bash
cd movieapi
composer start
```

After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```


