<?php

use gift\appli\models\Box;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;
use gift\appli\models\User;

//Q1 lister les prestations ; pour chaque prestation, afficher le libellé, la description, le
//tarif et l'unité.

echo "Q1 <br>";

$prestation = Prestation::all();

foreach ($prestation as $presta) {
    echo $presta->libelle . " |DESCRIPTION|: " . $presta->description ." |TARIF|: " . $presta->tarif . " |UNITE|: " . $presta->unite . "<br>";
}

//Q2 idem, mais en affichant de plus la catégorie de la prestation. On utilisera un
//chargement lié (eager loading).

echo "Q2 <br>";

$prestation = Prestation::with('categorie')->get();

foreach ($prestation as $presta) {
    echo $presta->libelle . " |DESCRIPTION|: " . $presta->description ." |TARIF|: " .  $presta->tarif . " |UNITE|: " . $presta->unite . " |CATEGORIE|: " . $presta->categorie->libelle . "<br>";
}


//Q3 afficher la catégorie 3 (libellé) et la liste des prestations (libellé, tarif, unité) de cette
//catégorie.

echo "Q3 <br>";

$categorie = Categorie::with('prestation')->find(3);
echo $categorie->libelle . "<br>";
foreach ($categorie->prestation as $presta) {
    echo $presta->libelle . " |TARIF|: " . $presta->tarif . " |UNITE|: " . $presta->unite . "<br>";
}

//Q4 afficher la box d'ID 360bb4cc-e092-3f00-9eae-774053730cb2 : libellé, description,
//montant.

echo "Q4 <br>";

$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
echo $box->libelle . " |DESCRIPTION|: " . $box->description . " |MONTANT|: " . $box->montant . "<br>";

//Q5 idem, en affichant en plus les prestations prévues dans la box (libellé, tarif, unité,
//quantité).

echo "Q5 <br>";

$box = Box::with('prestations')->find('360bb4cc-e092-3f00-9eae-774053730cb2');
echo $box->libelle . " |DESCRIPTION|: " . $box->description . " |MONTANT|: " . $box->montant . "<br>";
foreach ($box->prestations as $presta) {
    echo $presta->libelle . " |TARIF|: " . $presta->tarif . " |UNITE|: " . $presta->unite . " |QUANTITE|: " . $presta->pivot->quantite . "<br>";
}

//Q6 Créer une box et lui ajouter 3 prestations. L’identifiant de la box est un UUID.
//Consulter la documentation Eloquent pour la génération de cet identifiant.

echo "Q6 <br>";

$box = new Box();
$box->libelle = 'New box';
$box->description = 'Description';
$box->montant = 150;
$box->save();

$prestationIds = [
    '4cca8b8e-0244-499b-8247-d217a4bc542d',
    '14872d96-97d6-4a9f-8a28-463886fea622',
    '63cdce06-cd63-4fbe-9695-885d3cb64c7b'
];

foreach ($prestationIds as $prestationId) {
    $box->prestations()->attach($prestationId, ['quantite' => 1]);
}

echo "Box creer: " . $box->libelle . " | ID: " . $box->id . "<br>";
foreach ($box->prestations as $presta) {
    echo $presta->libelle . " | TARIF: " . $presta->tarif . " | UNITE: " . $presta->unite . " | QUANTITE: " . $presta->pivot->quantite . "<br>";
}