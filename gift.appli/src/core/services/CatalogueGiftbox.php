<?php

namespace gift\appli\core\services;

use Exception;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\DBConnectionError;
use gift\appli\core\domain\entities\Prestation;
use gift\appli\core\domain\entities\Box;
use gift\appli\core\domain\entities\User;
use http\Message;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\Eloquent\MissingAttributeException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CatalogueGiftbox
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

    public function getPrestations($sort = ''): array
    {

        try {
            $presta = Prestation::with('categorie');
            switch ($sort) {
                case '':
                    break;
                case 'price-asc':
                    $presta = $presta->orderBy('tarif');
                    break;
                case 'price-desc':
                    $presta = $presta->orderByDesc('tarif');
                    break;
                default:
                    break;
            }
            $presta = $presta->get();
            return $presta->toArray();
        } catch (QueryException $exception) {
            throw new DBConnectionError("Database connection error");

        }
    }

    public function getPrestationById(string $id): array
    {
        try {
            $presta = Prestation::with('categorie')->findOrFail($id);
            return $presta->toArray();
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Prestation $id not found");
        }
    }

    public function getPrestationsbyCategorie(int $categ_id, $sort = ''): array
    {
        try {
            $presta = Prestation::whereHas('categorie', function ($query) use ($categ_id) {
                $query->where('id', '=', $categ_id);
            })->with('categorie');
            switch ($sort) {
                case '':
                    break;
                case 'price-asc':
                    $presta = $presta->orderBy('tarif');
                    break;
                case 'price-desc':
                    $presta = $presta->orderByDesc('tarif');
                    break;
                default:
                    break;
            }
            $presta = $presta->get();
            $presta = $presta->toArray();
            if (empty($presta)) {
                throw new EntitesNotFound("Categorie vide");
            }

            return $presta;
        } catch (ModelNotFoundException $exception) {
            throw new EntitesNotFound("Categorie $categ_id not found");
        }
    }

    public function createBox(array $boxChamps, $userId): mixed
    {
        $box = new Box();
        $box->libelle = $boxChamps['libelle'];
        $box->description = $boxChamps['description'];
        $box->montant = $boxChamps['montant'];
        $box->kdo = $boxChamps['kdo'];
        $box->message_kdo = $boxChamps['message_kdo'];
        $box->statut = $boxChamps['statut'];
        $box->token = $boxChamps['token'];


        $box->createur_id=$userId;
        $box->save();

        return $box->id;

    }
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
        } catch (QueryException $e) {
            throw new DBConnectionError("Erreur de base de donnée");
        }

    }


    public function modifPrestation($prestation)
    {
        try {
            $presta = Prestation::findOrFail($prestation['id']);
            $presta->libelle = $prestation['libelle'];
            $presta->description = $prestation['description'];
            $presta->url = $prestation['url'];
            $presta->unite = $prestation['unite'];
            $presta->tarif = $prestation['tarif'];
            $presta->img = $prestation['img'];
            $presta->cat_id = $prestation['cat_id'];
            $presta->save();
            return ($presta->id);

        } catch (MissingAttributeException $e) {
            throw new EntitesNotFound("Il manque un champs");
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Id non valide");
        }
    }

    public function getBoxById(mixed $id)
    {
        try {
            $box = Box::with('prestations')->findOrFail($id);

            return $box->toArray();
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box {$id} non trouvé");
        }
    }

    public function ajouterPrestationToBox(mixed $prestaId, mixed $boxId, int $quantite = 1)
    {
        try {
            $presta = Prestation::findOrFail($prestaId);
            $presta->boxs()->attach($boxId, ['quantite' => $quantite]);
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Prestation introuvable");
        }
    }

    public function getBoxState(mixed $boxId)
    {
        try {
            $box = Box::findOrFail($boxId);
            return ($box->statut);
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box introuvable");
        }
    }

    public function validerBox(mixed $idBox,$userId)
    {
        try {
            $box = Box::with('prestations')->with('user')->findOrFail($idBox);
            $cat = [];
            foreach ($box->prestations as $b) {
                $cat[$b->cat_id] = 1;
            }
            if (count($cat) < 2) {
                throw new EntitesNotFound('Moins de deux prestations dans la box');
            }
            $userBox=$box->user->id;
            if($userBox!=$userId){
                throw new EntitesNotFound("Mauvais user, validation impossible");
            }
            $box->statut = Box::VALIDATED;
            $box->save();

        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box $idBox non trouvé");
        }
    }

    public function payerBox(mixed $boxId)
    {
        try {
            $box = Box::findOrFail($boxId);
            if ($box->statut != Box::VALIDATED) {
                throw new EntitesNotFound("Box non validé");
            }
            $box->statut = Box::PAYED;
            $box->save();
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box $boxId non trouvé");
        }
    }

    public function supprimerPrestationDeBox(mixed $id_presta, mixed $boxId)
    {
        try {
            $box = Box::with('prestations')->findOrFail($boxId);
            if ($box->statut != Box::CREATED) {
                throw new EntitesNotFound("Box dans le mauvaise etat");
            }
            $box->prestations()->detach($id_presta);
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box non trouvé");
        }

    }

    public function getBoxByToken(mixed $token)
    {
        try {
            $box = Box::where('token', '=', $token)->with('prestations')->first();

            return $box->toArray();
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box non trouvé");
        }
    }

    public function utiliserBox(mixed $boxId)
    {
        try {
            $box = Box::findOrFail($boxId);
            $box->statut = Box::USED;
            $box->save();
        } catch (ModelNotFoundException $e) {
            throw new EntitesNotFound("Box non trouvé");
        }
    }

    public function userBoxs(mixed $user_mail)
    {
        try {
            $boxs = Box::whereHas('user', function ($query) use ($user_mail) {
                $query->where('user_id','=',$user_mail);
            })->get();
            return $boxs;
        } catch (ModelNotFoundException $exception) {

        }

    }
}