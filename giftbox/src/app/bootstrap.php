<?php
declare(strict_types=1);
// phpinfo();
// echo "test";
require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\utils\Eloquent;
//
// try{
//
// gift\appli\utils\Eloquent::init(__DIR__.'/../conf/gift.db.conf.ini.dist');
// echo "pppp";
//
// }catch(Error $e){
// var_dump($e);
// echo "kljkljklj";
// }



use gift\appli\utils\TestUtils;
try{
	// $test = new TestUtils();
	// $test->hello();
// var_dump(__DIR__.'/../conf/gift.db.conf.ini.dist');
Eloquent::init(__DIR__.'/../conf/gift.db.conf.ini.dist');


// gift\appli\utils\Eloquent::init(__DIR__.'/../conf/gift.db.conf.ini.dist');

}catch(Error $e){
// echo ($e);
	echo("error");
	var_dump($e);
}

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
