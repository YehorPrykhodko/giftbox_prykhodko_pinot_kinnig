<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/vendor/autoload.php';
use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

Eloquent::init(__DIR__ . '/../src/conf/gift.db.conf.ini');

$app = (require_once __DIR__ . '/../src/conf/routes.php')($app);

$routeParser = $app->getRouteCollector()->getRouteParser();

$app->run();