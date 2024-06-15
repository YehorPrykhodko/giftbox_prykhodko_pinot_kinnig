<?php

namespace gift\appli\core\services;

interface CatalogueServiceInterface {
    public function getCategories(): array;
    public function getCategorieById(int $id): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsByCategorie(int $categ_id): array;
    public function createCategory(array $categoryData): int;
    public function modifyPrestation(string $id, array $properties): void;
    public function setCategoryToPrestation(string $prestationId, int $categoryId): void;

}