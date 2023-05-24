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
        // dd($request);
        $cart = $request->session()->get('cart');
        // dd($cart);
        if ($cart && isset($cart['expires_at']) && time() > $cart['expires_at']) {
            // Delete the cart if it has expired
            $request->session()->forget('cart');
            // dd('abs');
        }

        return $next($request);
    }
}
