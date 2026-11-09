<?php

declare(strict_types=1);

namespace BastienJcln\SalonCoifure\Controllers;

use BastienJcln\SalonCoifure\Core\Database;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminController extends BaseController
{
    public function dashboard(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        return $this->view->render(
            $response,
            'admin/dashboard.php',
            [
                'title' => 'Administration - CFPT COIFFURE',
                'withMenu' => true,
                'firstName' => $_SESSION['user']['first_name'],
            ]
        );
    }

    public function clients(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Récupérer le texte recherché
        $params = $request->getQueryParams();
        $search = trim($params['search'] ?? '');

        // Connexion à la base de données
        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'SELECT id, first_name, last_name, email, phone, created_at, is_active
             FROM users
             WHERE role = "client"
             AND (
                 first_name LIKE :search_first
                 OR last_name LIKE :search_last
                 OR email LIKE :search_email
             )
             ORDER BY last_name ASC, first_name ASC'
        );

        $searchValue = '%' . $search . '%';

        $stmt->execute([
            'search_first' => $searchValue,
            'search_last' => $searchValue,
            'search_email' => $searchValue
        ]);

        $clients = $stmt->fetchAll();

        return $this->view->render(
            $response,
            'admin/clients.php',
            [
                'title' => 'Gestion des clients - CFPT COIFFURE',
                'withMenu' => true,
                'firstName' => $_SESSION['user']['first_name'],
                'clients' => $clients,
                'search' => $search,
            ]
        );
    }

    public function clientDetails(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'SELECT id, first_name, last_name, email, phone, created_at, is_active
         FROM users
         WHERE id = :id AND role = :role
         LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'client',
        ]);

        $client = $stmt->fetch();

        if (!$client) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        return $this->view->render($response, 'admin/client-details.php', [
            'title' => 'Détails du client - CFPT COIFFURE',
            'withMenu' => true,
            'client' => $client,
        ]);
    }

    public function editClient(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/clients')
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
            'role' => 'client',
        ]);

        $client = $stmt->fetch();

        if (!$client) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        return $this->view->render($response, 'admin/client-edit.php', [
            'title' => 'Modifier un client - CFPT COIFFURE',
            'withMenu' => true,
            'client' => $client,
            'error' => null,
        ]);
    }

    public function updateClient(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Vérifier l'identifiant du client
        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        // Récupérer les données du formulaire
        $data = $request->getParsedBody();

        if (!is_array($data)) {
            $data = [];
        }

        $firstName = trim($data['first_name'] ?? '');
        $lastName = trim($data['last_name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');

        $pdo = Database::connection();

        // Vérifier que le client existe
        $stmt = $pdo->prepare(
            'SELECT id FROM users
         WHERE id = :id AND role = :role
         LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'client',
        ]);

        if (!$stmt->fetch()) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        // Préparer les informations à réafficher en cas d'erreur
        $client = [
            'id' => $id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ];

        $error = null;

        // Vérifier les champs obligatoires
        if ($firstName === '' || $lastName === '' || $email === '') {
            $error = 'Veuillez remplir tous les champs obligatoires.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Veuillez saisir une adresse e-mail valide.';
        }

        // Vérifier si l'adresse e-mail est déjà utilisée
        if ($error === null) {
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
                $error = 'Cette adresse e-mail est déjà utilisée par un autre compte.';
            }
        }

        // En cas d'erreur, réafficher le formulaire
        if ($error !== null) {
            return $this->view->render(
                $response->withStatus(400),
                'admin/client-edit.php',
                [
                    'title' => 'Modifier un client - CFPT COIFFURE',
                    'withMenu' => true,
                    'client' => $client,
                    'error' => $error,
                ]
            );
        }

        // Enregistrer les modifications
        $stmt = $pdo->prepare(
            'UPDATE users
         SET first_name = :first_name,
             last_name = :last_name,
             email = :email,
             phone = :phone
         WHERE id = :id AND role = :role'
        );

        $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone !== '' ? $phone : null,
            'id' => $id,
            'role' => 'client',
        ]);

        // Retourner à la fiche du client
        return $response
            ->withHeader('Location', '/admin/clients/' . $id)
            ->withStatus(302);
    }

    public function toggleClientStatus(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

        // Vérifier l'identifiant du client
        $id = filter_var($args['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id || $id <= 0) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        $pdo = Database::connection();

        // Vérifier que le compte existe et qu'il s'agit d'un client
        $stmt = $pdo->prepare(
            'SELECT id, is_active
         FROM users
         WHERE id = :id AND role = :role
         LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'role' => 'client',
        ]);

        $client = $stmt->fetch();

        if (!$client) {
            return $response
                ->withHeader('Location', '/admin/clients')
                ->withStatus(302);
        }

        // Inverser le statut du client
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
            'role' => 'client',
        ]);

        // Retourner à la fiche du client
        return $response
            ->withHeader('Location', '/admin/clients/' . $id)
            ->withStatus(302);
    }
}