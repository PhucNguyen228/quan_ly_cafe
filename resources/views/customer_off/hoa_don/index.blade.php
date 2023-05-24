@extends('home_page_off.master')
@section('title')
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Hóa Đơn Đã Đặt</h4>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card" style="margin-left: 10px">
                <div class="card-body" style="text-align: center">
                    <table style="overflow-x: scroll" class="mb-0 table table-bordered" id="tableCustomerOff">
                        <thead>
                            <tr>
                                <th class="text-center">Mã Hóa Đơn</th>
                                <th class="text-center">Tổng Thanh Toán</th>
                                <th class="text-center">Mã Bàn</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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

            function loadTable() {
                $.ajax({
                    url: '/customer-off/hoa-don/data',
                    type: 'get',
                    success: function(res) {
                        var content_table = '';
                        $.each(res.dataHoaDon, function(key, value) {
                            if (value.hoan_thanh == 1) {
                                var doan_muon_hien_thi =
                                    '<button class="btn btn-warning">vui lòng đợi </button><button class="btn btn-danger ml-3 delete" data-iddelete= ' +
                                    value.id + '>Hủy</button>';
                            } else if (value.hoan_thanh == 2) {
                                var doan_muon_hien_thi =
                                    '<button class="btn btn-success">Đã xác nhận</button>';
                            }
                            content_table += '<tr>';
                            content_table += '<td>' + value.ma_hoa_don + '</td>';
                            content_table += '<td>' + value.thuc_tra + '</td>';
                            content_table += '<td>' + value.ma_ban + '</td>';
                            content_table += '<td>' + doan_muon_hien_thi + '</td>';
                            content_table += '</tr>';
                        });
                        $("#tableCustomerOff tbody").html(content_table);
                    },
                });
            }
            loadTable();
            $('body').on('click','.delete', function(){
                var id = $(this).data('iddelete')
                $.ajax({
                    url: '/customer-off/huy/don-hang/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success("bạn đã hủy thành công đơn hàng");
                            loadTable();
                        }
                    },
                });
            });
        });
    </script>
@endsection
