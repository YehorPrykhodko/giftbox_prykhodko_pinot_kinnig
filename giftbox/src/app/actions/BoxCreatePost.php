<?php
namespace gift\appli\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BoxCreatePost {

	public function __invoke(Request $rq, Response $rs, $args):Response{
		$createBoxHtml=<<<END
		<h2> Submitted Info for box creation</h2>
		<div class="libelleBox"> {$_POST['libelleFormBox']} </div>
		<div class = "descriptionBox"> {$_POST['descriptionFormBox']} </div>
		<div class = "montantBox"> {$_POST['montantFormBox']} </div>
		END;
	$rs->getBody()->write($createBoxHtml);
		return($rs);
	}

}
