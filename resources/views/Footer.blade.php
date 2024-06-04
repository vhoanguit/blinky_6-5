
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/footer.css') }}">

    <footer class="Footer">

        <div class="section_container">
            <div class="footer_section">
                <p class="footer_section_title">Về chúng tớ</p>
                <div class="section_content">
                    <p class="footer_section_content"><a href="{{ URL::to('/trang-chu') }}">Trang chủ</a></p>
                    <p class="footer_section_content"><a href="{{ URL::to('/san-pham')}}">Sản phẩm</a></p>
                    <p class="footer_section_content"><a href="#">Giới thiệu</a></p>
                    <p class="footer_section_content"><a href="{{URL::to('/tat-ca-bai-viet')}}">Bài viết</a></p>
                </div>
            </div>
            <div class="footer_section">
                <p class="footer_section_title">Theo dõi chúng tớ</p>
                <div class="section_content">
                <p class="footer_section_content"><a href="#">
                    <i class="fa-brands fa-facebook" style="color: #1977F3"></i>  Facebook</a></p>
                <p class="footer_section_content"><a href="#">
                    <i class="fa-brands fa-instagram" style="color:#FD0871"></i>  Instagram</a></p>
                <p class="footer_section_content"><a href="#">
                    <i class="fa-brands fa-tiktok" style="color: black"></i>  Tiktok</a></p>
                </div>
            </div>
            <div class="footer_section">
                <p class="footer_section_title">Liên hệ</p>
                <div class="section_content">
                <p class="footer_section_content"><a href="mailto:Blinkiy.is334@gmail.com">Blinkiy.is334@gmail.com</a></p>
                <p class="footer_section_content">Hotline: 0814576804</p>
                </div>
            </div>
            <div class="footer_section">
                <p class="footer_section_title">Cửa hàng</p>
                <div class="section_content">
                <p class="footer_section_content">Trường Đại học Công nghệ Thông tin, Đại học Quốc gia, TP Hồ Chí Minh</p>
                </div>
            </div>
        </div>
        <!-- <hr style="width: 100%;"> -->
    </footer>