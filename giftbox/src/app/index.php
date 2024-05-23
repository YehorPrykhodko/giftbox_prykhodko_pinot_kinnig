<?php
declare(strict_types=1);
// phpinfo();
// echo "test";
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
//fichier de config db sql
$db->addConnection(parse_ini_file(__DIR__ . '/../conf/gift.db.conf.ini.dist'));
//Ne pas oublier de créer le fichier/changer les paramètres de configurations à l'interieur du fichier
$db->setAsGlobal(); 
$db->bootEloquent();

use \Slim\Factory\AppFactory;

try{
	$app = AppFactory::create();
	$app->addRoutingMiddleware();
	$app=(require_once __DIR__ . '/../conf/routes.php')($app);
	$app->run();
}catch(Error $e){
	// var_dump($e);
	echo $e;
}
