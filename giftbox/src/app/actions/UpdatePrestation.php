<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\CatalogueEloquent;
use gift\appli\core\services\EntitesNotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class UpdatePrestation extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $prestation['libelle'] = filter_var($_POST['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $prestation['description'] = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        $prestation['url'] = filter_var($_POST['url'], FILTER_SANITIZE_URL);
        $prestation['unite'] = filter_var($_POST['unite'], FILTER_SANITIZE_SPECIAL_CHARS);
        $prestation['tarif'] = filter_var($_POST['tarif'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $prestation['img'] = filter_var($_POST['img'], FILTER_SANITIZE_SPECIAL_CHARS);
        $prestation['cat_id'] = filter_var($_POST['cat_id'], FILTER_SANITIZE_NUMBER_INT);

//        var_dump($prestation['tarif']);
//        var_dump($_POST['tarif']);
        $cle = array_keys($prestation);
        foreach ($cle as $c) {
            if (!isset($prestation[$c])) {
                throw new HttpNotFoundException($rq, "Valeur $c not found");
            }
            if ($prestation[$c] != $_POST[$c]) {
                throw new HttpNotFoundException($rq, "Valeur $c invalide");
            }
        }

        $prestation['id'] = $args['id'];
        $cata = new CatalogueEloquent();
        try {
            $id = $cata->modifPrestation($prestation);
        } catch (EntitesNotFound $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'updatePrestationTerminee.twig', ['id' => $id]);
    }
}