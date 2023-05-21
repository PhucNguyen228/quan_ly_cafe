<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoaDonCustomerController extends Controller
{
    public function donHang()
    {
        return view('customer.don_hang.index');
    }
    public function donHangData()
    {
        $customer = Auth::guard('TaiKhoan')->check();
        if ($customer) {
            $dataCustomer = Auth::guard('TaiKhoan')->user();
            $hoadons = HoaDon::where('tinh_trang_don_hang', '<>', 1)->where('loai_hoa_don', 1)->where('agent_id', $dataCustomer->id)->orderBy('hoa_dons.id', 'desc')
                ->get();
            // dd($hoadons);
            return response()->json([
                'dataTinhTrang' => $hoadons,
            ]);
        }
    }
    public function chiTiet($id)
    {
        $customer = Auth::guard('TaiKhoan')->user();
        if ($customer) {
            $hoadon = HoaDon::where('agent_id', $customer->id)->find($id);
            // dd($ban);
            if ($hoadon) {
                return response()->json([
                    'status'  =>  true,
                    'data'    =>  $hoadon,
                ]);
            } else {
                return response()->json([
                    'status'  =>  false,
                ]);
            }
        }
    }
    public function chiTietData($id)
    {
        $customer = Auth::guard('TaiKhoan')->user();
        if ($customer) {
            $data = HoaDon::join('chi_tiet_hoa_don_olines', 'chi_tiet_hoa_don_olines.hoa_don_id', 'hoa_dons.id')
                ->where('hoa_dons.agent_id',$customer->id)
                ->where('hoa_dons.id', $id)
                ->where('hoa_dons.tinh_trang_don_hang', '<>', 1)
                ->where('hoa_dons.loai_hoa_don', 1)
                ->select('hoa_dons.*', 'chi_tiet_hoa_don_olines.*')
                // ->orderBy('hoa_dons.id', 'desc')
                ->get();
            // dd($data);
            return response()->json([
                'data' => $data,
            ]);
        }
    }
}
