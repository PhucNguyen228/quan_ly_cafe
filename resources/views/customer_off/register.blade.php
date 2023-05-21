<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastr_css
</head>

<body>
    <div class="navbar-header d-xl-block d-none " style="text-align: center">

    </div>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-2 mx-1 mx-md-4 mt-2">Sign up</p>
                                    <form class="mx-1 mx-md-4" autocomplete="off">
                                        <div id="messeger">

                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="ho_va_ten" class="form-control" />
                                                <label class="form-label">Họ Và Tên</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="phone" id="so_dien_thoai" class="form-control" />
                                                <label class="form-label">Số Điện Thoại</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="email" class="form-control" />
                                                <label class="form-label">Email</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password" class="form-control" />
                                                <label class="form-label">Mật Khẩu</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="re_password" class="form-control" />
                                                <label class="form-label">Nhập Lại Mật Khẩu</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <input class="form-check-input" id="agree" type="checkbox" value="" />
                                            <label class="form-check-label">
                                                I agree all statements in <a href="">Terms of service</a>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button id="register" type="button"
                                                class="btn btn-primary btn-lg">Register</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="https://tailieufree.net/wp-content/uploads/2021/01/hinh-nen-hat-cafe-9.jpg"
                                        class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @jquery
    @toastr_js
    @toastr_render
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#register").click(function(e) {
                var payload = {
                    'ho_va_ten'     : $("#ho_va_ten").val(),
                    'so_dien_thoai' : $("#so_dien_thoai").val(),
                    'email'         : $("#email").val(),
                    'password'      : $("#password").val(),
                    're_password'   : $("#re_password").val(),
                    'agree'         : $('#agree').get(0).checked,
                };

                console.log(payload);

                $.ajax({
                    url     :   '/customer_off/register',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        // $("#messeger").append('<div class="alert alert-success " role="alert"> Vui lòng kiểm tra Email để kích hoạt tài khoản</div>');
                        if(res.status){
                            // console.log(res.status);
                            toastr.success("Bạn đã đăng kí mời bạn check mail !!!");
                            // setTimeout(function(){
                            //     $(location).attr('href','http://127.0.0.1:8000/agent/login');;
                            // }, 2000);
                        }
                    },
                    error   :   function(res) {
                        var danh_sach_loi = res.responseJSON.errors;
                        $.each(danh_sach_loi, function(key, value){
                            toastr.error(value[0]);
                        });
                    },
                });
            });
        });
    </script>
</body>

</html>
