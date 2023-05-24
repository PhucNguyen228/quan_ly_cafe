<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginShipperRequest;
use App\Http\Requests\ShipperRegisterRequest;
use App\Http\Requests\UpdateTKNhanVienRequest;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ShipperController extends Controller
{
    public function login(){
        return view('shipper.login');
    }
    public function loginAction(LoginShipperRequest $request){
        $data  = $request->all();
        // dd($data);
        $check = Auth::guard('TaiKhoan')->attempt($data);
        // dd($check);
        if($check) {
            // Đã login thành công!!!
            $agent = Auth::guard('TaiKhoan')->user();
            if($agent->is_open == 1 && $agent->loai_tai_khoan == 3) {

                return response()->json(['status' => 2]);

                // dd(2);
            } else {
                return response()->json(['status' => 1]);
                // dd(1);
            }
         } else{
            //Login thất bại
            return response()->json(['status' => 0]);
        }
    }
    public function index(){
        return view('admin.pages.shipper.index');
    }
    public function getData(){
        $shipper = TaiKhoan::where('loai_tai_khoan',3)->get();
        return response()->json([
            'dulieuShipper' => $shipper,
        ]);
    }
    public function register(){
        return view('admin.pages.shipper.dang_ki');
    }
    public function registerAction(ShipperRegisterRequest $request){
        $data = $request->all();
        $data['is_email'] = 1;
        $data['loai_tai_khoan'] = 3;
        $data['hash']   = Str::uuid();
        $data['password']   = bcrypt($request->password);
        TaiKhoan::create($data);
        return response()->json(['status' => true]);

    }

    public function logout(){
        Auth::guard('TaiKhoan')->logout();
        toastr()->success('bạn đã đăng xuất');
        return redirect('/shipper/login');
    }
    public function doiTrangThai($id)
    {
        $user = TaiKhoan::find($id);
        if($user) {
            $user->is_open = !$user->is_open;
            $user->save();
            return response()->json([
                'trangThai'         =>  true,
                'tinhTrangShipper'      =>  $user->is_open,
            ]);
        } else {
            return response()->json([
                'trangThai'         =>  false,
            ]);
        }
    }
    public function destroy($id)
    {
        // dd($id);
        $user = TaiKhoan::find($id);
        if($user) {
            $user->delete();
            return response()->json([
                'status'  =>  true,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }
    public function edit($id)
    {
        $shipper = TaiKhoan::find($id);
        if($shipper) {
            return response()->json([
                'status'  =>  true,
                'data'    =>  $shipper,
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
            ]);
        }
    }
    public function update(UpdateTKNhanVienRequest $request)
    {
        $user = TaiKhoan::find($request->id);
        // $parts = explode(" ", $request->ho_va_ten);
        // if(count($parts) > 1) {
        //     $lastname = array_pop($parts);
        //     $firstname = implode(" ", $parts);
        // }
        // else
        // {
        //     $firstname = $request->ho_va_ten;
        //     $lastname = " ";
        // }
        if(!$request->password){
            // $user->ho_lot = $firstname;
            // $user->ten = $lastname;
            $user->ho_va_ten = $request->ho_va_ten;
            $user->so_dien_thoai = $request->so_dien_thoai;
            $user->email = $request->email;
            $user->dia_chi = $request->dia_chi;
            $user->is_open = $request->is_open;
            $user->save();
        } else{
            $data           = $request->all();
            // $data['ho_lot'] = $firstname;
            // $data['ten']    = $lastname;
            $data['password']   = bcrypt($request->password);
            $user->update($data);

        }
        return response()->json(['status'=> true]);
    }
}
