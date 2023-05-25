<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\HoaDon;
use Carbon\Carbon;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function loginAdmin(AdminRequest $request)
    {
        $data  = $request->all();
        // dd($data);
        $check = Auth::guard('TaiKhoan')->attempt($data);
        // dd($check);
        if ($check) {
            $admin = Auth::guard('TaiKhoan')->user();
            if ($admin->loai_tai_khoan == 1) {
                return response()->json(['status' => 1]);

                // dd(2);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            //Login thất bại
            return response()->json(['status' => 0]);
        }
    }
    public function logout()
    {
        Auth::guard("TaiKhoan")->logout();
        return redirect("/admin/index");
    }

    public function homeIndex()
    {
        $admin = Auth::guard('TaiKhoan')->user();
        if ($admin) {
            return view('admin.pages.index');
        } else {
            return redirect('/admin/login');
        }
    }

    public function demDonHang()
    {
        $data = HoaDon::where('tinh_trang_don_hang', 1)->where('loai_hoa_don', 1)->get();
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

    public function demOffline()
    {
        $data = HoaDon::where('tinh_trang_don_hang', 1)->where('loai_hoa_don', 2)->get();
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

    public function filter(Request $request)
    {
        // dd($request->all());
        $check = Auth::guard('TaiKhoan')->user();
        if ($check) {
            $data = $request->all();
            $from_date = $data['from_date'];
            // dd($from_date);

            // $get = HoaDon::whereRaw('YEAR(ngay_hoa_don) = ?', [$from_date])->where('hoan_thanh', 2)->orderBy('ngay_hoa_don', 'ASC')->get();
            $get = HoaDon::where('ngay_hoa_don', 'LIKE', '%' . $from_date . '%')->where('hoan_thanh', 2)->orderBy('ngay_hoa_don', 'ASC')->get()->groupBy(function ($date) {
                return Carbon::parse($date->ngay_hoa_don)->format('m/y');
            });
            if ($get->isEmpty()) {
                $chart_data[] = array(
                    'Thang_thu_nhap' => 0,
                    'Tong_tien'      => 0,
                );
                return response()->json(
                    [
                        'data' => $chart_data,
                        'status' => false,
                    ]
                );
            } else {
                foreach ($get as $month => $values) {
                    $tong_tien = array_sum(array_column($values->toArray(), 'thuc_tra'));
                    // dd(array_column($values->toArray(), 'tong_doanh_thu'));
                    $chart_data[] = array(
                        'Thang_thu_nhap' => $month,
                        'Tong_tien'      => $tong_tien,
                    );
                }
                return response()->json([
                    'status' => true,
                    'data' => $chart_data,

                ]);
            }
        }
    }

    public function doanhThuOn(Request $request)
    {
        // dd($request->all());
        // slipt $request->all() to get month and year
        $year = substr($request->all()['ngay_hoa_don'], 0, 4);
        $month = substr($request->all()['ngay_hoa_don'], 5, 6);
        // dd($month, $year);
        $data = HoaDon::whereMonth('ngay_hoa_don', $month)
            ->whereYear('ngay_hoa_don', $year)
            ->where('loai_hoa_don', 1)
            ->where('hoan_thanh', 2)
            ->get();
        $tong = 0;
        foreach ($data as $key => $value) {
            $tong = $tong + $value->thuc_tra;
        }
        return response()->json([
            'tong' => $tong,
            'status' => true,
        ]);
    }

    public function doanhThuOff(Request $request)
    {
        $year = substr($request->all()['ngay_hoa_don'], 0, 4);
        $month = substr($request->all()['ngay_hoa_don'], 5, 6);
        $data = HoaDon::whereMonth('ngay_hoa_don', $month)
            ->whereYear('ngay_hoa_don', $year)
            ->where('loai_hoa_don', 2)
            ->where('hoan_thanh', 2)
            ->get();
        $tong = 0;
        foreach ($data as $key => $value) {
            $tong = $tong + $value->thuc_tra;
        }
        return response()->json([
            'tong' => $tong,
            'status' => true,
        ]);
    }

    public function demCustomer()
    {
        $dataCustomer = TaiKhoan::where('loai_tai_khoan', 4)->get();
        $dem = 0;
        if ($dataCustomer) {
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
