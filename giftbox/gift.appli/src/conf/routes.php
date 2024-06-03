<?php
declare(strict_types=1);

use gift\appli\app\actions\GetBoxCreate;
use gift\appli\app\actions\GetCategorieId;
use gift\appli\app\actions\GetPrestation;
use gift\appli\app\actions\PostBoxCreate;
use gift\appli\app\actions\Racine;
use gift\appli\app\actions\GetCategories;

return function (\Slim\App $app): \Slim\App {

    //ajout d'une route
    $app->get('[/]', Racine::class);

    // Route 1
    $app->get('/categories[/]', GetCategories::class);

    //Route 2
    $app->get('/categorie/{id}[/]', GetCategorieId::class);

    //Route 3
    $app->get('/prestation[/]', GetPrestation::class);

    //Route 4.1
    $app->get('/box/create[/]', GetBoxCreate::class);

    // Route 4.2
    $app->post('/box/create[/]', PostBoxCreate::class);


    return $app;

};