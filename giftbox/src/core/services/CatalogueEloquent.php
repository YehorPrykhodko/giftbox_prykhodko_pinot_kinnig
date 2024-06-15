<?php

namespace gift\appli\core\services;

use Exception;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\DBConnectionError;
use gift\appli\core\domain\entities\Prestation;
use gift\appli\core\domain\entities\Box;
use http\Message;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\Eloquent\MissingAttributeException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CatalogueEloquent
    implements CatalogueInterface
{


    /*
    +-------------+--------------+------+-----+---------+----------------+
    | Field       | Type         | Null | Key | Default | Extra          |
    +-------------+--------------+------+-----+---------+----------------+
    | id          | int(11)      | NO   | PRI | NULL    | auto_increment |
    | libelle     | varchar(128) | NO   |     | NULL    |                |
    | description | text         | YES  |     | NULL    |                |
    +-------------+--------------+------+-----+---------+----------------+*
    $cat=['libelle'=>'',
    'description'=>''];
     */
//    public function createCategorie($categorie): void
//    {
//        $cat=new Categorie();
//        $cat->libelle=$categorie['libelle'];
//    }
//
//
//    public function updatePrestation($modifPrestation): void{
//        $presta=Prestation::where('id','=',$modifPrestation->id)->update($modifPrestation);
//    }
    public function getCategories(): array
    {
        try {
            $cat = Categorie::get();
            return $cat->toArray();
        } catch (Exception $e) {
            throw $e;
        }

    }


    public function getCategorieById(int $id): array
    {
        try {
            $cat = Categorie::find($id);
            return $cat->toArray();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPrestations(): array
    {
        try {
            $presta = Prestation::get();
            return $presta->toArray();
        } catch (QueryException $exception) {
            throw new DBConnectionError("Database connection error");

        }
    }

    public function getPrestationById(string $id): array
    {
        try {
            $presta = Prestation::findOrFail($id);
            return $presta->toArray();
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Prestation $id not found");
        }
    }

    public function getPrestationsbyCategorie(int $categ_id): array
    {
        try {
            $presta = Categorie::where('id','=',$categ_id)->with('prestations')->get();
            return $presta->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new EntitesNotFound("Categorie $categ_id not found");
        }
    }

//    public function createBox(array $box): void
//    {
//        $box=new Box();
//    }
//
//    public function getBoxById(int $id): array
//    {
//        return Box::where('id','=',$id)->get();
//    }
//
//    public function getBoxs(): array
//    {
//        return Box::get();
//    }
    public function createCategorie($categorie)
    {
        try {
            $cat = new Categorie();
            $cat->libelle = $categorie['libelle'];
            $cat->description = $categorie['description'];
            $cat->save();
            return $cat->id;
        }catch(QueryException $e){
            throw new DBConnectionError("Erreur de base de donnée");
        }

    }


    public function modifPrestation($prestation){
        try{
            $presta=Prestation::findOrFail($prestation['id']);
            $presta->libelle=$prestation['libelle'];
            $presta->description=$prestation['description'];
            $presta->url=$prestation['url'];
            $presta->unite=$prestation['unite'];
            $presta->tarif=$prestation['tarif'];
            $presta->img=$prestation['img'];
            $presta->cat_id=$prestation['cat_id'];
            $presta->save();
            return($presta->id);

        }catch (MissingAttributeException $e){
            throw new EntitesNotFound("Il manque un champs");
        }catch(ModelNotFoundException $e){
            throw new EntitesNotFound("Id non valide");
        }
    }
}