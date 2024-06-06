<?php
namespace gift\appli\app\actions;

use Illuminate\Database\QueryException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

class PrestationsDeCategorie extends AbstractAction{


    function __invoke(Request $rq, Response $rs, $args): Response
    {
	try{
	$presta=Categorie::where("id","=",$args['id'])->with('prestations')->get();
	}catch(QueryException $e){
	    // throw new HttpNotFoundException($rq,"Id {$args['id']} inconnue");
	    throw $e;
	}
	// var_dump($presta);
	$view=Twig::fromRequest($rq);
	return($view->render($rs, "presta2cat.twig", ['cat'=>$presta]));
    }

}



