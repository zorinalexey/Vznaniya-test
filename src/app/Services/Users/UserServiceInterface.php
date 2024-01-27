<?php

namespace App\Services\Users;

use App\Models\User;

interface UserServiceInterface
{
    public function auth(array $data): User|null;

    public function registration(array $data): User|null;

    public function restorePassword(string $email): array|null;

    public function view(int $id): User|null;

    public function delete(int $id): bool;
}
