<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string token
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string $middlename
 * @property string $birth_date
 * @property string $city
 * @property string $email
 * @property string $password
 * @method static HasOne|null token()
 */
final class User extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function token(): HasOne
    {
        return $this->hasOne(AuthToken::class, 'user_id', 'id');
    }
}
