<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trang Chủ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link href="{{asset('public/frontend/css/StyleHomePage.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/StyleHeader.css')}}" rel="stylesheet">
        <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet"> 

    </head>
    <body class="antialiased">
        <header>
            <div class="top-bar">
                <div class="logo">
                    <img class="logo-img" src="{{asset('public/frontend/image/Logo.jpg') }}"/>
                    <p class="logo-blinkiy">BLINKIY</p>
                    <p class="logo-phongthuy">PHONG THỦY</p>
                </div>
                <div class="search-bar">
                    <div class="search-bar-cover">
                        <i class="fas fa-search"></i>
                        <input type="input" class="search-bar-input" id="search-bar-input" name="search-bar-input" placeholder="Tìm kiếm"/>
                    </div>
                </div>
                <div class="top-bar-options">
                    <div class="top-bar-options-object">
                        <i class="fa-solid fa-user"></i>
                        <a class="top-bar-options-object-title" href="{{ URL::to('/personal_infor') }}">Tài khoản</a>
                    </div>
                    <div class="top-bar-options-object">
                        <i class="fa-solid fa-heart"></i>
                        <a class="top-bar-options-object-title" href="">Yêu thích</a>
                    </div>
                    <div class="top-bar-options-object">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <a class="top-bar-options-object-title" href="{{URL::to('/gio-hang')}}">Giỏ hàng</a>
                    </div>
                </div>
            </div>
       
            <nav class="menu-bar">
                <ul class="mainmenu">
                    <li class="mainmenu-li">
                        <a class="menu-bar-title" href="{{URL::to('/trang-chu')}}">TRANG CHỦ</a>
                    </li>
                    <li class="mainmenu-li">
                        <a class="menu-bar-title" href="{{ URL::to('/san-pham') }}">SẢN PHẨM</a>
                        <ul class="product-submenu">
                            @foreach ($category as $key => $cate)
                                <li><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{ $cate->category_name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="mainmenu-li">
                        <a class="menu-bar-title" href="">GIỚI THIỆU</a>
                    </li>
                    <li class="mainmenu-li">
                        <a class="menu-bar-title" href="">BLOG</a>
                        <ul class="product-submenu">
                        @if(isset($category_post) && count($category_post) > 0)
                        @foreach($category_post as $key => $danhmucbaiviet)
                            <li><a href="{{ URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug) }}">{{ $danhmucbaiviet->cate_post_name }}</a></li>
                        @endforeach
                            
                        @else
                            <li><a>No categories available</a></li>
                        @endif
                        <li><a href="{{ URL::to('/tat-ca-bai-viet/') }}">Tất cả bài viết</a></li>
                        </ul>
                    </li>
                    <li class="mainmenu-li">
                        <a class="menu-bar-title" href="">LIÊN HỆ</a>
                    </li>
                </ul> 
            </nav>
            <div class="slide-show">
                <div class="list-slider">
                    <img class="slider" src="{{asset('public/frontend/image/Slider1.jpg') }}">
                    <img class="slider" src="{{asset('public/frontend/image/Slider2.jpg') }}">
                    <img class="slider" src="{{asset('public/frontend/image/Slider3.jpg') }}">
                </div>
            </div>
    
    </header>
    
    <div class="background-img">
        <img src="{{asset('public/frontend/image/bgimg1.jpg') }}">
    </div>
    
    <section class="product-type-category">
        <div class="product-type-title">
            <hr>
            <p>XU HƯỚNG TÌM KIẾM</p>
            <hr>
        </div>
        <div class="product-type-slide">
            <div class="type-element">
                <a href="{{ URL::to('/danh-muc-san-pham/1') }}">
                <img src="{{asset('public/frontend/image/main_img_4.jpg') }}">
                </a>
                <p>Vòng tay</p>
                
            </div>
            <div class="type-element">
                <a href="{{ URL::to('/danh-muc-san-pham/2') }}">
                <img src="{{asset('public/frontend/image/main_img_38.jpg') }}">
                </a>
                <p>Dây chuyền</p>
                
            </div>
            <div class="type-element">
                <a href="{{ URL::to('/danh-muc-san-pham/3') }}">
                <img src="{{asset('public/frontend/image/main_img_8.jpg') }}">
                </a>
                <p>Nhẫn</p>
                
            </div>
            <div class="type-element">
                <a href="{{ URL::to('/danh-muc-san-pham/5') }}">
                <img src="{{asset('public/frontend/image/main_img_46.jpg') }}">
                </a>
                <p>Charm</p>
                
            </div>
            <div class="type-element">
                <a href="{{ URL::to('/danh-muc-san-pham/3') }}">
                <img src="{{asset('public/frontend/image/main_img_14.jpg') }}">
                </a>
                <p>Bông tai</p>
                
            </div>
        </div>
    
    </section>
    
    <section class="product-category">
        <div class="container-title">
            <p>SẢN PHẨM BÁN CHẠY</p>
            <hr>
        </div>
        <div class="card-container">
            <div class="pre-btn" ><i class="fa-solid fa-angle-left" ></i></div>
            
            <div class="carousel">
                <div class="list-product-card">
                @foreach($product as $key =>$pro)
                <a href="{{ URL::to('/chi-tiet-san-pham/'.$pro->product_id) }}">
                    <div class="product_card" >
                        <div class="product-image">
                            <img class="product-img" src="{{ URL::to('public/uploads/product/'.$pro->product_image) }}">
                        </div>
                        <div class="product-content">
                            <a href="{{ URL::to('/chi-tiet-san-pham/'.$pro->product_id) }}">{{ $pro->product_name }}</a>
                            <p>{{number_format ($pro->product_price) .' '.'VNĐ'}}</p>
                        </div>
                    </div>
                </a>
                @endforeach
                    <div class="carousel-end"></div>
                </div>   
            </div>
            
            <div class="nxt-btn" ><i class="fa-solid fa-angle-right"></i></div>
        </div>
    </section>
    
    <div class="background-img">
        <img src="{{asset('public/frontend/image/bgimg2.png') }}">
    </div>
    <section class="product-category">
        <div class="container-title">
            <p>SẢN PHẨM MỚI NHẤT</p>
            <hr>
        </div>
        <div class="card-container">
            <div class="pre-btn" ><i class="fa-solid fa-angle-left" ></i></div>
    
            <div class="carousel">
                <div class="list-product-card">
                 
                    @foreach($newest_product as $key => $sanphammoinhat)
                        <div class="product_card">
                        <div class="product-image">
                            <img class="product-img" src="{{ URL::to('public/uploads/product/'.$sanphammoinhat->product_image) }}">
                        </div>
                        <div class="product-content">
                            <a href="{{ URL::to('/chi-tiet-san-pham/'.$sanphammoinhat->product_id) }}">{{$sanphammoinhat->product_name}}</a>
                            <p>{{$sanphammoinhat->product_price}}</p>
                        </div>

                        </div>
                    @endforeach
                    <div class="carousel-end"></div>
                </div>   
            </div>
            
            <div class="nxt-btn" ><i class="fa-solid fa-angle-right"></i></div>
        </div>
    </section>
    
    <div class="hotline">
        <p class="hotline-title">Hotline</p>
        <p class="phone-numbers">0123456789</p>
        <p class="slogan">“Your order was made with love”</p>
    </div>
    
    <section class="news-category">
        <div class="container-title">
            <p>THÔNG TIN MỚI NHẤT</p>
            <hr>
        </div>
        <div class="news-container">
            <div class="news-container-leftside">
                <img src="{{asset('public/frontend/image/newsimg.jpg') }}">
                <a href="{{ URL::to('/tat-ca-bai-viet/') }}"><button class="see-more-button">
                    Xem thêm</button></a>
            </div>
            <div class="news-container-rightside">
                @foreach($all_post as $key => $baiviet)
                <div class="a-news">
                <img src="{{ URL::to('public/uploads/post/'.$baiviet->post_image) }}">
                <a href="{{url('/bai-viet/'.$baiviet->post_slug)}}">{{$baiviet -> post_title}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <script type="text/javascript" src="{{asset('public/frontend/js/ScriptCardSlider.js') }}"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/ScriptHomePage.js') }}"></script>
    </body>
</html>
