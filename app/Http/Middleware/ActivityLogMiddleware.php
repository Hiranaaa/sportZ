<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\ActivityLogService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogMiddleware
{
    public function __construct(
        private readonly ActivityLogService $activityLogService,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->user() && $request->route()) {
            $routeName = $request->route()->getName() ?? $request->route()->uri();

            $this->activityLogService->log(
                action: $request->method() . ' ' . $routeName,
                modelType: null,
                modelId: null,
                oldValues: null,
                newValues: [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'route' => $routeName,
                ],
            );
        }

        return $response;
    }
}
