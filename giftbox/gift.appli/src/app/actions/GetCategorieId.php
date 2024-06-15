<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\CatalogueService;
use gift\appli\actions\exceptions\EntityNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetCategorieId extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $catalogueService = new CatalogueService();

            if (!isset($args['id'])) {
                throw new HttpBadRequestException($request, "id categorie manquant");
            }

            $id = (int)$args['id'];
            $categorie = $catalogueService->getCategorieById($id);

            if (!$categorie) {
                throw new HttpNotFoundException($request, "id inexistant");
            }

            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'category.twig', compact('categorie'));
        } catch (EntityNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(404);
        }
    }
}