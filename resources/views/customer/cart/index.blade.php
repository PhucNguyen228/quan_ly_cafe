@extends('home_page_online.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card" style="margin-left: 10px">
                {{-- <div class="card-body" style="text-align: center"> --}}
                <table style="overflow-x: scroll" class="mb-0 table table-bordered" id="tableCustomer">
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
                {{-- </div> --}}
            </div>
        </div>
        <div class="row">
            <!-- Cart Button Start -->
            {{-- <div class="col-md-8 col-sm-12">

         </div> --}}
            <!-- Cart Button Start -->
            <!-- Cart Totals Start -->

            {{-- <div class="col-md-6 col-sm-12" style="text-align: center">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <b >Họ và tên</b>
                            <input type="text" class="form-control" id="ho_va_ten"
                                placeholder="Nhập vào tên">
                        </fieldset>
                    </div>
                </div>
            </div>
            <div style="text-align: right" class="col-md-6 col-sm-6">
                <div class="cart_totals float-md-right text-md-right">
                    <h2>Cart Totals</h2>
                    <div id="price " style="margin-bottom: 20px; font-size: 30px">
                        <span>Tổng tiền Thực: <span id="tongTienThuc" class="text-danger font-weight-bold"></span></span>
                    </div>
                    <div id="price " style="margin-bottom: 20px; font-size: 30px">
                        <span>Tổng tiền giảm: <span id="tongTienGiam" class="text-danger font-weight-bold"></span></span>
                    </div>
                    <div id="price " style="margin-bottom: 20px; font-size: 30px">
                        <span>Tổng tiền trả: <span id="tongTien" class="text-danger font-weight-bold"></span></span>
                    </div>
                    <div class="wc-proceed-to-checkout">
                        <a id="creatHoaDon" class="btn btn-danger " href="#">Proceed to Checkout</a>
                    </div>
                </div>
            </div> --}}

            <div class="row justify-content-around">
                <div class="col-lg-7 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                    <div class="container">
                        <div id="myMap" style="position:relative;width:750px;height:300px;"></div>
                        <b>Nhập thông tin địa chỉ</b>
                        <form action="">
                            <input type="text" id="address" name="address" value=""
                                placeholder="nhập địa chỉ số nhà" />
                            <select name="" id="province">
                            </select>
                            <select name="" id="district">
                                <option value="">chọn quận</option>
                            </select>
                            <select name="" id="ward">
                                <option value="">chọn phường</option>
                            </select>
                        </form>


                        <h2 id="result"></h2>
                    </div>
                </div>

                <div class="col-lg-3 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                    <div class="cart-total mb-3">
                        <h3>Thông tin và địa chỉ giao hàng</h3>
                        <p>Nhập thông tin</p>
                        <form action="#" class="info" id="resetform">
                            <div class="form-group">
                                <label for="">Họ tên </label>
                                <input name="ho_va_ten" value="{{ $customer->ho_va_ten }}" id="ho_va_ten" type="text"
                                    class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Số điện thoại</label>
                                <input id="so_dien_thoai" name="so_dien_thoai" value="{{ $customer->so_dien_thoai }}"
                                    type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Địa chỉ nhận hàng</label>
                                <input id="dia_chi" type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Khoảng cách</label>
                                <input id="distance" type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-lg-2 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Gía tiền: </span>
                            <span style="font-size: 20px" id="tongTienThuc"></span>
                        </p>
                        <p class="d-flex">
                            <span>Gía giảm: </span>
                            <span style="font-size: 20px" id="tongTienGiam">0&nbsp;₫</span>
                        </p>
                        <p class="d-flex">
                            <span>Tiền Vận Chuyển: </span>
                        <h4 style="font-size: 20px" id="tienVanChuyen">0&nbsp;₫</h4>
                        {{-- <input type="text" style="font-size: 20px" id="tienVanChuyen"> --}}
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total: </span>
                            <span style="font-size: 20px" id="tongTien"></span>
                        <p style="color: red">Tiền chưa bao gồm vận chuyển</p>
                        </p>
                    </div>

                    <p><a id="creatHoaDon" href="#" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>

                </div>
            </div>
            <!-- Cart Totals End -->
        </div>
    </div>
@endsection
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xóa </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
                <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDelete" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa </button>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
        integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type='text/javascript'
        src='http://www.bing.com/api/maps/mapcontrol?branch=release&callback=GetMap&key=AtZYD2JEyo37y8a4FhMiuv2uhn8lwxAcVBrz6GVAyHYl3CGlU051CUAgUqifmAUw'
        async defer></script>
    <script>
        // // 1. what is API
        // // 2. How do I call API
        // // 3. Explain code
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "province");
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district");
                });
        }
        var callApiWard = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward");
                });
        }

        var renderData = (array, select) => {
            let row = ' <option disable value="">chọn</option>';
            array.forEach(element => {
                row += `<option value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        $("#province").change(() => {
            callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
            printResult();
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").val() + "?depth=2");
            printResult();
        });
        $("#ward").change(() => {
            printResult();
        })

        var printResult = () => {
            if ($("#district").val() != "" && $("#province").val() != "" && $("#ward").val() != "") {
                let address = $("#address").val();
                let province = $("#province option:selected").text();
                let district = $("#district option:selected").text();
                let ward = $("#ward option:selected").text();

                let result = address + ", " + province + " " + district + " " + ward;
                document.getElementById('dia_chi').value = result;
                geocodeAddress(result);
            }
        }

        var map, searchManager;

        function GetMap() {
            map = new Microsoft.Maps.Map('#myMap', {});
        }

        function geocodeAddress(result) {
            Microsoft.Maps.loadModule(['Microsoft.Maps.Search', 'Microsoft.Maps.SpatialMath'], function() {
                var geocoder = new Microsoft.Maps.Search.SearchManager(map);
                var address = result;

                geocoder.geocode({
                    where: address,
                    callback: function(result) {
                        var location = result.results[0].location;
                        var latitude = location.latitude;
                        var longitude = location.longitude;
                        console.log('Latitude: ' + latitude + ', Longitude: ' + longitude);
                        var defaultLocation = new Microsoft.Maps.Location(16.057087, 108.1747995);
                        var pushpin = new Microsoft.Maps.Pushpin(location);
                        var defaultPushpin = new Microsoft.Maps.Pushpin(defaultLocation);

                        map.entities.push(pushpin);
                        map.entities.push(defaultPushpin);

                        var distance = Microsoft.Maps.SpatialMath.getDistanceTo(
                            location,
                            defaultLocation,
                            Microsoft.Maps.SpatialMath.DistanceUnits
                            .Kilometers // Thêm đơn vị đo khoảng cách
                        );

                        // alert('Khoảng cách giữa hai địa chỉ là: ' + distance + ' Km');
                        // i want show distance in input
                        document.getElementById('distance').value = distance.toFixed(0);

                        var tienVanChuyen = distance.toFixed(0) * 5000;
                        var tienVanChuyenSpan = document.getElementById('tienVanChuyen');
                        tienVanChuyenSpan.textContent = formatNumber(tienVanChuyen);
                    },
                    errorCallback: function(e) {
                        alert('Không thể tìm thấy địa chỉ');
                    }
                });
            });
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('vi-VI', {
                style: 'currency',
                currency: 'VND'
            }).format(number);
        }
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
                    url: '/cafe/customer/cart/data',
                    type: 'get',
                    success: function(res) {
                        var content_table = '';
                        var tongtien = 0;
                        var tongTienThuc = 0;
                        var tienGiam = 0;

                        $.each(res.data, function(key, value) {
                            console.log(value);
                            content_table += '<tr class="align-middle">';
                            content_table += '<td> ' + value.ten_san_pham + ' </td>';
                            content_table += ' <td class="product-price">';
                            content_table += ' <span class="amount">' + value.don_gia +
                                '</span>';
                            content_table += ' </td>';
                            content_table += '<td>';
                            content_table +=
                                '<input type="number" min=1 class="form-control qty" value="' +
                                value.so_luong + '" data-id=' + value.id + '>';
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
                            tongTienThuc = tongTienThuc + value.gia_ban * value.so_luong;
                            tienGiam = tongTienThuc - tongtien;
                        });
                        $("#tableCustomer tbody").html(content_table);
                        $("#tongTien").text(formatNumber(tongtien));
                        $("#tongTienThuc").text(formatNumber(tongTienThuc));
                        $("#tongTienGiam").text(formatNumber(tienGiam));
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

                $.ajax({
                    url: '/cafe/customer/cart/updateqty',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status == false) {
                            toastr.error('Số lượng lớn hơn 50 hoặc số lượng nhỏ hơn 0');
                            loadTable();
                        } else {
                            toastr.success("Đã cập nhật số lượng sản phẩm!");
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
            $('body').on('click', '.delete', function() {
                var getId = $(this).data('iddelete');
                $("#idDelete").val(getId);
            });
            $("#accpectDelete").click(function() {
                // var a = [
                //     'id'   : $("#idDelete").val(),
                // ]
                var id = $("#idDelete").val();
                $.ajax({
                    url: '/cafe/customer/cart/remove/' + id,
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
            $("#creatHoaDon").click(function(e) {
                e.preventDefault();
                var ho_va_ten = $("#ho_va_ten").val();
                var so_dien_thoai = $("#so_dien_thoai").val();
                var dia_chi = $("#dia_chi").val();
                var distance = $("#distance").val();
                var distanceInt = parseInt(distance.match(/\d+/g).join(''), 10);
                // console.log(distanceInt);


                var Total = $("#tongTien").text();
                var thuc_tra = Total.match(/\d+/g).join('');

                var TienThuc = $("#tongTienThuc").text();
                var tongTienThuc = TienThuc.match(/\d+/g).join('');
                // var tongTienThuc = parseInt(TienThuc);
                // console.log(tongTienThuc);

                var giamGia = $("#tongTienGiam").text();
                var tongTienGiam = giamGia.match(/\d+/g).join('');

                if (distance <= 5) {
                    // console.log(typeof(distanceInt * 5000));
                    // console.log(distanceInt * 5000);
                    var tongtienthuctra = parseInt(thuc_tra) + (distanceInt * 5000);
                    var tongtienchuagiam = parseInt(tongTienThuc) + (distanceInt * 5000);
                    var payload = {
                        'ho_va_ten': ho_va_ten,
                        'so_dien_thoai': so_dien_thoai,
                        'dia_chi': dia_chi,
                        'tong_tien': tongtienchuagiam,
                        'giam_gia': tongTienGiam,
                        'thuc_tra': tongtienthuctra,
                    };
                    // console.log(payload);
                    $.ajax({
                        url: '/cafe/customer/create-don-hang-online',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status == 1) {
                                toastr.success("Đã tạo đơn hàng thành công!");
                                loadTable();
                            } else if (res.status == 0) {
                                toastr.success("có lỗi xãy ra");

                            } else {
                                toastr.warning("giỏ hàng bị rỗng !")
                            }
                        },
                    });
                } else {
                    toastr.warning("không giao hàng quá 5km !");
                }

            });
        });
    </script>
@endsection
