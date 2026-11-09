# CAHIER DES CHARGES

## Création d’un site web de gestion pour CFPT COIFFURE

# CFPT COIFFURE

**Site web de présentation et de gestion des rendez-vous**

Projet TPI – IDA P4B 2026

---

**Mandant \:** Erdi Ibrahimi

**Candidat \:** Bastien Jacolino

**Durée du projet \:** 9 jours

**Environnement technique prévu \:** PHP 8.5, Composer et Slim Framework

## 1\. Introduction

### 1.1 Présentation du projet

Le présent cahier des charges définit les besoins et les fonctionnalités attendues pour la création d'un site web destiné au salon de coiffure pour hommes **CFPT COIFFURE**, situé à Genève, en Suisse.

Le salon dispose de six coiffeurs proposant différentes prestations de coiffure et d'entretien de la barbe.

Le projet consiste à développer un site web permettant de présenter le salon, ses prestations et ses coiffeurs, mais également de gérer les clients, les comptes utilisateurs, les disponibilités et les rendez-vous.

Le site devra proposer une interface adaptée aux visiteurs, aux clients, aux coiffeurs et au responsable du salon.

### 1.2 Objectif du cahier des charges

Ce document a pour objectif de définir précisément \:

- les besoins du salon ;
- les utilisateurs du système ;
- les fonctionnalités attendues ;
- les règles de gestion ;
- les contraintes du projet ;
- les exigences techniques et fonctionnelles ;
- les critères permettant de vérifier que le projet est réussi.

Il servira de référence pendant les différentes étapes de conception, de développement et de test.

---

## 2\. Présentation du salon

| Élément | Description |
|--------|--------|
| Nom | CFPT COIFFURE |
| Localisation | Genève, Suisse |
| Activité | Coiffure pour hommes |
| Nombre de coiffeurs | 6 |
| Type de solution | Site web |
| Identité visuelle | Moderne, élégante, noir et blanc |

### 2.1 Horaires d'ouverture

Le salon applique les horaires suivants \:

| Jour | Horaires |
|--------|--------|
| Lundi | 09h00 – 19h00 |
| Mardi | 09h00 – 19h00 |
| Mercredi | 09h00 – 19h00 |
| Jeudi | 09h00 – 19h00 |
| Vendredi | 09h00 – 19h00 |
| Samedi | 09h00 – 17h00 |
| Dimanche | Fermé |

Une pause quotidienne est prévue de **12h00 à 13h00**\. Aucun rendez-vous ne devra être proposé pendant cette période.

Les six coiffeurs suivent les mêmes horaires généraux. Cependant, chaque rendez-vous doit être associé à un coiffeur précis.

Le responsable doit pouvoir gérer les fermetures exceptionnelles du salon ainsi que les absences et les congés des coiffeurs.

---

## 3\. Identification des utilisateurs

Le système comporte trois rôles principaux.

### 3.1 Visiteur

Le visiteur est une personne qui consulte le site sans être connectée.

Il doit pouvoir \:

- consulter la page d'accueil ;
- découvrir le salon ;
- consulter les prestations et leurs prix ;
- consulter les six coiffeurs ;
- consulter les horaires d'ouverture ;
- consulter les informations de contact ;
- accéder à la page de connexion et d'inscription.

Le visiteur ne peut pas prendre de rendez-vous sans créer un compte et se connecter.

### 3.2 Client

Le client possède un compte personnel.

Il doit pouvoir \:

- se connecter et se déconnecter ;
- consulter et modifier ses informations personnelles ;
- demander la suppression de son compte ;
- consulter les prestations disponibles ;
- choisir une ou plusieurs prestations ;
- choisir un coiffeur ;
- consulter les disponibilités ;
- prendre un rendez-vous ;
- consulter ses rendez-vous passés et futurs ;
- annuler un rendez-vous dans le délai autorisé.

### 3.3 Coiffeur

Chaque coiffeur possède un compte personnel.

Il doit pouvoir \:

- se connecter à son espace personnel ;
- consulter son planning ;
- consulter ses rendez-vous ;
- consulter les informations nécessaires concernant ses clients ;
- modifier ses propres rendez-vous ;
- annuler ses propres rendez-vous ;
- signaler l'absence d'un client.

