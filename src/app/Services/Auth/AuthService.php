<?php

namespace App\Services\Auth;

use App\Models\AuthToken;
use Illuminate\Support\Facades\Cache;

final class AuthService implements AuthServiceInterface
{
    public function check(string $token): bool
    {
        return Cache::remember((new AuthToken())->getTable() . ':token:' . $token, now()->addMinutes(20),
            static function () use ($token) {
                return (bool)AuthToken::query()->where('token', $token)->first();
            });
    }
}
