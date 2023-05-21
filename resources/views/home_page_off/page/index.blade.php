@extends('home_page_off.master')
@section('title')
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Sản Phẩm</h4>
            <h1 class="display-4">
                Vui Lòng Tham Khảo Sản Phẩm</h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            {{-- <div class="col-lg-2">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">order a drink</h1>
                </div>
            </div> --}}
            {{-- <div class="col-lg-10"style="text-align: right">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    @foreach ($menuCha as $key => $value)
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 choose {{ $key == 0 ? 'active' : '' }}"
                                data-bs-toggle="pill" href="#tab-{{ $value->id }}">{{ $value->ten_danh_muc }}</a>
                        </li>
                    @endforeach
                </ul>
            </div> --}}

        </div>
        <div class="timkiem mb-5" style="text-align: center">
            <div>
                <b>Tìm kiếm sản phẩm</b>
            </div>
            <input id="searchSanPham" style="width: 100%; height: 50px;" type="text" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="tab-content">
            <div class="row g-4" id="loadPage">


            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadTable() {
                $.ajax({
                    url: '/data',
                    type: 'get',
                    success: function(res) {
                        var content_table = '';
                        $.each(res.data, function(key, value) {
                            content_table +=
                                '<div style="margin-top: 7px" class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">' +
                                '<div class="position-relative bg-light overflow-hidden" style="height: 200px">' +
                                '<img class="img-sp img-fluid w-100 h-100 object-fit-cover" src=' +
                                value
                                .anh_dai_dien + ' alt="">' +
                                '</div>' +
                                '<div class="text-center p-4" style = "width: 100%;height: 100px " > ' +
                                '<span class="d-block h5 mb-2">' + value.ten_san_pham +
                                '</span>';

                            if (value.gia_khuyen_mai == 0) {
                                content_table +=
                                    '<span class="text-primary me-1">' + value.gia_ban +
                                    '</span>';
                            } else {
                                content_table +=
                                    '<span class="text-primary me-1">' + value.gia_khuyen_mai +
                                    '</span><del class="text-body text-decoration-line-through">' +
                                    value.gia_ban + '</del>';
                            }

                            content_table +=
                                '</div>' +
                                '<div class=" border-top" style="background-color: rgb(164, 160, 216);text-align:center ;width: 100%">' +
                                '<small class="w-50 text-center py-2" >' +
                                '<a title="Add to Cart"  class="btn addToCart" style="font-size: 1.875em" data-id=' +
                                value.id + '>ODER</a>' +
                                '</small>' +
                                '</div>' +
                                '</div>';
                        });
                        $("#loadPage").html(content_table);
                    },
                });
            }
            loadTable();
            // setInterval(function() {
            //     loadTable()
            // }, 1000);
            // $('body').$(".addToCart").click(function() {

            // });
            $("#searchSanPham").keyup(function() {
                var search = $("#searchSanPham").val();
                $payload = {
                    'tenSanPham': search,
                };
                $.ajax({
                    url: '/search',
                    type: 'post',
                    data: $payload,
                    success: function(res) {
                        var content_table = '';
                        $.each(res.status, function(key, value) {
                            content_table +=
                                '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">' +
                                '<div class="position-relative bg-light overflow-hidden" style="height: 200px">' +
                                '<img class="img-sp img-fluid w-100 h-100 object-fit-cover" src=' +
                                value
                                .anh_dai_dien + ' alt="">' +
                                '</div>' +
                                '<div class="text-center p-4" style = "width: 250px;height: 100px " >' +
                                '<a class="d-block h5 mb-2" href="">' + value
                                .ten_san_pham +
                                '</a>';

                            if (value.gia_khuyen_mai == 0) {
                                content_table +=
                                    '<span class="text-primary me-1">' + value.gia_ban +
                                    '</span>';
                            } else {
                                content_table += '<span class="text-primary me-1">' +
                                    value
                                    .gia_khuyen_mai + '</span>';
                                content_table +=
                                    '<del class="text-body" style="text-decoration: line-through;">' +
                                    value.gia_ban + '</del>';

                            }

                            content_table +=
                                '</div>' +
                                '<div class="d-flex border-top" style="background-color: rgb(164, 160, 216)">' +
                                '<small class="w-50 text-center py-2" style="margin-left: 73px">' +
                                '<a title="Add to Cart" class="btn addToCart" style="font-size: 1.875em" data-id=' +
                                value.id + '>ODER</a>' +
                                '</small>' +
                                '</div>' +
                                '</div>';
                        });
                        $("#loadPage").html(content_table);
                    },
                });
            });
        });
    </script>
@endsection
