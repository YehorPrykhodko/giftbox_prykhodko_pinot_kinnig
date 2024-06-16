<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\services\EntitesNotFound;
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

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = '';
        }
        $cata = new CatalogueGiftbox();
        try {
            $presta = $cata->getPrestationsbyCategorie($args['id'],$sort);
        }catch (EntitesNotFound $e){
            throw new HttpNotFoundException($rq,$e->getMessage());
        }
        $categ=$presta[0]['categorie']['libelle'];
        $view = Twig::fromRequest($rq);
        return ($view->render($rs, "prestations.twig", ['prestations' => $presta,'titreListe'=>"Prestations de la categorie {$categ}"]));
    }

}



