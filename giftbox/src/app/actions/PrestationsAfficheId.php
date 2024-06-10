<?php
namespace gift\appli\app\actions;
use gift\appli\core\services\CatalogueEloquent;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\core\domain\entities\Prestation;

class PrestationsAfficheId extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, $args):Response{
        $cata=new CatalogueEloquent();
        $prestation=$cata->getPrestationById($args['id']);

	    $view=Twig::fromRequest($rq);
	    return($view->render($rs, 'prestaUnique.twig',['prestations'=>$prestation]));

    }

}
