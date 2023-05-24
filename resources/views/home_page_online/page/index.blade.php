@extends('home_page_online.master')
@section('content')
    <div class="container-xxl py-5">
        {{-- <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <fieldset class="form-group position-relative">
                <input id="searchSanPham" name="search_sp" type="text" class="form-control form-control mb-1"
                    placeholder="nhập tên sản phẩm">
            </fieldset>
        </div> --}}

        {{-- <div class="container">
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
        </div> --}}
    </div>
    <div id="chat-container">
        <div id="chat-log"></div>
        <input type="text" id="user-input" placeholder="Enter your message">
        <button id="send-btn">Send</button>
    </div>
    <section class="avenue-messenger">
        <div class="menu">
            <div class="items"><span>
                    <a href="#" title="Minimize">&mdash;</a><br>
                    <!--
                   <a href="">enter email</a><br>
                   <a href="">email transcript</a><br>-->
                    <a href="#" title="End Chat">&#10005;</a>

                </span></div>
            <div class="button">...</div>
        </div>
        <div class="agent-face">
            <div class="half">
                <img class="agent circle" src="http://askavenue.com/img/17.jpg" alt="Jesse Tino">
            </div>
        </div>
        <div class="chat">
            <div class="chat-title">
                <h1>Jesse Tino</h1>
                <h2>RE/MAX</h2>
            </div>
            <div class="messages">
                <div id="chat-log" class="messages-content"></div>
            </div>
            <div class="message-box">
                <textarea type="text" id="user-input" class="message-input" placeholder="Type message..."></textarea>
                <button id="send-btn" type="submit" class="message-submit">Send</button>
            </div>
        </div>
        </div>
        <!--<div class="bg"></div>-->
    @endsection
    @section('js')
        {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Định nghĩa hàm cần thực thi
            function myFunction() {
                // Cập nhật các phần tử có class "choose" thành active
                var elements = document.getElementsByClassName("choose");
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList.add("active");
                }
            }

            // Sử dụng setInterval() để thực thi hàm myFunction() mỗi 2 giây
            setInterval(myFunction, 1000);
        });
    </script> --}}
        <script>
            var $messages = $('.messages-content'),
                d, h, m,
                i = 0;

            $(window).load(function() {
                $messages.mCustomScrollbar();
                setTimeout(function() {
                    fakeMessage();
                }, 100);
            });


            function updateScrollbar() {
                $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
                    scrollInertia: 10,
                    timeout: 0
                });
            }

            function setDate() {
                d = new Date()
                if (m != d.getMinutes()) {
                    m = d.getMinutes();
                    $('<div class="timestamp">' + d.getHours() + ':' + m + '</div>').appendTo($('.message:last'));
                    $('<div class="checkmark-sent-delivered">&check;</div>').appendTo($('.message:last'));
                    $('<div class="checkmark-read">&check;</div>').appendTo($('.message:last'));
                }
            }

            function insertMessage() {
                msg = $('.message-input').val();
                if ($.trim(msg) == '') {
                    return false;
                }
                $('<div class="message message-personal">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');
                setDate();
                $('.message-input').val(null);
                updateScrollbar();
                setTimeout(function() {
                    fakeMessage();
                }, 1000 + (Math.random() * 20) * 100);
            }

            $('.message-submit').click(function() {
                insertMessage();
            });

            $(window).on('keydown', function(e) {
                if (e.which == 13) {
                    insertMessage();
                    return false;
                }
            })

            var Fake = [
                'Hi there, I\'m Jesse and you?',
                'Nice to meet you',
                'How are you?',
                'Not too bad, thanks',
                'What do you do?',
                'That\'s awesome',
                'Codepen is a nice place to stay',
                'I think you\'re a nice person',
                'Why do you think that?',
                'Can you explain?',
                'Anyway I\'ve gotta go now',
                'It was a pleasure chat with you',
                'Time to make a new codepen',
                'Bye',
                ':)'
            ]

            function fakeMessage() {
                if ($('.message-input').val() != '') {
                    return false;
                }
                $('<div class="message loading new"><figure class="avatar"><img src="http://askavenue.com/img/17.jpg" /></figure><span></span></div>')
                    .appendTo($('.mCSB_container'));
                updateScrollbar();

                setTimeout(function() {
                    $('.message.loading').remove();
                    $('<div class="message new"><figure class="avatar"><img src="http://askavenue.com/img/17.jpg" /></figure>' +
                        Fake[i] + '</div>').appendTo($('.mCSB_container')).addClass('new');
                    setDate();
                    updateScrollbar();
                    i++;
                }, 1000 + (Math.random() * 20) * 100);

            }

            $('.button').click(function() {
                $('.menu .items span').toggleClass('active');
                $('.menu .button').toggleClass('active');
            });
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
