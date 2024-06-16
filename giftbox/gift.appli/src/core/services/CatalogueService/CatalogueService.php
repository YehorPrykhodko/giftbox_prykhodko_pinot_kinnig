<?php

namespace gift\appli\core\services;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\Prestation;
use gift\appli\actions\exceptions\EntityNotFoundException;
use Slim\Views\Twig;
use Illuminate\Database\QueryException;

class CatalogueService implements CatalogueServiceInterface {
    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(int $id): array {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            throw new EntityNotFoundException("Catégorie non trouvée");
        }
        return $categorie->toArray();
    }

    public function getPrestationById(string $id): array {
        $prestation = Prestation::find($id);
        if (!$prestation) {
            throw new EntityNotFoundException("Prestation non trouvée");
        }
        return $prestation->toArray();
    }

    public function getPrestationsByCategorie(int $categ_id): array {
        $categorie = Categorie::find($categ_id);
        if (!$categorie) {
            throw new EntityNotFoundException("Catégorie non trouvée");
        }
        return $categorie->prestations->toArray();
    }

    public function createCategory(array $values): void
    {
        try {
            // Vérification du token CSRF
            CsrfService::check($values['csrf']);

            // Validation des données
            if ($values['libelle'] !== filter_var($values['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ||
                $values['description'] !== filter_var($values['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                throw new CatalogueServiceInvalidDataException("Les données ne sont pas valides");
            }

            // Création de la nouvelle catégorie
            $newCategory = new Categorie();
            $newCategory->libelle = filter_var($values['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newCategory->description = filter_var($values['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newCategory->save();
        } catch (QueryException $e) {
            throw new CatalogueServiceNoDataFoundException("Erreur de sauvegarde", 500);
        }
    }
    public function modifyPrestation(string $id, array $properties): void {
        $prestation = Prestation::find($id);
        if (!$prestation) {
            throw new EntityNotFoundException("Prestation non trouvée");
        }
        $prestation->fill($properties);
        $prestation->save();
    }

    public function setCategoryToPrestation(string $prestationId, int $categoryId): void {
        $prestation = Prestation::find($prestationId);
        $category = Categorie::find($categoryId);
        if (!$prestation || !$category) {
            throw new EntityNotFoundException("Prestation ou Catégorie non trouvée");
        }
        $prestation->categorie_id = $category->id;
        $prestation->save();
    }
}
