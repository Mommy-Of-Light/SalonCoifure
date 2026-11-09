# Journal de bord

## Sommaire 

- [Jour 1](JDB.md#j1)

## J1

Journée terminée - TPI – IDA P4B 2026

Projet : Création d’un site web de gestion pour CFPT COIFFURE\
Candidat : Bastien Jacolino\
Durée du projet : 9 jours\
Date : 09.11.2026

## 1. Objectifs de la journée

- Prendre connaissance du cahier des charges.
- Préparer l’environnement de développement.
- Installer et configurer le projet PHP avec Slim Framework.
- Mettre en place la base de données.
- Commencer le développement des espaces administrateur et coiffeur.

## 2. Travaux réalisés

| Domaine          | Travaux effectués                                                                                 |
| ---------------- | ------------------------------------------------------------------------------------------------- |
| Analyse          | Lecture et compréhension du cahier des charges et identification des fonctionnalités principales. |
| Environnement    | Préparation du projet avec PHP 8.5, Composer et Slim Framework 4.                                 |
| Structure        | Mise en place de l'organisation des dossiers et fichiers du projet.                               |
| Base de données  | Création de la base `cfpt_coiffure` et des six premières tables.                                  |
| Données          | Insertion des 12 prestations et configuration des horaires du salon.                              |
| Authentification | Création de la connexion, de la déconnexion et de l'inscription des clients.                      |
| Administration   | Développement du tableau de bord administrateur, de la gestion des clients et des coiffeurs.      |
| Espace coiffeur  | Création de la protection d'accès et du début du tableau de bord personnel.                       |

## 3. Difficultés rencontrées

- Compréhension de la structure MVC et de l'organisation d'un projet Slim.
- Configuration des routes et des contrôleurs.
- Connexion entre PHP et MariaDB avec PDO.
- Gestion des rôles et des redirections après connexion.
- Quelques ajustements nécessaires dans les requêtes SQL et l'affichage des pages.

Ces difficultés ont été résolues progressivement grâce aux tests et aux corrections effectuées.

## 4. Résultats obtenus

À la fin du J1 :

- Le projet Slim fonctionne sur le serveur local.
- La connexion à la base de données est opérationnelle.
- Les tables principales sont créées.
- Les prestations et horaires sont enregistrés.
- Le compte administrateur est créé.
- L'inscription et la connexion sont fonctionnelles.
- La gestion des clients et des coiffeurs est commencée.
- Le tableau de bord coiffeur est accessible avec son propre compte.

## 5. Travail restant

- Terminer et tester l'espace coiffeur.
- Développer la gestion des prestations.
- Développer la réservation des rendez-vous.
- Mettre en place les contrôles de disponibilité et de chevauchement.
- Développer la gestion des horaires et des absences.
- Effectuer les tests, améliorer la sécurité et préparer la documentation.

## 6. Bilan personnel

Cette première journée m'a permis de mettre en place les fondations techniques du projet. J'ai commencé à développer les fonctionnalités principales et à comprendre comment organiser une application avec Slim Framework.

J'ai rencontré quelques difficultés, notamment avec les routes, les contrôleurs et les requêtes SQL, mais j'ai pu les corriger progressivement. Le projet dispose maintenant d'une structure fonctionnelle sur laquelle je pourrai continuer à travailler lors de la prochaine journée.

Objectif du J2 : poursuivre le développement des fonctionnalités de gestion, en commençant par finaliser et tester l'espace coiffeur, puis avancer vers la gestion des prestations.