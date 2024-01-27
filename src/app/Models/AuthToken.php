<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $token
 */
class AuthToken extends Model
{
    use HasFactory;

    protected $guarded = [];
}