Un coiffeur ne doit pas pouvoir accéder aux fonctionnalités réservées au responsable ni gérer les rendez-vous des autres coiffeurs.

### 3.4 Administrateur / Responsable

Le responsable possède les droits de gestion du système.

Il doit pouvoir \:

- consulter et gérer les clients ;
- créer et gérer les comptes des six coiffeurs ;
- gérer les informations des coiffeurs ;
- gérer les prestations ;
- consulter, créer, modifier et annuler les rendez-vous ;
- créer manuellement un rendez-vous pour un client ;
- gérer les horaires d'ouverture ;
- ajouter des fermetures exceptionnelles ;
- gérer les absences et congés des coiffeurs ;
- consulter les informations nécessaires au fonctionnement du salon.

---

## 4\. Description fonctionnelle

### 4.1 Page d'accueil

Le site doit proposer une page d'accueil présentant les informations principales de CFPT COIFFURE.

Elle doit contenir \:

- le nom et le logo du salon ;
- une présentation générale ;
- les prestations proposées ;
- les prix des prestations ;
- une présentation des six coiffeurs ;
- les horaires d'ouverture ;
- l'adresse du salon ;
- un accès direct à la réservation.

L'interface doit être claire, moderne et adaptée à une activité de coiffure pour hommes.

### 4.2 Gestion des comptes utilisateurs

Le système doit permettre la création et la gestion des comptes.

**Inscription client \:**

Les informations suivantes doivent être enregistrées \:

- prénom ;
- nom ;
- numéro de téléphone ;
- adresse e-mail ;
- mot de passe.

L'adresse e-mail doit permettre d'identifier le compte de manière unique.

**Connexion \:**

Les utilisateurs doivent pouvoir accéder à leur espace personnel avec leurs identifiants.

Le système doit identifier leur rôle afin de leur afficher uniquement les fonctionnalités autorisées.

**Gestion du compte \:**

Le client doit pouvoir modifier ses informations personnelles et demander la suppression de son compte.

Le responsable doit pouvoir gérer les comptes des coiffeurs.

### 4.3 Gestion des clients

Le système doit conserver les informations des clients enregistrés.

Les informations principales sont \:

- identifiant du client ;
- prénom ;
- nom ;
- numéro de téléphone ;
- adresse e-mail ;
- informations du compte.

Le responsable doit pouvoir consulter et gérer les clients.

Le système doit également conserver l'historique des rendez-vous afin de permettre aux clients de retrouver leurs anciens et prochains rendez-vous.

### 4.4 Gestion des coiffeurs

Le salon possède six coiffeurs.

Chaque coiffeur doit disposer d'un compte personnel et d'un espace dédié.

Les informations prévues pour chaque coiffeur sont \:

- prénom ;
- nom ;
- photo ;
- courte description ;
- informations du compte ;
- statut du compte.

Le responsable doit pouvoir créer, modifier et gérer les comptes des coiffeurs.

Les noms et prénoms définitifs des six coiffeurs restent à définir.

### 4.5 Gestion des prestations

Le salon propose les prestations suivantes \:

| Prestation | Durée | Prix |
|--------|--------|--------|
| Coupe classique | 30 min | 35 CHF |
| Dégradé (Fade) | 40 min | 40 CHF |
| Coupe aux ciseaux | 40 min | 40 CHF |
| Taille de barbe | 25 min | 25 CHF |
| Coupe + barbe | 60 min | 55 CHF |
| Rasage traditionnel | 30 min | 35 CHF |
| Contours et finitions | 15 min | 15 CHF |
| Shampoing | 10 min | 10 CHF |
| Coiffage | 15 min | 15 CHF |
| Coloration | 90 min | 80 CHF |
| Décoloration | 120 min | 100 CHF |
| Permanente | 90 min | 80 CHF |

Le responsable doit pouvoir \:

- ajouter une prestation ;
- modifier une prestation ;
- supprimer une prestation lorsque cela est approprié ;
- désactiver temporairement une prestation ;
- réactiver une prestation.

Chaque prestation doit contenir au minimum un nom, une description, une durée et un prix.

