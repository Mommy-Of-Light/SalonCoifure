<?php

use BastienJcln\SalonCoifure\Controllers\AuthController;
use BastienJcln\SalonCoifure\Middleware\AuthMiddleware;
use Slim\Psr7\Factory\ResponseFactory;
use BastienJcln\SalonCoifure\Controllers\AdminController;
use BastienJcln\SalonCoifure\Controllers\BarberController;
use BastienJcln\SalonCoifure\Controllers\BarberDashboardController;
use BastienJcln\SalonCoifure\Middleware\BarberMiddleware;

$app->get('/login', [AuthController::class, 'showLogin']);
$app->post('/login', [AuthController::class, 'login']);
$app->get('/logout', [AuthController::class, 'logout']);

$app->get('/admin', [AdminController::class, 'dashboard'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/admin/clients', [AdminController::class, 'clients'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/register', [AuthController::class, 'showRegister']);
$app->post('/register', [AuthController::class, 'register']);

$app->get('/admin/clients/{id}', [AdminController::class, 'clientDetails'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/admin/clients/{id}/edit', [AdminController::class, 'editClient'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->post('/admin/clients/{id}/edit', [AdminController::class, 'updateClient'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->post('/admin/clients/{id}/toggle-status', [AdminController::class, 'toggleClientStatus'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/admin/barbers', [BarberController::class, 'index'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/admin/barbers/create', [BarberController::class, 'create'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->post('/admin/barbers/create', [BarberController::class, 'store'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/admin/barbers/{id}/edit', [BarberController::class, 'edit'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->post('/admin/barbers/{id}/edit', [BarberController::class, 'update'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->post('/admin/barbers/{id}/toggle-status', [BarberController::class, 'toggleStatus'])
    ->add(new AuthMiddleware(new ResponseFactory()));

$app->get('/barber', [BarberDashboardController::class, 'dashboard'])
    ->add(new BarberMiddleware(new ResponseFactory()));