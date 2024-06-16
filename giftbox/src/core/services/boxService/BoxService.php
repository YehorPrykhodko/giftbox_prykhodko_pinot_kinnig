<?php
namespace gift\appli\core\services;

use gift\appli\core\domain\entities\Box;
use gift\appli\core\services\exceptions\ValidationException;
use gift\appli\utils\CsrfToken;

class BoxService implements BoxServiceInterface {
    public function createBox(array $data): int {
        $libelle = filter_var($data['libelle'] ?? '', FILTER_SANITIZE_STRING);
        $description = filter_var($data['description'] ?? '', FILTER_SANITIZE_STRING);

        $kdo = filter_var($data['kdo'] ?? '', FILTER_SANITIZE_STRING);
        $message_kdo = filter_var($data['message_kdo'] ?? '', FILTER_SANITIZE_STRING);
        $url = filter_var($data['url'] ?? '', FILTER_SANITIZE_URL);

        if ($libelle !== $data['libelle'] || $description !== $data['description']) {
            throw new ValidationException("Les données ne sont pas valides");
        }

        $box = new Box([
            'libelle' => $libelle,
            'description' => $description,
            'kdo' => $kdo,
            'message_kdo' => $message_kdo,
            'url' => $url,
            'montant' => 0,
            'access_token' => CsrfToken::generate(),
            'status' => 1,
        ]);

        $box->save();

        return $box->id;
    }
}
