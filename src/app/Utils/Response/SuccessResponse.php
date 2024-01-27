<?php

namespace App\Utils\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

final class SuccessResponse extends JsonResponse
{
    public function __construct(array $data, #[SensitiveParameter] array $headers = [], int $options = 0)
    {
        $body = [
            'data' => Arr::pull($data, 'data', []),
            'message' => Arr::pull($data, 'message'),
            'success' => true,
            'error' => false,
            'code' => 1000,
        ];

        parent::__construct($body, 200, $headers, $options);
    }
}
