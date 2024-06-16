<?php
require_once(__DIR__ . "/../../vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
//fichier de config db sql
$db->addConnection(parse_ini_file(__DIR__ . '/../../conf/gift.db.conf.ini'));
//Ne pas oublier de créer le fichier/changer les paramètres de configurations à l'interieur du fichier
$db->setAsGlobal(); 
$db->bootEloquent();

use gift\appli\core\domain\entities\Box;
use gift\appli\core\domain\entities\Prestation;
use gift\appli\core\domain\entities\Categorie;

echo "Exercice 2 ";
echo "Question 1:\n";
//lister les prestations ; pour chaque prestation, afficher le libellé, la description, le tarif et l'unité

$prestations=Prestation::select("libelle","description","tarif","unite")->get();
foreach($prestations as $p){
	echo $p->libelle .", ". $p->description . ", ". $p->tarif . ", ". $p->unite."\n";
}

echo "Question 2:\n";
//idem, mais en affichant de plus la catégorie de la prestation. On utilisera un chargement lié (eager loading).
$prestaCat=Prestation::with("categorie")->get();
foreach($prestaCat as $presta){
	echo $presta->libelle .", ". $presta->description . ", ". $presta->tarif . ", ". $presta->unite.", ". $presta->categorie->libelle . "\n";
}

echo "Question 3:\n";
//3. afficher la catégorie 3 (libellé) et la liste des prestations (libellé, tarif, unité) de cette catégorie.
$cat3=Categorie::select("libelle","id")->where("id","=","3")->with("prestations")->get();
// var_dump($cat3);
foreach($cat3 as $cat){
	foreach($cat->prestations as $presta){
		echo "$cat->libelle, $presta->libelle, $presta->tarif, $presta->unite\n";
	}
}

echo "Question 4:\n";
//afficher la box d'ID 360bb4cc-e092-3f00-9eae-774053730cb2 : libellé, description, montant.
$box4=Box::select("libelle","id","description","montant")->where("id","=","360bb4cc-e092-3f00-9eae-774053730cb2")->get();
foreach($box4 as $b){
	echo "$b->libelle, $b->description, $b->montant\n";
}

echo "Question 5:\n";
//idem, en affichant en plus les prestations prévues dans la box (libellé, tarif, unité, quantité).


$box4=Box::select("libelle","id","description","montant")->where("id","=","360bb4cc-e092-3f00-9eae-774053730cb2")->with("prestations")->get();

foreach($box4 as $b){
	echo "$b->libelle, $b->description, $b->montant\n";
	foreach($b->prestations as $p){
		echo "\t$p->libelle, $p->tarif, $p->unite, {$p->pivot->quantite}\n";
	}
}

echo "Question 6:\n";
//Créer une box et lui ajouter 3 prestations. L’identifiant de la box est un UUID. Consulter la documentation Eloquent pour la génération de cet identifiant.

//on attribu les champs de la nouvelle box
$nbox = new Box();
$nbox->libelle="samousa";
$nbox->description="description du samousa";
$nbox->montant=45;
$nbox->message_kdo="message du samousa";
$nbox->token="toksamousa";
$nbox->kdo=2;
$nbox->statut=4;
$nbox->createur_id="aaaa";

// on sauvegarde, on à mis `use HasUuids` dans la classe Box pour la clé primaire 
$nbox->save();

//on selectionne 3 prestations à ajouter en relation avec la nouvelle box
$prestations=Prestation::take(3)->get();

//on sauvegarde chaque prestation a la nouvelle box avec les valeurs du pivot
foreach($prestations as $p){
$nbox->prestations()->save($p,['quantite'=>3]);
}

//on récupère les box avec un libelle samousa et les prestations associées
$boxcree=Box::where("libelle","like","samousa")->with("prestations")->get();

//on les affiche
foreach($boxcree as $b){
	foreach($b->prestations as $p){
		echo "$b->libelle, $b->id, $p->libelle, {$p->pivot->quantite}\n";
		$b->delete(); //on supprime l'entrée de la base pour que les entrées ne s'empiles pas
	}
}

$presta=Prestation::whereHas('categories', function($q){
$q->where('id','=',3);
});
foreach($presta as $p){
echo $presta->id.'\n';
}


