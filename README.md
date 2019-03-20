Anaxago symfony-starter-kit
===================

# Description

Ce projet est un kit de démarage avec :
- Symfony 3.4 minimum
- php 7.1 minimum, php7.2 maximum (pour la compatibilité avec Symfony 3)

La base de données contient trois tables :
- user => pour la gestion et la connexion des utilisateurs 
- project => pour la liste des projets
- proposal => pour les propositions de financements des projets par les utilisateurs

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
- ```php bin/console doctrine:migrations:migrate 20190320232501```

    - Script personnalisé permet de créer la base de données, de lancer la création du schéma et de précharger les données
    - Ce script peut être réutilisé pour ré-initialiser la base de données à son état initial à tout moment
