@extends('admin.master')
@section('title')
    <div style="text-align: center">
        <h3>Tình Trạng Hóa Đơn Online</h3>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div style="overflow: scroll;">
                <div style="text-align: center">
                    <h3>Các đơn hàng</h3>
                </div>

                <table class="table" id="tableDonHang">
                    <thead>
                        <tr>
                            <th scope="col" class="text-nowrap">#</th>
                            <th scope="col" class="text-nowrap">Mã hóa đơn</th>
                            <th scope="col" class="text-nowrap">Tiền thanh toán</th>
                            <th scope="col" class="text-nowrap">Ngày đặt</th>
                            <th scope="col" class="text-nowrap">Action</th>
                            <th scope="col" class="text-nowrap">Tình Trạng</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: center">
                    <h5 class="card-title">HÓA ĐƠN</h5>
                    <div>
                        <p>Tên: </p>
                        <h3 id="ho_va_ten"></h3>
                        <p>số điện thoại:</p>
                        <h4 id="so_dien_thoai"></h4>
                        <p>dịa chỉ: </p>
                        <h4 id="dia_chi"></h4>
                    </div>
                    <table class="mb-0 table table-bordered" id="tableRight">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Gía tiền</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                    <div style="text-align: left" class="col-md-12 col-sm-12">
                        <div class="cart_totals ">
                            <h1>Cart Totals</h1>
                            <div class="row">
                                <div class="cart float-md-left text-md-left" id="TongTienHang "
                                    style="margin-bottom: 20px; font-size: 30px">
                                    <span>Tổng tiền hàng: <span id="tongTien"
                                            class="text-danger font-weight-bold"></span></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="cart float-md-left text-md-left" id="TienGiam "
                                    style="margin-bottom: 20px; font-size: 30px">
                                    <span>Tổng tiền giảm: <span id="tongTienGiam"
                                            class="text-danger font-weight-bold"></span></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="cart float-md-left text-md-left" id="TienTra "
                                    style="margin-bottom: 20px; font-size: 30px">
                                    <span>Tổng tiền thực trả: <span id="tongTienThucTra"
                                            class="text-danger font-weight-bold"></span></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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

            function loadTableLeft() {
                $.ajax({
                    url: '/admin/hoa-don-online/tinh-trang-don-hang/data',
                    type: 'get',
                    success: function(res) {
                        var html = '';
                        $.each(res.dataTinhTrang, function(key, value) {
                            if (value.tinh_trang_don_hang == 2) {
                                var doan_muon_hien_thi =
                                    '<div class="btn btn-primary">Đang chờ shipper</div>';
                            } else if (value.tinh_trang_don_hang == 3) {
                                var doan_muon_hien_thi =
                                    '<div class="btn btn-primary">Đang giao</div>';
                            } else if (value.tinh_trang_don_hang == 4) {
                                var doan_muon_hien_thi =
                                    '<div class="btn btn-success">Giao thành công</div>';
                            }
                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<td>' + value.ma_hoa_don + '</td>';
                            html += '<td>' + value.thuc_tra + '</td>';
                            html += '<td>' + value.ngay_hoa_don + '</td>';
                            html += '<td class="text-center">';
                            html += '<button class="btn btn-danger mr-1 show" data-idshow="' +
                                value.id + '" data-toggle="modal" >Xem</button>';
                            html += '</td>';
                            html += '<td class="text-center">' + doan_muon_hien_thi + '</td>';
                            html += '</tr>';
                        });
                        $("#tableDonHang tbody").html(html);
                    },
                });
            }
            loadTableLeft();

            function loadTableRight(id) {
                $.ajax({
                    url: '/admin/hoa-don-online/chi-tiet-don-hang/data/' + id,
                    type: 'get',
                    success: function(res) {
                        var content_table = '';
                        var tongTien = 0;
                        var tongTienGiam = 0;
                        var tongTienThucTra = 0;
                        var ho_va_ten = '';
                        var so_dien_thoai = '';
                        var dia_chi = '';
                        // $("#id_hoa_don_thanh_toan").val(id);
                        // console.log($hihi);
                        $.each(res.data, function(key, value) {
                            content_table += '<tr>';
                            content_table += '<th class="text-center" scope="row">' + (key +
                                1) + '</th>';
                            content_table += '<td> ' + value.ten_san_pham + ' </td>';
                            content_table += '<td> ' + value.don_gia + ' </td>';
                            content_table += '<td> ' + value.so_luong + ' </td>';
                            content_table += '<td> ' + value.so_luong * value.don_gia +
                            ' </td>';
                            content_table += '</td>';
                            content_table += '</tr>';
                            tongTien = value.tong_tien;
                            tongTienGiam = value.tien_giam_gia;
                            tongTienThucTra = value.thuc_tra;
                            ho_va_ten = value.ho_va_ten;
                            so_dien_thoai = value.so_dien_thoai;
                            dia_chi = value.dia_chi;
                        });
                        $("#tableRight tbody").html(content_table);
                        $("#tongTien").text(formatNumber(tongTien));
                        $("#tongTienGiam").text(formatNumber(tongTienGiam));
                        $("#tongTienThucTra").text(formatNumber(tongTienThucTra));
                        $("#ho_va_ten").text(ho_va_ten);
                        $("#so_dien_thoai").text(integer(so_dien_thoai));
                        $("#dia_chi").text(dia_chi);
                    }
                });
            }

            function formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            }
            function integer(int) {
                var fomatinteger = '0'+int;
                return fomatinteger;
            }
            $('body').on('click', '.show', function() {
                var id = $(this).data('idshow');
                $.ajax({
                    url: '/admin/hoa-don-online/chi-tiet-don-hang/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            loadTableRight(id);
                        }
                    },
                });
            });
        });
    </script>
@endsection
