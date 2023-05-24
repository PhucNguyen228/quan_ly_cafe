<?php

namespace App\Http\Controllers;

use App\Models\agent;
use App\Models\Ban;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietHoaDonOline;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HoaDonController extends Controller
{
    public function index()
    {
        return view('admin.pages.hoa_don.index');
    }
    public function data()
    {
        $data = HoaDon::where('tinh_trang_don_hang', 1)->where('loai_hoa_don', 2)->get();
        return response()->json([
            'dataOffline'  => $data,
        ]);
    }
    public function dataHoaDon($id)
    {
        $data = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', 'hoa_dons.id')
            ->join('tai_khoans', 'tai_khoans.id', 'chi_tiet_hoa_dons.id_customer')
            ->where('tinh_trang_don_hang', 1)
            ->where('hoa_dons.id', $id)
            // ->orderBy('hoa_dons.id', 'desc')
            ->select('hoa_dons.*', 'tai_khoans.ho_va_ten', 'tai_khoans.so_dien_thoai', 'chi_tiet_hoa_dons.ten_san_pham', 'chi_tiet_hoa_dons.don_gia', 'chi_tiet_hoa_dons.so_luong')
            ->get();
        return response()->json([
            'dataHoaDon' => $data,
        ]);
    }
    public function HoaDonOffline($id)
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
            $data->hoan_thanh = 2;
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
    //    public function index(){
    //         $check = Auth::guard('TaiKhoan')->user();
    //         if($check){
    //             return view('admin.pages.hoa_don.index');
    //         }else{
    //             toastr()->error('Bạn cần phải đăng nhập');
    //             return view('admin.login');
    //         }
    //     }
    //     public function banData()
    //     {
    //         $data = Ban::all();
    //         return response()->json([
    //             'dulieu' => $data,
    //         ]);
    //     }
    //     public function getData($id)
    //     {


    //         $data = HoaDon::join('chi_tiet_hoa_dons','chi_tiet_hoa_dons.hoa_don_id', 'hoa_dons.id')
    //                         ->join('bans' , 'bans.id' , 'hoa_dons.id_ban')
    //                         ->join('agents','agents.id','hoa_dons.agent_id')
    //                         //  ->join('san_phams', 'chi_tiet_hoa_dons.san_pham_id', 'san_phams.id')
    //                         ->where('tinh_trang_don_hang', 1)
    //                         ->where('bans.id', $id)
    //                         ->select('hoa_dons.*','chi_tiet_hoa_dons.*','bans.ma_ban','agents.ho_va_ten')
    //                         ->get();

    //         return response()->json([
    //             'dulieu' => $data,
    //         ]);


    //     }
    //     public function ban($id){
    //         $ban = Ban::find($id);
    //         // dd($ban);
    //         if($ban) {
    //             return response()->json([
    //                 'status'  =>  true,
    //                 'data'    =>  $ban,
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status'  =>  false,
    //             ]);
    //         }
    //     }

    //    public function store($id){
    //     $admin = Auth::guard('TaiKhoan')->user();
    //     if($admin){
    //         // $ban = Ban::find($id);
    //         $data = HoaDon::where('id_ban',$id)
    //                         ->where('tinh_trang_don_hang',1)
    //                         ->get();
    //         // if($ban){
    //             if(count($data)>0){
    //                 foreach ($data as $value) {
    //                     $tmp  = HoaDon::find($value->id);
    //                     $tmp->tinh_trang_don_hang = 2;
    //                     $tmp->save();
    //                     // dd($tmp);
    //                 }
    //                 return response()->json([
    //                     'status'=>true,
    //                 ]);
    //             }else{
    //                 return response()->json([
    //                     'status'=>false,
    //                 ]);
    //             }
    //         // }else{
    //         //     toastr()->error('id bàn không đúng');
    //         // }
    //     }else{
    //         toastr()->error('bạn cần phải đăng nhập');
    //     }
    //    }






    /// PHẦN HÓA ĐƠN THEO NGÀY


    //Hóa đơn từng ngày của quán Cafe Online
    public function page()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            return view('admin.pages.quan_ly_hoa_don_online.index');
        } else {
            toastr()->error('Bạn cần đăng nhập');
            return view('admin.login');
        }
    }
    public function tongHD(Request $request)
    {

        $hoadon = HoaDon::join('tai_khoans', 'tai_khoans.id', 'hoa_dons.agent_id')
            ->where('hoa_dons.hoan_thanh', 2)
            ->where('hoa_dons.loai_hoa_don', 1)
            ->whereDate('ngay_hoa_don', $request->ngay_hoa_don)
            ->select('hoa_dons.*', 'tai_khoans.ho_va_ten')
            ->orderBy('hoa_dons.id', 'desc')
            ->get();

        // dd($hoadon);
        return response()->json([
            'ngay_hoa_don' => $hoadon,
        ]);
    }
    public function HoaDon($id)
    {
        // $HoaDon = HoaDon::find($id);
        // dd($HoaDon);
        // if($HoaDon) {
        $data = HoaDon::join('chi_tiet_hoa_don_olines', 'chi_tiet_hoa_don_olines.hoa_don_id', 'hoa_dons.id')
            ->where('chi_tiet_hoa_don_olines.hoa_don_id', $id)
            ->where('hoa_dons.id', $id)
            ->select('hoa_dons.*', 'chi_tiet_hoa_don_olines.id as id_chi_tiet', 'chi_tiet_hoa_don_olines.*')
            ->get();
        return response()->json([
            // 'status'  =>  true,
            'dataNe'    =>  $data,
        ]);
        // } else {
        //     return response()->json([
        //         'status'  =>  false,
        //     ]);
        // }
    }
    public function search(Request $request)
    {
        $data = TaiKhoan::join('hoa_dons', 'hoa_dons.agent_id', 'tai_khoans.id')
            ->where('hoa_dons.loai_hoa_don',1)
            ->where('ho_va_ten', 'like', '%' . $request->tenNhanVien . '%')
            ->whereDate('hoa_dons.ngay_hoa_don', $request->ngay_hoa_don)
            ->select('tai_khoans.ho_va_ten','hoa_dons.ngay_hoa_don', 'hoa_dons.id')
            ->orderBy('hoa_dons.id', 'desc')
            ->get();
        // dd($data);
        return response()->json(['dataProduct' => $data]);
    }
    public function updateqty(Request $request)
    {
        // $request = $request->all();
        // $request->id, $request->so_luong, $request->don_gia
        $khoHang = ChiTietHoaDonOline::where('id', $request->id)->first();
        // $sanPham = SanPham::where('id', $request->id)->first();
        $total = 0;
        $thuc_tra = 0;
        if ($khoHang) {
            // $sanPham = SanPham::find($khoHang->san_pham_id);
            // if($sanPham)
            // {
            $khoHang->so_luong = $request->so_luong;
            // }
            if ($khoHang->so_luong > 0) {
                $khoHang->save();
                $hoaDon = HoaDon::find($khoHang->hoa_don_id);
                if ($hoaDon) {
                    $chiTiet = ChiTietHoaDonOline::join('san_phams', 'chi_tiet_hoa_don_olines.san_pham_id', 'san_phams.id')->where('hoa_don_id', $khoHang->hoa_don_id)->where('is_cart', 0)->select('san_phams.gia_ban', 'chi_tiet_hoa_don_olines.*')->get();
                    foreach ($chiTiet as $value) {
                        $sanPham = SanPham::find($value->san_pham_id);
                        if ($sanPham) {
                            $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                            $total += $value->gia_ban * $value->so_luong;
                            // dd($giaBan);
                            $thuc_tra += $value->so_luong * $giaBan;
                        }
                    }
                    // $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                    $hoaDon->tong_tien = $total;
                    $hoaDon->thuc_tra = $thuc_tra;
                    $hoaDon->tien_giam_gia = $hoaDon->tong_tien - $hoaDon->thuc_tra;
                    $hoaDon->save();
                    // $hoaDon->thuc_tra = $khoHang->so_luong * $khoHang->don_gia;
                    // $hoaDon->save();
                }

                return response()->json([
                    'status' => true,
                    'kho_hang' => $khoHang
                ]);
            } else {
                return response()->json(['status' => false]);
            }
            ///
            // }

        } else {
            return response()->json(['status' => false]);
        }
    }
    public function ngayHoaDon($id)
    {
        $HoaDon = HoaDon::find($id);
        if ($HoaDon) {
            return response()->json([
                'status'  =>  true,
                // 'data'    =>  $HoaDon,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }
    public function destroy($id)
    {
        $ChiTiethoaDon = ChiTietHoaDonOline::find($id);
        $total = 0;
        $thuc_tra = 0;
        if ($ChiTiethoaDon) {
            $ChiTiethoaDon->delete();
            // $ChiTiethoaDon->save();
            $hoaDon = HoaDon::find($ChiTiethoaDon->hoa_don_id);
            if ($hoaDon) {
                $chiTiet = ChiTietHoaDonOline::join('san_phams', 'chi_tiet_hoa_don_olines.san_pham_id', 'san_phams.id')
                    ->where('hoa_don_id', $ChiTiethoaDon->hoa_don_id)
                    ->where('is_cart', 0)
                    ->select('san_phams.gia_ban', 'chi_tiet_hoa_don_olines.*')
                    ->get();
                foreach ($chiTiet as $value) {
                    $sanPham = SanPham::find($value->san_pham_id);
                    if ($sanPham) {
                        $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                        $total += $value->gia_ban * $value->so_luong;
                        // dd($giaBan);
                        $thuc_tra += $value->so_luong * $giaBan;
                    }
                }
                // $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                $hoaDon->tong_tien = $total;
                $hoaDon->thuc_tra = $thuc_tra;
                $hoaDon->tien_giam_gia = $hoaDon->tong_tien - $hoaDon->thuc_tra;
                $hoaDon->save();
                return response()->json([
                    'status'  =>  true,
                    'hang' => $ChiTiethoaDon,
                ]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function StoreDoanhThu($id)
    {
        $data = HoaDon::where('id',$id)
                        ->where('tinh_trang_don_hang',4)
                        ->get();
        if(count($data)>0){
            return response()->json([
                'status'    => true,
                'kho_hang'  => $data,
            ]);
        }else{
            return response()->json([
                'status'    => false,
            ]);
        }
    }

    //QUẢN LÝ HÓA ĐƠN THEO NGÀY OFFLINE
    public function pageOffline()
    {
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            return view('admin.pages.quan_ly_hoa_don_offline.index');
        } else {
            toastr()->error('Bạn cần đăng nhập');
            return view('admin.login');
        }
    }
    public function TongHDOffline(Request $request)
    {
        $hoadon = HoaDon::join('tai_khoans', 'tai_khoans.id', 'hoa_dons.agent_id')
            ->join('bans','bans.id','hoa_dons.id_ban')
            ->where('hoa_dons.hoan_thanh', 2)
            ->where('hoa_dons.loai_hoa_don', 2)
            ->whereDate('ngay_hoa_don', $request->ngay_hoa_don)
            ->select('hoa_dons.*', 'tai_khoans.ho_va_ten','bans.ma_ban')
            ->orderBy('hoa_dons.id', 'desc')
            ->get();

        // dd($hoadon);
        return response()->json([
            'ngay_hoa_don' => $hoadon,
        ]);
    }
    public function ngayHoaDonOffline($id){
        $HoaDon = HoaDon::find($id);
        if ($HoaDon) {
            return response()->json([
                'status'  =>  true,
                // 'data'    =>  $HoaDon,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }

    public function HDOffline($id)
    {
        $data = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', 'hoa_dons.id')
            ->where('chi_tiet_hoa_dons.hoa_don_id', $id)
            ->where('hoa_dons.id', $id)
            ->select('hoa_dons.*', 'chi_tiet_hoa_dons.id as id_chi_tiet', 'chi_tiet_hoa_dons.*')
            ->get();
        return response()->json([
            // 'status'  =>  true,
            'dataNe'    =>  $data,
        ]);
    }
    public function searchOffline(Request $request){
        $data = TaiKhoan::join('hoa_dons', 'hoa_dons.agent_id', 'tai_khoans.id')
            ->join('bans', 'bans.id', 'hoa_dons.id_ban')
            ->where('hoa_dons.loai_hoa_don',2)
            ->where('ho_va_ten', 'like', '%' . $request->tenNhanVien . '%')
            ->whereDate('hoa_dons.ngay_hoa_don', $request->ngay_hoa_don)
            ->select('tai_khoans.ho_va_ten', 'bans.ma_ban', 'hoa_dons.ngay_hoa_don', 'hoa_dons.id')
            ->orderBy('hoa_dons.id', 'desc')
            ->get();
        // dd($data);
        return response()->json(['dataProduct' => $data]);
    }
    public function updateqtyOffline(Request $request){
        $khoHang = ChiTietHoaDon::where('id', $request->id)->first();
        $total = 0;
        $thuc_tra = 0;
        if ($khoHang) {

            $khoHang->so_luong = $request->so_luong;
            // }
            if ($khoHang->so_luong > 0) {
                $khoHang->save();
                $hoaDon = HoaDon::find($khoHang->hoa_don_id);
                if ($hoaDon) {
                    $chiTiet = ChiTietHoaDon::join('san_phams', 'chi_tiet_hoa_dons.san_pham_id', 'san_phams.id')->where('hoa_don_id', $khoHang->hoa_don_id)->where('is_cart', 1)->select('san_phams.gia_ban', 'chi_tiet_hoa_dons.*')->get();
                    // dd($chiTiet);
                    foreach ($chiTiet as $value) {
                        $sanPham = SanPham::find($value->san_pham_id);
                        if ($sanPham) {
                            $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                            $total += $value->gia_ban * $value->so_luong;
                            // dd($giaBan);
                            $thuc_tra += $value->so_luong * $giaBan;
                        }
                        // dd($giaBan);
                    }
                    $hoaDon->tong_tien = $total;
                    $hoaDon->thuc_tra = $thuc_tra;
                    $hoaDon->tien_giam_gia = $hoaDon->tong_tien - $hoaDon->thuc_tra;
                    $hoaDon->save();
                }

                return response()->json([
                    'status' => true,
                    'kho_hang' => $khoHang
                ]);
            } else {
                return response()->json(['status' => false]);
            }
            ///
            // }

        } else {
            return response()->json(['status' => false]);
        }
    }
    public function destroyOffline($id){
        $ChiTiethoaDon = ChiTietHoaDon::find($id);
        $total = 0;
        $thuc_tra = 0;
        if ($ChiTiethoaDon) {
            $ChiTiethoaDon->delete();
            // $ChiTiethoaDon->save();
            $hoaDon = HoaDon::find($ChiTiethoaDon->hoa_don_id);
            if ($hoaDon) {
                $chiTiet = ChiTietHoaDon::join('san_phams', 'chi_tiet_hoa_dons.san_pham_id', 'san_phams.id')
                    ->where('hoa_don_id', $ChiTiethoaDon->hoa_don_id)
                    ->where('is_cart', 1)
                    ->select('san_phams.gia_ban', 'chi_tiet_hoa_dons.*')
                    ->get();
                foreach ($chiTiet as $value) {
                    $sanPham = SanPham::find($value->san_pham_id);
                    if ($sanPham) {
                        $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                        $total += $value->gia_ban * $value->so_luong;
                        // dd($giaBan);
                        $thuc_tra += $value->so_luong * $giaBan;
                    }
                }
                // $giaBan = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
                $hoaDon->tong_tien = $total;
                $hoaDon->thuc_tra = $thuc_tra;
                $hoaDon->tien_giam_gia = $hoaDon->tong_tien - $hoaDon->thuc_tra;
                $hoaDon->save();
                return response()->json([
                    'status'  =>  true,
                    'hang' => $ChiTiethoaDon,
                ]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function StoreDoanhThuOffline($id){
        $data = HoaDon::where('id',$id)
                        ->where('hoan_thanh',2)
                        ->get();
        if(count($data)>0){
            return response()->json([
                'status'    => true,
                'kho_hang'  => $data,
            ]);
        }else{
            return response()->json([
                'status'    => false,
            ]);
        }
    }
}
