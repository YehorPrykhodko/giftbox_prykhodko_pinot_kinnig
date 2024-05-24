<?php
namespace gift\appli\app\actions;
use Error;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;

class CategoriesAffiches {

public function __invoke(Request $rq, Response $rs, $args):Response{
        try{
    $cat=Categorie::select("id","libelle")->get();
    $htmlCat="";
    foreach($cat as $c){
        $htmlCat.=<<<END
                <a href="/categories/$c->id"><p class="categorie"> 
                    <span class="libelleCat" style="font-weight:bold">
                    {$c->libelle}
                </span>
                $c->id
                </p>
                </a>
        END;
        }
    $rs->getBody()->write(<<<END
        <h1>Bonjour catégories</h1>
        <div class="listeCategories">
        $htmlCat
        </div>
        END);
        }catch(Error $e){
            var_dump($e);
        }
    return $rs;
}

}
