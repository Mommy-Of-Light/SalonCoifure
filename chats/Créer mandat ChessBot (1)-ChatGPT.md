# Créer mandat ChessBot (1)

**User:** Mommy Of Light (empress.mommy.of.light@gmail.com)  
**Created:** 11/9/2026 13:16:30  
**Updated:** 11/9/2026 13:36:20  
**Exported:** 11/9/2026 13:36:42  
**Link:** [https://chatgpt.com/c/6af1b99d-6588-83ed-9e0f-ac610ac2ddb2](https://chatgpt.com/c/6af1b99d-6588-83ed-9e0f-ac610ac2ddb2)  

## Response:
09/11/2026 13:15:24 · gpt-6-mini

Oui, absolument \! À partir de maintenant, nous allons utiliser **ton cahier des charges comme référence principale pour développer CFPT COIFFURE**\.

Je vais t'accompagner comme si nous réalisions le projet ensemble, étape par étape. L'objectif n'est pas seulement d'obtenir un site fonctionnel : tu dois aussi être capable d'expliquer ton code, tes choix techniques et le fonctionnement de ton application lors de ta présentation du TPI.

## 1\. Notre méthode de développement

Nous allons respecter les fonctionnalités de ton cahier des charges, tout en tenant compte de ton environnement actuel.

**Environnement actuel** (Déjà installé)

- PHP 8.5
- Composer
- Slim Framework 4
- Apache
- Slim PHP View
- Structure MVC de départ
  
  ---
  
  **Technologies complémentaires** (À mettre en place)
- MySQL pour la base de données
- HTML et CSS
- Bootstrap 5 pour l'interface
- PDO pour les accès à la base de données
- Sessions PHP pour l'authentification

Nous conserverons notamment ton namespace \:

```php
BastienJcln\SalonCoifure
```

Et ton organisation actuelle \:

```text
SalonCoifure/
├── config/
├── public/
│   ├── index.php
│   └── .htaccess
├── routes/
│   └── web.php
├── src/
│   ├── Controllers/
│   ├── Core/
│   ├── Middleware/
│   ├── Models/
│   └── Services/
├── views/
│   ├── errors/
│   ├── layout.php
│   └── menu.php
├── composer.json
└── helpers.php
```

Nous ajouterons les fichiers nécessaires au fur et à mesure.

## 2\. Plan de développement basé sur ton cahier des charges

Voici l'ordre que je te propose pour réaliser les fonctionnalités.

1. **Préparation du projet**
   
   Vérifier Slim, configurer le projet, préparer les dossiers et mettre en place une première route fonctionnelle.
   
   (En cours)
2. **Conception et base de données**
   
   Définir les tables, les relations, les clés étrangères et le script SQL d'initialisation.
3. **Page d'accueil**
   
   Créer le design noir et blanc, présenter le salon, les prestations, les tarifs, les six coiffeurs et les horaires.
4. **Authentification et rôles**
   
   Inscription, connexion, déconnexion, mots de passe sécurisés et trois rôles : client, coiffeur et responsable.
5. **Gestion des clients et des coiffeurs**
   
   Profils, modifications, comptes des six coiffeurs et gestion des clients.
6. **Gestion des prestations**
   
   Ajouter, modifier, désactiver et réactiver les prestations avec leurs prix et durées.
7. **Prise de rendez-vous**
   
   Sélection des prestations, choix du coiffeur, date, créneau, calcul de la durée et du prix, confirmation automatique.
8. **Disponibilités et plannings**
   
   Gestion des horaires, pause de midi, chevauchements, absences, congés et fermetures exceptionnelles.
9. **Espaces personnels et administration**
   
   Espace client, espace coiffeur et tableau de bord du responsable.
10. **Tests, sécurité et documentation**
    
    Tester les règles du cahier des charges, corriger les erreurs et préparer les livrables du TPI.

## 3\. Comment nous allons travailler ensemble

Pour chaque étape, je vais suivre cette méthode \:

1. **Objectif \:** je t'explique ce que nous devons réaliser et pourquoi.
2. **Fichiers \:** je t'indique précisément quels fichiers créer ou modifier.
3. **Code \:** je te donne le code complet nécessaire.
4. **Explications \:** je t'explique les parties importantes du code.
5. **Test \:** tu exécutes le code et tu me transmets le résultat.
6. **Validation \:** nous vérifions que cela fonctionne avant de continuer.

Nous ne passerons pas à la prochaine étape tant que la précédente ne sera pas suffisamment fonctionnelle.

## 4\. Quelques décisions techniques importantes

Pour respecter ton cahier des charges, je recommande les décisions suivantes \:

| Sujet | Décision proposée |
|--------|--------|
| Base de données | MySQL |
| Accès aux données | PDO et requêtes préparées |
| Architecture | MVC avec Slim |
| Mots de passe | `password_hash()` et `password_verify()` |
| Authentification | Sessions PHP |
| Autorisations | Middleware selon les rôles |
| Interface | Bootstrap 5 + CSS personnalisé |
| Suppression des comptes | Désactivation/anonymisation pour préserver l'historique |
| Rendez-vous | Enregistrement des prix et durées au moment de la réservation |

Il faudra aussi traiter quelques points du cahier des charges qui restent à préciser, notamment les modifications de rendez-vous par les clients, les rendez-vous traversant la pause de midi et les règles d'annulation par les coiffeurs.

---

## 5\. On commence concrètement : étape 1

Nous avons déjà examiné tes fichiers `BaseController.php`, `layout.php`, `menu.php` et `Database.php`\.

Pour commencer proprement, je te propose de faire fonctionner une première page Slim avant de développer son apparence.

(Première tâche) **Créer la route d'accueil et son contrôleur.**

Nous utiliserons \:

- `routes/web.php` pour définir l'URL `/`\.
- `src/Controllers/HomeController.php` pour traiter la requête.
- `views/home.php` pour afficher la page.

Mais avant de commencer, j'aimerais savoir une chose pour organiser correctement le développement \:

**As-tu déjà créé une base de données MySQL pour CFPT COIFFURE, ou devons-nous la créer ensemble depuis zéro ?**

## Prompt:
09/11/2026 13:16:57

non je par de zero. je n'ai que la base

## Response:
09/11/2026 13:16:58 · gpt-6-mini

Parfait \! Nous allons donc **créer toute la base de données MySQL depuis zéro**, en suivant ton cahier des charges.

C'est une bonne chose de commencer par là : la base de données sera le fondement de toutes les fonctionnalités du site (clients, coiffeurs, prestations, rendez-vous et disponibilités).

## Étape 1 - Concevoir la base de données

Avant de créer les tables, voici la structure que je te propose \:

**Base de données : `cfpt_coiffure`**

1. **users**
   
   Comptes des utilisateurs, mots de passe et rôles (client, coiffeur, administrateur).
2. **barbers**
   
   Informations des six coiffeurs : photo, description et compte associé.
3. **services**
   
   Prestations, descriptions, durées, prix et statut actif/inactif.
4. **appointments**
   
   Rendez-vous : client, coiffeur, date, heures et statut.
5. **appointment\_services**
   
   Prestations associées à chaque rendez-vous, avec prix et durée enregistrés au moment de la réservation.
6. **opening\_hours**
   
   Horaires d'ouverture du salon et pause quotidienne.
7. **closures**
   
   Fermetures exceptionnelles du salon.
8. **barber\_absences**
   
   Congés et absences des coiffeurs.

Nous utiliserons des clés étrangères pour relier correctement les tables et préserver la cohérence des données.

## Étape 2 - Vérifier MySQL sur ton environnement

Avant de créer la base, ouvre ton terminal et exécute \:

```bash
mysql --version
```

Puis \:

```bash
sudo systemctl status mysql
```

Si tu utilises MariaDB plutôt que MySQL, ce n'est pas un problème : les deux conviennent à notre projet.

## Étape 3 - J'ai besoin de ton résultat

Envoie-moi les résultats de ces deux commandes.

Ensuite, nous allons \:

1. Créer la base `cfpt_coiffure`\.
2. Créer les tables avec leurs relations.
3. Ajouter les six coiffeurs (avec des données provisoires).
4. Insérer les douze prestations et leurs tarifs.
5. Configurer les horaires et la pause de midi.
6. Préparer un fichier `database.sql` qui permettra de réinitialiser la base.

**Important \:** nous allons créer cette base proprement, avec un script SQL que tu pourras remettre dans les livrables de ton TPI et expliquer pendant ta présentation.

## Prompt:
09/11/2026 13:18:56

╭─bastien-jcln@DESKTOP-FJVU78J /var/www/html/26-27/SalonCoifure
╰─$ mysql --version
mysql  Ver 15.1 Distrib 10.11.14-MariaDB, for debian-linux-gnu (x86_64) using  EditLine wrapper
╭─bastien-jcln@DESKTOP-FJVU78J /var/www/html/26-27/SalonCoifure
╰─$ sudo systemctl status mysql
[sudo] password for bastien-jcln:
● mariadb.service - MariaDB 10.11.14 database server
     Loaded: loaded (/usr/lib/systemd/system/mariadb.service; enabled; preset: enabled)
     Active: active (running) since Mon 2026-11-09 08:11:48 CET; 5h 6min ago
       Docs: man:mariadbd(8)
             https://mariadb.com/kb/en/library/systemd/
    Process: 203 ExecStartPre=/usr/bin/install -m 755 -o mysql -g root -d /var/run/mysqld (code=exited, status=0/SUCCESS)
    Process: 259 ExecStartPre=/bin/sh -c systemctl unset-environment _WSREP_START_POSITION (code=exited, status=0/SUCCESS)
    Process: 278 ExecStartPre=/bin/sh -c [ ! -e /usr/bin/galera_recovery ] && VAR= ||   VAR=`/usr/bin/galera_recovery`; [ $? -eq 0 ]   && systemctl set-environment _WSREP_START_POSITION=$VAR || exit 1 (code=exite>
    Process: 541 ExecStartPost=/bin/sh -c systemctl unset-environment _WSREP_START_POSITION (code=exited, status=0/SUCCESS)
    Process: 547 ExecStartPost=/etc/mysql/debian-start (code=exited, status=0/SUCCESS)
   Main PID: 407 (mariadbd)
     Status: "Taking your SQL requests now..."
      Tasks: 9 (limit: 125264)
     Memory: 112.2M (peak: 135.8M)
        CPU: 3.410s
     CGroup: /system.slice/mariadb.service
             └─407 /usr/sbin/mariadbd

Notice: journal has been rotated since unit was started, output may be incomplete.

## Response:
09/11/2026 13:19:02 · gpt-6

Parfait \! (MariaDB opérationnel)

Ton environnement est prêt \:

- MariaDB **10.11.14** est installé.
- Le service `mariadb.service` est actif (`running`\).
- Le serveur accepte les requêtes SQL.

MariaDB est compatible avec notre projet PHP 8.5 + PDO. Nous pouvons donc l'utiliser comme système de gestion de base de données.

## Étape suivante - Créer la base de données

Nous allons d'abord créer uniquement la base, puis nous ajouterons les tables dans un script SQL organisé.

### 1\. Ouvrir MariaDB

Dans ton terminal, exécute \:

```bash
sudo mariadb
```

Tu devrais obtenir une invite similaire à \:

```text
MariaDB [(none)]>
```

### 2\. Créer la base

Copie cette commande dans MariaDB \:

```sql
CREATE DATABASE cfpt_coiffure
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Cette commande crée une base \:

- appelée `cfpt_coiffure` ;
- compatible avec les accents et caractères spéciaux ;
- utilisant l'encodage UTF-8 complet.

### 3\. Sélectionner la base

```sql
USE cfpt_coiffure;
```

Puis vérifie \:

```sql
SELECT DATABASE();
```

Tu dois obtenir `cfpt_coiffure`\.

### 4\. Vérifier la création

Exécute \:

```sql
SHOW DATABASES;
```

Tu dois voir `cfpt_coiffure` dans la liste.

Puis quitte MariaDB \:

```sql
EXIT;
```

(À faire maintenant) Envoie-moi le résultat de `SELECT DATABASE();` et de `SHOW DATABASES;`\.

**Ne crée pas encore les tables.** Nous allons ensuite construire ensemble le fichier `database.sql`, avec les relations entre les utilisateurs, les coiffeurs, les prestations et les rendez-vous. Je t'expliquerai chaque table et chaque relation pour que tu puisses les justifier à l'oral du TPI.

## Prompt:
09/11/2026 13:20:44

peux tu juste me faire le script sql avec un utilisateur uniquement pour cette base

## Response:
09/11/2026 13:20:45 · gpt-6

Oui \! Nous allons créer un script SQL complet qui prépare la base de données **CFPT COIFFURE** et crée un utilisateur MariaDB dédié, avec des droits uniquement sur cette base.

Je te propose le fichier `database.sql`\.

## 1\. Script SQL : `database.sql`

Crée un fichier `database.sql` à la racine de ton projet et copie le contenu suivant \:

```sql

-- =====================================================
-- PROJET : CFPT COIFFURE
-- Base de données : cfpt_coiffure
-- SGBD : MariaDB 10.11
-- =====================================================

-- 1. Création de la base de données
CREATE DATABASE IF NOT EXISTS cfpt_coiffure
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 2. Création d'un utilisateur dédié
-- Remplacer le mot de passe avant l'exécution
CREATE USER IF NOT EXISTS 'cfpt_user'@'localhost'
IDENTIFIED BY 'ChangeMoi_2026!';

-- 3. Attribution des droits uniquement sur cette base
GRANT ALL PRIVILEGES ON cfpt_coiffure.*
TO 'cfpt_user'@'localhost';

-- 4. Sélection de la base
USE cfpt_coiffure;

-- =====================================================
-- FIN DE LA CONFIGURATION INITIALE
-- Les tables seront ajoutées ensuite.
-- =====================================================
```

## 2\. Exécuter le script

Depuis le terminal, à la racine du projet \:

```bash
sudo mariadb < database.sql
```

## 3\. Vérifier l'utilisateur

Connecte-toi avec le nouvel utilisateur \:

```bash
mariadb -u cfpt_user -p cfpt_coiffure
```

Entre le mot de passe défini dans le script.

Puis exécute \:

```sql
SELECT DATABASE();
SHOW TABLES;
```

La base doit être sélectionnée et ne contient pas encore de tables.

## 4\. Configurer PHP

Dans `config/database.php`, tu pourras mettre \:

```php
<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'cfpt_coiffure');
define('DB_CHARSET', 'utf8mb4');
define('DB_USER', 'cfpt_user');
define('DB_PASSWORD', 'ChangeMoi_2026!');
```

Attention : utilise un vrai mot de passe personnel à la place de celui proposé et ne publie jamais ce fichier dans Git.

**Pour l'instant, nous avons uniquement créé la base et son utilisateur.** Les tables correspondant au cahier des charges seront ajoutées dans la suite du script.

## Prompt:
09/11/2026 13:30:03

-- =====================================================
-- PROJET : CFPT COIFFURE
-- Base de données : cfpt_coiffure
-- SGBD : MariaDB 10.11
-- =====================================================

-- 1. Création de la base de données
DROP DATABASE IF EXISTS cfpt_coiffure;
CREATE DATABASE IF NOT EXISTS cfpt_coiffure
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 2. Création d'un utilisateur dédié
-- Remplacer le mot de passe avant l'exécution
DELETE USER IF EXISTS 'cfpt_user'@'localhost';
CREATE USER IF NOT EXISTS 'cfpt_user'@'localhost'
IDENTIFIED BY 'cfpt_coiffure';

-- 3. Attribution des droits uniquement sur cette base
GRANT ALL PRIVILEGES ON cfpt_coiffure.*
TO 'cfpt_user'@'localhost';

-- 4. Sélection de la base
USE cfpt_coiffure;

-- =====================================================
-- FIN DE LA CONFIGURATION INITIALE
-- Les tables seront ajoutées ensuite.
-- =====================================================

## Response:
09/11/2026 13:30:06 · gpt-6

Ton script est presque correct et sa logique est bonne : tu souhaites repartir de zéro à chaque exécution, recréer la base et recréer l'utilisateur dédié.

Il y a cependant **une erreur SQL** \:

```sql
DELETE USER IF EXISTS 'cfpt_user'@'localhost';
```

MariaDB utilise `DROP USER`, et non `DELETE USER`\.

## Script corrigé

Voici la version que je te recommande \:

```sql

-- =====================================================
-- PROJET : CFPT COIFFURE
-- Base de données : cfpt_coiffure
-- SGBD : MariaDB 10.11
-- =====================================================

-- 1. Suppression et recréation de la base
DROP DATABASE IF EXISTS cfpt_coiffure;

CREATE DATABASE cfpt_coiffure
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 2. Suppression et recréation de l'utilisateur
DROP USER IF EXISTS 'cfpt_user'@'localhost';

CREATE USER 'cfpt_user'@'localhost'
IDENTIFIED BY 'cfpt_coiffure';

-- 3. Attribution des droits sur la base uniquement
GRANT ALL PRIVILEGES ON cfpt_coiffure.*
TO 'cfpt_user'@'localhost';

-- 4. Sélection de la base
USE cfpt_coiffure;

-- =====================================================
-- FIN DE LA CONFIGURATION INITIALE
-- Les tables seront ajoutées ensuite.
-- =====================================================
```

## Quelques explications importantes

- `DROP DATABASE` \: supprime complètement l'ancienne base et toutes ses données.
- `CREATE DATABASE` \: crée une nouvelle base.
- `DROP USER` \: supprime l'ancien utilisateur s'il existe.
- `CREATE USER` \: crée le nouvel utilisateur.
- `GRANT ALL PRIVILEGES` \: donne les droits sur `cfpt_coiffure` uniquement.

(Attention) Ton script supprime toutes les données de la base à chaque exécution. C'est pratique pendant le développement, mais il ne faudra pas l'utiliser sur une base contenant des données réelles.

**Concernant le mot de passe \:** `cfpt_coiffure` est acceptable pour un test local temporaire, mais choisis un mot de passe plus robuste pour la version finale.

Tu peux maintenant enregistrer ce script sous `database.sql` et l'exécuter avec \:

```bash
sudo mariadb < database.sql
```

Nous aurons ainsi une base propre pour commencer à créer les tables de ton application.

## Prompt:
09/11/2026 13:31:01

fini

## Response:
09/11/2026 13:31:03 · gpt-6

Parfait \! On s’arrête ici pour le moment.

La prochaine étape sera de **créer les tables de la base de données** pour CFPT COIFFURE, en commençant par les utilisateurs, les barbiers et les services. On avancera étape par étape, sans modifier inutilement la structure de ton projet.

## Prompt:
09/11/2026 13:32:12

j'ai completer config/database.php <?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'cfpt_coiffure');
define('DB_CHARSET', 'utf8mb4');
define('DB_USER', 'cfpt_user');
define('DB_PASSWORD', 'cfpt_coiffure');

## Response:
09/11/2026 13:32:14 · gpt-6

Parfait \! Ton fichier `config/database.php` est correctement configuré et correspond au script SQL que nous avons préparé.

```php
<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'cfpt_coiffure');
define('DB_CHARSET', 'utf8mb4');
define('DB_USER', 'cfpt_user');
define('DB_PASSWORD', 'cfpt_coiffure');
```

### Étape suivante : tester la connexion à MariaDB

Avant de créer les tables, vérifions que PHP arrive bien à se connecter à la base de données.

Dans le terminal, exécute \:

```bash
cd /var/www/html/26-27/SalonCoifure
php -r "require 'vendor/autoload.php'; require 'config/database.php'; new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWORD); echo 'Connexion réussie !'.PHP_EOL;"
```

(Résultat attendu)

```text
Connexion réussie !
```

Si tu obtiens une erreur, envoie-moi le message exact. Si la connexion fonctionne, nous pourrons passer à la création du schéma SQL.

**Petite remarque de sécurité \:** `cfpt_coiffure` est un mot de passe temporaire assez simple. Nous le remplacerons par un mot de passe plus robuste avant la mise en production.

## Prompt:
09/11/2026 13:32:38

╭─bastien-jcln@DESKTOP-FJVU78J /var/www/html/26-27/SalonCoifure
╰─$ cd /var/www/html/26-27/SalonCoifure
php -r "require 'vendor/autoload.php'; require 'config/database.php'; new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWORD); echo 'Connexion réussie !'.PHP_EOL;"
Connexion réussie !

## Response:
09/11/2026 13:32:39 · gpt-6-mini

(Connexion réussie \!)

Excellent \! PHP arrive bien à se connecter à MariaDB avec l'utilisateur `cfpt_user`\. Notre configuration de base de données fonctionne.

### Prochaine étape : concevoir les tables SQL

Avant de créer les tables, voici les principales entités dont nous aurons besoin \:

1. **users** \: comptes clients, barbiers et administrateur.
2. **services** \: prestations proposées par le salon.
3. **appointments** \: rendez-vous.
4. **appointment\_services** \: services associés à chaque rendez-vous.
5. **opening\_hours** \: horaires d'ouverture.
6. **closures** \: fermetures exceptionnelles et absences des barbiers.

Nous allons également prévoir les rôles et les règles nécessaires pour empêcher les conflits de réservation.

**Pour l'instant, ne crée aucune table.** La prochaine étape sera de préparer un script SQL complet et cohérent avec ton cahier des charges, puis de le vérifier avant son exécution.

## Prompt:
09/11/2026 13:32:51

ok

## Response:
09/11/2026 13:32:53 · gpt-6-mini

Parfait \! Nous passerons à la conception du schéma SQL lors de la prochaine étape. 👍

## Prompt:
09/11/2026 13:33:24

ok

## Response:
09/11/2026 13:33:26 · gpt-6-mini

À bientôt \! On reprendra à la création des tables SQL de CFPT COIFFURE.

## Prompt:
09/11/2026 13:33:36

je suis pret

## Response:
09/11/2026 13:33:44 · gpt-6-mini

> **Préparant le schéma SQL**
>
> Je vais structurer six tables : utilisateurs, coiffeurs, services, horaires, fermetures et rendez-vous. J’inclus les instantanés de prix et durée afin de préserver l’historique, même après modification d’un service.
>
> **Préparé le schéma SQL**
>
> 
>
> Réfléchi pendant 8s

Super \! Nous allons maintenant créer la structure de la base de données **CFPT COIFFURE**\.

L'objectif est de construire une base cohérente avec ton cahier des charges, sans créer de tables inutiles. Nous allons commencer par les utilisateurs, les services et les rendez-vous.

### 1\. Structure prévue

Voici les tables que nous allons créer \:

| Table | Rôle |
|--------|--------|
| `users` | Clients, barbiers et administrateur |
| `services` | Prestations et tarifs |
| `appointments` | Rendez-vous |
| `appointment_services` | Services associés à chaque rendez-vous |
| `opening_hours` | Horaires d'ouverture |
| `closures` | Fermetures exceptionnelles et absences |

**Quelques choix importants \:**

- Une seule table `users` avec un champ `role` $`client`, `barber`, `admin`$.
- Un rendez-vous appartient à un client et à un barbier.
- Un rendez-vous peut contenir plusieurs services.
- Nous conserverons une copie du prix et de la durée des services au moment de la réservation.
- Les absences des barbiers et les fermetures du salon seront gérées dans `closures`\.

### 2\. Créer le fichier SQL

Dans ton projet, crée un dossier `database`, puis un fichier `schema.sql` \:

```bash
mkdir -p database
nano database/schema.sql
```

Colle le script suivant dans ce fichier.

```sql

