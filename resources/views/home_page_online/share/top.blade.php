<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>120 Hòa Minh Thảo, Hòa Khánh Nam, Liên Chiểu, Đà Nẵng</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>trankimthat2603@gmail.com</small>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0 home">KO<span class="text-secondary">PP</span>EE</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/cafe/homepage" style="color: yellowgreen" class="nav-item nav-link active home">Trang Chủ</a>
                <a href="/cafe/sell" class="nav-item nav-link">Sản Phẩm Giảm giá</a>

                <a href="/cafe/lien-he/index" class="nav-item nav-link">Liên Hệ</a>
                <div class="nav-item dropdown">
                    @if (Auth::guard('TaiKhoan')->check())
                        {{-- <a href="contact.html" class="nav-item nav-link">
                            {{ Auth::guard('Customer')->user()->ho_va_ten }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="/customer/thong-tin/index">Thông tin</a>
                            <a class="dropdown-item" href="/customer/don-hang">Đơn hàng</a>
                            @if (Auth::guard('Customer')->check())
                                <a class="dropdown-item" href="/cafe/customer/logout">
                                    Logout
                                </a>
                            @endif
                        </div> --}}
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle show" data-bs-toggle="dropdown" aria-expanded="true">{{ Auth::guard('TaiKhoan')->user()->ho_va_ten }}</a>
                            <div class="dropdown-menu m-0 show" data-bs-popper="none">
                                <a href="/cafe/customer/thong-tin" class="dropdown-item">Thông tin cá nhân</a>
                                <a href="/cafe/customer/don-hang" class="dropdown-item">Thông tin đơn hàng</a>
                                @if (Auth::guard('TaiKhoan')->check())
                                <a class="dropdown-item" href="/cafe/customer/logout">
                                    Logout
                                </a>
                            @endif
                            </div>
                        </div>
                    @else
                        <a class="nav-link" href="/cafe/customer/login" id="dropdown04" aria-haspopup="true" aria-expanded="false">
                            Login </a>
                            <a class="nav-link" href="/cafe/customer/register" id="dropdown04" aria-haspopup="true" aria-expanded="false">
                                Register </a>
                    @endif
                </div>
            </div>
            <div class="d-none d-lg-flex ms-2">

                {{-- <small style="font-size: 30px" class="fa fa-user  text-body">

                    <a href=""><i class="lnr "></i>
                        @if (Auth::guard('agent')->check())
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">{{ Auth::guard('agent')->user()->ho_va_ten }} </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="/customer/thong-tin/index">Thông tin</a>
                                <a class="dropdown-item" href="/customer/don-hang">Đơn hàng</a>
                                @if (Auth::guard('agent')->check())
                                    <a class="dropdown-item" href="/logout">
                                        Logout
                                    </a>
                                @endif
                            </div>
                        </li>
                    @else
                        <li class="nav-item ">
                            <a class="nav-link" href="/login" id="dropdown04" aria-haspopup="true"
                                aria-expanded="false"> Singin </a>
                        </li>
                    @endif
                    </a>
                </small> --}}
                <a style="font-size: 30px" class="btn-sm-square bg-white rounded-circle ms-3" href="/cafe/customer/cart/index">
                    <small class="fa fa-shopping-bag text-body"></small>
                </a>

            </div>
        </div>
    </nav>
</div>
