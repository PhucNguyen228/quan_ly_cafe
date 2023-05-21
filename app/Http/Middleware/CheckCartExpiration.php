<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CheckCartExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $cart = $request->session()->get('cart');

        if ($cart && isset($cart['expires_at']) && time() > $cart['expires_at']) {
            // Delete the cart if it has expired
            $request->session()->forget('cart');
        }

        return $next($request);
    }
}
