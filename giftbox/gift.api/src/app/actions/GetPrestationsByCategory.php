<?php

namespace gift\api\app\actions;

use gift\api\core\services\CatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestationsByCategory extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $catalogueService = new CatalogueService();

        $categoryId = (int)$args['id'];
        $prestations = $catalogueService->getPrestationsByCategorie($categoryId);
        $response->getBody()->write(json_encode($prestations));
        return $response->withHeader('Content-Type', 'application/json');
    }
}