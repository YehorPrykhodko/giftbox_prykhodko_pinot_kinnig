<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Box;
use gift\appli\core\services\CatalogueGiftbox;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class AjouterPrestationToBox extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        if (!isset($_SESSION['idBoxCourant'])) {
            throw new HttpNotFoundException($rq, "Pas de box séléctionné");
        }

        if (isset($_POST['quantite'])) {
            $quantite = filter_var($_POST['quantite'], FILTER_VALIDATE_INT);
            if ($quantite != $_POST['quantite']) {
                throw new HttpNotFoundException($rq, 'Quantite invalide');
            }
        } else {
            $quantite = 1;
        }
        $boxId = $_SESSION['idBoxCourant'];

        $cata = new CatalogueGiftbox();

        if ($cata->getBoxState($boxId) != Box::CREATED) {
            throw new HttpNotFoundException($rq, "Box déjà validé ou payé");
        }
        $cata->ajouterPrestationToBox($args['id'], $boxId, $quantite);
        var_dump($boxId);
        var_dump($args['id']);
        return $rs->withStatus(302)->withHeader('Location', '/prestations');
    }
}