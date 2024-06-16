<?php

namespace gift\api\app\actions;

use gift\api\core\services\CatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestations extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $catalogueService = new CatalogueService();

        $prestations = $catalogueService->getAllPrestations();
        $response->getBody()->write(json_encode($prestations));
        return $response->withHeader('Content-Type', 'application/json');
    }
}