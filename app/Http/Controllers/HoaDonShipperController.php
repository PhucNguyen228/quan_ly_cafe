<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class HoaDonShipperController extends Controller
{
    public function index()
    {
        return view('shipper.pages.index');
    }

    public function dataShipper()
    {
        $hoadons = HoaDon::where('tinh_trang_don_hang', '=', 2)->where('loai_hoa_don', 1)->orderBy('hoa_dons.id', 'desc')
            ->get();
        return response()->json([
            'dataTinhTrang' => $hoadons,
        ]);
    }
    public function chiTiet($id)
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
    public function dataChiTiet($id)
    {
        $data = HoaDon::join('chi_tiet_hoa_don_olines', 'chi_tiet_hoa_don_olines.hoa_don_id', 'hoa_dons.id')
            ->where('hoa_dons.id', $id)
            ->where('hoa_dons.tinh_trang_don_hang', '=', 2)
            ->where('hoa_dons.loai_hoa_don', 1)
            ->select('hoa_dons.*', 'chi_tiet_hoa_don_olines.*')
            ->get();
        return response()->json([
            'data' => $data,
        ]);
    }
    public function nhanHang($id)
    {
        $shipper = Auth::guard('TaiKhoan')->user();
        if ($shipper) {
            $data = HoaDon::find($id);
            if ($data) {
                $data->tinh_trang_don_hang = 3;
                $data->shipper_id = $shipper->id;
                $data->save();
                return response()->json([
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }
    }

    public function DonHang(){
        return view('shipper.pages.don_hang_da_nhan.index');
    }

    public function DataDonHang(){
        $shipper =Auth::guard('TaiKhoan')->user();
        if($shipper){
            $hoadons = HoaDon::where('tinh_trang_don_hang', 3)->where('loai_hoa_don', 1)->where('shipper_id',$shipper->id)
            ->get();
            return response()->json([
                'data' => $hoadons,
            ]);
        }
    }
    public function daGiao($id)
    {
        $shipper = Auth::guard('TaiKhoan')->user();
        if ($shipper) {
            $data = HoaDon::find($id);
            if ($data) {
                $data->tinh_trang_don_hang = 4;
                $data->shipper_id = $shipper->id;
                $data->hoan_thanh = 2;
                $data->save();
                return response()->json([
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }
    }
    public function chiTietDonGiao($id){
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

    public function DataChiTietDonGiao($id){
        $data = HoaDon::join('chi_tiet_hoa_don_olines', 'chi_tiet_hoa_don_olines.hoa_don_id', 'hoa_dons.id')
            ->where('hoa_dons.id', $id)
            ->where('hoa_dons.tinh_trang_don_hang', '=', 3)
            ->where('hoa_dons.loai_hoa_don', 1)
            ->select('hoa_dons.*', 'chi_tiet_hoa_don_olines.*')
            ->get();
        return response()->json([
            'data' => $data,
        ]);
    }

}
