<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetBoxDetails extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $boxId = $args['id'];
        $userId = $_SESSION['user']['id'];

        $box = Box::where('id', $boxId)->where('createur_id', $userId)->first();

        if (!$box) {
            return $response->withStatus(404);
        }

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'box_details.twig', compact('box'));
    }
}