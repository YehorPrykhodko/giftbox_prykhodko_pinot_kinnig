<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use gift\appli\app\actions\BoxCreateGet;
use gift\appli\app\actions\BoxCreatePost;
use gift\appli\app\actions\CategoriesAfficheId;
use gift\appli\app\actions\CategoriesAffiches;
use gift\appli\app\actions\PrestationsAffiche;
use gift\appli\app\actions\Racine;
use gift\appli\app\exceptions\TeaPotException;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

return function( \Slim\App $app): \Slim\App {
	/* home */
	$app->post('/box/create[/]', BoxCreatePost::class); //twigOk

	$app->get('/box/create[/]', BoxCreateGet::class)->setName('createBoxForm');//twigOk

	$app->get('/test[/]', function(Request $rq, Response $rs, $args){
		$cat=Prestation::where("tarif",">","30")->get();
		
		$routeContext=RouteContext::fromRequest($rq);
		$routeParser=$routeContext->getRouteParser();
		$url = $routeParser->urlFor('createBoxForm');
		echo $url;
		$view=Twig::fromRequest($rq);
		return($view->render($rs,'testPrestation.twig',["prestations"=> $cat]));
	     });
	$app->get('[/]',Racine::class);


	$app->get('/prestations[/]',PrestationsAffiche::class);

	$app->get('/categories[/]',CategoriesAffiches::class); 

	$app->get('/categories/{id}[/]',CategoriesAfficheId::class);



	return $app;

};
