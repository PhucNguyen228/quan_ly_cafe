<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Http\Requests\UpdateThongTinRequest;
use App\Models\ChiTietHoaDonOline;
use App\Models\Customer;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomePageOlineController extends Controller
{
    public function index(){
        $sql = "SELECT *, (`gia_ban` - `gia_khuyen_mai`) / `gia_ban` * 100 AS `TYLE` FROM `san_phams` WHERE `is_open` = 1 ORDER BY TYLE DESC";
         $allSanPham = DB::select($sql);
         return view('home_page_online.page.index', compact('allSanPham'));
    }
    public function addToCart(AddCartRequest $request)
    {
        $customer = Auth::guard('TaiKhoan')->user();
        if ($customer) {
            $sanPham = SanPham::find($request->san_pham_id);
            // $ban = Ban::all();
            $chiTietDonHang = ChiTietHoaDonOline::where('san_pham_id', $request->san_pham_id)
                ->where('is_cart', 1)
                ->where('agent_id', $customer->id)
                ->first();

            if ($chiTietDonHang) {
                if($chiTietDonHang->so_luong  < 50){
                    $chiTietDonHang->so_luong += $request->so_luong;
                    $chiTietDonHang->save();
                    return response()->json(['status' => 2]);
                }else{
                    return response()->json(['status' => 3]);
                }
            } else {
                ChiTietHoaDonOline::create([
                    'san_pham_id'       => $sanPham->id,
                    'ten_san_pham'      => $sanPham->ten_san_pham,
                    'don_gia'           => $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban,
                    'so_luong'          => $request->so_luong,
                    'is_cart'           => 1,
                    'agent_id'          => $customer->id,
                ]);
                return response()->json(['status' => 2]);
            }
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function indexSell(){

        return view('customer.san_pham_sell.index');
    }
    public function sellData(){
        $allSanPham = SanPham::where('gia_khuyen_mai','>',0)->get();
        return response()->json([
        'data'  => $allSanPham,
        ]);
    }

    public function indexThongTin(){
        $check = Auth::guard('TaiKhoan')->user();
        if($check){
            $dataTK = TaiKhoan::where('id', $check->id)
                    ->select('tai_khoans.ho_va_ten','tai_khoans.email','tai_khoans.so_dien_thoai','tai_khoans.id')
                    ->first();
        return view('customer.thong_tin_ca_nhan.index',compact('dataTK'));
        }
    }
    public function updateThongTin(UpdateThongTinRequest $request){
        $data     = $request->all();
        $tai_khoan = TaiKhoan::find($request->id);
        $tai_khoan->update($data);
        toastr()->success('Đã cập nhật danh mục thành công!');
        return redirect('/cafe/customer/thong-tin');
   }

   public function indexLienHeCuaHang(){
    return view('customer.lien_he_cua_hang.index');
   }
}
