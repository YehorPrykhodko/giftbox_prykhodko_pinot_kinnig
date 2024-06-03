<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategories extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $categories = Categorie::select("id","libelle")->get();

        if ($categories->isEmpty()) {
            $response->getBody()->write('Aucune catégorie trouvée.');
            return $response;
        }

        $html = <<<HTML
        <html>
        <head><title>Liste des Catégories</title></head>
        <body>
        <h1>Liste des Catégories</h1>
        <ul>
        HTML;

        foreach ($categories as $categorie) {
            $html .= "<li><a href='/categorie/{$categorie['id']}'>{$categorie['libelle']}</a></li>";
        }

        $html .= <<<HTML
        </ul>
        </body>
        </html>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}