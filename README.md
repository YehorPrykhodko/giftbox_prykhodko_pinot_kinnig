# giftbox_prykhodko_pinot_kinnig

## Repartition des taches

Kinnig Félicien  (N'a pas participé, aucun push sur le repository ni de communication)  
Pinot Gaëtan (Fonctionnalité 1 à 14)  
Prykhodko Yehor (Fonctionnalité 15 à 24)  
A cause d'une mauvaise organisation, nous avons du combiner manuellement notre travail sur la branche main, c'est pour
ça qu'il apparait donc que Gaëtan ai fait plus de commit que Yehor, mais sur la branche `Production` vous pouvez voir
les commits effectué par Yehor.

## Installation

### Docker compose

Au niveau du fichier `docker-compose.yml` copier le fichier `template.env` en `.env` et remplacer les mot de passe et
nom d'utilisateur par ce qui vous conviennent

### Fichier de conf

Dans le dossier `src/conf` de `gift.appli` et `gift.api`, copier et renommer le fichier `templateConfDB`
en `gift.db.conf.ini`.  
Ils doivent contenir les informations necessaire pour se connecter à la base de donnée, les informations doivent
concorder avec le fichier `.env`

### Composer

Faire un `composer install` dans le dossier `src` de `gift.appli` et `gift.api`

### Demmarrage

Faire un `docker compose up -d` pour demarrer les containeur.  
Remplir la base de donnée avec le fichier `giftbox.data.sql` grace soit à adminer au port spécifié dans
le `docker-compose.yml` et les logins spécifié dans le `.env`, soit avec un cli mysql ou mariadb

## Test

### API

Il y a un dossier `giftboxApiBruno` qui devrait normalement pouvoir permettre de tester les appelles à l'api sans avoir
à fouiller.

### Appli

Vous pouvez créer un utilisateur ou simplement utiliser un compte déjà créer comme celui de `simone24@example.com` avec
le mdp `simone24`.


