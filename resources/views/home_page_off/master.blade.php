<!DOCTYPE html>
<html lang="en">

<head>

</head>
@include('home_page_off.share.head')
<style>
    .dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
.addToCart:hover{
    color: red;
}
.rectangle-button {
  width: 250px;
  height: 150px;
  background-color: #007bff;
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}
@media (max-width: 767px) {
  /* Điện thoại */
  .rectangle-button {
    width: 100px;
    height: 50px;
  }
}

@media (min-width: 768px) {
  /* Desktop */
  .rectangle-button {
    width: 250px;
    height: 150px;
  }
}
</style>
<body>
    <!-- Navbar Start -->
    @include('home_page_off.share.top')
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="/home_off_assets/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        {{-- <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2> --}}
                        <h1 class="display-1 text-white m-0">COFFEE</h1>
                        {{-- <h2 class="text-white m-0">* SINCE 1950 *</h2> --}}
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="/home_off_assets/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        {{-- <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2> --}}
                        <h1 class="display-1 text-white m-0">COFFEE</h1>
                        {{-- <h2 class="text-white m-0">* SINCE 1950 *</h2> --}}
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <!-- Service End -->


    <!-- Offer Start -->
    <div class="container-fluid py-5">
        @yield('title')
    </div>

    @yield('content')
    <!-- Testimonial End -->


    <!-- Footer Start -->
    @include('home_page_off.share.foot')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    @include('home_page_off.share.boot')
    @yield('js')
    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.addToCart', function(){

                var san_pham_id = $(this).data('id');
                // console.log(san_pham_id);
                var payload = {
                    'san_pham_id': san_pham_id,
                    'so_luong': 1,
                };

                axios
                    .post('/customer-off/add-to-cart', payload)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.status) {
                            toastr.success("Đã thêm vào giỏ hàng!");
                        }else{
                            toastr.error("bạn cần đăng nhập")
                        }
                    })
                    .catch((res) => {
                        var danh_sach_loi = res.response.data.errors;
                        console.log(danh_sach_loi);
                        $.each(danh_sach_loi, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            });
        });
    </script>
</body>

</html>
