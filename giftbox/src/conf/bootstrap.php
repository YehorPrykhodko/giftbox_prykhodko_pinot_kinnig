<?php
declare(strict_types=1);

use gift\appli\utils\Eloquent;
use \Slim\Factory\AppFactory;


Eloquent::init(__DIR__.'/../conf/gift.db.conf.ini.dist');


try{
	$app = AppFactory::create();
	$app->addRoutingMiddleware();
	$app->addErrorMiddleware(true, false, false);
	$app=(require_once __DIR__ . '/../conf/routes.php')($app);
	return($app);
}catch(Error $e){
	// var_dump($e);
	echo $e;
}
