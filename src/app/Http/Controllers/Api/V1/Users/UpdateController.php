<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Requests\Api\V1\Users\UpdateRequest;
use App\Http\Resources\Api\V1\Users\UserResource;
use App\Utils\Response\FailResponse;
use App\Utils\Response\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;

final class UpdateController extends AbstractUserController
{
    public function __invoke(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            if ($user = $this->service->update($request->validated(), $id)) {
                return new SuccessResponse([
                    'data' => UserResource::make($user),
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
