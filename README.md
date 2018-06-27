# bbh_project

#### Une fois le projet récupéré

* Créer une base de donnée database dans mysql

* Copier le contenu de db_backup.sql (situé dans le dossier database) dans la base de donnée créée précédemment.
$mysql -u username -p -h localhost DATA-BASE-NAME < [le chamin]/db_backup.sql

* Dans le dossier du projet 
$composer install

* Modifier le fichier .env situé à la racine du projet
-> ligne 23 mettre le bon db_user, db_password et [database]

* $bin/console server:run

* Se rendre à l'url donnée

