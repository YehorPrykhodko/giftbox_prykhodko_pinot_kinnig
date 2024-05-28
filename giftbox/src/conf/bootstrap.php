<?php
declare(strict_types=1);

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use gift\appli\utils\Eloquent;
use \Slim\Factory\AppFactory;


Eloquent::init(__DIR__.'/../conf/gift.db.conf.ini.dist');



// try{
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app=(require_once __DIR__ . '/../conf/routes.php')($app);

$twig=Twig::create(__DIR__.'/../templates',
	['cache'=>__DIR__.'/../cache',
		'auto_reload'=> true]);

$app->add(TwigMiddleware::create($app,$twig));


return($app);

// }catch(Error $e){
// var_dump($e);
// echo $e;
// }
