<?php

declare(strict_types=1);

use BastienJcln\SalonCoifure\Core\Database;

require __DIR__ . '/../vendor/autoload.php';

$pdo = Database::connection();

$email = 'admin@dev.com';

// Vérifier si le compte existe déjà
$stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);

if ($stmt->fetch()) {
    exit("Un compte utilise déjà cette adresse e-mail.\n");
}

// Demander le mot de passe sans l'afficher
echo "Création du compte administrateur\n";
echo "Adresse e-mail : $email\n";
echo "Choisis un mot de passe (12 caractères minimum) : ";

system('stty -echo');
$password = trim((string) fgets(STDIN));
system('stty echo');

echo PHP_EOL . "Confirme le mot de passe : ";

system('stty -echo');
$confirmation = trim((string) fgets(STDIN));
system('stty echo');

echo PHP_EOL;

if (strlen($password) < 12) {
    exit("Erreur : le mot de passe doit contenir au moins 12 caractères.\n");
}

if ($password !== $confirmation) {
    exit("Erreur : les deux mots de passe ne correspondent pas.\n");
}

// Hacher le mot de passe
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Créer le compte administrateur
$stmt = $pdo->prepare(
    'INSERT INTO users
        (first_name, last_name, email, password_hash, role, is_active)
     VALUES
        (:first_name, :last_name, :email, :password_hash, :role, :is_active)'
);

$stmt->execute([
    'first_name' => 'Administrateur',
    'last_name' => 'CFPT COIFFURE',
    'email' => $email,
    'password_hash' => $passwordHash,
    'role' => 'admin',
    'is_active' => 1,
]);

echo "Compte administrateur créé avec succès !\n";
