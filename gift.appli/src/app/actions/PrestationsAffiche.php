<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\DBConnectionError;
use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\appli\core\domain\entities\Prestation;

class PrestationsAffiche
{

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = '';
        }
        $cata = new CatalogueGiftbox();
        try {
            $prestation = $cata->getPrestations($sort);
        } catch (DBConnectionError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return ($view->render($rs, 'prestations.twig', ['prestations' => $prestation, 'titreListe' => 'Prestations']));

    }

}
