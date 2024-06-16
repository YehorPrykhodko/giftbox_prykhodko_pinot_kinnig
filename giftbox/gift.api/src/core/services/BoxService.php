<?php
namespace gift\api\core\services;


use gift\api\actions\exceptions\EntityNotFoundException;
use gift\api\core\domain\entities\Box;

class BoxService implements BoxServiceInterface {
    public function getBoxById(string $id): array {
        $box = Box::with('prestations')->find($id);
        if (!$box) {
            throw new EntityNotFoundException("Box non trouvé");
        }
        return $box->toArray();
    }
}
