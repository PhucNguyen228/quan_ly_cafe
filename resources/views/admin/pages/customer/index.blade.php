@extends('admin.master')
@section('title')
<div style="text-align: center">
    <h3>Quản Lý Tài Khoản Khách Hàng</h3>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: center"><h5 class="card-title">Table Quản Lý Khách Hàng</h5>
                    <table class="mb-0 table table-bordered" id="tableCustomer">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Họ Và Tên</th>
                                <th class="text-center">Số Điện Thoại</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Tình Trạng</th>
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Xóa Tài Khoản</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
            <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDeleteShipper" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa </button>
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
    function loadTable(){
        $.ajax({
                url     :   '/admin/customer/dulieu',
                type    :   'get',
            success :   function(res) {
                    var content_table = '';
                    $.each(res.dulieuCustomer, function(key, value) {
                    if(value.is_open) {
                            var class_button = 'btn-primary';
                            var text_button  = 'Hiển thị';
                    } else {
                            var text_button  = 'Tạm tắt';
                            var class_button = 'btn-danger';
                    }
                        content_table += '<tr>';
                        content_table += '<th class="text-center" scope="row">' + (key + 1) +'</th>';
                        content_table += '<td> ' + value.ho_va_ten +' </td>';
                        content_table += '<td> ' + value.so_dien_thoai +' </td>';
                        content_table += '<td> ' + value.email +' </td>';
                        content_table += '<td class="text-center">';
                        content_table += '<button data-id="'+ value.id +'" class="doiTrangThai btn '+ class_button +'">';
                        content_table +=  text_button;
                        content_table += '</button></td>';
                        content_table += '<td class="text-center">';
                        content_table += '<button class="btn btn-danger delete mr-1" data-iddelete="'+ value.id +'" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                        content_table += '</td>';
                        content_table += '</tr>';
                    });
                    $("#tableCustomer tbody").html(content_table);
            },
        });
    }
    loadTable();
    $('body').on('click','.doiTrangThai',function(){
            var idUser = $(this).data('id');
            var self = $(this);
            $.ajax({
                url     :     '/admin/customer/doi-trang-thai/' + idUser,
                type    :     'get',
                success :     function(res) {
                    if(res.trangThai) {
                        toastr.success('Đã đổi trạng thái thành công!');
                        // Tình trạng mới là true
                        // loadTable();
                        if(res.tinhTrangCustomer == true){
                            self.html('Hiển Thị');
                            self.removeClass('btn-danger');
                            self.addClass('btn-primary');
                        } else {
                            self.html('Tạm Tắt');
                            self.removeClass('btn-primary');
                            self.addClass('btn-danger');
                        }
                    } else {
                        toastr.error('Vui lòng không can thiệp hệ thống!');
                    }
                },
            });
        });
        $('body').on('click','.delete',function(){
            var getId = $(this).data('iddelete');
            $("#idDeleteShipper").val(getId);
        });

        $("#accpectDelete").click(function(){
            var id = $("#idDeleteShipper").val();
            $.ajax({
                url     :   '/admin/customer/delete/' + id,
                type    :   'get',
                success :   function(res) {
                    if(res.status) {
                        toastr.success('Đã xóa tài khoản thành công!');
                        loadTable();
                    } else {
                        toastr.error('Tài khoản không tồn tại!');
                    }
                },
            });
        });
});
</script>

@endsection
