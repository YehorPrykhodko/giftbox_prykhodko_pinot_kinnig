<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class Racine extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $twig = Twig::fromRequest($request);
        $isAuthenticated = isset($_SESSION['user']);
        $userEmail = $isAuthenticated ? $_SESSION['user']['user_id'] : null;

        return $twig->render($response, 'index.twig', [
            'is_authenticated' => $isAuthenticated,
            'user_email' => $userEmail,
        ]);
    }
}