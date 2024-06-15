<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use gift\appli\core\services\CatalogueService;

class PostCategoryCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $catalogueService = new CatalogueService();
        $data = $request->getParsedBody();
        $csrfToken = $data['csrf_token'] ?? '';

        try {
            CsrfService::check($csrfToken);
        } catch (\Exception $e) {
            return $response->withStatus(403); //bad csrf token
        }

        $name = $data['name'] ?? 'N/A';
        $description = $data['description'] ?? 'N/A';
        $csrf = $data['csrf'] ?? 'N/A';

        try {
            $catalogueService->createCategory(compact('name', 'description', 'csrf'));
            $url = '/categories';
            return $response->withStatus(302)->withHeader('Location', $url);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'category_created.twig', compact('name', 'description', 'error'));
        }
    }
}
