<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanUserController extends Controller
{
    public function index(){
         $agent = Auth::guard('TaiKhoan')->user();
         if($agent){
            return view('staff.ban.index');
         }else{
            toastr()->error('Bạn cần đăng nhập');
             return view('staff.login');
         }

    }
    public function getData()
    {

        $data = Ban::where('is_open',1)->get();
        return response()->json([
            'dulieu' => $data,
        ]);
    }
    public function ban($id)
    {
        $ban = Ban::find($id);
        if($ban) {
            return response()->json([
                'status'  =>  true,
                // 'data'    =>  $ban,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }
    public function doiTrangThai($id)
    {
        $ban = Ban::find($id);
        if($ban) {
            $ban->is_open_oder = !$ban->is_open_oder;
            $ban->save();
            return response()->json([
                'trangThai'         =>  true,
                'tinhTrangBan'      =>  $ban->is_open_oder,
            ]);
        } else {
            return response()->json([
                'trangThai'         =>  false,
            ]);
        }
    }
}
