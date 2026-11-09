<?php

declare(strict_types=1);

namespace BastienJcln\SalonCoifure\Controllers;

use BastienJcln\SalonCoifure\Core\Database;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends BaseController
{
    /**
     * Rediriger l'utilisateur selon son rôle
     */
    private function redirectByRole(ResponseInterface $response): ResponseInterface
    {
        $destinations = [
            'admin' => '/admin',
            'barber' => '/barber',
            'client' => '/account',
        ];

        $role = $_SESSION['user']['role'] ?? null;

        if (!isset($destinations[$role])) {
            unset($_SESSION['user']);

            return $response
                ->withHeader('Location', '/login')
                ->withStatus(302);
        }

        return $response
            ->withHeader('Location', $destinations[$role])
            ->withStatus(302);
    }

    /**
     * Afficher la page de connexion
     */
    public function showLogin(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Si l'utilisateur est déjà connecté, le rediriger
        if (isset($_SESSION['user'])) {
            return $this->redirectByRole($response);
        }

        return $this->view->render(
            $response,
            'auth/login.php',
            [
                'title' => 'Connexion - CFPT COIFFURE',
                'withMenu' => false,
                'error' => null,
            ]
        );
    }

    /**
     * Traiter le formulaire de connexion
     */
    public function login(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Récupérer les données du formulaire
        $data = $request->getParsedBody();

        if (!is_array($data)) {
            $data = [];
        }

        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if ($email === '' || !is_string($password) || $password === '') {
            return $this->view->render(
                $response->withStatus(400),
                'auth/login.php',
                [
                    'title' => 'Connexion - CFPT COIFFURE',
                    'withMenu' => false,
                    'error' => 'Veuillez remplir tous les champs.',
                ]
            );
        }

        // Rechercher le compte
        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'SELECT id, first_name, last_name, email,
                    password_hash, role, is_active
             FROM users
             WHERE email = :email
             LIMIT 1'
        );

        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        // Vérifier les identifiants et le statut du compte
        if (
            !$user ||
            (int) $user['is_active'] !== 1 ||
            !password_verify($password, $user['password_hash'])
        ) {
            return $this->view->render(
                $response->withStatus(401),
                'auth/login.php',
                [
                    'title' => 'Connexion - CFPT COIFFURE',
                    'withMenu' => false,
                    'error' => 'Adresse e-mail ou mot de passe incorrect.',
                ]
            );
        }

        // Renouveler l'identifiant de session
        session_regenerate_id(true);

        // Enregistrer l'utilisateur connecté
        $_SESSION['user'] = [
            'id' => (int) $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        // Rediriger selon le rôle
        return $this->redirectByRole($response);
    }

    public function logout(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Vider les données de session
        $_SESSION = [];

        // Détruire la session
        session_destroy();

        // Rediriger vers la connexion
        return $response
            ->withHeader('Location', '/login')
            ->withStatus(302);
    }

    public function showRegister(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        if (isset($_SESSION['user'])) {
            return $this->redirectByRole($response);
        }

        return $this->view->render($response, 'auth/register.php', [
            'title' => 'Inscription - CFPT COIFFURE',
            'withMenu' => false,
            'error' => null,
            'old' => [],
        ]);
    }

    public function register(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $data = $request->getParsedBody();

        if (!is_array($data)) {
            $data = [];
        }

        $firstName = trim($data['first_name'] ?? '');
        $lastName = trim($data['last_name'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $passwordConfirm = $data['password_confirm'] ?? '';

        $old = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone,
            'email' => $email,
        ];

        $error = null;

        if (
            $firstName === '' ||
            $lastName === '' ||
            $email === '' ||
            !is_string($password) ||
            !is_string($passwordConfirm) ||
            $password === '' ||
            $passwordConfirm === ''
        ) {
            $error = 'Veuillez remplir tous les champs obligatoires.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Veuillez saisir une adresse e-mail valide.';
        } elseif ($password !== $passwordConfirm) {
            $error = 'Les mots de passe ne correspondent pas.';
        } elseif (strlen($password) < 12) {
            $error = 'Le mot de passe doit contenir au moins 12 caractères.';
        }

        $pdo = Database::connection();

        if ($error === null) {
            $stmt = $pdo->prepare(
                'SELECT id FROM users WHERE email = :email LIMIT 1'
            );
            $stmt->execute(['email' => $email]);

            if ($stmt->fetch()) {
                $error = 'Cette adresse e-mail est déjà utilisée.';
            }
        }

        if ($error !== null) {
            return $this->view->render($response->withStatus(400), 'auth/register.php', [
                'title' => 'Inscription - CFPT COIFFURE',
                'withMenu' => false,
                'error' => $error,
                'old' => $old,
            ]);
        }

        $stmt = $pdo->prepare(
            'INSERT INTO users (
            first_name,
            last_name,
            phone,
            email,
            password_hash,
            role
        ) VALUES (
            :first_name,
            :last_name,
            :phone,
            :email,
            :password_hash,
            "client"
        )'
        );

        $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone !== '' ? $phone : null,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return $response
            ->withHeader('Location', '/login?registered=1')
            ->withStatus(302);
    }
}
