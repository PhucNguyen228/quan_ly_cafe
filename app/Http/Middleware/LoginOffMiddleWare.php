<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginOffMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $customer = Auth::guard('TaiKhoan')->check();
        if ($customer) {
            $check = Auth::guard('TaiKhoan')->user();
            if ($check->is_open == 1) {
                return $next($request);
            } else {
                // toastr()->error('trạng thái tài khoản bị tắt');
                return redirect("/customer-off/login");

            }
        } else {
            // toastr()->error('bạn cần đăng nhập trước');
            return redirect("/customer-off/login");
        }
    }
}
