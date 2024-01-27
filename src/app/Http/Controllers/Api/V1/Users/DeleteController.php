<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Utils\Response\FailResponse;
use App\Utils\Response\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;

final class DeleteController extends AbstractUserController
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            if ($user = $this->service->delete($id)) {
                return new SuccessResponse([
                    'message' => 'Ok',
                ]);
            }
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