Les prix sont identiques pour les six coiffeurs.

Le client doit pouvoir sélectionner plusieurs services lors d'une même réservation. Le système devra calculer la durée totale et le prix total correspondants.

### 4.6 Gestion des rendez-vous

La gestion des rendez-vous constitue la fonctionnalité centrale du site.

Le client doit pouvoir effectuer les opérations suivantes \:

1. Se connecter à son compte.
2. Sélectionner une ou plusieurs prestations.
3. Choisir un coiffeur.
4. Choisir une date.
5. Consulter les heures disponibles.
6. Sélectionner un créneau.
7. Confirmer la réservation.

Une fois enregistrée, la réservation est automatiquement confirmée.

Chaque rendez-vous doit contenir au minimum \:

- un identifiant ;
- le client concerné ;
- le coiffeur concerné ;
- la ou les prestations sélectionnées ;
- la date ;
- l'heure de début ;
- l'heure de fin ;
- le prix total ;
- le statut du rendez-vous.

Le système doit permettre de distinguer les rendez-vous à venir, terminés, annulés et les absences des clients.

**Gestion par le client**

Le client doit pouvoir consulter ses rendez-vous et les annuler jusqu'à 12 heures avant l'heure prévue.

Il peut réserver plusieurs rendez-vous à l'avance.

**Gestion par le coiffeur**

Le coiffeur doit pouvoir consulter, modifier ou annuler ses propres rendez-vous.

Il doit également pouvoir signaler l'absence d'un client.

**Gestion par le responsable**

Le responsable doit pouvoir consulter et gérer tous les rendez-vous du salon.

Il doit également pouvoir créer manuellement une réservation pour un client.

### 4.7 Gestion des disponibilités

Le système doit calculer les disponibilités en fonction des horaires du salon, des prestations choisies et du planning du coiffeur.

Les règles suivantes doivent être appliquées \:

- aucun rendez-vous le dimanche ;
- aucun rendez-vous en dehors des horaires d'ouverture ;
- aucun rendez-vous entre 12h00 et 13h00 ;
- aucun chevauchement entre deux rendez-vous d'un même coiffeur ;
- la durée totale des prestations doit être prise en compte ;
- les fermetures exceptionnelles doivent être respectées ;
- les absences et congés des coiffeurs doivent être respectés.

Le système doit proposer uniquement les créneaux qui permettent de réaliser l'ensemble des prestations avant la fermeture ou le début de la pause.

Les réservations le jour même sont autorisées si un créneau est disponible.

Aucune limite de réservation à l'avance n'est définie.

### 4.8 Gestion des horaires et des fermetures

Le responsable doit pouvoir gérer les horaires généraux du salon.

Il doit également pouvoir \:

- ajouter une fermeture exceptionnelle ;
- modifier une fermeture ;
- supprimer une fermeture ;
- enregistrer une absence d'un coiffeur ;
- enregistrer les congés d'un coiffeur.

Les créneaux concernés ne doivent plus être proposés aux clients.

---

## 5\. Règles de gestion

Les règles de gestion définissent le comportement que le système doit obligatoirement respecter.

| Référence | Règle |
|--------|--------|
| RG01 | Un client doit posséder un compte pour prendre rendez-vous. |
| RG02 | Un utilisateur doit être authentifié pour accéder à son espace personnel. |
| RG03 | Chaque utilisateur possède un rôle défini. |
| RG04 | Chaque rendez-vous est associé à un client et à un coiffeur. |
| RG05 | Un coiffeur ne peut pas avoir deux rendez-vous qui se chevauchent. |
| RG06 | Les rendez-vous doivent respecter les horaires d'ouverture. |
| RG07 | Aucun rendez-vous ne peut être planifié entre 12h00 et 13h00. |
| RG08 | La durée du rendez-vous correspond à la durée totale des prestations sélectionnées. |
| RG09 | Le prix total correspond à la somme des prix des prestations sélectionnées. |
| RG10 | Une réservation est automatiquement confirmée après son enregistrement. |
| RG11 | Le client peut annuler son rendez-vous jusqu'à 12 heures avant celui-ci. |
| RG12 | Le client peut réserver plusieurs rendez-vous. |
| RG13 | Le client peut consulter son historique de rendez-vous. |
| RG14 | Une prestation désactivée ne peut plus être réservée. |
| RG15 | Une fermeture exceptionnelle empêche toute nouvelle réservation pendant la période concernée. |
| RG16 | Une absence ou un congé rend le coiffeur indisponible pendant la période concernée. |
| RG17 | Un coiffeur peut uniquement gérer ses propres rendez-vous. |
| RG18 | Le responsable peut gérer les rendez-vous de tous les coiffeurs. |
| RG19 | Le responsable peut créer un rendez-vous pour un client. |
| RG20 | Le système doit enregistrer les absences des clients. |

