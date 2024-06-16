<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class PayerBox extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {


        if (!isset($_SESSION['idBoxCourant'])) {
            throw new HttpNotFoundException($rq, "Pas de box séléctionné");
        }
        $boxId = $_SESSION['idBoxCourant'];

        $cata=new CatalogueGiftbox();
        $cata->payerBox($boxId);

        return $rs->withStatus(302)->withHeader('Location', "/box/$boxId");
    }
}