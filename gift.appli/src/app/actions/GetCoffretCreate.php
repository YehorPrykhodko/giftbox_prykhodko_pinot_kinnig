<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetCoffretCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $queryParams = $rq->getQueryParams();
        $predefinedBoxId = $queryParams['predefined_box_id'] ?? null;

        $predefinedBoxes = Box::where('statut', 1)->get();
        $selectedBox = $predefinedBoxId ? Box::find($predefinedBoxId) : null;

        $twig = Twig::fromRequest($rq);
        return $twig->render($rs, 'coffret_create.twig', [
            'predefined_boxes' => $predefinedBoxes,
            'selected_box' => $selectedBox
        ]);
    }
}