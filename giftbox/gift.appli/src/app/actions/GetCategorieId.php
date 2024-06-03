<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class GetCategorieId extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if (!isset($args['id'])) {
            throw new HttpBadRequestException($request, "id categorie manquant");
        }

        $id = (int)$args['id'];
        $categorie = Categorie::where("id","=",$id)->first();

        if (!$categorie) {
            throw new HttpNotFoundException($request, "id inexistant");
        }

        $html = <<<HTML
        <html>
        <head><title>{$categorie->libelle}</title></head>
        <body>
        <h1>{$categorie->libelle}</h1>
        <p>ID: {$id}</p>
        <p>Description: {$categorie->description}</p>
        <a href="/categories">Retour a la liste des categories</a>
        </body>
        </html>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}