<?php
declare(strict_types=1);

use gift\appli\app\actions\GetBoxCreate;
use gift\appli\app\actions\GetCategorieId;
use gift\appli\app\actions\GetCategoryCreate;
use gift\appli\app\actions\GetPrestation;
use gift\appli\app\actions\PostBoxCreate;
use gift\appli\app\actions\PostCategoryCreate;
use gift\appli\app\actions\Racine;
use gift\appli\app\actions\GetCategories;

return function (\Slim\App $app): \Slim\App {

    $app->get('[/]', Racine::class);

    $app->get('/categories[/]', GetCategories::class);

    $app->get('/categorie/{id}[/]', GetCategorieId::class);

    $app->get('/prestation[/]', GetPrestation::class);

    $app->get('/box/create[/]', GetBoxCreate::class);

    $app->post('/box/create[/]', PostBoxCreate::class);

    $app->get('/categories/create[/]', GetCategoryCreate::class);

    $app->post('/categories/create[/]', PostCategoryCreate::class);

    return $app;
};