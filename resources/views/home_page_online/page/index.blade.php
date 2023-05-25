@extends('home_page_online.master')
@section('content')
    <div class="container-xxl py-5">
        {{-- <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <fieldset class="form-group position-relative">
                <input id="searchSanPham" name="search_sp" type="text" class="form-control form-control mb-1"
                    placeholder="nhập tên sản phẩm">
            </fieldset>
        </div> --}}

        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-2">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Gọi đồ uống</h1>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>

                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: slideInRight;">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        @foreach ($menuCha as $key => $value)
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary border-2 choose {{ $key == 0 ? 'active' : '' }}"
                                    data-bs-toggle="pill" href="#tab-{{ $value->id }}">{{ $value->ten_danh_muc }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                @foreach ($menuCha as $key => $value)
                    <div id="tab-{{ $value->id }}" class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}">
                        <div class="row g-4">
                            @foreach ($allSanPham as $key_sp => $value_sp)
                                @if (in_array($value_sp->id_danh_muc, explode(',', $value->tmp)))
                                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">

                                        <div class="position-relative bg-light overflow-hidden">
                                            <a href="/cafe/chi-tiet-san-pham/{{ $value_sp->id }}"> <img
                                                    style="width: 300px;height: 250px;" class="img-sp img-fluid w-100"
                                                    src="{{ $value_sp->anh_dai_dien }}" alt=""></a>

                                        </div>
                                        <div class="text-center p-4 " style="width: 300px; height: 104px ">
                                            <a class="d-block h5 mb-2"
                                                href="/cafe/chi-tiet-san-pham/{{ $value_sp->id }}">{{ $value_sp->ten_san_pham }}</a>
                                            @if ($value_sp->gia_khuyen_mai == 0)
                                                <span class="text-primary me-1">{{ $value_sp->gia_ban }}</span>
                                            @else
                                                <span class="text-primary me-1">{{ $value_sp->gia_khuyen_mai }}</span>
                                                <span
                                                    class="text-body text-decoration-line-through">{{ $value_sp->gia_ban }}</span>
                                            @endif

                                        </div>
                                        <div class="d-flex border-top" style="background-color: rgb(164, 160, 216)">
                                            <small class="w-50 text-center py-2" style="margin-left: 73px">
                                                <a title="Add to Cart" class="btn addToCart" style="font-size: 1.875em"
                                                    data-id="{{ $value_sp->id }} ">ODER</a>
                                            </small>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- <div id="chat-container">
        <div id="chat-log"></div>
        <input type="text" id="user-input" placeholder="Enter your message">
        <button id="send-btn">Send</button>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <button class="open-button" onclick="openForm()">Chat</button>

            <div class="chat-popup" id="myForm">
                <form class="form-container">
                    <h1>Chat</h1>

                    <label for="msg"><b>Message</b></label>
                    <div id="chat-log" style="overflow-y: scroll;height: 300px;"></div>
                    <textarea id="user-input" placeholder="Type message.." name="msg" required></textarea>

                    <button type="submit" id="send-btn" class="btn">Send</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>
        </div>

    </div>
    <!--<div class="bg"></div>-->
@endsection

@section('js')
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var chatLog = $('#chat-log');
            var userInput = $('#user-input');
            var sendBtn = $('#send-btn');


            // Gửi yêu cầu chatbot khi nhấn nút Send
            sendBtn.click(function() {
                var message = userInput.val();
                console.log(message);
                if (message.trim() !== '') {
                    // sendMessage(message);
                    userInput.val('');
                }
                // Hiển thị câu hỏi của người dùng trên giao diện
                chatLog.append('<div class="user-message">' + message + '</div>');

                // Gửi yêu cầu chatbot thông qua AJAX
                $.ajax({
                    url: '{{ route('chatbot.chat') }}',
                    method: 'POST',
                    data: {
                        message: message
                    },
                    success: function(response) {
                        // Hiển thị câu trả lời từ chatbot trên giao diện
                        // alert(response);
                        chatLog.append('<div class="bot-message">' + response.response +
                            '</div>');
                        // console.log(response.response);
                    },
                    error: function() {
                        chatLog.append(
                            '<div class="bot-message">Oops! Something went wrong.</div>');
                    }
                });
            });
        });
    </script>
@endsection
