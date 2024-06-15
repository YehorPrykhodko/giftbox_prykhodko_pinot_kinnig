<?php
namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class CategorieCreateFormulaire extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $view=Twig::fromRequest($rq);
        return($view->render($rs,"formulaireCreateCategorie.twig"));
    }
}