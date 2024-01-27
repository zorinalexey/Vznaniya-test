<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Requests\Api\V1\Users\RestorePasswordRequest;
use App\Http\Resources\Api\V1\Auth\LoginResource;
use App\Utils\Response\FailResponse;
use App\Utils\Response\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;

final class RestorePasswordController extends AbstractUserController
{
    public function __invoke(RestorePasswordRequest $request): JsonResponse
    {
        try {
            if ($data = $this->service->restorePassword(...$request->validated())) {
                return new SuccessResponse([
                    'data' => LoginResource::make($data['user']),
                    'message' => 'Новый пароль для входа: ' . $data['password'],
                ]);
            }

            return new FailResponse(
                data: ['message' => 'email не найден'],
                status_code: 400
            );
        } catch (Exception $exception) {
            return new FailResponse(
                data: [
                    'message' => $exception->getMessage(),
                    'error_code' => $exception->getCode()
                ],
                status_code: $exception->getCode()?:500
            );
        }
    }
}
