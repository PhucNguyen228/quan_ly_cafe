@extends('home_page_online.master')
@section('content')
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Liên hệ</h4>
                <h1 class="display-4">Hãy liên hệ cho chúng tôi</h1>
            </div>
            <div class="row px-3 pb-2">
                <div class="col-sm-4 text-center mb-3">
                    <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                    <h4 class="font-weight-bold">Address</h4>
                    <p>120 Hòa Minh Thảo, Hòa Khánh Nam, Liên Chiểu, Đà Nẵng</p>
                </div>
                <div class="col-sm-4 text-center mb-3">
                    <i class="fa fa-2x fa-phone-alt mb-3 text-primary"></i>
                    <h4 class="font-weight-bold">Phone</h4>
                    <p>+0917513293</p>
                </div>
                <div class="col-sm-4 text-center mb-3">
                    <i class="far fa-2x fa-envelope mb-3 text-primary"></i>
                    <h4 class="font-weight-bold">Email</h4>
                    <p>trankimthat2603@gmail.com</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pb-5">
                    {{-- <iframe style="width: 100%; height: 443px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}
                        <iframe style="width: 100%; height: 443px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.3108356964462!2d108.15789337500432!3d16.049351884627285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421938d61a3ce5%3A0x29d80f3ebbdcb44a!2zxJDhuqFpIEjhu41jIER1eSBUw6JuIEjDsmEgS2jDoW5oIE5hbQ!5e0!3m2!1svi!2s!4v1682412752063!5m2!1svi!2s"
                        frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
