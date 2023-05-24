<!DOCTYPE html>
<!--
Template Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/vuexy_admin
Renew Support: https://1.envato.market/vuexy_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('admin.shares.head')
    <style>
        <style>button.doiTrangThai.btn.btn-primary {
            margin-left: 13px;
        }

        button.doiTrangThai.btn.btn-danger {
            margin-left: 6px;
        }

        .row.col-md-12 {
            margin-left: 1px;
        }

        .row.col-md-3 {
            margin-top: 30px;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    @include('admin.shares.top')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('admin.shares.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">


                    <div class="content-wrapper">
                        <div class="content-header row">
                            <div class="content-header-left col-md-12 mb-2">
                                @yield('title')
                            </div>
                            {{-- <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings icon-left"></i> Settings</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Bootstrap Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons Extended</a></div>
                    </div><a class="btn btn-outline-primary" href="full-calender-basic.html"><i class="feather icon-mail"></i></a><a class="btn btn-outline-primary" href="timeline-center.html"><i class="feather icon-pie-chart"></i></a>
                </div>
            </div> --}}
                        </div>
                        <div class="content-body">
                            @yield('content')
                        </div>
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->

    <!-- Customizer header -->


    <!-- Styling & Text Direction -->


    <!-- Menu -->


    <!-- Layout Width -->


    <!-- Navbar -->


    <!-- Footer -->

    <!-- End: Customizer-->

    <!-- Buynow Button-->



    <!-- BEGIN: Footer-->
    @include('admin.shares.foot')
    <!-- END: Footer-->


    @include('admin.shares.bot')
    @yield('js')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
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

            function loadTable() {
                $.ajax({
                    url: '/admin/dem',
                    type: 'get',
                    success: function(res) {
                        var html = '';
                        var dem = res.demDonHang; // Lấy giá trị của biến dem từ response
                        // console.log(dem);
                        html += '<span class="cricel badge-pill badge-danger badge-up">' + dem +
                            '</span>';
                        $("#loaddem .badge-up").html(html); // Sử dụng selector đúng để cập nhật nội dung vào phần tử con
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Xử lý lỗi nếu có
                    }
                });
            }
            setInterval(function() {
                loadTable()
            }, 1000);

            function loadTableOffline() {
                $.ajax({
                    url: '/admin/dem/offline',
                    type: 'get',
                    success: function(res) {
                        var html = '';
                        var dem = res.demOffline; // Lấy giá trị của biến dem từ response
                        // console.log(dem);
                        html += '<span class="cricel badge-pill badge-danger badge-up offline">' + dem +
                            '</span>';
                        $("#loaddemoffline .offline").html(html); // Sử dụng selector đúng để cập nhật nội dung vào phần tử con
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Xử lý lỗi nếu có
                    }
                });
            }
            setInterval(function() {
                loadTableOffline()
            }, 1000);
        });
    </script>
</body>
<!-- END: Body-->

</html>
