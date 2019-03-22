Anaxago symfony-starter-kit
===================

# Description

Ce projet est issu du kit de démarage  
Il ajoute une API REST JSON au kit de démarrage   

Il fonctionne avec :
- Symfony 3.4 minimum
- php 7.1 minimum, php7.2 maximum (pour la compatibilité avec Symfony 3)

La base de données contient 4 tables :
- user => pour la gestion et la connexion des utilisateurs 
- project => pour la liste des projets
- proposal => pour les propositions de financements des projets par les utilisateurs
- user_session => une table tehcnique pour les sessions de connexion  l'API

Les données préchargés sont
- pour les users 

| email     | password    | Role |
| ----------|-------------|--------|
| john@local.com  | john   | ROLE_USER    |
| admin@local.com | admin | ROLE_ADMIN   | 

 - une liste de 3 projets
 
La connexion et l'enregistrement des utilisateurs sont déjà configurés et opérationnels


# Installation
- ```composer install```
- ```composer init-db ```
- ```php bin/console doctrine:schema:update --force ```

    - Script personnalisé permet de créer la base de données, de lancer la création du schéma et de précharger les données
    - Ce script peut être réutilisé pour ré-initialiser la base de données à son état initial à tout moment
    - Doctrine Migration a été installé mais en phase de développement , on peut faire un  schema-update --force comme ci-dessus.
    
L'API est décrite dans le fichier swagger [app/config/swagger.yml](app/config/swagger.yml)  
Visualisation possible grâce à [https://editor.swagger.io/](https://editor.swagger.io/)  

Pour se connecter à l'API : http://127.0.0.1:8000/oauth en POST avec un flux json : 
```json
{
"username": "pitlejariel@hotmail.com",
"password": "anaxago",
"client_id": "frontend",
"client_secret": "monmotdepassesecret"
}

```
Le jeton nommé acces_token est à placer dans l'entête HTTP Authorization sous la forme "Bearer {{jeton }}"


