<?php

namespace gift\appli\app\utils;

class CsrfService {
    public static function generate() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check($token) {
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $token) {
            unset($_SESSION['csrf_token']);
            throw new \Exception("Invalid CSRF token");
        }
        unset($_SESSION['csrf_token']);
    }
}
