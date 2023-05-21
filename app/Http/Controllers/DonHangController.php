<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoaDonRequest;
use App\Models\Ban;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietHoaDonOline;
use App\Models\HoaDon;
use App\Models\SanPham;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DonHangController extends Controller
{

    //ONLINE
    public function CreatestoreOnline(HoaDonRequest $request)
    {
        $agent = Auth::guard('TaiKhoan')->user();
        if ($agent) {

            $giohang = ChiTietHoaDonOline::where('is_cart', 1)
                ->where('agent_id', $agent->id)
                ->get();

            if (count($giohang) > 0) {
                $hoadon = HoaDon::create([
                    'ma_hoa_don'   => Str::uuid(),
                    'tong_tien'     => 0,
                    'tien_giam_gia' => 0,
                    'thuc_tra'      => 0,
                    'agent_id'      => $agent->id,
                    'loai_thanh_toan'   => 1,
                    'tinh_trang_don_hang' => 1,
                    'loai_hoa_don'      => 1,
                    'ngay_hoa_don'      => date('Y-m-d'),
                    'hoan_thanh'        => 1,
                ]);
                $thuc_tra = 0;
                $tong_tien = 0;
                foreach ($giohang as $key => $value) {
                    $sanPham = SanPham::find($value->san_pham_id);
                    if ($sanPham) {
                        $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                        $thuc_tra += $value->so_luong * $giaBan;
                        $tong_tien += $value->so_luong * $sanPham->gia_ban;


                        $value->don_gia  = $giaBan;
                        $value->is_cart  = 0;
                        $value->hoa_don_id  = $hoadon->id;

                        $value->ho_va_ten = $request->ho_va_ten;
                        $value->so_dien_thoai = $request->so_dien_thoai;
                        $value->dia_chi = $request->dia_chi;

                        $value->save();
                    } else {
                        $value->delete();
                    }
                }

                $hoadon->thuc_tra = $thuc_tra;
                $hoadon->tong_tien = $tong_tien;
                $hoadon->tien_giam_gia = $tong_tien - $thuc_tra;
                $hoadon->save();

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => 2]);
            }
        }
    }

    //OFLINE
    public function createHoaDon(Request $request)
    {
        $giohang = $request->session()->get('cart');
        // dd($giohang);
        // dd($idban);
        $id = $request->id_ban;
        $customer = Auth::guard('TaiKhoan')->user();
        $ban = Ban::find($id);
        if ($giohang) {
            $now = now();
            foreach ($giohang as $value) {
                $san_pham_id = $value['id'];
                $ten_san_pham = $value['ten_san_pham'];
                $don_gia = $value['don_gia'];
                $so_luong = $value['so_luong'];

                $chiTiet = new ChiTietHoaDon();
                $chiTiet->san_pham_id = $san_pham_id;
                $chiTiet->ten_san_pham = $ten_san_pham;
                $chiTiet->don_gia = $don_gia;
                $chiTiet->so_luong = $so_luong;
                $chiTiet->id_ban = $ban->id;
                $chiTiet->id_customer = $customer->id;
                $chiTiet->created_at = $now;
                $chiTiet->updated_at = $now;
                $chiTiet->save();
            }

            $thuc_tra = 0;
            $tong_tien = 0;
            $hoadon = HoaDon::create([
                'ma_hoa_don' => Str::uuid(),
                'tong_tien' => 0,
                'tien_giam_gia' => 0,
                'thuc_tra' => 0,
                'agent_id' => $customer->id,
                'id_ban' => $ban->id,
                'loai_thanh_toan' => 1,
                'tinh_trang_don_hang' => 1,
                'loai_hoa_don' => 2,
                'ngay_hoa_don' => date('Y-m-d'),
                'hoan_thanh'   => 1,
            ]);
            foreach ($giohang as $key => $value) {
                $giaBan = $value['don_gia'];
                $thuc_tra +=  $value['so_luong'] * $giaBan;
                $tong_tien +=   $value['so_luong'] *  $value['gia_ban'];
                // $chiTiet->hoa_don_id  = $hoadon->id;

            }
            $hoadon->tong_tien = $tong_tien;
            $hoadon->thuc_tra = $thuc_tra;
            // dd($hoadon->thuc_tra);
            $hoadon->tien_giam_gia = $tong_tien - $thuc_tra;
            $hoadon->save();
            $chiTietHoaDon = ChiTietHoaDon::where('id_customer', $customer->id)
                              ->where('id_ban', $ban->id)
                              ->get();
            foreach ($chiTietHoaDon as $cthd) {
                $cthd->hoa_don_id = $hoadon->id;
                $cthd->save();
            }

            if($ban) {
                $ban->is_open_oder = 0;
                $ban->save();
            }

            $request->session()->forget('cart');
            return response()->json(['status' => true]);
        } else {
            // Giỏ hàng rỗng
            toastr()->error('Giỏ hàng rỗng');
            return redirect('/');
        }
    }

}
