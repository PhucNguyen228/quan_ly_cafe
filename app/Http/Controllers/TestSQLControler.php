<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class TestSQLControler extends Controller
{
    public function dataBan(){
        $data = SanPham::join('danh_muc_san_phams','danh_muc_san_phams.id','san_phams.id_danh_muc')
                        ->join('tai_khoans','danh_muc_san_phams.id_tai_khoan','tai_khoans.id')
                        ->select('san_phams.*','tai_khoans.ho_va_ten')
                        ->get();
        dd($data);
    }
}
