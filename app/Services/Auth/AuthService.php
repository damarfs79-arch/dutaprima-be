<?php

namespace App\Services\Auth;

class AuthService
{
    public function attemptLogin(string $username, string $password): bool
    {
        $adminUsername = env('ADMIN_USER', 'admin@gmail.com');
        $adminPassword = env('ADMIN_PASS', 'yakkadek26');

        if ($username !== $adminUsername || $password !== $adminPassword) {
            return false;
        }

        return true;
    }
}
