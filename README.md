# giftbox_prykhodko_pinot

## Git

Depot Git : [https://github.com/YehorPrykhodko/giftbox_prykhodko_pinot_kinnig](https://github.com/YehorPrykhodko/giftbox_prykhodko_pinot_kinnig)

## Repartition des taches

Kinnig Félicien  (N'a pas participé, aucun push sur le repository ni de communication)  Félicien : Il n'y a pas eu d'essai de communication des autres membres du groupe, je ne suis pas venu en cours a cause de problèmes mentale mais j'ai quand même essayer de bosser chez moi, les autres membres du groupe ne m'ont jamaiis communiquer quelle tâches je suis censer faire
Pinot Gaëtan (Fonctionnalité 1 à 14)  
Prykhodko Yehor (Fonctionnalité 15 à 24)  
A cause d'une mauvaise organisation, nous avons du combiner manuellement notre travail sur la branche `main`, c'est pour
ça qu'il apparait donc que Gaëtan ai fait plus de commits que Yehor, mais sur la branche `Production` vous pouvez voir
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


### Demmarrage

Faire un `docker compose up -d` pour demarrer les containeur.  
Remplir la base de donnée avec le fichier `giftbox.data.sql` grace soit à adminer au port spécifié dans
le `docker-compose.yml` et les logins spécifié dans le `.env`, soit avec un cli mysql ou mariadb

### Composer

Faire un `docker compose exec php composer install` et `docker compose exec api composer install` pour installer les dependances et l'autoloader avec le composer des containers

### Cache

J'ai eu des problèmes certaines fois avec le dossier `cache` dans `src`, il à fallut soit que je supprime celui créer par défaut et que je le remplace par un que j'ai créer moi meme soit que j'y attribue tout les droits.

## Test

### API

Il y a un dossier `giftboxApiBruno` qui devrait normalement pouvoir permettre de tester les appelles à l'api sur un déployement local sans avoir à fouiller dans le fichier `routes.php` et le `docker-compose.yml`

### Appli

Vous pouvez créer un utilisateur ou simplement utiliser un compte déjà créer comme celui de `simone24@example.com` avec
le mdp `simone24`.

#### Boxs
Une fois connécté vous pouvez créer une box avec le lien dans la navbar, une fois créée la box est enregistré en session et vous pouvez y rajouter des prestations en allant sur les prestations et en cliquant sur ajouter.  
Vous pouvez valider la prestation ce qui bloque la modification.
Pour valider la prestations il faut avoir au moins 2 prestations de categorie differentes.  
Si vous faites quelque chose qui engendre une erreur vous êtes sensé recevoir une erreur 404 avec un message qui vous indique la raison.  
Le reste des fonctionnalités fonctionne comme décrit dans le sujet détaillé.  


### Docketu

Le site est normalement déployé sur `docketu.iutnc.univ-lorraine.fr:56580` [Ici](http://docketu.iutnc.univ-lorraine.fr:56580), et l'api `docketu.iutnc.univ-lorraine.fr:56583` [Ici](http://docketu.iutnc.univ-lorraine.fr:56583).





