<?php

namespace App\Http\Resources\Api\V1\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var User $this */
        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'middlename' => $this->middlename,
            'birth_date' => $this->birth_date,
            'city' => $this->city,
            'email' => $this->email,
        ];
    }
}
