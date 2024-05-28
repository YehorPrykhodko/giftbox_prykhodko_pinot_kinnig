<?php
namespace gift\appli\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

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
		$data=[ "description"=> $_POST['descriptionFormBox'],
			"libelle"=> $_POST['libelleFormBox'],
			"montant"=>   $_POST['montantFormBox']];
		$view=Twig::fromRequest($rq);
		return($view->render($rs, 'afficheFormulaireBox.twig',$data));
	}

}
