<?php

namespace gift\appli\app\actions;

use gift\appli\utils\CsrfToken;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class BoxCreateGet
{

    public function __invoke(Request $rq, Response $rs, $args): Response
    {

// | libelle     | varchar(128)  | NO   |     | NULL                |       |
// | description | text          | YES  |     | NULL                |       |
// | montant     | decimal(12,2) | YES  |     | 0.00                |       |
// | kdo         | tinyint(4)    | NO   |     | 0                   |       |
// | message_kdo | text          | YES  |     | ''                  |       |
// | statut      | int(11)       | NO   |     | 1                   |       |
// | created_at  | datetime      | YES  |     | 0000-00-00 00:00:00 |       |
// | updated_at  | datetime      | YES  |     | NULL                |       |
// | createur_id | varchar(128)  | YES  |     | NULL                |       |

        $token = CsrfToken::generate();
        $view = Twig::fromRequest($rq);
        return ($view->render($rs, "createBoxGet.twig",['token'=>$token]));
    }

}
