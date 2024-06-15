<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Prestation;
use gift\appli\core\services\CatalogueService;
use gift\appli\actions\exceptions\EntityNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetPrestation extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $params = $request->getQueryParams();
            if (!isset($params['id'])) {
                $response->getBody()->write("Erreur de l'id.");
                return $response->withStatus(400);
            }

            $catalogueService = new CatalogueService();

            $id = (int)$params['id'];

            $prestation = $catalogueService->getPrestationById($id);

            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'prestation.twig', compact('prestation'));
        } catch (EntityNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(404);
        }
    }
}