<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentRequet;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\QuenMkRequest;
use App\Http\Requests\UpdatePassword;
use App\Mail\MaiForgot;
use App\Mail\MailKichHoat;
use App\Mail\MailKichHoatOff;
use App\Models\agent;
use App\Models\Customer;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    //tài khoản online
    public function login()
    {
        return view('customer.login');
    }
    public function loginAction(LoginCustomerRequest $request)
    {
        $data = $request->all();
        $check = Auth::guard('TaiKhoan')->attempt($data);
        // dd($check);
        if ($check) {
            $TaiKhoan = Auth::guard('TaiKhoan')->user();
            // dd($agent);
            if ($TaiKhoan->is_open == 1) {
                if ($TaiKhoan->is_email == 1) {
                    return response()->json([
                        'status'   => 1
                    ]);
                } else {
                    return response()->json(['status' => 2]);
                }
            } else {
                return response()->json(['status' => 3]);
            }
        } else {
            //Login thất bại
            return response()->json(['status' => false]);
        }
    }
    public function register()
    {
        return view('customer.register');
    }
    public function registerAction(CustomerRequest $request)
    {
        $data = $request->all();
        $data['loai_tai_khoan'] = 4;
        $data['hash']       = Str::uuid();
        $data['password']   = bcrypt($request->password);
        TaiKhoan::create($data);

        Mail::to($request->email)->send(new MailKichHoat(
            $request->ho_va_ten,
            $data['hash'],
            'Kích Hoạt Tài Khoản Đăng Ký'
        ));
        return response()->json(['status' => true]);
    }
    public function active($hash)
    {
        $customer = TaiKhoan::where('hash', $hash)->first();
        if ($customer->is_email) {
            toastr()->warning('Tài khoản của bạn đã được kích hoạt trước đó!');
        } else {
            $customer->is_email = 1;
            $customer->save();
            toastr()->success('Tài khoản của bạn đã được kích hoạt!');
        }
        return redirect("/cafe/customer/login");
    }

    public function logout()
    {
        $customer = Auth::guard('TaiKhoan')->user();
        if ($customer) {
            Auth::guard('TaiKhoan')->logout();
            return redirect('/cafe/customer/login');
        }
    }



    // Tài khoản của off

    public function registerOff()
    {
        return view('customer_off.register');
    }
    public function registerActionOff(CustomerRequest $request)
    {
        $data = $request->all();
        $data['hash']       = Str::uuid();
        $data['loai_tai_khoan'] = 4;
        $data['password']   = bcrypt($request->password);
        TaiKhoan::create($data);

        Mail::to($request->email)->send(new MailKichHoatOff(
            $request->ho_va_ten,
            $data['hash'],
            'Kích Hoạt Tài Khoản Đăng Ký'
        ));
        return response()->json(['status' => true]);
    }
    public function loginOff()
    {
        return view('customer_off.login');
    }
    public function activeOff($hash)
    {
        $customer = TaiKhoan::where('hash', $hash)->first();
        if ($customer->is_email) {
            toastr()->warning('Tài khoản của bạn đã được kích hoạt trước đó!');
        } else {
            $customer->is_email = 1;
            $customer->save();
            toastr()->success('Tài khoản của bạn đã được kích hoạt!');
        }
        return redirect("/customer-off/login");
    }

    public function loginActionOff(LoginCustomerRequest $request)
    {
        $data = $request->all();
        $check = Auth::guard('TaiKhoan')->attempt($data);
        // dd($check);
        if ($check) {
            $customer = Auth::guard('TaiKhoan')->user();
            // dd($agent);
            if ($customer->is_open == 1) {
                if ($customer->is_email == 1) {
                    return response()->json([
                        'status'   => 1
                    ]);
                } else {
                    return response()->json(['status' => 2]);
                }
            } else {
                return response()->json(['status' => 3]);
            }
        } else {
            //Login thất bại
            return response()->json(['status' => false]);
        }
    }

    public function logoutOff()
    {
        $customer = Auth::guard('TaiKhoan')->user();
        if ($customer) {
            Auth::guard('TaiKhoan')->logout();
            return redirect('/customer-off/login');
        }
    }

    //QUÊN MẬT KHẨU

    public function forgot(){
        return view('quen_mk.index');
    }

    public function forgotPassword(QuenMkRequest $request)
    {
        // $data = $request->email;
        $check = TaiKhoan::where('email',$request->email)->first();
        // dd($check);
        if ($check) {
            // $agent = Auth::guard('TaiKhoan')->user();
            Mail::to($request->email)->send(new MaiForgot(
                $check->ten_tai_khoan,
                $check['hash'],
                'Đặt lại mật khẩu'
            ));
        }
        return response()->json([
            'status' => true,
        ]);
    }

    public function resetPassword($hash){
        $customer = TaiKhoan::where('hash', $hash)->first();
        return view('update_mk.index',compact('customer'));
    }

    public function updatePassword(UpdatePassword $request){
        $data['password']   = bcrypt($request->password);
        $tai_khoan = TaiKhoan::find($request->id);
        // dd($tai_khoan);
        $tai_khoan->update($data);
        toastr()->success('Đã cập nhật password thành công!');
        return redirect('/forgot');
    }

}
