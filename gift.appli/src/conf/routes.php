<?php
declare(strict_types=1);

use gift\appli\app\actions\AjouterPrestationToBox;
use gift\appli\app\actions\BoxActuelle;
use gift\appli\app\actions\BoxById;
use gift\appli\app\actions\CategorieCreatePost;
use gift\appli\app\actions\CreateCategorieGet;
use gift\appli\app\actions\GetLoginForm;
use gift\appli\app\actions\GetLogout;
use gift\appli\app\actions\GetRegisterForm;
use gift\appli\app\actions\PayerBox;
use gift\appli\app\actions\PostLogin;
use gift\appli\app\actions\PostRegister;
use gift\appli\app\actions\UpdatePrestation;
use gift\appli\app\actions\UpdatePrestationGet;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use gift\appli\app\actions\BoxCreateGet;
use gift\appli\app\actions\BoxCreatePost;
use gift\appli\app\actions\CategoriesAfficheId;
use gift\appli\app\actions\CategoriesAffiches;
use gift\appli\app\actions\PrestationsAffiche;
use gift\appli\app\actions\PrestationsAfficheId;
use gift\appli\app\actions\PrestationsDeCategorie;
use gift\appli\app\actions\Racine;
use gift\appli\app\exceptions\TeaPotException;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\Prestation;

return function (\Slim\App $app): \Slim\App {
    /* home */
    $app->get('/categorie/create[/]', CreateCategorieGet::class)->setName("createCategorie");

    $app->post('/categorie/create[/]', CategorieCreatePost::class);

    $app->post('/box/create[/]', BoxCreatePost::class)->add(\gift\appli\core\services\auth\Auth::class); //twigOk

    $app->get('/box/create[/]', BoxCreateGet::class)->setName('createBox')->add(\gift\appli\core\services\auth\Auth::class);//twigOk

    $app->get('/box/{id}[/]', BoxById::class)->setName('boxById');

    $app->get('/validerBox[/]', \gift\appli\app\actions\ValiderBox::class)->setName('validerBox')->add(\gift\appli\core\services\auth\Auth::class);

    $app->get('/payerBox[/]', PayerBox::class)->setName('payerBox')->add(\gift\appli\core\services\auth\Auth::class);

    $app->post('/supprimerPrestation[/]', \gift\appli\app\actions\SupprimmerPrestation::class)->setName('supprimerPrestation')->add(\gift\appli\core\services\auth\Auth::class);

    $app->get('[/]', Racine::class)->setName('racine');


    $app->get('/prestation/update/{id}[/]', UpdatePrestationGet::class)->setName('updatePrestation');

    $app->post('/prestation/update/{id}[/]', UpdatePrestation::class);

    $app->get('/prestationsDeCategorie/{id}[/]', PrestationsDeCategorie::class)->setName('presta2cat');

    $app->get('/prestations[/]', PrestationsAffiche::class)->setName('listPrestations');

    $app->get('/prestations/{id}[/]', PrestationsAfficheId::class)->setName('prestationId');
    $app->post('/prestations/{id}[/]', AjouterPrestationToBox::class);

    $app->get('/boxActuel[/]', BoxActuelle::class)->setName('boxActuelle');

    $app->get('/categories[/]', CategoriesAffiches::class)->setName('listCategories');

    $app->get('/categories/{id:\d+}[/]', CategoriesAfficheId::class)->setName('categorieId');

    $app->get('/utiliserBox/{token}[/]', \gift\appli\app\actions\PageUniqueBox::class)->setName('utiliserBox')->add(\gift\appli\core\services\auth\Auth::class);
    $app->post('/utiliserBox/{token}[/]', \gift\appli\app\actions\UtiliserBox::class)->add(\gift\appli\core\services\auth\Auth::class);


    $app->get('/register', GetRegisterForm::class)->setName('register');

    $app->post('/register', PostRegister::class);

    $app->get('/login', GetLoginForm::class)->setName('login');

    $app->post('/login', PostLogin::class);

    $app->get('/logout', GetLogout::class)->setName('logout');


    return $app;

};
