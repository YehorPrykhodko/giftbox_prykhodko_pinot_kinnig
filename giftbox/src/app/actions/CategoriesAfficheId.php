<?php
namespace gift\appli\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;

class CategoriesAfficheId {

public function __invoke(Request $rq, Response $rs, $args):Response{
        $cat=Categorie::where("id","=",$args['id'])->get();
        $catDetails=<<<END
            <h2> Détail de catégorie</h2>
        END;
              foreach($cat as $c){
$catDetails.=<<<END
                <div class="detailsCategorie">
                <h3 class="libelleCatTitre">
                $c->libelle
                </h3>
                <p class="idCat">
                Id : $c->id
                </p>
                <p class="descriptionCat">
                Description : $c->description
                </p>
                </div>
END;
}
        $rs->getBody()->write($catDetails);

                        return($rs);
}

}
