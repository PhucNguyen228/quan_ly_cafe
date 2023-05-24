<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanUserController extends Controller
{
    public function index()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            return view('staff.ban.index');
        } else {
            toastr()->error('Bạn cần đăng nhập');
            return view('staff.login');
        }
    }
    public function getData()
    {

        $data = Ban::where('is_open', 1)->get();
        return response()->json([
            'dulieu' => $data,
        ]);
    }
    public function ban($id)
    {
        $ban = Ban::find($id);
        if ($ban) {
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
    // public function doiTrangThai($id)
    // {
    //     $ban = Ban::find($id);
    //     if($ban) {
    //         $data = Ban::join('hoa_dons','hoa_dons.id_ban','bans.id')->where('hoa_dons.id_ban',$id)->where('tinh_trang_ban',1)->select('bans.*','hoa_dons.*')->get();
    //         // dd($data);
    //         if ($data) {
    //             foreach ($data as $key => $value) {
    //                 // $value->save();
    //                 $value->tinh_trang_ban = 2;
    //                 $value->save();
    //             }
    //             // dd($value);
    //             // dd($dem);
    //         }
    //         $ban->is_open_oder = !$ban->is_open_oder;
    //         $ban->save();
    //         return response()->json([
    //             'trangThai'         =>  true,
    //             'tinhTrangBan'      =>  $ban->is_open_oder,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'trangThai'         =>  false,
    //         ]);
    //     }
    // }
    public function doiTrangThai($id)
    {
        $ban = Ban::find($id);
        if ($ban) {
            $data = HoaDon::join('bans', 'hoa_dons.id_ban', 'bans.id')
            ->where('hoa_dons.id_ban', $id)->where('tinh_trang_ban', 1)
            ->select('bans.*', 'hoa_dons.*')->get();
            if ($data) {
                foreach ($data as $value) {
                    $value->tinh_trang_ban = 2;
                    $value->save();
                }
                $ban->is_open_oder = !$ban->is_open_oder;
                $ban->save();
                return response()->json([
                    'trangThai'         =>  true,
                    'tinhTrangBan'      =>  $ban->is_open_oder,
                ]);
            }else{
                $ban->is_open_oder = !$ban->is_open_oder;
                $ban->save();
                return response()->json([
                    'trangThai'         =>  true,
                    'tinhTrangBan'      =>  $ban->is_open_oder,
                ]);
            }
        } else {
            return response()->json([
                'trangThai'         =>  false,
            ]);
        }
    }
}
