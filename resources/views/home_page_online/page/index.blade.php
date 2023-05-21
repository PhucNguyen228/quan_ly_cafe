@extends('home_page_online.master')
@section('content')
    <div class="container-xxl py-5">
        {{-- <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <fieldset class="form-group position-relative">
                <input id="searchSanPham" name="search_sp" type="text" class="form-control form-control mb-1"
                    placeholder="nhập tên sản phẩm">
            </fieldset>
        </div> --}}

        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-2">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Gọi đồ uống</h1>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>

                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: slideInRight;">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        @foreach ($menuCha as $key => $value)
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary border-2 choose {{ $key == 0 ? 'active' : '' }}"
                                    data-bs-toggle="pill" href="#tab-{{ $value->id }}">{{ $value->ten_danh_muc }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                @foreach ($menuCha as $key => $value)
                    <div id="tab-{{ $value->id }}" class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}">
                        <div class="row g-4">
                            @foreach ($allSanPham as $key_sp => $value_sp)
                                @if (in_array($value_sp->id_danh_muc, explode(',', $value->tmp)))
                                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">

                                            <div class="position-relative bg-light overflow-hidden">
                                                <a href="/cafe/chi-tiet-san-pham/{{ $value_sp->id }}"> <img style="width: 300px;height: 250px;" class="img-sp img-fluid w-100" src="{{ $value_sp->anh_dai_dien }}"
                                                    alt=""></a>

                                            </div>
                                            <div class="text-center p-4 " style = "width: 300px; height: 104px " >
                                                <a class="d-block h5 mb-2" href="/cafe/chi-tiet-san-pham/{{ $value_sp->id }}">{{ $value_sp->ten_san_pham }}</a>
                                                @if ($value_sp->gia_khuyen_mai == 0)
                                                    <span class="text-primary me-1">{{ $value_sp->gia_ban }}</span>
                                                @else
                                                    <span class="text-primary me-1">{{ $value_sp->gia_khuyen_mai }}</span>
                                                    <span
                                                        class="text-body text-decoration-line-through">{{ $value_sp->gia_ban }}</span>
                                                @endif

                                            </div>
                                            <div class="d-flex border-top" style="background-color: rgb(164, 160, 216)">
                                                <small class="w-50 text-center py-2" style="margin-left: 73px">
                                                    <a title="Add to Cart" class="btn addToCart" style="font-size: 1.875em"
                                                        data-id="{{ $value_sp->id }} ">ODER</a>
                                                </small>
                                            </div>
                                        </div>

                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
@endsection
{{-- @section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Định nghĩa hàm cần thực thi
            function myFunction() {
                // Cập nhật các phần tử có class "choose" thành active
                var elements = document.getElementsByClassName("choose");
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList.add("active");
                }
            }

            // Sử dụng setInterval() để thực thi hàm myFunction() mỗi 2 giây
            setInterval(myFunction, 1000);
        });
    </script>
@endsection --}}