### 5.1 Vérification des chevauchements

Le système doit vérifier qu'un nouveau rendez-vous ne chevauche aucun rendez-vous existant du même coiffeur.

Par exemple, si un coiffeur possède un rendez-vous de 10h00 à 10h40, un autre rendez-vous ne peut pas commencer à 10h20.

En revanche, un rendez-vous peut commencer à 10h40 si sa durée et les autres règles de disponibilité le permettent.

Cette vérification doit être effectuée lors de la réservation, mais également lors de la modification d'un rendez-vous.

---

## 6\. Exigences non fonctionnelles

### 6.1 Interface utilisateur

Le site devra présenter une interface \:

- moderne ;
- élégante ;
- professionnelle ;
- intuitive ;
- cohérente avec l'identité visuelle du salon.

Les couleurs principales seront le noir et le blanc.

L'organisation des pages devra permettre aux utilisateurs de trouver rapidement les fonctionnalités recherchées.

### 6.2 Compatibilité

Le site devra être utilisable sur les navigateurs web récents.

L'affichage devra être adapté aux ordinateurs et, dans la mesure du possible, aux smartphones et tablettes.

### 6.3 Sécurité

Le système devra protéger les informations personnelles des utilisateurs.

Il devra notamment \:

- protéger les mots de passe ;
- contrôler les accès selon les rôles ;
- empêcher l'accès aux espaces non autorisés ;
- vérifier les données envoyées par les formulaires ;
- éviter les accès non autorisés aux rendez-vous d'autres clients ;
- protéger les opérations de modification et de suppression.

### 6.4 Fiabilité des données

Les données doivent être conservées de manière cohérente.

Les relations entre les clients, les coiffeurs, les prestations et les rendez-vous doivent être correctement gérées.

Le système doit éviter les réservations incompatibles avec les disponibilités.

### 6.5 Utilisabilité

La prise de rendez-vous doit être compréhensible et ne pas nécessiter de connaissances techniques particulières.

Les messages de confirmation et d'erreur doivent être suffisamment explicites.

---

## 7\. Périmètre du projet

### 7.1 Fonctionnalités incluses

Le projet comprend \:

- la présentation publique du salon ;
- la présentation des prestations et des prix ;
- la présentation des six coiffeurs ;
- l'inscription et la connexion ;
- la gestion des comptes et des rôles ;
- la gestion des clients ;
- la gestion des coiffeurs ;
- la gestion des prestations ;
- la prise de rendez-vous ;
- la modification et l'annulation des rendez-vous ;
- la consultation des plannings ;
- la gestion des horaires ;
- la gestion des fermetures exceptionnelles ;
- la gestion des congés et absences des coiffeurs ;
- l'enregistrement des absences des clients.

### 7.2 Fonctionnalités exclues

Les fonctionnalités suivantes ne font pas partie du projet \:

- paiement en ligne ;
- notifications par e-mail ;
- génération de documents PDF ;
- réservation sans compte client ;
- gestion de plusieurs salons ;
- application mobile native ;
- système de fidélité ;
- gestion des stocks de produits.

Ces fonctionnalités ne devront pas être développées dans le cadre du projet, sauf demande complémentaire du mandant.

---

## 8\. Exigences techniques

### 8.1 Environnement de développement

Le développement sera réalisé avec l'environnement suivant \:

| Technologie / outil | Utilisation |
|--------|--------|
| PHP 8.5 | Langage principal |
| Composer | Gestion des dépendances |
| Slim Framework | Framework PHP pour l'application web |

