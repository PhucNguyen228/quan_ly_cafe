<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;

class QuanLyCustomerController extends Controller
{
    public function index(){
        return view('admin.pages.customer.index');
    }
    public function getData(){
        $customer = TaiKhoan::where('loai_tai_khoan',4)->get();
        return response()->json([
            'dulieuCustomer' => $customer,
        ]);
    }
    public function doiTrangThai($id)
    {
        $customer = TaiKhoan::find($id);
        if($customer) {
            $customer->is_open = !$customer->is_open;
            $customer->save();
            return response()->json([
                'trangThai'         =>  true,
                'tinhTrangCustomer'      =>  $customer->is_open,
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
        $customer = TaiKhoan::find($id);
        if($customer) {
            $customer->delete();
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
