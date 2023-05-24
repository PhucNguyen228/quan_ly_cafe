<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use Illuminate\Http\Request;

class HoaDonOfflineController extends Controller
{
    public function index()
    {
        return view('customer_off.hoa_don.index');
    }

    public function dataHoaDon()
    {
        $data = HoaDon::join('bans', 'bans.id', 'hoa_dons.id_ban')
            ->where('loai_hoa_don', 2)
            ->select('hoa_dons.*','bans.ma_ban')
            ->get();
        return response()->json([
            'dataHoaDon' => $data,
        ]);
    }

    public function destroy($id){
        $hoadon = HoaDon::find($id);
        // dd($hoadon);
        if($hoadon){
            $hoadon->delete();
            $chitietdonhang = ChiTietHoaDon::where('hoa_don_id', $id)->get();
            foreach($chitietdonhang as $item) {
                $item->delete();
            }
            return response()->json([
                'status'  =>  true,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }
}
