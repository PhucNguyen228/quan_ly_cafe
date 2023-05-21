<?php

namespace App\Providers;

use App\Models\DanhMucSanPham;
use App\Models\HoaDon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menuCha = DanhMucSanPham::where('is_open', 1)->get();
         foreach($menuCha as $key => $value_cha) {
            $value_cha->tmp = $value_cha->id;
         }
        view()->share('menuCha', $menuCha);


        $data = HoaDon::where('tinh_trang_don_hang',1)->where('loai_hoa_don',1)->get();
        $dem = 0;
        if ($data) {
            foreach ($data as $key => $value) {
                $dem = $dem + 1;
            }
            // dd($dem);
        }
        view()->share('dem',$dem);


        // $data = HoaDon::where('tinh_trang_don_hang',2)->where('loai_hoa_don',1)->get();
        // $dem = 0;
        // if ($data) {
        //     foreach ($data as $key => $value) {
        //         $dem = $dem + 1;
        //     }
        //     // dd($dem);
        // }
        // view()->share('demDonHang',$dem);
    }
}

