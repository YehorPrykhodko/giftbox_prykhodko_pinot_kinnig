<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetPredefinedBoxDetails extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $boxId = $args['id'];

        $box = Box::with('prestations')->where('id', $boxId)->where('statut', 1)->first();

        if (!$box) {
            return $rs->withStatus(404);
        }

        $twig = Twig::fromRequest($rq);
        return $twig->render($rs, 'predefined_box_details.twig', compact('box'));
    }
}