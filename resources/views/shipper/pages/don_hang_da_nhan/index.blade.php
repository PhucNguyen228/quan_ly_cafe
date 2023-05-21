@extends('shipper.master')
@section('title')
    <div style="text-align: center">
        <h3>Đơn hàng đã nhận</h3>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                            <th scope="col" class="text-nowrap">Xem</th>
                            <th scope="col" class="text-nowrap">Giao</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
<div class="modal fade" id="seen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Đơn hàng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div style="overflow-x: scroll;text-align: center" class="modal-body" >
            <input type="text" id="id_edit" hidden>
            <div class="position-relative form-group">
                <label style="color:red;">Tên khách hàng</label>
                <p id="ho_va_ten"></p>
            </div>
            <div class="position-relative form-group">
                <label style="color:red;">Số điện thoại</label>
               <p id="so_dien_thoai"></p>
            </div>
            <div class="position-relative form-group">
                <label style="color:red;">Địa chỉ</label>
               <p id="dia_chi"></p>
            </div>
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
                <h3>Cart Totals</h3>
                <div class="row">
                    <div class="cart float-md-left text-md-left" id="TongTienHang "
                        style="margin-bottom: 20px; font-size: 20px">
                        <span>Tổng tiền hàng: <span id="tongTien"
                                class="text-danger font-weight-bold"></span></span>
                    </div>
                </div>

                <div class="row">
                    <div class="cart float-md-left text-md-left" id="TienGiam "
                        style="margin-bottom: 20px; font-size: 20px">
                        <span>Tổng tiền giảm: <span id="tongTienGiam"
                                class="text-danger font-weight-bold"></span></span>
                    </div>
                </div>

                <div class="row">
                    <div class="cart float-md-left text-md-left" id="TienTra "
                        style="margin-bottom: 20px; font-size: 20px">
                        <span>Tổng tiền thực trả: <span id="tongTienThucTra"
                                class="text-danger font-weight-bold"></span></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="closeModalUpdate" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
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
                    url: '/shipper/don-nhan/data',
                    type: 'get',
                    success: function(res) {
                        var html = '';
                        $.each(res.data, function(key, value) {
                            if (value.tinh_trang_don_hang == 3) {
                                var doan_muon_hien_thi =
                                    '<div class="btn btn-primary">Giao</div>';
                            }
                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<td>' + value.ma_hoa_don + '</td>';
                            html += '<td>' + value.thuc_tra + '</td>';
                            html += '<td>' + value.ngay_hoa_don + '</td>';
                            html += '<td class="text-center">';
                            html += '<button class="btn btn-danger mr-1 show" data-idshow=' +
                                value.id +
                                ' data-toggle="modal" data-target="#seen" >Xem</button>';
                            html += '</td>';
                            html += '<td class="text-center tinhtrang" data-idhang = "' + value
                                .id + '">' + doan_muon_hien_thi + '</td>';
                            html += '</tr>';
                        });
                        $("#tableDonHang tbody").html(html);
                    },
                });
            }
            loadTable();
            function loadTableRight(id) {
                $.ajax({
                    url: '/shipper/chi-tiet-don-giao/data/' + id,
                    type: 'get',
                    success: function(res) {
                        console.log(res);
                        var content_table = '';
                        var tongTien = 0;
                        var tongTienGiam = 0;
                        var tongTienThucTra = 0;
                        var so_dien_thoai = '';
                        var ho_va_ten = '';
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
            loadTableRight();
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
                    url: '/shipper/chi-tiet-don-giao/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            loadTableRight(id);
                        }
                    },
                });
            });
            $('body').on('click', '.tinhtrang', function() {
                var id = $(this).data('idhang');
                $.ajax({
                    url: '/shipper/da-giao/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success("đã giao hàng thành công!");
                            loadTable();
                        }
                    },
                });
            });
        });
    </script>
@endsection
