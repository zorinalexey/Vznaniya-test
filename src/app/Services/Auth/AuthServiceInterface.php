<?php

namespace App\Services\Auth;

interface AuthServiceInterface
{
    public function check(string $token): bool;
}
