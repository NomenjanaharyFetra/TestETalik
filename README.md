comment installer et executer
1-Cloner le projet Git
git clone <url>
2-Acceder au repertoire du projet et installer les dépendances nécessaires php
cd <chemin_dossier>
composer install
3-Installer dépendances necessaire javascript
npm install
4-configurer la variable d’environnement c’est à dire edit .env, configurer le nom du base de donner et d’autre paramètre necessaire (utiliser mariadb)
exemple: DATABASE_URL="mysql://root:root@127.0.0.1:8889/DatabaseTest?serverVersion=mariadb-10.8.3"
5-Créer la base de données
php bin/console doctrine:database:create
6-Executer les migrations
-générer les fichier des migrations
php bin/console make:migration
7-Mettre à jour les schema de la base de données
php bin/console doctrine:migrations:migrate
8-Compiler les assets avec Webpack
npm run dev
9-Demarer le projet symfony
symfony serve

