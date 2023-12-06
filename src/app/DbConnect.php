<?php
namespace MovieApi\app;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use PDO;

final class DbConnect
{
    public ?PDO $conn = null;
    /**
     * @throws NotFoundException
     * @throws DependencyException
     */
    public function __construct(Container $container)
    {
        if ($this->conn == null) {
            $dbHost = $container->get('settings')['DB_HOST'];
            $dbName = $container->get('settings')['DB_NAME'];
            $dbUser = $container->get('settings')['DB_USER'];
            $dbPassword = $container->get('settings')['DB_PASSWORD'];
            $dsn = "mysql:host=$dbHost;dbname=$dbName";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conn = new PDO($dsn, $dbUser, $dbPassword, $options);
        }
    }
}