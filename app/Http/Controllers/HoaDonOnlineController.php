<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\ChiTietHoaDonOline;
use App\Models\HoaDon;
use Illuminate\Http\Request;

class HoaDonOnlineController extends Controller
{
    public function index()
    {
        return view('admin.pages.hoa_don_online.index');
    }
    public function data()
    {
        $data = HoaDon::where('tinh_trang_don_hang', 1)->where('loai_hoa_don', 1)->get();
        return response()->json([
            'dataOnline'  => $data,
        ]);
    }

    public function dataHoaDon($id)
    {
        $data = HoaDon::join('chi_tiet_hoa_don_olines', 'chi_tiet_hoa_don_olines.hoa_don_id', 'hoa_dons.id')
            ->join('tai_khoans', 'tai_khoans.id', 'chi_tiet_hoa_don_olines.agent_id')
            ->where('tinh_trang_don_hang', 1)
            ->where('hoa_dons.id', $id)
            // ->orderBy('hoa_dons.id', 'desc')
            ->select('hoa_dons.*', 'chi_tiet_hoa_don_olines.ho_va_ten', 'chi_tiet_hoa_don_olines.so_dien_thoai', 'chi_tiet_hoa_don_olines.dia_chi', 'chi_tiet_hoa_don_olines.ten_san_pham', 'chi_tiet_hoa_don_olines.don_gia', 'chi_tiet_hoa_don_olines.so_luong')
            ->get();
        return response()->json([
            'dataHoaDon' => $data,
        ]);
    }
    public function HoaDon($id)
    {
        $hoadon = HoaDon::find($id);
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
    public function inBill($id)
    {
        $data = HoaDon::find($id);
        if ($data) {
            // foreach ($data as $value) {
            //     $tmp  = HoaDon::find($value->id);
            $data->tinh_trang_don_hang = 2;
            $data->save();
            // // dd($tmp);
            // }
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
    // tình trạng đơn hàng
    public function indexTinhTrang()
    {
        return view('admin.pages.tinh_trang_don_hang.index');
    }
    // public function chi_tiet_hoa_don_olines()
    // {
    //     return $this->hasMany(ChiTietHoaDonOline::class, 'hoa_don_id', 'id');
    // }
    public function tinhTrangDonHang()
    {
        $hoadons = HoaDon::where('tinh_trang_don_hang','<>' ,1)->where('loai_hoa_don',1)->orderBy('hoa_dons.id','desc')
        ->get();
        return response()->json([
            'dataTinhTrang' => $hoadons,
        ]);
    }

    public function DataChiTietDonHang($id){
        $data = HoaDon::join('chi_tiet_hoa_don_olines','chi_tiet_hoa_don_olines.hoa_don_id','hoa_dons.id')
                        ->where('hoa_dons.id',$id)
                        ->where('hoa_dons.tinh_trang_don_hang','<>',1)
                        ->where('hoa_dons.loai_hoa_don',1)
                        ->select('hoa_dons.*','chi_tiet_hoa_don_olines.*')
                        // ->orderBy('hoa_dons.id', 'desc')
                        ->get();
        // dd($data);
        return response()->json([
            'data' => $data,
        ]);
    }
    public function chiTietDonHang($id)
    {
        $hoadon = HoaDon::find($id);
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
