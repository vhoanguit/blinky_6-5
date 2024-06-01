<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home | E-Shopper</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
	<link href="{{asset('public/frontend/css/blog_page.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/main_page.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/sanpham.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet"> 

</head>

<body>

    <header class="header">
        <div class="top-bar">
            <div class="logo">
                <img class="logo-img" src="Logo.jpg">
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
                    <a class="top-bar-options-object-title" href="">Tài khoản</a>
                </div>
                <div class="top-bar-options-object">
                    <i class="fa-solid fa-heart"></i>
                    <a class="top-bar-options-object-title" href="">Yêu thích</a>
                </div>
                <div class="top-bar-options-object">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <a class="top-bar-options-object-title" href="{{URL::to('/shopping-cart')}}">Giỏ hàng</a>
                </div>
            </div>
        </div>
        
        <nav class="menu-bar">
            <ul class="mainmenu">
                <li class="mainmenu-li">
                    <a href="{{URL::to('/trang-chu')}}" class="menu-bar-title">TRANG CHỦ</a>
                </li>
                <li class="mainmenu-li"><a class="menu-bar-title" href="#">SẢN PHẨM</a>
                <?php
                    $category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'asc')->get();
                ?>
                    <ul class="product-submenu">       
                        @foreach ($category_product as $key => $cate)
                            <li><a
                                href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{ $cate->category_name }}</a>
                            </li>
                        @endforeach
                            
                    </ul>
                </li> 
                <li class="mainmenu-li">
                    <a class="menu-bar-title" href="">GIỚI THIỆU</a>
                </li>
                <li class="mainmenu-li">
                    <a class="menu-bar-title" href="#">BLOG</a>
                    <ul class="product-submenu">
                    @if(isset($category_post) && count($category_post) > 0)
                        @foreach($category_post as $key => $danhmucbaiviet)
                            <li><a href="{{ URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug) }}">{{ $danhmucbaiviet->cate_post_name }}</a></li>
                        @endforeach
                    @else
                        <li><b>No categories available</b></li>
                    @endif
                    
                    </ul>
                </li> 
                <li class="mainmenu-li">
                    <a class="menu-bar-title" href="">LIÊN HỆ</a>
                </li>
            </ul>
        </nav>
        <div>
        <img class="bg-menu-img" alt="" src="{{asset('public/frontend/image/menu.jpg')}}">
        </div>
	</header>

					
		

    <footer></footer>			
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script>
        $(document).ready(function(){
            $('#add_product_to_cart').click(function(){
                swal("Good job!", "You clicked the button!", "success");

            });
        });

    </script> -->
</body>
</html>