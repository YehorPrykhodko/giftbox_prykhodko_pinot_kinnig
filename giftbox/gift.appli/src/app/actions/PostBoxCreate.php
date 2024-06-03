<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostBoxCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $html = <<<HTML
            <h2>NEW BOX</h2>
            <div class = "libBox"> {$_POST['libelle']} </div>
            <div class = "descBox"> {$_POST['description']} </div>
            <div class = "montantBox"> {$_POST['montant']} </div>   
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}