<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BoxActuelle extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        if(isset($_SESSION['idBoxCourant'])){
            $route="/box/{$_SESSION['idBoxCourant']}";
        }else{
            $route="/";
        }
        return $rs->withStatus(302)->withHeader('Location', $route);
    }
}