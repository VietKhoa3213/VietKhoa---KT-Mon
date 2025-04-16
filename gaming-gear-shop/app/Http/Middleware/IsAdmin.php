<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class IsAdmin
{



    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->level == 1) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực này.');
    }
}
