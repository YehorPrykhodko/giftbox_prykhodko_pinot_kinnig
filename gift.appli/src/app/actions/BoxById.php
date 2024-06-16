<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class BoxById extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $cata=new CatalogueGiftbox();
        $data=$cata->getBoxById($args['id']);

//        var_dump($data);
        $prixTotal=0;
        foreach($data['prestations'] as $d){
            $prixTotal+=$d['tarif']*$d['pivot']['quantite'];
        }
        $view=Twig::fromRequest($rq);
        return $view->render($rs,'boxById.twig',['box'=>$data,'montantTotal'=>$prixTotal]);
    }
}