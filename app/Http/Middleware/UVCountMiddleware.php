<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use App\Models\Statistic;

class UVCountMiddleware
{
    public function handle($request, Closure $next)
    {
        if (is_file(base_path('install.lock'))) {
            // 判断是否已经设置了 Cookie
            $hasCookie = Cookie::has('uv_cookie');

            // 如果未设置 Cookie，表示是独立访客，进行统计
            if (!$hasCookie) {
                // 更新总的 UV 统计数据
                Statistic::firstOrCreate([])->increment('total_uv');

                // 设置 Cookie，有效期为一天
                Cookie::queue('uv_cookie', 'visited', 1440);
            }

            return $next($request);
        } else {
            return redirect()->route('install.index');
        }
    }
}
