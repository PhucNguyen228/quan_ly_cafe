@extends('admin.master')
@section('title')
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Medal Card -->
                <div class="col-lg-4 col-12">
                    <div class="row match-height">
                        <!-- Bar Chart - Orders -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card">
                                <div class="card-body pb-50" style="position: relative;">
                                    <h6>Doanh Thu Online</h6>
                                    <label for="start">Start month:</label>

                                    <input type="month" id="doanh_thu_on" name="start" min="2018-03" value="">
                                    <h3 class="font-weight-bolder mb-1 mt-2" id="giaOnline"></h3>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 218px; height: 181px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Bar Chart - Orders -->

                        <!-- Line Chart - Profit -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card card-tiny-line-stats">
                                <div class="card-body pb-50" style="position: relative;">
                                    <h6>Doanh thu Ofline</h6>
                                    <label for="start">Start month:</label>
                                    <input type="month" id="doanh_thu_off" name="start" min="2018-03" value="">
                                    <h3 class="font-weight-bolder mb-1 mt-2" id="giaOffline"></h3>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 218px; height: 181px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Line Chart - Profit -->

                        <!-- Earnings Card -->

                        <!--/ Earnings Card -->
                    </div>
                </div>
                <!--/ Medal Card -->

                <!-- Statistics Card -->
                <div class="col-xl-8 col-md-6 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">Số lượng khách hàng</h4>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="media">
                                        <div class="avatar bg-light-info mr-2">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-user avatar-icon">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto" id="demCustomer">
                                            <h4 class="font-weight-bolder mb-0 demTK">

                                            </h4>
                                            <p class="card-text font-small-3 mb-0">Customers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>


        </section>
        <!-- Dashboard Ecommerce ends -->

    </div>

    <form class="row ml-lg-1" method="POST" autocomplete="off">
        @csrf
        <div class="col-md-2">
            <span>Từ Năm: </span>
            <input type="number" class="form-control" name="datepicker" id="datepicker" />
            <button type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm">Lọc kết quả</button>
        </div>
    </form>
    <div class="col-md-12">
        <div id="Chart" style="height: 250px;">
            {{-- {{ $get }} --}}
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

            // chart30days();
            var chart = new Morris.Bar({
                element: 'Chart',
                lineColors: ['#0b62a4', '#7A92A3', '#4da74d', '#afd8f8'],
                //data
                paseTime: false,
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                paseTime: false,
                xkey: 'Thang_thu_nhap',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['Tong_tien'],
                behaveLinked: true,
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Tháng Thu Nhập', 'Tổng Tiền'],
            });

            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                // alert(from_date);
                // alert(to_date);
                $.ajax({
                    url: "{{ route('admin.doanh_thu.filter') }}",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        _token: _token
                    },
                    success: function(res) {
                        if (res.status == true) {
                            if (res.data.Thang_thu_nhap != 0 || res.data.Tong_tien != 0) {
                                // console.log(data); // In ra dữ liệu trả về để kiểm tra
                                chart.setData(res.data);
                                // console.log(data);
                            }
                        } else {
                            chart.setData(res.data);
                            toastr.error('Không có dữ liệu');
                        }
                    },
                    error: function(res) {
                        var danh_sach_loi = res.responseJSON.errors;
                        $.each(danh_sach_loi, function(key, value) {
                            toastr.error(value[0]);
                        });
                    }
                });
            });

            function loadTableOffline() {
                $.ajax({
                    url: '/admin/dem/customer',
                    type: 'get',
                    success: function(res) {
                        var html = '';
                        var dem = res.demCustomer; // Lấy giá trị của biến dem từ response
                        // console.log(dem);
                        html += '<h4 class="font-weight-bolder mb-0 demTK">' + dem +
                            '</span>';
                        $("#demCustomer .demTK").html(
                            html); // Sử dụng selector đúng để cập nhật nội dung vào phần tử con
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Xử lý lỗi nếu có
                    }
                });
            }
            // setInterval(function() {
            //     loadTableOffline()
            // }, 1000);
            loadTableOffline();

            $('#doanh_thu_on').change(function() {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                payload = {
                        'ngay_hoa_don': selectedValue,
                    },
                    $.ajax({
                        url: "{{ route('admin.doanh_thu_on') }}",
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status == true) {
                                $("#giaOnline").text(formatNumber(res.tong));
                            } else {
                                toastr.error("Không có dữ liệu");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // Xử lý lỗi nếu có
                        }
                    });
            });

            $('#doanh_thu_off').change(function() {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                payload = {
                        'ngay_hoa_don': selectedValue,
                    },
                    $.ajax({
                        url: "{{ route('admin.doanh_thu_off') }}",
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status == true) {
                                $("#giaOffline").text(formatNumber(res.tong));
                            } else {
                                toastr.error("Không có dữ liệu");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // Xử lý lỗi nếu có
                        }
                    });
            });

            function formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            }
        });
    </script>
@endsection
