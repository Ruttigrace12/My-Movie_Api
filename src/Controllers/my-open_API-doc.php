<?php

namespace MovieApi\Controllers;
error_reporting(1);

use OpenApi\Generator;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;

class OpenApiController
{
    /**
     * @throws \JsonException
     */
    public function documentationsAction(request $request, ResponseInterface $response): ResponseInterface
    {
        $openapi = Generator::scan([__DIR__ . '/../../src']);
        return new JsonResponse(json_decode($openapi->toJson(), true, 512, JSON_THROW_ON_ERROR));
    }
}