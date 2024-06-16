<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\CatalogueGiftbox;
use gift\appli\core\domain\entities\Box;
use gift\appli\utils\CsrfToken;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use const http\Client\Curl\FEATURES;

class BoxCreatePost
{

    public function __invoke(Request $rq, Response $rs, $args): Response
    {

        try {
            if (!isset($_POST['csrf'])) {
                throw new \Exception();
            }
            CsrfToken::check($_POST['csrf']);
        } catch (\Exception $e) {
            throw new HttpNotFoundException($rq, 'Erreur de formulaire non valide');
        }
        $data = ['description' => filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS),
            'libelle' => filter_var($_POST['libelle'], FILTER_SANITIZE_SPECIAL_CHARS),
            'montant' => filter_var($_POST['montant'], FILTER_SANITIZE_NUMBER_FLOAT)
        ];
        if (isset($_POST['kdo'])) {
            $data['message_kdo'] = filter_var($_POST['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $data['kdo'] = 1;
            $_POST['kdo'] = 1;
        } else {
            $data['message_kdo'] = '';
            $_POST['message_kdo'] = '';
            $data['kdo'] = 0;
            $_POST['kdo'] = 0;
        }

        $cle = array_keys($data);
        foreach ($cle as $c) {
            $champs = $data[$c];
            if (!isset($champs)) {
                throw new HttpNotFoundException($rq, "Valeur $c non renseignée");
            }
            if ($champs != $_POST[$c]) {
                throw new HttpNotFoundException($rq, "Valeur $c non valide");
            }
        }

        $user = $_SESSION['user'];

        $data['token'] = bin2hex(random_bytes(32));
        $data['statut'] = Box::CREATED;
        $cata = new CatalogueGiftbox();
        $idBox = $cata->createBox($data, $user);

        $_SESSION['idBoxCourant'] = $idBox;
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'createBoxPost.twig', ['idBox' => $idBox]);
    }

}
