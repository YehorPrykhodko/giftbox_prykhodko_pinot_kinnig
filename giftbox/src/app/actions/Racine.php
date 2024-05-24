<?php
namespace gift\appli\app\actions;
use Error;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;
use gift\appli\utils\TestUtils;
class Racine {

public function __invoke(Request $rq, Response $rs, $args):Response{
	try{
	$test = new TestUtils();
	// $test->hello();
	}catch(Error $e){
	echo($e);
	}
$acceuil=<<<END
	<h1> Giftbox accueil</h1>
		<a href="/categories"> Catégories </a>
END;
	  $rs->getBody()->write($acceuil);
	return($rs);
}

}
