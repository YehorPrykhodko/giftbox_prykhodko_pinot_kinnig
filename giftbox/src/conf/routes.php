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
use gift\appli\app\actions\PrestationsAfficheId;
use gift\appli\app\actions\PrestationsDeCategorie;
use gift\appli\app\actions\Racine;
use gift\appli\app\exceptions\TeaPotException;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\Prestation;

return function( \Slim\App $app): \Slim\App {
	/* home */
	$app->post('/box/create[/]', BoxCreatePost::class); //twigOk

	$app->get('/box/create[/]', BoxCreateGet::class)->setName('boxCreateForm');//twigOk

	$app->get('/test[/]', function(Request $rq, Response $rs, $args){

        $categorie=['libelle'=>'superlibelle',
            'description'=>'abba'];
        $cata=new \gift\appli\core\services\CatalogueEloquent();
        $cata->createCategorie($categorie);
		$view=Twig::fromRequest($rq);
		return($view->render($rs,'presta2cat.twig',[]));
	     });
	$app->get('[/]',Racine::class)->setName('racine');


	$app->get('/prestationsDeCategorie/{id}[/]',PrestationsDeCategorie::class)->setName('presta2cat');

	$app->get('/prestations[/]',PrestationsAffiche::class)->setName('listPrestations');

	$app->get('/prestations/{id}[/]',PrestationsAfficheId::class)->setName('prestationId');

	$app->get('/categories[/]',CategoriesAffiches::class)->setName('listCategories'); 

	$app->get('/categories/{id:\d+}[/]',CategoriesAfficheId::class)->setName('categorieId');



	return $app;

};
