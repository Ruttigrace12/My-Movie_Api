<?php

declare(strict_types=1);

namespace Tests\Domain\Movie;

use MovieApi\models\Movie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    public function movieProvider(): array
    {
        return [
            [
                1,
                '1',
                'Die Hard',
                1988,
                '20 Jul 1988',
                '132 min',
                'Action, Thriller',
                'John McTiernan',
                'Bruce Willis, Alan Rickman, Bonnie Bedelia',
                'United States',
                'https://m.media-amazon.com/images/M/MV5BZjRlNDUxZjAtOGQ4OC00OTNlLTgxNmQtYTBmMDgwZmNmNjkxXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                8.2,
                'movie'
            ],
            // Add more movie data as needed
        ];
    }

    /**
     * @dataProvider movieProvider
     * @param int    $id
     * @param string $uid
     * @param string $title
     * @param int    $year
     * @param string $released
     * @param string $runtime
     * @param string $genre
     * @param string $director
     * @param string $actors
     * @param string $country
     * @param string $poster
     * @param float  $imdb
     * @param string $type
     */
    public function testGetters(
        int $id,
        string $uid,
        string $title,
        int $year,
        string $released,
        string $runtime,
        string $genre,
        string $director,
        string $actors,
        string $country,
        string $poster,
        float $imdb,
        string $type
    ) {
        $movie = new Movie(
            $id,
            $uid,
            $title,
            $year,
            $released,
            $runtime,
            $genre,
            $director,
            $actors,
            $country,
            $poster,
            $imdb,
            $type
        );

        $this->assertEquals($id, $movie->getId());
        $this->assertEquals($uid, $movie->getUid());
        $this->assertEquals($title, $movie->getTitle());
        $this->assertEquals($year, $movie->getYear());
        $this->assertEquals($released, $movie->getReleased());
        $this->assertEquals($runtime, $movie->getRuntime());
        $this->assertEquals($genre, $movie->getGenre());
        $this->assertEquals($director, $movie->getDirector());
        $this->assertEquals($actors, $movie->getActors());
        $this->assertEquals($country, $movie->getCountry());
        $this->assertEquals($poster, $movie->getPoster());
        $this->assertEquals($imdb, $movie->getImdb());
        $this->assertEquals($type, $movie->getType());
    }

    /**
     * @dataProvider movieProvider
     * @param int    $id
     * @param string $uid
     * @param string $title
     * @param int    $year
     * @param string $released
     * @param string $runtime
     * @param string $genre
     * @param string $director
     * @param string $actors
     * @param string $country
     * @param string $poster
     * @param float  $imdb
     * @param string $type
     */
    public function testJsonSerialize(
        int $id,
        string $uid,
        string $title,
        int $year,
        string $released,
        string $runtime,
        string $genre,
        string $director,
        string $actors,
        string $country,
        string $poster,
        float $imdb,
        string $type
    ) {
        $movie = new Movie(
            $id,
            $uid,
            $title,
            $year,
            $released,
            $runtime,
            $genre,
            $director,
            $actors,
            $country,
            $poster,
            $imdb,
            $type
        );

        $expectedPayload = json_encode([
            'id' => $id,
            'uid' => $uid,
            'title' => $title,
            'year' => $year,
            'released' => $released,
            'runtime' => $runtime,
            'genre' => $genre,
            'director' => $director,
            'actors' => $actors,
            'country' => $country,
            'poster' => $poster,
            'imdb' => $imdb,
            'type' => $type,
        ]);

        $this->assertEquals($expectedPayload, json_encode($movie));
    }
}