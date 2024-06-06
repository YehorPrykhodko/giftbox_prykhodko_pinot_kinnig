<?php
namespace gift\appli\app\actions;
use Error;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;
use gift\appli\utils\TestUtils;
class Racine {

	public function __invoke(Request $rq, Response $rs, $args):Response{
		$view=Twig::fromRequest($rq);
		return($view->render($rs,'accueil.twig',[]));
	}

}
