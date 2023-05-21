<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDonOline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class ChiTietHoaDonOlineController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('TaiKhoan')->user();
        if ($customer) {
            return view('customer.cart.index',compact('customer'));
        }
    }

    public function dataCart()
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {
            $data = ChiTietHoaDonOline::join('san_phams', 'chi_tiet_hoa_don_olines.san_pham_id', 'san_phams.id')
                ->where('agent_id', $agent->id)
                ->where('is_cart', 1)
                ->select('chi_tiet_hoa_don_olines.*', 'san_phams.anh_dai_dien', 'san_phams.gia_ban')
                ->get();
            // dd($data->toArray());
            return response()->json(['data' => $data]);
        }
    }

    public function updateqty(Request $request)
    {
        $mon = ChiTietHoaDonOline::where('id', $request->id)->where('is_cart', 1)->whereNull('hoa_don_id')->first();
        if ($mon) {
            $mon->so_luong = $request->so_luong;
            if ($mon->so_luong > 0 && $mon->so_luong <= 50 ) {
                $mon->save();
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function removeCart($id)
    {
        $agent = Auth::guard('TaiKhoan')->user();
        $chiTietDonHang = ChiTietHoaDonOline::where('is_cart', 1)
            ->where('agent_id', $agent->id)
            ->where('id', $id)
            ->whereNull("hoa_don_id")
            ->first();
        if ($chiTietDonHang) {
            $chiTietDonHang->delete();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
