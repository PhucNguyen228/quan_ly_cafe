<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminMiddleWare
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
        $admin = Auth::guard('TaiKhoan')->check();
        if ($admin) {
            $check = Auth::guard('TaiKhoan')->user();
            if ($check->loai_tai_khoan == 1 && $check->is_open == 1) {
                return $next($request);
            } else {
                // toastr()->error('trạng thái tài khoản bị tắt');
                return redirect("/admin/login");

            }
        } else {
            // toastr()->error('bạn cần đăng nhập trước');
            return redirect("/admin/login");
        }
    }
}
