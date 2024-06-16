<?php
declare(strict_types=1);

use gift\appli\app\actions\GetBoxCreate;
use gift\appli\app\actions\GetBoxDetails;
use gift\appli\app\actions\GetCategorieId;
use gift\appli\app\actions\GetCategoryCreate;
use gift\appli\app\actions\GetCoffretCreate;
use gift\appli\app\actions\GetLoginForm;
use gift\appli\app\actions\GetLogout;
use gift\appli\app\actions\GetPredefinedBoxDetails;
use gift\appli\app\actions\GetPredefinedBoxes;
use gift\appli\app\actions\GetPrestation;
use gift\appli\app\actions\GetRegisterForm;
use gift\appli\app\actions\GetUserBoxes;
use gift\appli\app\actions\PostBoxCreate;
use gift\appli\app\actions\PostCategoryCreate;
use gift\appli\app\actions\PostCoffretCreate;
use gift\appli\app\actions\PostLogin;
use gift\appli\app\actions\PostRegister;
use gift\appli\app\actions\Racine;
use gift\appli\app\actions\GetCategories;
use gift\appli\core\services\auth\Auth;

return function (\Slim\App $app): \Slim\App {

    $app->get('[/]', Racine::class);

    $app->get('/categories[/]', GetCategories::class);

    $app->get('/categorie/{id}[/]', GetCategorieId::class);

    $app->get('/prestation[/]', GetPrestation::class);

    $app->get('/box/create[/]', GetBoxCreate::class);

    $app->post('/box/create[/]', PostBoxCreate::class);

    $app->get('/categories/create[/]', GetCategoryCreate::class);

    $app->post('/categories/create[/]', PostCategoryCreate::class);

    $app->get('/register', GetRegisterForm::class);

    $app->post('/register', PostRegister::class);

    $app->get('/login', GetLoginForm::class);

    $app->post('/login', PostLogin::class);

    $app->get('/logout', GetLogout::class);

    $app->get('/user/boxes', GetUserBoxes::class)->add(Auth::class);

    $app->get('/box/{id}', GetBoxDetails::class);

    $app->get('/predefined_boxes', GetPredefinedBoxes::class);

    $app->get('/predefined_box/{id}', GetPredefinedBoxDetails::class);

    $app->get('/coffret/create', GetCoffretCreate::class)->add(Auth::class);

    $app->post('/coffret/create', PostCoffretCreate::class)->add(Auth::class);

    return $app;
};