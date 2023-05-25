<?php

use App\Http\Controllers\ChiTietHoaDonController;
use App\Http\Controllers\ChiTietHoaDonOlineController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\HoaDonCustomerController;
use App\Http\Controllers\HoaDonOfflineController;
use App\Http\Controllers\HoaDonOnlineController;
use App\Http\Controllers\HoaDonShipperController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\HomePageOlineController;
use App\Http\Controllers\QuanLyCustomerController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\TestSQLControler;
use App\Models\ChiTietHoaDonOline;
use App\Models\HoaDon;
use App\Models\SanPham;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomePageController::class, 'index']);
Route::get('/data', [\App\Http\Controllers\HomePageController::class, 'data']);
Route::post('/search', [\App\Http\Controllers\HomePageController::class, 'search']);
Route::post('/search/san-pham-sell', [\App\Http\Controllers\HomePageController::class, 'searchSell']);

//Login bằng google
Route::get('/login-google', [GoogleController::class, 'login_google']);
Route::get('/google/callback', [GoogleController::class, 'callback_google']);

//QUÊN MẬT KHẨU
Route::get('/forgot', [CustomerController::class, 'forgot']);
Route::post('/forgot-password', [CustomerController::class, 'forgotPassword']);
Route::get('/reset-password/{hash}', [CustomerController::class, 'resetPassword']);
Route::post('/update-password', [CustomerController::class, 'updatePassword']);

// Route::get('/home-page/{id}', [\App\Http\Controllers\HomePageController::class, 'index']);
// Route::get('/home-page/data/{id}', [\App\Http\Controllers\HomePageController::class, 'getData']);

// QUẢN LÝ ONLINE
Route::group(['prefix' => '/cafe'], function () {
    Route::get('/homepage', [HomePageOlineController::class, 'index']);
    Route::post('/chatbot', [HomePageOlineController::class, 'chat'])->name('chatbot.chat');
    Route::get('/customer/login', [\App\Http\Controllers\CustomerController::class, 'login']);
    Route::post('/customer/login', [CustomerController::class, 'loginAction']);
    Route::get('/customer/register', [\App\Http\Controllers\CustomerController::class, 'register']);
    Route::post('/customer/register', [\App\Http\Controllers\CustomerController::class, 'registerAction']);
    Route::get('/customer/logout', [CustomerController::class, 'Logout']);
    Route::get('/active/{hash}', [CustomerController::class, 'active']);
    Route::get('/sell', [HomePageOlineController::class, 'indexSell']);
    Route::get('/sell/data', [HomePageOlineController::class, 'sellData']);
    Route::get('/chi-tiet-san-pham/{id}', [SanPhamController::class, 'ChiTietSanPham']);
    Route::group(['prefix' => '/lien-he'], function () {
        Route::get('/index', [HomePageOlineController::class, 'indexLienHeCuaHang']);
    });
    Route::group(['prefix' => '/customer', 'middleware' => 'CustomerMiddleWare'], function () {
        Route::post('/add-to-cart', [HomePageOlineController::class, 'addToCart']);
        Route::post('/create-don-hang-online', [DonHangController::class, 'CreatestoreOnline']);
        Route::get('/thong-tin', [HomePageOlineController::class, 'indexThongTin']);
        Route::post('/thong-tin/update', [HomePageOlineController::class, 'updateThongTin']);
        Route::get('/don-hang', [HoaDonCustomerController::class, 'donHang']);
        Route::get('/don-hang/data', [HoaDonCustomerController::class, 'donHangData']);
        Route::get('/don-hang/huy/{id}', [HoaDonCustomerController::class, 'huyDonHang']);
        Route::get('/chi-tiet-don-hang/{id}', [HoaDonCustomerController::class, 'chiTiet']);
        Route::get('/chi-tiet-don-hang/data/{id}', [HoaDonCustomerController::class, 'chiTietData']);
        Route::get('/hai-long/{id}', [DanhGiaController::class, 'HaiLong']);
        Route::get('/khong-hai-long/{id}', [DanhGiaController::class, 'KhongHaiLong']);
        Route::group(['prefix' => '/cart'], function () {
            Route::get('/index', [ChiTietHoaDonOlineController::class, 'index']);
            Route::get('/data', [ChiTietHoaDonOlineController::class, 'dataCart']);
            Route::post('/updateqty', [ChiTietHoaDonOlineController::class, 'updateqty']);
            Route::get('/remove/{id}', [ChiTietHoaDonOlineController::class, 'removeCart']);
        });
    });
});

