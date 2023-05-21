<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    public function HaiLong($id)
    {
        $data = SanPham::find($id);
        $customer = Auth::guard('TaiKhoan')->user();

        if ($data) {
            $danhgia = DanhGia::where('san_pham_id', $id)->where('id_customer',$customer->id)->first();
            if ($danhgia) {
                $danhgia->muc_do = 1;
                $danhgia->save();
                return response()->json([
                    'status' => true,
                ]);
            } else {
                DanhGia::create([
                    'san_pham_id' => $data->id,
                    'muc_do' => 1,
                    'id_customer'   => $customer->id,
                ]);
                return response()->json([
                    'status'    => true,
                ]);
            }
        }
    }
    public function KhongHaiLong($id)
    {
        $data = SanPham::find($id);
        $customer = Auth::guard('TaiKhoan')->user();
        if ($data) {
            $danhgia = DanhGia::where('san_pham_id', $id)->where('id_customer',$customer->id)->first();
            if ($danhgia) {
                $danhgia->muc_do = 2;
                $danhgia->save();
                return response()->json([
                    'status' => true,
                ]);
            } else {
                DanhGia::create([
                    'san_pham_id' => $data->id,
                    'muc_do' => 2,
                    'id_customer'   => $customer->id,
                ]);
                return response()->json([
                    'status'    => true,
                ]);
            }
        }
    }
}
