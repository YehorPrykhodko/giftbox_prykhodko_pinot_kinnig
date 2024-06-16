<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostCoffretCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $userId = $_SESSION['user']['id'];

        $newBox = new Box();
        $newBox->libelle = $data['libelle'];
        $newBox->description = $data['description'];
        $newBox->montant = 0;
        $newBox->statut = 1;
        $newBox->createur_id = $userId;
        $newBox->token = CsrfService::generate();
        $newBox->kdo = $data['kdo'] ?? 0;
        $newBox->message_kdo = $data['message_kdo'] ?? '';

        if (!empty($data['predefined_box_id'])) {
            $predefinedBox = Box::find($data['predefined_box_id']);
            $newBox->save();
            foreach ($predefinedBox->prestations as $prestation) {
                $newBox->prestations()->attach($prestation->id, ['quantite' => $prestation->pivot->quantite]);
            }
        }
        else
            $newBox->save();


        return $response->withHeader('Location', '/user/boxes')->withStatus(302);
    }
}