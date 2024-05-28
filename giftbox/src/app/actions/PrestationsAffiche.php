<?php
namespace gift\appli\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\models\Prestation;

class PrestationsAffiche {

    public function __invoke(Request $rq, Response $rs, $args):Response{
	if(isset($_GET["id"])){
	    $idPresta=$_GET["id"];
	    $prestation=Prestation::where("id","=",$idPresta)->get();


	    if(count($prestation)==0){
		throw new HttpNotFoundException($rq,"Id $idPresta non valide");
	    }

	    $view=Twig::fromRequest($rq);
	    return($view->render($rs, 'prestations.twig',['prestations'=>$prestation]));
	    //id present

	}else{
	    // $rs->getBody()->write('<label class="error"> Erreur id de préstations non valide </label>');
	    throw new HttpBadRequestException($rq,"Pas d'id après /prestations");

	}
	return($rs);
    }

}
