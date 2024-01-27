<?php

namespace App\Services\Users;

use App\Models\AuthToken;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

final class UserService implements UserServiceInterface
{
    public function auth(array $data): User|null
    {
        if (
            ($user = User::query()->where('email', $data['email'])->first()) &&
            Hash::check($data['password'], $user->password)
        ) {
            /** @var User $user */
            $this->setAuthToken($user);

            return $user;
        }

        return null;
    }

    private function setAuthToken(User $user): void
    {
        /** @var AuthToken $authToken */
        $authToken = $user->token;

        if (!$authToken) {
            $authToken = new AuthToken();
            $authToken->user_id = $user->id;
        }

        $authToken->token = Hash::make(time() . rand(0, 1000));
        $user->token()->save($authToken);
    }

    public function registration(array $data): User|null
    {
        if ($data['password'] === Arr::pull($data, 'repeat_password')) {
            $data['password'] = Hash::make($data['password']);

            /** @var User $user */
            $user = User::query()->create($data);
            $this->setAuthToken($user, true);

            return $user;
        }

        return null;
    }

    public function restorePassword(string $email): array|null
    {
        /** @var User $user */
        if ($user = User::query()->where('email', $email)->first()) {
            $password = fake()->password;

            $user->password = Hash::make($password);
            $this->setAuthToken($user);
            $user->save();

            return compact('user', 'password');
        }

        return null;
    }

    public function delete(int $id): bool
    {
        if (($user = $this->view($id)) && $user->delete()) {
            Cache::delete($this->getKey($id));

            return true;
        }

        throw new RuntimeException('Error when deleting a record from the database');
    }

    public function view(int $id): User|null
    {
        $key = $this->getKey($id);
        $user = Cache::remember($key, now()->addMinutes(20), static function () use ($id): User|null {
            return User::query()->find($id);
        });

        if (!$user) {
            throw new RuntimeException('Page not found', 404);
        }

        return $user;
    }

    public function update(array $data, int $id): User|null
    {
        if($user = $this->view($id)){
            $user->update($data);
            Cache::put($this->getKey($id), $user, now()->addMinutes(20));

            return $user;
        }

        throw new RuntimeException('Error updating database record');
    }

    private function getKey(int $id): string
    {
        return (new User())->getTable() . ':id:' . $id;
    }
}
