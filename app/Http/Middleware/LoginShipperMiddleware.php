<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginShipperMiddleware
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
        $shipper = Auth::guard('TaiKhoan')->check();
        if ($shipper) {
            $check = Auth::guard('TaiKhoan')->user();
            if ($check->loai_tai_khoan == 3 && $check->is_open == 1) {
                return $next($request);
            } else {
                // toastr()->error('trạng thái tài khoản bị tắt');
                return redirect("/shipper/login");

            }
        } else {
            // toastr()->error('bạn cần đăng nhập trước');
            return redirect("/shipper/login");
        }
    }
}
