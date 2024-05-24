<?php
namespace gift\appli\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use gift\appli\models\Prestation;

class PrestationsAffiche {

    public function __invoke(Request $rq, Response $rs, $args):Response{
	if(isset($_GET["id"])){
	    $idPresta=$_GET["id"];
	    $prestation=Prestation::where("id","=",$idPresta)->get();

	    $prestationHtml="";


	    $prestationHtml="";
	    if(count($prestation)==0){
		throw new HttpNotFoundException($rq,"Id $idPresta non valide");
		$prestationHtml.=<<<END
		<div class="error">
		Aucune ligne ne correspond à l'id $idPresta
		</div>
		END;
	    }
	    foreach($prestation as $p){

		$prestationHtml.=<<<END

		<div class="prestation">

		<div class="libellePres">$p->libelle </div>
		<div class = "idPres">	$p->id</div>
		<div class ="descriptionPres"> $p->description</div> 
		<div class="idCat">	$p->cat_id</div>

		</div>

		END;

	    }
	$rs->getBody()->write($prestationHtml);
	    //id present

	}else{
	    // $rs->getBody()->write('<label class="error"> Erreur id de préstations non valide </label>');
	    throw new HttpBadRequestException($rq,"Pas d'id après /prestations");

	}
	return($rs);
    }

}
