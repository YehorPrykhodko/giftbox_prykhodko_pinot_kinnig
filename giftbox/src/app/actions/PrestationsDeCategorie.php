<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueEloquent;
use Illuminate\Database\QueryException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\Prestation;

class PrestationsDeCategorie extends AbstractAction
{


    function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $cata=new CatalogueEloquent();
            $presta=$cata->getPrestationsbyCategorie($args['id']);
        } catch (QueryException $e) {
            // throw new HttpNotFoundException($rq,"Id {$args['id']} inconnue");
            throw $e;
        }
        // var_dump($presta);
        $view = Twig::fromRequest($rq);
        return ($view->render($rs, "presta2cat.twig", ['cat' => $presta]));
    }

}



