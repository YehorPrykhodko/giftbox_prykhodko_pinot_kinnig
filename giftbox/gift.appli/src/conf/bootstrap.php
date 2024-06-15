<?php
use gift\appli\infrastructure\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

Eloquent::init(__DIR__.'/gift.db.conf.ini');


$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app=(require_once __DIR__ . '/routes.php')($app);

$twig=Twig::create(__DIR__.'/../app/views/',
    [/*'cache'=>__DIR__.'/../cache',*/
        'auto_reload'=> true]);

$app->add(TwigMiddleware::create($app,$twig));

session_start();

return $app;