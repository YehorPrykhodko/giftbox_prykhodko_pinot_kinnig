<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetUserBoxes extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $userId = $_SESSION['user']['id'];

        $boxes = Box::where('createur_id', $userId)->get();
        $twig = Twig::fromRequest($rq);
        return $twig->render($rs, 'user_boxes.twig', compact('boxes'));
    }
}