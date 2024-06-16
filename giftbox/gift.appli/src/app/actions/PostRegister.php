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

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();
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

            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'registerOK.twig');
        } catch (ValidationException $e) {
            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'register.twig', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}