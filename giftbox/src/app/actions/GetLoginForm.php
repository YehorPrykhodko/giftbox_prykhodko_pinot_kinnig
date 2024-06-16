<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetLoginForm extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $twig = Twig::fromRequest($rq);
        return $twig->render($rs, 'login.twig');
    }
}