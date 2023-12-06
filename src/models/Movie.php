<?php
namespace MovieApi\models;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Faker\Factory;
use PDO;
use Psr\Http\Message\ResponseInterface;
class Movie
{
    protected ?PDO $pdo;
    const DB_TABLE_NAME = 'movies_table';
    protected int $id;
    protected string $title;
    protected int $year;
    protected string $runtime;
    protected string $director;
    protected string $released;
    protected string $actors;
    protected string $country;
    protected string $poster;
    protected string $type;
    protected float $imdb;
    protected string $genre;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->pdo = $container->get('database');
    }

    public function findById(): int
    {
        return -1;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM " . self::DB_TABLE_NAME;
        $stm = $this->getPdo()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    /**
     * @param array $data
     * @return int
     */
    public function insert(array $data): int
    {
        $sql = "INSERT INTO " . self::DB_TABLE_NAME . " (title, year, released, runtime, genre, director, actors,
        country, poster, imdb, type) VALUES (?,?,?,?,?,?,?,?,?,?,?) ";
        $stm = $this->getPdo()->prepare($sql);
        $stm->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5],
            $data[6], $data[7], $data[8], $data[9], $data[10]]);
        return $this->getPdo()->lastInsertId();
    }

    public function updateAllById(array $data): void
    {
        $sql = "UPDATE " . self::DB_TABLE_NAME . " SET title=?, year=?, runtime=?, director=?, released=?, actors=?,
         country=?, poster=?, imdb=?, type=?, genre=? WHERE id=?";
        $this->extracted($sql, $data);
    }

    public function partialUpdate(array $data): void
    {
        $sql = "UPDATE " . self::DB_TABLE_NAME .
            "SET
            title = COALESCE(?, title),
            year = COALESCE(?, year),
            runtime = COALESCE(?, runtime),
            director = COALESCE(?, director),
            released = COALESCE(?, released),
            actors = COALESCE(?, actors),
            country = COALESCE(?, country),
            poster = COALESCE(?, poster),
            imdb = COALESCE(?, imdb),
            type = COALESCE(?, type),
            genre = COALESCE(?, genre)
            WHERE id = :id";
        $this->extracted($sql, $data);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM " . self::DB_TABLE_NAME . " WHERE id=?";
        try {
            $stm = $this->getPdo()->prepare($sql);
            $stm->execute([$id]);
        } catch (\PDOException $exception) {
            return false;
        }
        return true;
    }

    public function getNumberPerPage($numberPerPage = null): array
    {
        $sql = " SELECT * FROM " . self::DB_TABLE_NAME;
        if ($numberPerPage !== null) {
            // Add a LIMIT clause to limit the number of results per page
            $sql .= " LIMIT :limit";
        }
        $stm = $this->getPdo()->prepare($sql);
        if ($numberPerPage !== null) {
            $stm->bindParam(':limit', $numberPerPage, PDO::PARAM_INT);
        }
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSortedMovies($numberPerPage, $fieldToSort): array
    {
        $sql = "SELECT * FROM " . self::DB_TABLE_NAME . " ORDER BY $fieldToSort";
        if ($numberPerPage > 0) {
            $sql .= " LIMIT $numberPerPage";
        }
        $stm = $this->getPdo()->query($sql);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $data
     * @return void
     */
    public function extracted(string $sql, array $data): void
    {
        $stm = $this->getPdo()->prepare($sql);
        $stm->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]]);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}