<?php

declare(strict_types=1);

namespace BastienJcln\SalonCoifure\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BarberMiddleware implements MiddlewareInterface
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
            return $this->responseFactory
                ->createResponse(302)
                ->withHeader('Location', '/login');
        }

        // Vérifier si l'utilisateur est un coiffeur
        if ($_SESSION['user']['role'] !== 'barber') {

            $destinations = [
                'admin' => '/admin',
                'client' => '/account',
            ];

            $role = $_SESSION['user']['role'];
            $destination = $destinations[$role] ?? '/login';

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader('Location', $destination);
        }

        // Le coiffeur est autorisé
        return $handler->handle($request);
    }
}