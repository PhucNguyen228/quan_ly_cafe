<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="index.html" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">KOPPEE</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a
                href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Trang Chủ</a>
                @foreach ($menuCha as $key => $value)
                <a href="/page-off/san-pham/{{$value->id}}" class="nav-item nav-link {{ request()->is('page-off/san-pham/'.$value->id) ? 'active' : '' }}">
                    {{ $value->ten_danh_muc }}
                </a>
                @endforeach
                <a href="/page-off/san-pham-sell" class="nav-item nav-link {{ request()->is('page-off/san-pham-sell') ? 'active' : '' }}">Sản Phẩm Giảm Giá</a>
                <div class="nav-item dropdown">
                    @if (Auth::guard('TaiKhoan')->check())
                        <a href="#" class="nav-link dropdown-toggle"
                            data-toggle="dropdown">{{ Auth::guard('TaiKhoan')->user()->ho_va_ten }}</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="reservation.html" class="dropdown-item">Thông Tin</a>
                            {{-- <a href="testimonial.html" class="dropdown-item">Testimonial</a> --}}
                            @if (Auth::guard('TaiKhoan')->check())
                                <a class="dropdown-item" href="/customer-off/logout">
                                    Logout
                                </a>
                            @endif
                        </div>
                    @else
                        <a class="nav-link" href="/customer-off/login" id="dropdown04" aria-haspopup="true"
                            aria-expanded="false">
                            Đăng Nhập</a>
                        <a class="nav-link" href="/customer_off/register" id="dropdown04" aria-haspopup="true"
                            aria-expanded="false">
                            Đăng Kí </a>
                    @endif
                </div>
                <a href="/customer-off/cart-off"><i class="fa fa-shopping-cart" style="font-size:36px"></i></a>
            </div>
        </div>
    </nav>
</div>
