<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\HoaDon;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function loginAdmin(AdminRequest $request)
    {
        $data  = $request->all();
        // dd($data);
        $check = Auth::guard('TaiKhoan')->attempt($data);
        // dd($check);
        if($check) {
            $admin = Auth::guard('TaiKhoan')->user();
            if($admin->loai_tai_khoan == 1){
                return response()->json(['status' => 1]);

                // dd(2);
            }else{
                return response()->json(['status' => 0]);
            }
         } else{
            //Login thất bại
            return response()->json(['status' => 0]);
        }
    }
    public function logout(){
        Auth::guard("TaiKhoan")->logout();
        return redirect("/admin/index");
    }

    public function homeIndex(){
        $admin = Auth::guard('TaiKhoan')->user();
        if($admin){
        return view('admin.pages.index');
        }else{
            return redirect('/admin/login');
        }
    }

    public function demDonHang(){
        $data = HoaDon::where('tinh_trang_don_hang',1)->where('loai_hoa_don',1)->get();
        $dem = 0;
        if ($data) {
            foreach ($data as $key => $value) {
                $dem = $dem + 1;
            }
        }
        return response()->json([
            'demDonHang' => $dem,
        ]);
    }

    public function demOffline(){
        $data = HoaDon::where('tinh_trang_don_hang',1)->where('loai_hoa_don',2)->get();
        $dem = 0;
        if ($data) {
            foreach ($data as $key => $value) {
                $dem = $dem + 1;
            }
        }
        return response()->json([
            'demOffline' => $dem,
        ]);
    }

    public function demCustomer(){
        $dataCustomer = TaiKhoan::where('loai_tai_khoan',4)->get();
        $dem = 0;
        if($dataCustomer) {
            $dem = 0; // Initialize $dem to 0
            foreach ($dataCustomer as $key => $value) {
                $dem = $dem + 1;
            }
        }
        // dd($dem);
        return response()->json([
            'demCustomer' => $dem,
        ]);
    }
}
