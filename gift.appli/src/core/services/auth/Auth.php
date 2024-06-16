<?php

namespace gift\appli\core\services\auth;

use gift\appli\core\domain\entities\User;
use Psr\Http\Message\ResponseInterface ;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class Auth implements AuthInterface
{
    public static function login(string $email, string $password): bool
    {
        $user = User::where('user_id', '=', $email)->first();
        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = [
                'id' => $user->id,
                'email' => $user->user_id,
            ];
            return true;
        }
        return false;
    }
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {

        if (!isset($_SESSION['user'])) {
            $twig = Twig::fromRequest($request);

            return $twig->render(new Response(), "LogInNeeded.twig");
        }

        return $handler->handle($request);
    }
}