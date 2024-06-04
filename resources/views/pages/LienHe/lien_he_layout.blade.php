<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/lien_he.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;Epilogue:ital,wght@0,100..900;Poly:ital@0;1;Dongle&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>

    @include('Header')

    <section>
        <form method="post" action="{{ route('contact.store') }}">
            @csrf
            <div class="title_2LH">
                <p class="title_2LH_content">Liên hệ</p>
            </div>
            <div class="LHmain">
                <div class="formside">
                    <div class = "sbc">
                        <div class = "form_row">
                            <p class="Forminstruction">Hãy liên hệ khi bạn gặp bất cứ vấn đề nào liên quan đến cửa hàng hoặc sản phẩm của chúng tôi. Chúng tôi sẽ cố gắng phản hồi trong thời gian sớm nhất.</p>
                        </div>
                        <div class = "form_row">
                            <label for="name">Tên *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class = "form_row">
                            <label for="sdt">Số điện thoại</label>
                            <input type="tel" id="sdt" name="sdt">
                        </div>   
                        <div class = "form_row">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class = "form_row">
                            <label for="title">Tiêu đề *</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div class = "form_row">
                            <label for="question">Câu hỏi *</label>
                            <textarea id="question" rows="7" placeholder="" name="question" required></textarea><br>
                        </div>
                        <div class="Submit_form">
                            <input class="Submit_button" type="submit" value="Gửi" name="Submit">
                        </div>
                    </div>
                </div>
                <div class="Storei4">
                    <div class = "i4_cont">
                        <p style="font-weight: bold;">Thông tin cửa hàng</p>
                        <p><img src="{{ asset('public/frontend/images/email.png') }}">Blinkiy.is334@gmail.com</p>
                        <p><img src="{{ asset('public/frontend/images/location-pointer.png') }}">Trường Đại học Công nghệ Thông tin - ĐHQG TPHCM</p>
                        <p><img src="{{ asset('public/frontend/images/phone-call.png') }}">0814576804</p>
                        <p><img style="padding-top: -2px;" src="{{ asset('public/frontend/images/email.png') }}">Blinkiy.is334@gmail.com</p>
                        <div align="center">
                            <button id="myButton" onclick="redirectToUrl()" type="button"><img src="{{ asset('public/frontend/images/facebook.png')}}"></button>
                            <button id="myButton" onclick="redirectToUrl()" type="button"><img src="{{ asset('public/frontend/images/instagram.png')}}"></button>
                            <button id="myButton " onclick="redirectToUrl()" type="button"><img src="{{ asset('public/frontend/images/tik-tok.png')}}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </section>

    @include('Footer')
</body>
</html>