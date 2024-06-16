<?php

namespace gift\appli\app\actions;

use gift\appli\core\services\auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostLogin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $data = $rq->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (Auth::login($email, $password)) {

            $twig = Twig::fromRequest($rq);
            return $twig->render($rs, 'login_successful.twig');
        } else {
            $twig = Twig::fromRequest($rq);
            return $twig->render($rs, 'login.twig', [
                'error' => 'Invalid email or password',
            ])->withStatus(401);
        }
    }
}