<?php

namespace gift\api\app\actions;

use gift\api\core\services\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCoffret extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $boxService = new BoxService();

        $coffretId = $args['id'];
        $coffret = $boxService->getBoxById($coffretId);
        $response->getBody()->write(json_encode($coffret));
        return $response->withHeader('Content-Type', 'application/json');
    }
}