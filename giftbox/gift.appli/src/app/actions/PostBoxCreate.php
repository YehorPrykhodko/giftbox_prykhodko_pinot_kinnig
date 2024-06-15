<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostBoxCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? 'N/A';
        $description = $data['description'] ?? 'N/A';
        $montant = $data['montant'] ?? 'N/A';

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'box_created.twig',
            compact('libelle', 'description', 'montant'));
    }
}