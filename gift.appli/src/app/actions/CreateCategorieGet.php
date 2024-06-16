<?php

namespace gift\appli\app\actions;

use gift\appli\utils\CsrfToken;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class CreateCategorieGet extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $token=CsrfToken::generate();
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'formulaireCreateCategorie.twig', ['token' =>$token]);
    }
}