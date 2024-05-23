<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\app\actions\BoxCreateGet;
use gift\appli\app\actions\BoxCreatePost;
use gift\appli\app\actions\CategoriesAfficheId;
use gift\appli\app\actions\CategoriesAffiches;
use gift\appli\app\actions\PrestationsAffiche;
use gift\appli\app\actions\Racine;
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
