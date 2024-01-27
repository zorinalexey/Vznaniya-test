<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Resources\Api\V1\Users\UserResource;
use App\Utils\Response\FailResponse;
use App\Utils\Response\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;

final class ViewController extends AbstractUserController
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            if ($user = $this->service->view($id)) {
                return new SuccessResponse([
                    'data' => UserResource::make($user),
                ]);
            }

            return new FailResponse(
                data: ['message' => 'Page not found'],
                status_code: 404
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
