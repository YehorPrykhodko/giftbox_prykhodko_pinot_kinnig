<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class ValiderBox extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        if (!isset($_SESSION['idBoxCourant'])) {
            throw new HttpNotFoundException($rq, "Pas de box séléctionné");
        }

        $idBox = $_SESSION['idBoxCourant'];
        $cata = new CatalogueGiftbox();
        try {
            $cata->validerBox($idBox,$_SESSION['user']['id']);
        } catch (EntitesNotFound $e) {
            throw new HttpNotFoundException($rq,$e->getMessage());
        }
        return $rs->withStatus(302)->withHeader('Location', '/');
    }
}