<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session; 

class EnsureCartIsNotEmpty
{
    public function handle(Request $request, Closure $next): Response
    {
        $cart = Session::get('cart', []);

        if (!is_array($cart) || empty($cart)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        return $next($request);
    }
}