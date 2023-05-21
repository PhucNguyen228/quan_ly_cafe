@extends('admin.master')
@section('title')
    <div style="text-align: center">
        <h3>Quản Lý Hóa Đơn Online</h3>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div style="overflow: scroll;">
                <div style="text-align: center">
                    <h3>Các đơn hàng</h3>
                </div>

                <table class="table" id="tableLeft">
                    <thead>
                        <tr>
                            <th scope="col" class="text-nowrap">#</th>
                            <th scope="col" class="text-nowrap">Mã hóa đơn</th>
                            <th scope="col" class="text-nowrap">Ngày đặt</th>
                            <th scope="col" class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-7">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: center">
                    <h5 class="card-title">HÓA ĐƠN</h5>
                    <div>
                        <p>Tên : </p>
                        <h3 id="ho_va_ten"></h3>
                        <p>Số Điện Thoại : </p>
                        <h4 id="so_dien_thoai"></h4>
                        <p>Địa chỉ : </p>
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
                            <div class="cart float-md-right text-md-right" class="wc-proceed-to-checkout">
                                <input type="hidden" id="id_hoa_don_thanh_toan">
                                <a id="inBill" class="btn btn-danger" href="#">INVOICE</a>
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
                    url: '/admin/hoa-don-online/data',
                    type: 'get',
                    success: function(res) {
                        var html = '';
                        $.each(res.dataOnline, function(key, value) {
                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<td>'+ value.ma_hoa_don +'</td>';
                            html += '<td>' + value.ngay_hoa_don + '</td>';
                            html += '<td class="text-center">';
                            html += '<button class="btn btn-danger mr-1 show" data-idshow="' +
                                value.id + '" data-toggle="modal" >Xem</button>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $("#tableLeft tbody").html(html);
                    },
                });
            }
            setInterval(function() {
                loadTableLeft()
            }, 1000);

            function loadTableRight(id){
                $.ajax({
                    url     :   '/admin/hoa-don-online/data-hoa-don/'+ id,
                    type    :   'get',
                    success :   function(res) {
                        var content_table = '';
                        var tongTien = 0;
                        var tongTienGiam = 0;
                        var tongTienThucTra = 0;
                        var ho_va_ten = '';
                        var so_dien_thoai = '';
                        var dia_chi = '';
                        $("#id_hoa_don_thanh_toan").val(id);
                        // console.log($hihi);
                        $.each(res.dataHoaDon, function(key, value) {
                        content_table += '<tr>';
                        content_table += '<th class="text-center" scope="row">' + (key + 1) +'</th>';
                        content_table += '<td> ' + value.ten_san_pham +' </td>';
                        content_table += '<td> ' + value.don_gia + ' </td>';
                        content_table += '<td> ' + value.so_luong + ' </td>';
                        content_table += '<td> ' + value.so_luong * value.don_gia + ' </td>';
                        content_table += '</td>';
                        content_table += '</tr>';
                        tongTien =  value.tong_tien;
                        tongTienGiam = value.tien_giam_gia;
                        tongTienThucTra =  value.thuc_tra;
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
            function formatNumber(number){
                return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
            }
            function integer(int) {
                var fomatinteger = '0'+int;
                return fomatinteger;
            }
            $('body').on('click','.show',function(){
                var id = $(this).data('idshow');
                $.ajax({
                    url     :   '/admin/hoa-don-online/' + id,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            loadTableRight(id);
                        }
                    },
                });
            })
            $('body').on('click','#inBill',function(){
                var id = $("#id_hoa_don_thanh_toan").val();
                $.ajax({
                    url     :'/admin/hoa-don-online/in-bill/'+ id,
                    type    : 'get',
                    success : function(res) {
                        if(res.status == 1){
                            toastr.success("Đã in bill thành công!");
                            loadTableRight();
                            loadTableLeft();
                        }else{
                            toastr.warning("Bill Rỗng !")
                        }
                    },
                });
            })
        });
    </script>
@endsection
