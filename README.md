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
