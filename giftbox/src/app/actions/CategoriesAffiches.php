<?php
namespace gift\appli\app\actions;
use Error;
use gift\appli\core\services\CatalogueGiftbox;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\core\domain\entities\Categorie;

class CategoriesAffiches {

public function __invoke(Request $rq, Response $rs, $args):Response{
        // try{
    $cata=new CatalogueGiftbox();
    $cat=$cata->getCategories();

        $view=Twig::fromRequest($rq);
    return $view->render($rs, "categorie.twig",["categories"=>$cat]);
}

}
