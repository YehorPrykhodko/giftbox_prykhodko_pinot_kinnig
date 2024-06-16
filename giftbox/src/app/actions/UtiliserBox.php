<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class UtiliserBox extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        if (!isset($_POST['box_id'])) {
            throw new HttpNotFoundException($rq, "Box non valide");
        }
        $boxId = $_POST['box_id'];

        $cata = new CatalogueGiftbox();
        try {
            $cata->utiliserBox($boxId);
        } catch (EntitesNotFound $e) {
            throw new HttpNotFoundException($rq,$e);
        }
        return $rs->withStatus(302)->withHeader('Location', "/box/$boxId");
    }
}