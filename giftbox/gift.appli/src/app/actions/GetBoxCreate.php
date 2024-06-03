<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetBoxCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $html = <<<HTML
        <html>
            <head><title>Creer une Box</title></head>
            <body>
                <h1>Creer une Box</h1>
                <form action="/box/create" method="POST">
                    <label for="libelle">Libelle:</label>
                    <input type="text" id="libelle" name="libelle" required><br>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea><br>
                    <label for="montant">Montant:</label>
                    <input type="number" id="montant" name="montant" required><br>
                    <label for="kdoFormBox">KDO:</label>
                    <input type="number" id="kdoFormBox" name="kdoFormBox" required><br>
                    <button type="submit">Créer</button>
                </form>
            </body>
        </html>
        HTML;

        $response->getBody()->write($html);
        return $response;
    }
}