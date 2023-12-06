<?php
namespace MovieApi\Controllers;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
abstract class A_controller
{
    protected Container $container;
    /**
     * @var ?PDO
     */
    protected mixed $pdo;
    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->pdo = $container->get('database');
        $this->container = $container;
    }
    protected function render(array $data, ResponseInterface $response): ResponseInterface
    {
        $payload = json_encode($data, JSON_PRETTY_PRINT);
        $response->getBody()->write((string)$payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    /**
     * @param Request $request
     * @return mixed[]
     */
    protected function getRequestBodyAsArray(Request $request): array
    {
        $requestBody = explode('&', urldecode($request->getBody()->getContents()));
        $requestBodyParsed = [];
        foreach ($requestBody as $item) {
            $itemTmp = explode('=', $item);
            $requestBodyParsed[$itemTmp[0]] = $itemTmp[1];
        }
        return $requestBodyParsed;
    }
}