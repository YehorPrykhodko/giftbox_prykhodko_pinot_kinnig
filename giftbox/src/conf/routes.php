<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\conf\BoxCreateGet;
use gift\appli\conf\BoxCreatePost;
use gift\appli\conf\CategoriesAfficheId;
use gift\appli\conf\CategoriesAffiches;
use gift\appli\conf\PrestationsAffiche;
use gift\appli\conf\Racine;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

return function( \Slim\App $app): \Slim\App {
/* home */

$app->post('/box/create[/]', BoxCreatePost::class);

$app->get('/box/create[/]', BoxCreateGet::class);


$app->get('[/]',Racine::class);


$app->get('/prestations[/]',PrestationsAffiche::class);

$app->get('/categories[/]',CategoriesAffiches::class);

	$app->get('/categories/{id}[/]',CategoriesAfficheId::class);



    return $app;

    };
