<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\CatalogueEloquent;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class UpdatePrestationGet extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $cata=new CatalogueEloquent();
        try {
            $presta = $cata->getPrestationById($args['id']);
        }catch (EntitesNotFound $e){
            throw new HttpNotFoundException($rq,$e->getMessage());
        }
        $view=Twig::fromRequest($rq);
        return $view->render($rs,'formulaireUpdatePrestation.twig',['presta'=>$presta]);
    }
}