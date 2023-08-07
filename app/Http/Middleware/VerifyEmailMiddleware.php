<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\CustomVerifyEmailMiddleware;

class VerifyEmailMiddleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        // 检查环境变量 VERIFIED_ENABLED 的值
        $verifiedEnabled = env('EMAIL_VERIFIED_ENABLED', false);

        // 根据环境变量值来选择中间件
        $middleware = $verifiedEnabled ? EnsureEmailIsVerified::class : CustomVerifyEmailMiddleware::class;

        // 执行选择的中间件
        return app($middleware)->handle($request, $next, ...$guards);
    }
}
