<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetPredefinedBoxes extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $boxes = Box::where('statut', 1)->get();

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'predefined_boxes.twig', compact('boxes'));
    }
}