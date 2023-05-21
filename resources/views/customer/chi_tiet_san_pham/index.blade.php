@extends('home_page_online.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $data->anh_dai_dien }}" alt="{{ $data->ten_san_pham }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $data->ten_san_pham }}</h2>
                <div class="row">
                    <div class="col-md-9">
                        <div data-idhailong="{{$data->id}}" class="col-md-4 btn btn-success hailong">
                            <b>Hài Lòng</b>
                        </div>
                        <div data-idkhonghailong="{{$data->id}}" class="col-md-5 btn btn-success khonghailong">
                            <b>Không Hài Lòng</b>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px">
                    @if ($data->gia_khuyen_mai == 0)
                        <p class="price-sale" style="margin-top: 10px"> Gía Hiện Tại :{{ $data->gia_ban }}đ</p>
                    @else
                        <p class="price-sale">Gía Hiện Tại :{{ $data->gia_khuyen_mai }}đ</p>
                        <p class="price-dc">Gía gốc :<del>{{ $data->gia_ban }}đ</del></p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary addToCart" data-id="{{ $data->id }}">Add to cart</button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.hailong', function() {
                var id = $(this).data('idhailong');
            //     // console.log(id);
                $.ajax({
                url     :     '/cafe/customer/hai-long/' + id,
                type    :     'get',
                success :     function(res) {
                    if(res.status){
                        toastr.success('đã đánh giá hài lòng!');
                    }
                },
                });
            });
            $('body').on('click', '.khonghailong', function() {
                var id = $(this).data('idkhonghailong');
            //     // console.log(id);
                $.ajax({
                url     :     '/cafe/customer/khong-hai-long/' + id,
                type    :     'get',
                success :     function(res) {
                    if(res.status){
                        toastr.success('đã đánh giá không hài lòng!');
                    }
                },
                });
            });
        })
    </script>
@endsection
