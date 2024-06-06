<?php
namespace gift\appli\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\models\Prestation;

class PrestationsAfficheId extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, $args):Response{
	    $prestation=Prestation::where("id","=",$args['id'])->get();

	    $view=Twig::fromRequest($rq);
	    return($view->render($rs, 'prestaUnique.twig',['prestations'=>$prestation]));

    }

}