Le candidat devra définir et justifier les autres outils nécessaires à la réalisation du projet, notamment \:

- le système de gestion de base de données ;
- les technologies utilisées pour l'interface ;
- les outils de développement ;
- les outils de test.

Aucun système de gestion de base de données particulier n'est imposé à ce stade.

### 8.2 Architecture

La solution devra être organisée de manière claire et structurée.

Les différentes responsabilités devront être séparées autant que possible \:

- gestion des routes ;
- traitement des requêtes ;
- logique métier ;
- accès aux données ;
- présentation des pages.

La structure définitive sera adaptée à l'organisation du projet et à la structure de base fournie par le candidat.

---

## 9\. Tests et validation

Des tests devront être réalisés afin de vérifier le bon fonctionnement du site.

### 9.1 Tests des comptes utilisateurs

- inscription d'un nouveau client ;
- connexion avec des identifiants corrects ;
- refus d'une connexion avec des identifiants incorrects ;
- modification des informations personnelles ;
- vérification des droits selon les rôles ;
- demande de suppression d'un compte.

### 9.2 Tests des prestations

- affichage des prestations ;
- création d'une prestation ;
- modification d'une prestation ;
- désactivation et réactivation ;
- impossibilité de réserver une prestation désactivée.

### 9.3 Tests des rendez-vous

- création d'un rendez-vous ;
- sélection de plusieurs prestations ;
- calcul de la durée totale ;
- calcul du prix total ;
- consultation des rendez-vous ;
- modification d'un rendez-vous ;
- annulation d'un rendez-vous ;
- création manuelle par le responsable ;
- enregistrement d'une absence.

### 9.4 Tests des disponibilités

- réservation pendant les horaires d'ouverture ;
- refus d'une réservation le dimanche ;
- refus d'une réservation pendant la pause ;
- refus d'une réservation en dehors des horaires ;
- refus d'un chevauchement pour un même coiffeur ;
- prise en compte des fermetures exceptionnelles ;
- prise en compte des congés et absences ;
- vérification de la durée des prestations.

### 9.5 Tests des droits

- un client ne peut pas consulter les données privées d'un autre client ;
- un coiffeur ne peut pas gérer les rendez-vous d'un autre coiffeur ;
- le responsable peut accéder aux fonctionnalités de gestion ;
- les visiteurs ne peuvent pas accéder aux espaces privés.

---

## 10\. Critères d'acceptation

Le projet sera considéré comme réussi lorsque les conditions suivantes seront remplies \:

| Référence | Critère d'acceptation |
|--------|--------|
| CA01 | Le site est accessible et fonctionne dans l'environnement prévu. |
| CA02 | La page d'accueil présente correctement le salon. |
| CA03 | Les prestations et les prix sont consultables. |
| CA04 | Les six coiffeurs sont présentés. |
| CA05 | Un client peut créer un compte et se connecter. |
| CA06 | Les rôles et les droits d'accès sont correctement appliqués. |
| CA07 | Un client connecté peut réserver une ou plusieurs prestations. |
| CA08 | Le système calcule correctement la durée et le prix total. |
| CA09 | Le système propose uniquement des créneaux disponibles. |
| CA10 | Un coiffeur ne peut pas avoir deux rendez-vous simultanés. |
| CA11 | Les horaires, la pause et les fermetures sont respectés. |
| CA12 | Les absences et congés des coiffeurs sont pris en compte. |
| CA13 | Les clients peuvent consulter leurs rendez-vous. |
| CA14 | Les règles d'annulation sont respectées. |
| CA15 | Les coiffeurs peuvent consulter et gérer leurs propres rendez-vous. |
| CA16 | Le responsable peut gérer les informations du salon. |
| CA17 | Les tests principaux sont réalisés et documentés. |
| CA18 | La documentation permet d'installer et d'utiliser le site. |

---

## 11\. Documentation attendue

La documentation devra présenter \:

- une présentation générale du projet ;
- l'analyse des besoins ;
- les fonctionnalités développées ;
- les choix technologiques et leur justification ;
- l'architecture de l'application ;
- la modélisation de la base de données ;
- les règles de gestion ;
- les mesures de sécurité ;
- les tests réalisés et leurs résultats ;
- les difficultés rencontrées et les solutions apportées ;
- les instructions d'installation et de lancement ;
- un guide d'utilisation destiné aux utilisateurs.

