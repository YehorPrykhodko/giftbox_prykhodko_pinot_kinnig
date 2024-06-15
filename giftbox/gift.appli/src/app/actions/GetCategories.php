<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;

use gift\appli\core\domain\entities\Categorie;

use gift\appli\core\services\CatalogueService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetCategories extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $catalogueService = new CatalogueService();

        $categories = $catalogueService->getCategories();
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'categories.twig', compact('categories'));

    }
}