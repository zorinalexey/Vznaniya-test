<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\UserServiceInterface;

abstract class AbstractUserController extends Controller
{
    public function __construct(
        protected readonly UserServiceInterface $service
    )
    {

    }
}
