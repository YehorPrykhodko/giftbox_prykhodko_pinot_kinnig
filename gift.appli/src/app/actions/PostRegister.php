<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\entities\User;
use gift\appli\core\services\auth\Auth;
use gift\appli\core\services\exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostRegister extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $data = $rq->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        try {
            if (User::where('user_id', $email)->exists()) {
                throw new ValidationException("Email déjà utilisé");
            }

            $user = new User();
            $user->user_id = $email;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->role = 1;
            $user->save();

            Auth::login($email, $password);

            $twig = Twig::fromRequest($rq);
            return $twig->render($rs, 'registerOK.twig');
        } catch (ValidationException $e) {
            $twig = Twig::fromRequest($rq);
            return $twig->render($rs, 'register.twig', [
                'error' => $e->getMessage(),
            ])->withStatus(400);
        }
    }
}