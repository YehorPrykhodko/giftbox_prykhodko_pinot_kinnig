<?php

namespace gift\api\core\services;

use gift\api\core\domain\entities\Categorie;
use gift\api\core\domain\entities\Prestation;
use gift\api\actions\exceptions\EntityNotFoundException;
use Illuminate\Database\QueryException;

class CatalogueService implements CatalogueServiceInterface {

    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getAllPrestations(): array {
        return Prestation::all()->toArray();
    }

    public function getPrestationsByCategorie(int $categ_id): array {
        $categorie = Categorie::with('prestation')->find($categ_id);
        if (!$categorie) {
            throw new EntityNotFoundException("Catégorie non trouvée");
        }
        return $categorie->prestation->toArray();
    }
}
