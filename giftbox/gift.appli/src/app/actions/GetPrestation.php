<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestation extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $params = $request->getQueryParams();
        if (!isset($params['id'])) {
            $response->getBody()->write("Erreur de l'id.");
            return $response->withStatus(400);
        }

        $id = (int)$params['id'];
        $prestation = Prestation::where("id","=",$id)->first();

        $html = <<<HTML
        <html>
        <head><title>{$prestation['libelle']}</title></head>
        <body>
        <h1>{$prestation['libelle']}</h1>
        <p>Description: {$prestation['description']}</p>
        <p>Tarif: {$prestation['tarif']}</p>
        <p>Unité: {$prestation['unite']}</p>
        <a href="/categories">Retour à la liste des catégories</a>
        </body>
        </html>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}