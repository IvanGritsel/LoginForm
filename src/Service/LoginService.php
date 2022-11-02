<?php

namespace App\Service;

use App\Logger\Logger;

class LoginService
{
    public function login(string $userData): array|bool
    {
        $decoded = json_decode($userData, true);
        $usersBase = include ROOT_DIR . '/../resources/users_base.php';
        $login = $usersBase[$decoded['login']];
        if (password_verify($decoded['password'], $login['password'])) {
            return [
                'login' => $decoded['login'],
                'name' => $login['name'],
            ];
        } else {
            return false;
        }
    }
}
