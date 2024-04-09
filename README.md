## Backlog du projet

- User1 (propriétaires)

    - à la possibilité de publier une photo de sa plante sur son profil

        - la photo se retrouve dans le fil d'actualité en attente de trouver un User2 qui va le garder.
        - possibilité de se faire contacter afin de se coordonner pour la garde des plantes.
        - possibilité de consulter leurs profils contenant les photos des plantes qu’ils ont gardées ou fait garder.

- User2 (gardiens)

    - n'a pas de photo publié

        - à la possibilité de lancer la garde d'une plante vu sur le fil d'actualité
        - une foi la garde accepté, il garde les plante en suivant les conseils des botanistes,
        - à chaque conseil suivie ils vont publie une photo (sous le conseil)

- User_botaniste

    - ne peuvent que mettre des commentaires (conseils) sur les photos de plante publié.

        - sur les photos des User2 pourront prévenir d’éventuels problèmes de santé ou d’entretiens des plantes.
        - Rassurer les propriétaires des plantes pourront garder une tranquillité d’esprit en sachant que leurs plantes sont bien entretenues (avec une action de validation).
        - possibilité de chercher les plantes suscitant leur intérêt afin d’écrire des conseils d’entretiens pour les plantes.

## schema de la base de données
- users
    - user_id (Clé primaire)
    - Nom
    - Photo de profil
    - Role (UserSimple, User_botaniste.)
    - Autres informations utilisateur ...
- plants
    - plant_id (Clé primaire)
    - name
    - description
    - user_created
    - address
    - path_image
    - created_at
    - updated_at
- demands
    - plant_id (Clé étrangère référence plants.plant_id)
    - user_created
    - user_gardien
    - status (pending, accepted, refused)
- interaction
    - interaction_id (Clé primaire)
    - user_created
    - user_gardien
    - demand_id
    - message
- soinPlant
- conseil
    - message
    - user_botaniste
    - plant_id

---
1. **Users Table:**

    - UserID (Primary Key)
    - Name
    - profile_photo_path
    - Role (SimpleUser, BotanistUser)
    - Other user information
2. **Plants Table:**

    - PlantID (Primary Key)
    - Name
    - Description
    - user_created (Foreign Key references Users.UserID)
    - path_image
    - address
    - date_begin
    - date_end
    - CreatedAt
    - UpdatedAt
3. **Demands Table:**

    - DemandID (Primary Key)
    - plant_id (Foreign Key references Plants.PlantID)
    - user_id (Foreign Key references Users.UserID)
    - IsClosed
5. **Advice Table:**

    - AdviceID (Primary Key)
    - content
    - user_id (Foreign Key references Users.UserID)
    - plant_id (Foreign Key references Plants.PlantID)
6. **messages Table:**
    - id
    - message
    - sender_id (Foreign Key references Users.UserID)
    - receiver_id (Foreign Key references Users.UserID)
    - demand_id (Foreign Key references Demands.DemandID)
    - is_read
5. **Advice Table:**

    - AdviceID (Primary Key)
    - content
    - BotanistUser (Foreign Key references Users.UserID)
    - plant_id (Foreign Key references Plants.PlantID)
  
---

## Introduction

Ce document explique comment cloner, installer et lancer une application Laravel.

## Prérequis

Avant de commencer, vous devez avoir installé les éléments suivants :

Git
PHP 8.0 ou supérieur
Composer
Cloner le projet

Pour cloner le projet, utilisez la commande suivante :

```sh
git clone https://github.com/votre-nom-utilisateur/nom-du-projet.git
```

## Installer les dépendances

Pour installer les dépendances du projet, utilisez la commande suivante :

```sh
composer install
```

## Créer le fichier .env

Copiez le fichier `.env.example` vers `.env` et configurez les variables d'environnement.

Créer la base de données

Créez la base de données et configurez les utilisateurs et les permissions.

## Exécuter les migrations

Exécutez les migrations pour créer les tables de la base de données :

```sh
php artisan migrate
```

## Lancer l'application

Pour lancer l'application, utilisez la commande suivante :

php artisan serve
Accéder à l'application

L'application est accessible à l'adresse http://localhost:8000.

Fonctionnalités de l'application
