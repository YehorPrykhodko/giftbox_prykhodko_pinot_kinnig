<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PageUniqueBox extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $cata=new CatalogueGiftbox();
        try {
            $box = $cata->getBoxByToken($args['token']);
        } catch (EntitesNotFound $e) {
        }

        $view=Twig::fromRequest($rq);
        return $view->render($rs,'pageUniqueBox.twig',['box'=>$box]);
    }
}