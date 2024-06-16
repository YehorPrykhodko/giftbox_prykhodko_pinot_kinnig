<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\DBConnectionError;
use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\utils\CsrfToken;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class CategorieCreatePost extends \gift\appli\app\actions\AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        try {
            if (!isset($_POST['csrf'])) {
                throw new \Exception();
            }
            CsrfToken::check($_POST['csrf']);
        } catch (\Exception $e) {
            throw new HttpNotFoundException($rq, 'Erreur de formulaire non valide');
        }

        $champsCreateCategorie = [];
        $champsCreateCategorie['libelle'] = filter_var($_POST['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $champsCreateCategorie['description'] = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $cle = array_keys($champsCreateCategorie);
        foreach ($cle as $c) {
            $champs = $champsCreateCategorie[$c];
            if (!isset($champs)) {
                throw new HttpNotFoundException($rq, "Valeur $c non renseignée");
            }
            if ($champs != $_POST[$c]) {
                throw new HttpNotFoundException($rq, "Valeur $c non valide");
            }
        }

        $cata = new CatalogueGiftbox();
        try {
            $id = $cata->createCategorie($champsCreateCategorie);
        } catch (DBConnectionError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'createCategoriePost.twig', ['id' => $id]);
    }
}