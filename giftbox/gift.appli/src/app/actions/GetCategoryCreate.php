<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetCategoryCreate extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'category_create.twig');
    }
}
