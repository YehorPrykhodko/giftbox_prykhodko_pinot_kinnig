<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\User;
use gift\appli\core\services\auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostLogin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (Auth::login($email, $password)) {

            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'login_successful.twig');
        } else {
            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'login.twig', [
                'error' => 'Invalid email or password',
            ]);
        }
    }
}