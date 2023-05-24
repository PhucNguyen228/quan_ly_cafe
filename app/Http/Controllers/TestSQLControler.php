<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\HoaDon;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestSQLControler extends Controller
{
    public function dataBan()
    {
        // $data = SanPham::join('danh_gias','danh_gias.san_pham_id','san_phams.id')
        //                 ->select('san_phams.*')
        //                 ->get();
        // dd($data->toArray());
        // $data = SanPham::leftJoin('danh_gias', 'danh_gias.san_pham_id', 'san_phams.id')
        //     ->select(
        //         'san_phams.*',
        //         DanhGia::raw('SUM(COALESCE(muc_do = 1, 0)) AS tong_hai_long'),
        //         DanhGia::raw('SUM(COALESCE(muc_do = 2, 0)) AS tong_k_hai_long')
        //     )
        //     ->groupBy('san_phams.id');
        //     $data = $data->get();

            $data = HoaDon::
            whereRaw("DAY(ngay_hoa_don) = 20")
            ->get();
            dd($data->toArray());



    }
}
