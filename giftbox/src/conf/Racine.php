<?php
namespace gift\appli\conf; 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Racine {

public function __invoke(Request $rq, Response $rs, $args):Response{
$acceuil=<<<END
	<h1> Giftbox acceuil</h1>
		<a href="/categories"> Catégories </a>
END;
	  $rs->getBody()->write($acceuil);
	return($rs);
}

}
