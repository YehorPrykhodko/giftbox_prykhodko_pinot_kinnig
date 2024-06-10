<?php
namespace gift\appli\app\actions;
use gift\appli\core\services\CatalogueEloquent;
use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use const http\Client\Curl\FEATURES;

class BoxCreatePost {

	public function __invoke(Request $rq, Response $rs, $args):Response{
		// $createBoxHtml=<<<END
		// <h2> Submitted Info for box creation</h2>
		// <div class="libelleBox"> {$_POST['libelleFormBox']} </div>
		// <div class = "descriptionBox"> {$_POST['descriptionFormBox']} </div>
		// <div class = "montantBox"> {$_POST['montantFormBox']} </div>
		// 	END;
		// $rs->getBody()->write($createBoxHtml);
		// return($rs);
		$data=[ "description"=> filter_var($_POST['descriptionFormBox'],FILTER_SANITIZE_SPECIAL_CHARS),
			"libelle"=> filter_var($_POST['libelleFormBox'],FILTER_SANITIZE_SPECIAL_CHARS),
			"montant"=>   filter_var($_POST['montantFormBox'],FILTER_SANITIZE_NUMBER_FLOAT)];
		$view=Twig::fromRequest($rq);
		return($view->render($rs, 'afficheFormulaireBox.twig',$data));
	}

}
