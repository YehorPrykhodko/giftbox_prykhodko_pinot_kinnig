<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueEloquent;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\core\domain\entities\Categorie;

class CategoriesAfficheId
{

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $cata = new CatalogueEloquent();
        $cat = $cata->getCategorieById($args['id']);
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorieId.twig', ['categories' => $cat]);

    }

}
