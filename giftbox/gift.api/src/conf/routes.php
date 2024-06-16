<?php
declare(strict_types=1);

use gift\api\app\actions\GetCategories;
use gift\api\app\actions\GetCoffret;
use gift\api\app\actions\GetPrestations;
use gift\api\app\actions\GetPrestationsByCategory;

use gift\api\app\actions\Racine;

return function (\Slim\App $app): \Slim\App {

    $app->get('[/]', Racine::class);

    $app->get('/api/prestations',  GetPrestations::class);
    $app->get('/api/categories', GetCategories::class);
    $app->get('/api/categories/{id}/prestations', GetPrestationsByCategory::class);
    $app->get('/api/coffrets/{id}',  GetCoffret::class);

    return $app;
};