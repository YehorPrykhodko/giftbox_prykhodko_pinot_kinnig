<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class SupprimmerPrestation extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        if (!isset($_SESSION['idBoxCourant'])) {
            throw new HttpNotFoundException($rq, "Pas de box séléctionné");
        }
        $boxId = $_SESSION['idBoxCourant'];

        if (!isset($_POST['id_presta'])) {
            throw new HttpNotFoundException($rq, "Prestation non valide");
        }

        $id_presta = $_POST['id_presta'];
        $cata = new CatalogueGiftbox();
        try {
            $cata->supprimerPrestationDeBox($id_presta, $boxId);
        } catch (EntitesNotFound $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }


        return $rs->withStatus(302)->withHeader('Location', "/box/$boxId");
    }
}