@extends('home_page_off.master')
@section('title')
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Ordered Product</h4>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card" style="margin-left: 10px">
                <div class="card-body" style="text-align: center">
                <table style="overflow-x: scroll"  class="mb-0 table table-bordered" id="tableCustomerOff">
                    <thead>
                        <tr>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Gía</th>
                            <th class="text-center">Số Lượng</th>
                            <th class="text-center">Tổng cộng</th>
                            <th class="text-center">Remove</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>
            </div>
        </div>


    </div>
    <div class="row justify-content-end">
        <div class="col-md-12 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated" style="text-align: right">
            <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="total-price">
                    <span>Total: </span>
                    <span style="font-size: 20px" id="tongTien"></span>
                </p>
            </div>
            <p><a id="creatHoaDon" href="/customer-off/ban/index" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>
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
                console.log(123);
                $.ajax({
                    url: '/customer-off/cart-off/data',
                    type: 'get',
                    success: function(res) {
                        // console.log(res.dataOff);
                        var content_table = '';
                        var tongtien = 0;
                        var tongTienThuc = 0;
                        var tienGiam = 0;
                        // var du_lieu = res.dataOf[items];
                        // console.log(du_lieu);
                        $.each(res.dataOff, function(key, value) {
                            // console.log(res.dataOff);
                            content_table += '<tr class="align-middle">';
                            content_table += '<td> ' + value.ten_san_pham + ' </td>';
                            content_table += ' <td class="product-price">';
                            content_table += ' <span class="amount">' + value.don_gia +
                                '</span>';
                            content_table += ' </td>';
                            content_table += '<td>';
                            content_table +=
                                '<input type="number" min=1 class="form-control qty" value="' +
                                value.so_luong + '" data-id="' + value.id + '">';
                            content_table += '</td>';
                            content_table += '<td >' + formatNumber(value.so_luong * value
                                .don_gia) + '</td>';
                            content_table += '<td class="text-center">';
                            content_table +=
                                '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                value.id +
                                '" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                            content_table += '</td>';
                            content_table += '</tr>';
                            tongtien = tongtien + value.so_luong * value.don_gia;
                            // tongTienThuc = tongTienThuc + value.gia_ban * value.so_luong;
                            // tienGiam = tongTienThuc - tongtien;
                        });
                        $("#tableCustomerOff tbody").html(content_table);
                        $("#tongTien").text(formatNumber(tongtien));
                    },

                });
            }
            loadTable();

            function formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            }

            $("body").on('change', '.qty', function() {
                var payload = {
                    'id': $(this).data('id'),
                    'so_luong': $(this).val(),
                };
                console.log(payload);

                $.ajax({
                    url: '/customer-off/cart-off/updateqty',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status == true) {
                            toastr.success('Cập nhật thành công');
                            loadTable();
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });
            $('body').on('click', '.delete', function(){
                // var a = [
                //     'id'   : $("#idDelete").val(),
                // ]
                var id = $(this).data('iddelete');
                $.ajax({
                    url: '/customer-off/remove/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Đã xóa  thành công!');
                            loadTable();
                        } else {
                            toastr.error('không tồn tại!');
                        }
                    },
                });
            });
        });
    </script>
@endsection
