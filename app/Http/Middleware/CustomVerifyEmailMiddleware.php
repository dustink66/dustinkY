<?php

namespace App\Http\Middleware;

use Closure;

class CustomVerifyEmailMiddleware
{
    public function handle($request, Closure $next)
    {
        // 这里定义不需要验证时的逻辑
        // 例如，直接放行请求或者跳转到其他页面

        return $next($request);
    }
}
