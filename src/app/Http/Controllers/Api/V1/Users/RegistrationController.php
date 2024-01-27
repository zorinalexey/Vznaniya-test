<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Requests\Api\V1\Users\RegistrationRequest;
use App\Http\Resources\Api\V1\Auth\LoginResource;
use App\Utils\Response\FailResponse;
use App\Utils\Response\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;

final class RegistrationController extends AbstractUserController
{
    public function __invoke(RegistrationRequest $request): JsonResponse
    {
        try {
            if ($user = $this->service->registration($request->validated())) {
                return new SuccessResponse([
                    'data' => LoginResource::make($user),
                ]);
            }

            return new FailResponse(
                data: ['message' => 'Пароли не совпадают'],
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
