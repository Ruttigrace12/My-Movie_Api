<?php
namespace MovieApi\Controllers;
use Laminas\Diactoros\Response\JsonResponse;
use MovieApi\middlewares\middlewareAfter;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
class ExceptionController extends A_controller
{
    public function notFound(Request $request, Response $response): JsonResponse
    {
        $middleware = new MiddlewareAfter($this->container);
        $payload = ['status' => 404, 'message' => 'not found'];
        $response = new JsonResponse($payload, 404);
        $middleware->logResponse($response);
        return $response;
    }
}