// QUẢN LÝ SHIPPER
Route::get('/shipper/login', [ShipperController::class, 'login']);
Route::post('/shipper/dang-nhap', [ShipperController::class, 'loginAction']);
Route::group(['prefix' => '/shipper', 'middleware' => 'ShipperWare'], function () {
    Route::get('/index', [HoaDonShipperController::class, 'index']);
    Route::get('/logout', [ShipperController::class, 'logout']);
    Route::get('/data', [HoaDonShipperController::class, 'dataShipper']);
    Route::get('/chi-tiet-don-hang/data/{id}', [HoaDonShipperController::class, 'dataChiTiet']);
    Route::get('/chi-tiet-don-hang/{id}', [HoaDonShipperController::class, 'chiTiet']);
    Route::get('/nhan-hang/{id}', [HoaDonShipperController::class, 'nhanHang']);
    Route::get('/don-nhan', [HoaDonShipperController::class, 'DonHang']);
    Route::get('/don-nhan/data', [HoaDonShipperController::class, 'DataDonHang']);
    Route::get('/da-giao/{id}', [HoaDonShipperController::class, 'daGiao']);
    Route::get('/chi-tiet-don-giao/{id}', [HoaDonShipperController::class, 'chiTietDonGiao']);
    Route::get('/chi-tiet-don-giao/data/{id}', [HoaDonShipperController::class, 'DataChiTietDonGiao']);
});

