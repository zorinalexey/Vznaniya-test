<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\Api\V1\Auth\LoginResource;
use App\Utils\Response\FailResponse;
use App\Utils\Response\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;

final class LoginController extends AbstractUserController
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            if ($user = $this->service->auth($request->validated())) {
                return new SuccessResponse([
                    'data' => LoginResource::make($user),
                ]);
            }

            return new FailResponse(
                data: ['message' => 'Не верный email или пароль'],
                status_code: 401
            );
        } catch (Exception $exception) {
            return new FailResponse(
                data: [
                    'data' => $exception->getTrace(),
                    'message' => $exception->getMessage(),
                    'error_code' => $exception->getCode()
                ],
                status_code: $exception->getCode()?:500
            );
        }
    }
}
