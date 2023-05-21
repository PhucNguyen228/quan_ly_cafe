@extends('home_page_online.master')
@section('content')
    <div class="col-md-12" >
        <div class="card" style="align-items: center">
            <div class="card-content">
                <div class="card-body" >
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                            aria-labelledby="account-pill-general" aria-expanded="true">
                            @if ($errors->any())
                                @foreach ($errors->all() as $key => $value)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $value }}
                                    </div>
                                @endforeach
                            @endif
                            <form autocomplete="off" method="post" action="/cafe/customer/thong-tin/update">
                                @csrf
                                <div class="row">
                                    <input type="text" name="id" value="{{ $dataTK->id }}" hidden>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-username">Tên Tài Khoản</label>
                                                <input type="text" class="form-control" name="ho_va_ten"
                                                    value="{{ $dataTK->ho_va_ten }}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">Email</label>
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ $dataTK->email }}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-e-mail">Số Điện Thoại</label>
                                                <input type="text" class="form-control" name="so_dien_thoai"
                                                    value="{{ $dataTK->so_dien_thoai }}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Cập
                                            Nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
