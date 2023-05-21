<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        // $sanPham = SanPham::all();
        // $danhMuc = DanhMucSanPham::where('yeu_cau', 1)->get();
        $google = Socialite::driver('google')->user();
        // dd($google);

        // Check if there is an existing user with this email
        $authUser = TaiKhoan::where('email', $google->email)->first();

        if ($authUser) {
            Auth::guard('TaiKhoan')->login($authUser);
            Toastr()->success('đăng nhập thành công');

        } else {
            // Create a new user
            $user = new TaiKhoan();
            $user->ho_va_ten = $google->name;
            $user->email = $google->email;
            $user->password = bcrypt($user->name);
            $user->so_dien_thoai = '';
            $user->dia_chi ='';
            $user->is_email = 1;
            $user->is_open = 1;
            $user->loai_tai_khoan = 4;
            $user->hash = Str::uuid();
            $user->save();


            Auth::guard('TaiKhoan')->login($user);
        }
        return redirect('/cafe/homepage');
    }
}