//QUẢN LÝ ADMIN
Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'index']);
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'loginAdmin']);
Route::group(['prefix' => '/admin', 'middleware' => 'AdminMiddleWare'], function () {
    Route::post('/filter', [\App\Http\Controllers\AdminController::class, 'filter'])->name('admin.doanh_thu.filter');
    Route::post('/doanh-thu-on', [\App\Http\Controllers\AdminController::class, 'doanhThuOn'])->name('admin.doanh_thu_on');
    Route::post('/doanh-thu-off', [\App\Http\Controllers\AdminController::class, 'doanhThuOff'])->name('admin.doanh_thu_off');
    Route::get('/logout', [\App\Http\Controllers\AdminController::class, 'logout']);
    Route::get('/index', [\App\Http\Controllers\AdminController::class, 'homeIndex']);
    Route::get('/dem', [\App\Http\Controllers\AdminController::class, 'demDonHang']);
    Route::get('/dem/offline', [\App\Http\Controllers\AdminController::class, 'demOffline']);
    Route::get('/dem/customer', [\App\Http\Controllers\AdminController::class, 'demCustomer']);

    // Route::post('/getData/{id}', [\App\Http\Controllers\DanhMucSanPhamController::class, 'getData1']);
    Route::group(['prefix' => '/danh-muc-san-pham'], function () {
        Route::get('/index', [\App\Http\Controllers\DanhMucSanPhamController::class, 'index']);
        Route::post('/index', [\App\Http\Controllers\DanhMucSanPhamController::class, 'store']);
        Route::get('/data', [\App\Http\Controllers\DanhMucSanPhamController::class, 'getData']);

        Route::get('/doi-trang-thai/{id}', [\App\Http\Controllers\DanhMucSanPhamController::class, 'doiTrangThai']);

        Route::get('/delete/{id}', [\App\Http\Controllers\DanhMucSanPhamController::class, 'destroy']);
        Route::get('/edit/{id}', [\App\Http\Controllers\DanhMucSanPhamController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\DanhMucSanPhamController::class, 'update']);
        // Route::post('/search', [\App\Http\Controllers\DanhMucSanPhamController::class, 'search']);
    });
    Route::group(['prefix' => '/san-pham'], function () {
        Route::get('/index', [\App\Http\Controllers\SanPhamController::class, 'index']);
        Route::post('/tao-san-pham', [\App\Http\Controllers\SanPhamController::class, 'HamTaoSanPhamDayNe']);

        Route::get('/danh-sach-san-pham', [\App\Http\Controllers\SanPhamController::class, 'getData']);
        Route::get('/doi-trang-thai/{id}', [\App\Http\Controllers\SanPhamController::class, 'DoiTrangThaiSanPham']);

        Route::get('/xoa-san-pham/{id}', [\App\Http\Controllers\SanPhamController::class, 'XoaSanPham']);

        Route::get('/edit/{id}', [\App\Http\Controllers\SanPhamController::class, 'editSanPham']);
        Route::post('/update', [\App\Http\Controllers\SanPhamController::class, 'updateSanPham']);


        Route::post('/search', [\App\Http\Controllers\SanPhamController::class, 'search']);
    });
    Route::group(['prefix' => '/ban'], function () {
        Route::get('/index', [\App\Http\Controllers\BanController::class, 'index']);
        Route::post('/index', [\App\Http\Controllers\BanController::class, 'store']);
        Route::get('/data', [\App\Http\Controllers\BanController::class, 'getData']);

        Route::get('/thiet-lap/{id}', [\App\Http\Controllers\BanController::class, 'thietLap']);
        Route::get('/tinh-trang/{id}', [\App\Http\Controllers\BanController::class, 'doiTrangThai']);

        Route::get('/delete/{id}', [\App\Http\Controllers\BanController::class, 'destroy']);
        Route::get('/edit/{id}', [\App\Http\Controllers\BanController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\BanController::class, 'update']);
    });
    Route::group(['prefix' => '/user'], function () {
        Route::get('/index', [\App\Http\Controllers\AgentController::class, 'index']);
        Route::get('/dulieu', [\App\Http\Controllers\AgentController::class, 'getData']);
        Route::get('/dangki', [\App\Http\Controllers\AgentController::class, 'register']);
        Route::post('/register', [\App\Http\Controllers\AgentController::class, 'registerAction']);
        Route::get('/doi-trang-thai/{id}', [\App\Http\Controllers\AgentController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [\App\Http\Controllers\AgentController::class, 'destroy']);
        Route::get('/edit/{id}', [\App\Http\Controllers\AgentController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\AgentController::class, 'update']);
    });


    Route::group(['prefix' => '/shipper'], function () {
        Route::get('/index', [\App\Http\Controllers\ShipperController::class, 'index']);
        Route::get('/dulieu', [\App\Http\Controllers\ShipperController::class, 'getData']);
        Route::get('/dangki', [\App\Http\Controllers\ShipperController::class, 'register']);
        Route::post('/register', [\App\Http\Controllers\ShipperController::class, 'registerAction']);
        Route::get('/doi-trang-thai/{id}', [\App\Http\Controllers\ShipperController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [\App\Http\Controllers\ShipperController::class, 'destroy']);
        Route::get('/edit/{id}', [\App\Http\Controllers\ShipperController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\ShipperController::class, 'update']);
    });
    Route::group(['prefix' => '/customer'], function () {
        Route::get('/index', [QuanLyCustomerController::class, 'index']);
        Route::get('/dulieu', [QuanLyCustomerController::class, 'getData']);
        Route::get('/doi-trang-thai/{id}', [QuanLyCustomerController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [QuanLyCustomerController::class, 'destroy']);
    });

    Route::group(['prefix' => '/kho'], function () {
        Route::get('/index', [\App\Http\Controllers\KhoController::class, 'index']);
        Route::get('/data', [\App\Http\Controllers\KhoController::class, 'getData']);
        Route::post('/create', [\App\Http\Controllers\KhoController::class, 'store']);

        Route::get('/remove/{id}', [\App\Http\Controllers\KhoController::class, 'destroy']);
        Route::post('/updateqty', [\App\Http\Controllers\KhoController::class, 'updateqty']);
        Route::post('/updateprice', [\App\Http\Controllers\KhoController::class, 'updateprice']);
        Route::get('/createnhapkho', [\App\Http\Controllers\KhoController::class, 'create']);

        //xuất khogetData
    });

    Route::group(['prefix' => '/xuat-kho'], function () {
        Route::get('/index', [\App\Http\Controllers\XuatKhoController::class, 'index']);
        Route::get('/data', [\App\Http\Controllers\XuatKhoController::class, 'dataXuat']);
        Route::post('/create', [\App\Http\Controllers\XuatKhoController::class, 'store']);
        Route::get('/data/table-xuat', [\App\Http\Controllers\XuatKhoController::class, 'getData']);
        Route::get('/delete/{id}', [\App\Http\Controllers\XuatKhoController::class, 'destroy']);
        Route::post('/updateqty', [\App\Http\Controllers\XuatKhoController::class, 'updateqty']);
        Route::get('/create-xuat-kho', [\App\Http\Controllers\XuatKhoController::class, 'create']);
    });
    /// quản lý in hóa đơn
    Route::group(['prefix' => '/hoa-don'], function () {
        Route::get('/index', [HoaDonController::class, 'index']);
        Route::get('/data', [HoaDonController::class, 'data']);
        Route::get('/data-hoa-don/{id}', [HoaDonController::class, 'dataHoaDon']);
        Route::get('/{id}', [HoaDonController::class, 'HoaDonOffline']);
        Route::get('/in-bill/{id}', [HoaDonController::class, 'inBill']);
    });

    Route::group(['prefix' => '/hoa-don-online'], function () {
        Route::get('/index', [HoaDonOnlineController::class, 'index']);
        Route::get('/data', [HoaDonOnlineController::class, 'data']);
        Route::get('/data-hoa-don/{id}', [HoaDonOnlineController::class, 'dataHoaDon']);
        Route::get('/{id}', [HoaDonOnlineController::class, 'HoaDon']);
        Route::get('/in-bill/{id}', [HoaDonOnlineController::class, 'inBill']);
        // Route::get('/in-bill/{id}',[HoaDonOnlineController::class, 'inBill']);
        Route::get('/tinh-trang-don-hang/index', [HoaDonOnlineController::class, 'indexTinhTrang']);
        Route::get('/tinh-trang-don-hang/data', [HoaDonOnlineController::class, 'tinhTrangDonHang']);
        Route::get('/chi-tiet-don-hang/{id}', [HoaDonOnlineController::class, 'chiTietDonHang']);
        Route::get('/chi-tiet-don-hang/data/{id}', [HoaDonOnlineController::class, 'DataChiTietDonHang']);
    });
    //Quản lý hóa đơn trong ngày
    Route::group(['prefix' => '/doanh-thu'], function () {
        //QUẢN LÝ HÓA ĐƠN THEO NGÀY ONLINE
        Route::get('/index', [\App\Http\Controllers\HoaDonController::class, 'page']);
        Route::post('/data', [\App\Http\Controllers\HoaDonController::class, 'TongHD']);
        Route::get('/hoa-don/{id}', [\App\Http\Controllers\HoaDonController::class, 'HoaDon']);
        Route::post('/search', [\App\Http\Controllers\HoaDonController::class, 'search']);
        Route::post('/updateqty', [\App\Http\Controllers\HoaDonController::class, 'updateqty']);
        Route::get('/ngay-hoa-don/{id}', [\App\Http\Controllers\HoaDonController::class, 'ngayHoaDon']);
        Route::get('/delete/{id}', [\App\Http\Controllers\HoaDonController::class, 'destroy']);
        Route::post('/in-bill/{id}', [\App\Http\Controllers\HoaDonController::class, 'StoreDoanhThu']);
        //QUẢN LÝ HÓA ĐƠN THEO NGÀY OFFLINE
        Route::get('/offline/index', [\App\Http\Controllers\HoaDonController::class, 'pageOffline']);
        Route::post('/offline/data', [\App\Http\Controllers\HoaDonController::class, 'TongHDOffline']);
        Route::get('/offline/ngay-hoa-don/{id}', [\App\Http\Controllers\HoaDonController::class, 'ngayHoaDonOffline']);
        Route::get('/offline/hoa-don/{id}', [\App\Http\Controllers\HoaDonController::class, 'HDOffline']);
        Route::post('/offline/search', [\App\Http\Controllers\HoaDonController::class, 'searchOffline']);
        Route::post('/offline/updateqty', [\App\Http\Controllers\HoaDonController::class, 'updateqtyOffline']);
        Route::get('/offline/delete/{id}', [\App\Http\Controllers\HoaDonController::class, 'destroyOffline']);
        Route::post('/offline/in-bill/{id}', [\App\Http\Controllers\HoaDonController::class, 'StoreDoanhThuOffline']);

    });
    Route::group(['prefix' => '/nguyen-lieu'], function () {
        Route::get('/index', [\App\Http\Controllers\NguyenLieuController::class, 'index']);
        Route::post('/index', [\App\Http\Controllers\NguyenLieuController::class, 'store']);
        Route::get('/data', [\App\Http\Controllers\NguyenLieuController::class, 'getData']);
        Route::get('/doi-trang-thai/{id}', [\App\Http\Controllers\NguyenLieuController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [\App\Http\Controllers\NguyenLieuController::class, 'destroy']);
        Route::get('/edit/{id}', [\App\Http\Controllers\NguyenLieuController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\NguyenLieuController::class, 'update']);

        Route::post('/search', [\App\Http\Controllers\NguyenLieuController::class, 'search']);
    });
});

// QUẢN LÝ STAFF
Route::get('/staff/login', [\App\Http\Controllers\AgentController::class, 'login']);
Route::post('/staff/login', [\App\Http\Controllers\AgentController::class, 'loginAction']);
Route::group(['prefix' => '/staff', 'middleware' => 'StaffMiddleWare'], function () {
    Route::get('/logout', [\App\Http\Controllers\AgentController::class, 'logout']);
    // Route::get('/oder/index', [\App\Http\Controllers\DonHangController::class, 'index']);
    Route::get('/ban/index', [\App\Http\Controllers\BanUserController::class, 'index']);
    Route::get('/data', [\App\Http\Controllers\BanUserController::class, 'getData']);
    Route::get('/ban/doi-trang-thai/{id}', [\App\Http\Controllers\BanUserController::class, 'doiTrangThai']);
    // Route::get('/ban/{id}', [\App\Http\Controllers\BanUserController::class, 'ban']);
    // Route::post('/add-to-cart', [\App\Http\Controllers\ChiTietHoaDonController::class, 'addToCart']);
    // // Route::get('/cart/{id}', [\App\Http\Controllers\ChiTietHoaDonController::class, 'index']);
    // Route::get('/cart/data/{id}', [\App\Http\Controllers\ChiTietHoaDonController::class, 'dataCart']);
    // Route::post('/updateqty', [\App\Http\Controllers\ChiTietHoaDonController::class, 'updateqty']);
    // Route::get('/remove-cart/{id}', [\App\Http\Controllers\ChiTietHoaDonController::class, 'removeCart']);
    // Route::get('/create-bill/{id}', [\App\Http\Controllers\DonHangController::class, 'store']);
});


//QUẢN LÝ OFFLINE
Route::get('/customer_off/register', [CustomerController::class, 'registerOff']);
Route::post('/customer_off/register', [CustomerController::class, 'registerActionOff']);
Route::get('/active-off/{hash}', [CustomerController::class, 'activeOff']);
Route::get('/customer-off/login', [CustomerController::class, 'loginOff']);
Route::post('/customer-off/login', [CustomerController::class, 'loginActionOff']);
Route::get('/customer-off/logout', [CustomerController::class, 'LogoutOff']);
Route::get('/page-off/san-pham/{id}', [HomePageController::class, 'sanPhamIndex']);
Route::get('/page-off/san-pham/data/{id}', [HomePageController::class, 'sanPham']);

Route::get('/page-off/san-pham-sell', [HomePageController::class, 'sanPhamSellIndex']);
Route::get('/page-off/san-pham-sell/data', [HomePageController::class, 'sanPhamSell']);

Route::group(['prefix' => '/customer-off', 'middleware' => ['web', 'CustomerOffMiddleWare']], function () {
    Route::get('/cart-off', [ChiTietHoaDonController::class, 'index']);
    Route::post('/add-to-cart', [ChiTietHoaDonController::class, 'addToCart']);
    Route::get('/cart-off/data', [ChiTietHoaDonController::class, 'dataCart']);
    Route::post('/cart-off/updateqty', [ChiTietHoaDonController::class, 'updateqty']);
    Route::get('/remove/{id}', [ChiTietHoaDonController::class, 'removeCart']);
    Route::get('/ban/index', [ChiTietHoaDonController::class, 'indexBan']);
    Route::get('/ban/data', [ChiTietHoaDonController::class, 'dataBan']);
    Route::post('/create-hoa-don', [DonHangController::class, 'createHoaDon']);

    /// quản lý đơn hàng của customer offline
    Route::get('/hoa-don/index', [HoaDonOfflineController::class, 'index']);
    Route::get('/hoa-don/data', [HoaDonOfflineController::class, 'dataHoaDon']);
    Route::get('/huy/don-hang/{id}', [HoaDonOfflineController::class, 'destroy']);

});



// Route::group(['prefix' => 'laravel-filemanager'], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

Route::get('/sql/data', [TestSQLControler::class, 'dataBan']);

