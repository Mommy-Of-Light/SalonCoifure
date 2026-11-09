<?php

namespace BastienJcln\SalonCoifure\Controllers;

use BastienJcln\SalonCoifure\Core\Database;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BarberController extends BaseController
{
    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'SELECT id, first_name, last_name, email, phone, created_at, is_active
             FROM users
             WHERE role = :role
             ORDER BY last_name ASC, first_name ASC'
        );

        $stmt->execute([
            'role' => 'barber',
        ]);

        $barbers = $stmt->fetchAll();

        return $this->view->render($response, 'admin/barbers.php', [
            'title' => 'Gestion des coiffeurs',
            'barbers' => $barbers,
        ]);
    }

    public function create(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        return $this->view->render($response, 'admin/barber-create.php', [
            'title' => 'Ajouter un coiffeur',
            'error' => null,
        ]);
    }

    public function store(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $data = $request->getParsedBody();

        $firstName = trim($data['first_name'] ?? '');
        $lastName = trim($data['last_name'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        // Vérifier les champs obligatoires
        if (
            $firstName === '' ||
            $lastName === '' ||
            $email === '' ||
            $password === ''
        ) {
            return $this->view->render($response, 'admin/barber-create.php', [
                'title' => 'Ajouter un coiffeur',
                'error' => 'Veuillez remplir tous les champs obligatoires.',
            ]);
        }

        // Vérifier le format de l'adresse e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->view->render($response, 'admin/barber-create.php', [
                'title' => 'Ajouter un coiffeur',
                'error' => 'L’adresse e-mail est invalide.',
            ]);
        }

        // Vérifier la longueur du mot de passe
        if (strlen($password) < 12) {
            return $this->view->render($response, 'admin/barber-create.php', [
                'title' => 'Ajouter un coiffeur',
                'error' => 'Le mot de passe doit contenir au moins 12 caractères.',
            ]);
        }

        $pdo = Database::connection();

        // Vérifier si l'adresse e-mail existe déjà
        $stmt = $pdo->prepare(
            'SELECT id FROM users WHERE email = :email LIMIT 1'
        );

        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            return $this->view->render($response, 'admin/barber-create.php', [
                'title' => 'Ajouter un coiffeur',
                'error' => 'Cette adresse e-mail est déjà utilisée.',
            ]);
        }

        // Sécuriser le mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Créer le compte coiffeur
        $stmt = $pdo->prepare(
            'INSERT INTO users
        (first_name, last_name, phone, email, password_hash, role)
        VALUES
        (:first_name, :last_name, :phone, :email, :password_hash, :role)'
        );

        $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone !== '' ? $phone : null,
            'email' => $email,
            'password_hash' => $passwordHash,
            'role' => 'barber',
        ]);

        return $response
            ->withHeader('Location', '/admin/barbers')
            ->withStatus(302);
    }

    public function edit(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/barbers')
                ->withStatus(302);
        }

        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'SELECT id, first_name, last_name, email, phone
         FROM users
         WHERE id = :id AND role = :role
         LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'barber',
        ]);

        $barber = $stmt->fetch();

        if (!$barber) {
            return $response
                ->withHeader('Location', '/admin/barbers')
                ->withStatus(302);
        }

        return $this->view->render($response, 'admin/barber-edit.php', [
            'title' => 'Modifier un coiffeur',
            'barber' => $barber,
            'error' => null,
        ]);
    }

    public function update(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/barbers')
                ->withStatus(302);
        }

        $data = $request->getParsedBody();

        $firstName = trim($data['first_name'] ?? '');
        $lastName = trim($data['last_name'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $email = trim($data['email'] ?? '');

        if (
            $firstName === '' ||
            $lastName === '' ||
            $email === ''
        ) {
            return $response->withHeader(
                'Location',
                '/admin/barbers/' . $id . '/edit'
            )->withStatus(302);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $response->withHeader(
                'Location',
                '/admin/barbers/' . $id . '/edit'
            )->withStatus(302);
        }

        $pdo = Database::connection();

        // Vérifier que le coiffeur existe
        $stmt = $pdo->prepare(
            'SELECT id FROM users
         WHERE id = :id AND role = :role
         LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'barber',
        ]);

        if (!$stmt->fetch()) {
            return $response
                ->withHeader('Location', '/admin/barbers')
                ->withStatus(302);
        }

        // Vérifier que l'e-mail n'est pas utilisé par un autre compte
        $stmt = $pdo->prepare(
            'SELECT id FROM users
         WHERE email = :email AND id != :id
         LIMIT 1'
        );

        $stmt->execute([
            'email' => $email,
            'id' => $id,
        ]);

        if ($stmt->fetch()) {
            return $response
                ->withHeader('Location', '/admin/barbers/' . $id . '/edit')
                ->withStatus(302);
        }

        // Mettre à jour les informations
        $stmt = $pdo->prepare(
            'UPDATE users
         SET first_name = :first_name,
             last_name = :last_name,
             phone = :phone,
             email = :email
         WHERE id = :id AND role = :role'
        );

        $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone !== '' ? $phone : null,
            'email' => $email,
            'id' => $id,
            'role' => 'barber',
        ]);

        return $response
            ->withHeader('Location', '/admin/barbers')
            ->withStatus(302);
    }

    public function toggleStatus(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/barbers')
                ->withStatus(302);
        }

        $pdo = Database::connection();

        // Vérifier que le coiffeur existe
        $stmt = $pdo->prepare(
            'SELECT id, is_active
         FROM users
         WHERE id = :id AND role = :role
         LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'barber',
        ]);

        $barber = $stmt->fetch();

        if (!$barber) {
            return $response
                ->withHeader('Location', '/admin/barbers')
                ->withStatus(302);
        }

        // Inverser le statut du compte
        $stmt = $pdo->prepare(
            'UPDATE users
         SET is_active = CASE
             WHEN is_active = 1 THEN 0
             ELSE 1
         END
         WHERE id = :id AND role = :role'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'barber',
        ]);

        return $response
            ->withHeader('Location', '/admin/barbers')
            ->withStatus(302);
    }
}