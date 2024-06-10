<?php

namespace gift\appli\core\services;

interface CatalogueInterface
{
    public function getCategories(): array;

    public function getCategorieById(int $id): array;

    public function getPrestationById(string $id): array;

    public function getPrestationsbyCategorie(int $categ_id): array;

    public function createCategorie(array $categorie): void;

    public function updatePrestation(array $modifPrestation): void;

    public function createBox(array $box): void;

    public function getBoxById(int $id): array;

    public function getBoxs(): array;

}