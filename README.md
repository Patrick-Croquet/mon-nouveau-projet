# mon-nouveau-projet
 Mon nouveau projet Symfony 5

# Branche Pagination-Formulaire_Contact 

# Importer dans PhpMyAdmin bd_new.sql
# Activer la vérification des clés étrangères

php bin/console make:migration

# Roles dans la table user
{"0": "ROLE_USER", "2": "ROLE_ADMIN"}

composer install
symfony serve -d
