<?php

namespace gift\appli\utils;

class CsrfToken
{
    public static function generate()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check($token)
    {
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $token) {
            unset($_SESSION['csrf_token']);
            throw new \Exception("Formulaire invalide");
        }
        unset($_SESSION['csrf_token']);
    }


}