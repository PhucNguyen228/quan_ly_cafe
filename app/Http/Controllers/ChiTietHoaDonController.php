<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\Ban;
use App\Models\ChiTietHoaDon;
use App\Models\SanPham;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChiTietHoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer_off.cart.index');
    }

    // public function addToCart(Request $request)
    // {

    //     $product = SanPham::find($request->san_pham_id);
    //     $customer = Auth::guard('TaiKhoan')->user();

    //     if (!$product) {
    //         return response()->json([
    //             'error' => 'Product not found'
    //         ], 404);
    //     }
    //     $quantity = $request->so_luong;

    //     $ten_san_pham = $product->ten_san_pham;

    //     $cart = session()->get('cart', []);

    //     $existingProduct = collect($cart)->first(function ($item) use ($product, $customer) {
    //         return $item['id'] == $product->id && $item['customer_id'] == $customer->id;
    //     });
    //     if ($existingProduct) {
    //         $existingProduct['so_luong'] += $request->so_luong;

    //         $request->session()->put('cart', $cart);
    //     } else {
    //         $cart[] = [
    //             'id'            => $product->id,
    //             'ten_san_pham' => $ten_san_pham,
    //             'gia_ban'      => $product->gia_ban,
    //             'don_gia' => $product->gia_khuyen_mai ? $product->gia_khuyen_mai : $product->gia_ban,
    //             'so_luong' => $quantity,
    //             'customer_id' => $customer->id,
    //         ];
    //     }
    //     // dd($cart);
    //     $request->session()->put('cart', $cart);

    //     return response()->json([
    //         'status'  => true,
    //     ]);
    // }
    public function addToCart(Request $request)
    {
        $product = SanPham::find($request->san_pham_id);
        $customer = Auth::guard('TaiKhoan')->user();

        if (!$product) {
            return response()->json([
                'error' => 'Product not found'
            ], 404);
        }

        $quantity = $request->so_luong;
        $ten_san_pham = $product->ten_san_pham;

        $cart = session()->get('cart', []);

        $existingProductKey = null;
        $existingProduct = collect($cart)->first(function ($item, $key) use ($product, $customer, &$existingProductKey) {
            $existingProductKey = $key;
            return $item['id'] == $product->id && $item['customer_id'] == $customer->id;
        });

        if ($existingProduct) {
            $existingProduct['so_luong'] += $request->so_luong;

            // Cập nhật lại giá trị của phần tử trong mảng
            $cart[$existingProductKey] = $existingProduct;
        } else {
            $cart[] = [
                'id'            => $product->id,
                'ten_san_pham'  => $ten_san_pham,
                'gia_ban'       => $product->gia_ban,
                'don_gia'       => $product->gia_khuyen_mai ? $product->gia_khuyen_mai : $product->gia_ban,
                'so_luong'      => $quantity,
                'customer_id'   => $customer->id,
                'expires_at'    => strtotime('+1 minutes'),
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        return response()->json([
            'status'  => true,
        ]);
    }

    public function updateqty(Request $request)
    {
        $cart = $request->session()->get('cart');
        $itemIndex = array_search($request->id, array_column($cart, 'id'));
        // dd($itemIndex);
        if ($itemIndex !== false) {
            $cart[$itemIndex]['so_luong'] = $request->so_luong;
            session()->put('cart', $cart);

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }


    public function dataCart(Session $request)
    {

        $cart = $request->get('cart');
        // $idcustomer = $cart['customer_id'];
        // dd($cart);


        $customer = Auth::guard('TaiKhoan')->user();
        $customerId = $customer->id;
        // Lọc các phần tử của mảng session dựa trên điều kiện customer_id
        $filteredCart = array_filter($cart, function ($item) use ($customerId) {
        return isset($item['customer_id']) && $item['customer_id'] == $customerId;
        });

        // Chuyển đổi mảng đã lọc thành một mảng kết quả
        $filteredCart = array_values($filteredCart);

        // In ra mảng kết quả
        // dd($filteredCart);

        return response()->json([
            'dataOff'  => $filteredCart,
        ]);
    }
    public function removeCart(Request $request)
    {
        $productId = $request->id;
        $cart = $request->session()->get('cart', []);
        $productIndex = array_search($productId, array_column($cart, 'id'));

        if ($productIndex !== false) {
            array_splice($cart, $productIndex, 1);
            $request->session()->put('cart', $cart);
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                // 'message' => 'Product not found in cart',
            ]);
        }
    }
    public function indexBan(Session $request)
    {
        $value = $request->get('cart');
        // dd($value);
        if (count($value) > 0) {
            // Giỏ hàng không rỗng
            toastr()->success('Hãy chọn bàn');
            return view('customer_off.ban.index');
        } else {
            // Giỏ hàng rỗng
            toastr()->error('Hãy đặt món');
            return redirect('/');
        }
    }
    public function dataBan()
    {
        $ban = Ban::where('is_open', 1)->where('is_open_oder', 1)->get();
        return response()->json([
            'dataBan' => $ban,
        ]);
    }
}
