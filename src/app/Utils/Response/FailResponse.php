<?php

namespace App\Utils\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

final class FailResponse extends JsonResponse
{
    public function __construct(array $data = [], int $status_code = 200, #[SensitiveParameter] array $headers = [], int $options = 0)
    {
        $body = [
            'data' => Arr::pull($data, 'data', []),
            'message' => Arr::pull($data, 'message'),
            'success' => false,
            'error' => true,
            'code' => Arr::pull($data, 'error_code', 500),
        ];

        parent::__construct($body, $status_code, $headers, $options);
    }
}
