<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthServiceInterface;
use App\Utils\Response\FailResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class AuthTokenUser
{

    public function __construct(
        private readonly AuthServiceInterface $service
    )
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->service->check(request('token'))) {
            return $next($request);
        }

        return new FailResponse(
            data: ['message' => 'Токен не найден'],
            status_code: 401
        );
    }
}