-- =====================================================
-- CFPT COIFFURE
-- Structure initiale de la base de données
-- MariaDB 10.11
-- =====================================================

USE cfpt_coiffure;

-- -----------------------------------------------------
-- 1. UTILISATEURS
-- Clients, barbiers et administrateur
-- -----------------------------------------------------

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('client', 'barber', 'admin') NOT NULL DEFAULT 'client',
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 2. SERVICES
-- Prestations proposées par le salon
-- -----------------------------------------------------

CREATE TABLE services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT DEFAULT NULL,
    duration_minutes SMALLINT UNSIGNED NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT chk_service_duration
        CHECK (duration_minutes > 0),

    CONSTRAINT chk_service_price
        CHECK (price >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 3. RENDEZ-VOUS
-- Un client réserve auprès d'un barbier
-- -----------------------------------------------------

CREATE TABLE appointments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id INT UNSIGNED NOT NULL,
    barber_id INT UNSIGNED NOT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    total_duration SMALLINT UNSIGNED NOT NULL,
    total_price DECIMAL(8,2) NOT NULL,
    status ENUM(
        'confirmed',
        'cancelled',
        'completed',
        'no_show'
    ) NOT NULL DEFAULT 'confirmed',
    created_by INT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT chk_appointment_dates
        CHECK (end_at > start_at),

    CONSTRAINT fk_appointment_client
        FOREIGN KEY (client_id) REFERENCES users(id),

    CONSTRAINT fk_appointment_barber
        FOREIGN KEY (barber_id) REFERENCES users(id),

    CONSTRAINT fk_appointment_creator
        FOREIGN KEY (created_by) REFERENCES users(id)
        ON DELETE SET NULL,

    INDEX idx_appointment_barber_date (barber_id, start_at),
    INDEX idx_appointment_client_date (client_id, start_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 4. SERVICES DES RENDEZ-VOUS
-- Copie du nom, du prix et de la durée au moment
-- de la réservation pour conserver l'historique
-- -----------------------------------------------------

CREATE TABLE appointment_services (
    appointment_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    service_name VARCHAR(150) NOT NULL,
    duration_minutes SMALLINT UNSIGNED NOT NULL,
    price DECIMAL(8,2) NOT NULL,

    PRIMARY KEY (appointment_id, service_id),

    CONSTRAINT fk_appointment_services_appointment
        FOREIGN KEY (appointment_id)
        REFERENCES appointments(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_appointment_services_service
        FOREIGN KEY (service_id)
        REFERENCES services(id),

    CONSTRAINT chk_appointment_service_duration
        CHECK (duration_minutes > 0),

    CONSTRAINT chk_appointment_service_price
        CHECK (price >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 5. HORAIRES D'OUVERTURE
-- 1 = lundi, 7 = dimanche
-- -----------------------------------------------------

CREATE TABLE opening_hours (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    day_of_week TINYINT UNSIGNED NOT NULL UNIQUE,
    open_time TIME DEFAULT NULL,
    close_time TIME DEFAULT NULL,
    break_start TIME DEFAULT NULL,
    break_end TIME DEFAULT NULL,
    is_open BOOLEAN NOT NULL DEFAULT TRUE,

    CONSTRAINT chk_opening_day
        CHECK (day_of_week BETWEEN 1 AND 7)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 6. FERMETURES ET ABSENCES
-- barber_id NULL = fermeture du salon
-- barber_id renseigné = absence d'un barbier
-- -----------------------------------------------------

CREATE TABLE closures (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    barber_id INT UNSIGNED DEFAULT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    reason VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT chk_closure_dates
        CHECK (end_at > start_at),

    CONSTRAINT fk_closure_barber
        FOREIGN KEY (barber_id) REFERENCES users(id),

    INDEX idx_closure_dates (start_at, end_at),
    INDEX idx_closure_barber (barber_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 3\. Exécuter le script

Enregistre le fichier, puis quitte l'éditeur. Dans le terminal, exécute \:

```bash
mariadb -u cfpt_user -p cfpt_coiffure < database/schema.sql
```

Le terminal te demandera le mot de passe \:

```text
cfpt_coiffure
```

### 4\. Vérifier la création des tables

Exécute ensuite \:

```bash
mariadb -u cfpt_user -p cfpt_coiffure
```

Puis, dans MariaDB \:

```sql
SHOW TABLES;
```

(Résultat attendu : 6 tables)

- `users`
- `services`
- `appointments`
- `appointment_services`
- `opening_hours`
- `closures`

**Attention \:** ce script crée uniquement les tables. Il ne crée pas encore les comptes, les services ni les horaires. Nous les ajouterons ensuite avec des données initiales.

Autre point important : les contrôles de disponibilité (horaires, pause, absences et chevauchements) seront réalisés côté PHP lors de la réservation. Les clés étrangères seules ne suffisent pas à garantir ces règles.

**Pour le moment, exécute le script et envoie-moi le résultat de `SHOW TABLES;`\.** Nous vérifierons ensemble avant de continuer.



---
Powered by [ChatGPT Exporter](https://www.chatgptexporter.com)