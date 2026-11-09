<?php

declare(strict_types=1);

namespace BastienJcln\SalonCoifure\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            $response = $this->responseFactory->createResponse(302);

            return $response->withHeader('Location', '/login');
        }

        // Vérifier si l'utilisateur est administrateur
        if ($_SESSION['user']['role'] !== 'admin') {
            $destinations = [
                'client' => '/account',
                'barber' => '/barber',
            ];

            $role = $_SESSION['user']['role'];

            $destination = $destinations[$role] ?? '/login';

            $response = $this->responseFactory->createResponse(302);

            return $response->withHeader('Location', $destination);
        }

        // L'utilisateur est administrateur : continuer
        return $handler->handle($request);
    }
}