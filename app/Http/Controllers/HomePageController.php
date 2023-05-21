<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    public function index(){
          $sql = "SELECT *, (`gia_ban` - `gia_khuyen_mai`) / `gia_ban` * 100 AS `TYLE` FROM `san_phams` WHERE `is_open` = 1
          ORDER BY TYLE DESC";

         $allSanPham = DB::select($sql);
        return view('home_page_off.page.index',compact('allSanPham'));
    }

    public function data(){
        $data = SanPham::all();
        return response()->json([
            'data'     => $data,
        ]);
    }

    public function search(Request $request){
        $data = SanPham::where('ten_san_pham', 'like', '%' . $request->tenSanPham .'%')
        ->get();

        return response()->json(['status' => $data]);
    }

    public function searchSell(Request $request){
        $data = SanPham::where('ten_san_pham', 'like', '%' . $request->tenSanPham .'%')
                        ->where('gia_khuyen_mai', '>' , 0)
                        ->get();

        return response()->json(['status' => $data]);
    }
    public function sanPhamIndex(){
        return view('customer_off.san_pham_danh_muc.index');
    }
    public function sanPham(Request $request){
        $data = sanPham::join('danh_muc_san_phams','san_phams.id_danh_muc','danh_muc_san_phams.id')
                        ->where('danh_muc_san_phams.id', $request->id)
                        ->select('san_phams.*')
                        ->get();
        return response()->json([
            'data'  => $data,
        ]);
    }
    public function sanPhamSellIndex(){
        return view('customer_off.san_pham_sell.index');
    }
    public function sanPhamSell(){
        $data = sanPham::where('gia_khuyen_mai','>',0)->get();
        return response()->json([
            'dataSell'  => $data,
        ]);
    }
}