Le candidat devra également tenir un journal de travail permettant de suivre l'avancement du projet.

---

## 12\. Livrables

À la fin du projet, les éléments suivants devront être remis \:

1. Les sources complètes du site web.
2. La base de données.
3. Le script d'initialisation de la base de données.
4. Les modèles de conception réalisés.
5. La documentation technique.
6. La documentation utilisateur.
7. Les tests réalisés et leurs résultats.
8. Les instructions d'installation et d'utilisation.
9. Une version fonctionnelle du site.
10. Les éléments nécessaires à la présentation orale.

---

## 13\. Organisation prévisionnelle du travail

Le projet doit être réalisé sur une durée de neuf jours.

Voici une proposition de répartition du travail \:

| Jour | Activités principales |
|--------|--------|
| Jour 1 | Analyse du mandat, clarification des besoins et définition du cahier des charges. |
| Jour 2 | Conception de la solution, architecture, modélisation de la base de données et planification. |
| Jour 3 | Mise en place de l'environnement, structure du projet et base de données. |
| Jour 4 | Développement des comptes utilisateurs, de la connexion et des rôles. |
| Jour 5 | Développement de la gestion des clients, coiffeurs et prestations. |
| Jour 6 | Développement de la prise de rendez-vous et du calcul des disponibilités. |
| Jour 7 | Développement des espaces de gestion, des plannings et des règles complémentaires. |
| Jour 8 | Tests, corrections, sécurisation et finalisation de l'interface. |
| Jour 9 | Documentation finale, préparation et démonstration du projet. |

Cette planification est indicative et pourra être adaptée en fonction de l'avancement.

---

## 14\. Présentation finale

Le candidat devra être capable de présenter le site et d'expliquer les principaux choix effectués.

La démonstration devra notamment montrer \:

- la page d'accueil ;
- la présentation des prestations ;
- la présentation des coiffeurs ;
- l'inscription et la connexion ;
- les différents rôles ;
- la prise d'un rendez-vous ;
- le calcul des disponibilités ;
- la gestion des rendez-vous ;
- la gestion des prestations ;
- la gestion des horaires et des absences ;
- les principaux tests réalisés.

Le candidat devra être capable d'expliquer le fonctionnement général du site, son architecture, sa base de données et les principales règles métier.

---

## 15\. Points restant à préciser

Certaines informations n'ont pas encore été définies par le mandant. Elles devront être clarifiées ou faire l'objet d'une décision de conception documentée.

| Point | État |
|--------|--------|
| Nom et prénom des six coiffeurs | À définir |
| Adresse exacte du salon | À définir |
| Logo du salon | À définir |
| Photos des coiffeurs | À fournir ou à définir |
| Descriptions des coiffeurs | À définir |
| Descriptions détaillées des prestations | À définir |
| Règles précises de modification d'un rendez-vous par le client | À clarifier |
| Règles de modification et d'annulation par un coiffeur | À clarifier |
| Gestion d'une réservation qui traverse la pause de midi | À définir |
| Gestion des demandes de suppression d'un compte avec un historique de rendez-vous | À définir |
| Base de données et technologies complémentaires | À choisir par le candidat |

---

## 16\. Conclusion

Le projet CFPT COIFFURE consiste à développer un site web permettant de présenter les activités du salon et de centraliser la gestion de ses clients, de ses coiffeurs, de ses prestations et de ses rendez-vous.

La fonctionnalité principale est la réservation en ligne, qui devra tenir compte des horaires d'ouverture, des prestations sélectionnées, des disponibilités des coiffeurs, des fermetures exceptionnelles et des absences.

La solution devra être simple à utiliser, sécurisée, cohérente et suffisamment complète pour répondre aux besoins du salon.

Le développement sera réalisé avec PHP 8.5, Composer et Slim Framework. Le candidat conservera une liberté de conception concernant l'architecture et les technologies complémentaires, à condition de justifier ses choix et de respecter les exigences définies dans ce cahier des charges.
