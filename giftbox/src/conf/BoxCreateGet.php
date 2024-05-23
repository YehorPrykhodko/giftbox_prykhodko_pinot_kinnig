<?php
namespace gift\appli\conf; 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BoxCreateGet {

public function	__invoke(Request $rq, Response $rs, $args):Response{

// | libelle     | varchar(128)  | NO   |     | NULL                |       |
// | description | text          | YES  |     | NULL                |       |
// | montant     | decimal(12,2) | YES  |     | 0.00                |       |
// | kdo         | tinyint(4)    | NO   |     | 0                   |       |
// | message_kdo | text          | YES  |     | ''                  |       |
// | statut      | int(11)       | NO   |     | 1                   |       |
// | created_at  | datetime      | YES  |     | 0000-00-00 00:00:00 |       |
// | updated_at  | datetime      | YES  |     | NULL                |       |
// | createur_id | varchar(128)  | YES  |     | NULL                |       |

	$createBoxHtml="";
		$createBoxHtml=<<<END
		<form class="createBox" method="post">
		<label for ="libelleFormBox">Libelle Box:</label>
		<input type="text" id="libelleFormBox" name="libelleFormBox" required>
		<label for="descriptionFormBox">Description Box: </label>
		<input type="text" id="descriptionFormBox" name = "descriptionFormBox" required>
		<label for = "montantFormBox">Montnat Box: </label>
		<input type="number" id="montantFormBox" name= "montantFormBox" min="0" required>
		<label for="kdoFormBox">Cadeau Box: </label>
		<input type="number" id="kdoFormBox" name = "kdoFormBox" required min="0" step="1">
		<input type="submit" value="Submit">
			</form>
		END;

$rs->getBody()->write($createBoxHtml);
	return($rs);
}

}
