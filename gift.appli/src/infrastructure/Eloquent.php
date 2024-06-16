<?php

namespace gift\appli\infrastructure;

use Illuminate\Database\Capsule\Manager as DB;

class Eloquent
{

    public static function init(string $pathConfFile): void
    {
        $db = new DB();
        //fichier de config db sql
        $db->addConnection(parse_ini_file($pathConfFile));
        //Ne pas oublier de créer le fichier/changer les paramètres de configurations à l'interieur du fichier
        $db->setAsGlobal();
        $db->bootEloquent();

    }
}
