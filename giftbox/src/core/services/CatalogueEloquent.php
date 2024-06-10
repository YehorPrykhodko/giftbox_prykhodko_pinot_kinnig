<?php

namespace gift\appli\core\services;

use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\Prestation;
use gift\appli\core\services\ExceptionServices\DBException;
use gift\appli\core\domain\entities\Box;
use http\Message;
use Illuminate\Database\Eloquent\InvalidCastException;

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
    public function createCategorie($categorie): void
    {
        $cat=new Categorie();
        $cat->libelle=$categorie['libelle'];
        $cat->description=$categorie['description'];
        $cat->save();

    }


    public function updatePrestation($modifPrestation): void{
        $presta=Prestation::where('id','=',$modifPrestation->id)->update($modifPrestation);
    }
    public function getCategories(): array
    {
        try {
            $cat = Categorie::get();
            return CatalogueEloquent::modelToArray($cat);
        } catch (\Exception $e) {
            $this->throwDBException($e);
        }

    }

    public static function modelToArray($obj): array{
        $retour=[];
        foreach($obj as $o){
            $retour[]=$o;
        }
        return($retour);
    }

    public function getCategorieById(int $id): array
    {
        try {
            $cat = Categorie::where("id", "=", $id)->get();
            return CatalogueEloquent::modelToArray($cat);
        } catch (\Exception $e) {
            $this->throwDBException($e);
        }
    }

    public function getPrestations():array{
        try{
            $presta=Prestation::get();
            return CatalogueEloquent::modelToArray($presta);
        }catch (\Exception $exception){
            $this->throwDBException($exception);
        }
    }

    public function getPrestationById(string $id): array
    {
        try {
            $presta = Prestation::where("id", "=", $id)->get();
            return CatalogueEloquent::modelToArray($presta);
        } catch (\Exception $e) {
            $this->throwDBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function getPrestationsbyCategorie(int $categ_id): array
    {
        try {
//            $presta = Prestation::whereHas('categorie', function ($q) use ($categ_id) {
//                $q->where("id", "=", $categ_id);
//            });
            $presta = Categorie::where("id", "=", $categ_id)->with('prestations')->get();
            return CatalogueEloquent::modelToArray($presta);
        } catch (\Exception $exception) {
            $this->throwDBException($exception);
        }
    }

    /**
     * @throws DBException
     */
    private function throwDBException($exception)
    {
        throw new DBException($exception->getMessage());
    }

    public function createBox(array $box): void
    {
        $box=new Box();
    }

    public function getBoxById(int $id): array
    {
        return Box::where('id','=',$id)->get();
    }

    public function getBoxs(): array
    {
        return Box::get();
    }
}