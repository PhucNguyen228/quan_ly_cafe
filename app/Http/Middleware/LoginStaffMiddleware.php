<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginStaffMiddleware
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
            if ($check->loai_tai_khoan == 2 && $check->is_open == 1) {
                return $next($request);
            } else {
                // toastr()->error('trạng thái tài khoản bị tắt');
                return redirect("/staff/login");

            }
        } else {
            // toastr()->error('bạn cần đăng nhập trước');
            return redirect("/staff/login");
        }
    }
}
