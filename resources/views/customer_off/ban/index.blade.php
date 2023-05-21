@extends('home_page_off.master')
@section('title')
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Chọn Bàn</h4>
        </div>
    </div>
@endsection
@section('content')
    <div class = "row " style="text-align: center" id="tableBan">

    </div>
@endsection
@section('js')
<script>
    $(window).on('load',  function(){
      if (feather) {
        feather.replace({ width: 14, height: 14 });
      }
    })
  </script>
  <script>
       $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function loadTable(){
                $.ajax({
                    url     :   '/customer-off/ban/data',
                    type    :   'get',
                    success :   function(res) {
                        var content_table = '';
                        $.each(res.dataBan, function(key, value) {
                            content_table += ' <div class="col-3">'
                            content_table += '<button data-idban='+ value.id +' style="font-size: 50px;" class="rectangle-button createHoaDon">'+ value.ma_ban +'</button>';
                            content_table += '</div>';
                        });
                        $("#tableBan").html(content_table);
                    }
                    });
            }
            loadTable();
            $("body").on('click', '.createHoaDon', function() {
                var id = $(this).data('idban');
                var payload = {
                    'id_ban': id,
                };
                $.ajax({
                    url: '/customer-off/create-hoa-don',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status == true) {
                            toastr.success('đã đặt hàng thành công');
                            setTimeout(function(){
                                $(location).attr('href','http://127.0.0.1:8000/');
                            }, 2000);
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
        });
  </script>
@endsection
