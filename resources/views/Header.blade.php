<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('public/frontend/css/header_only.css')}}" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script type="text/javascript" src="{{ asset('public/frontend/js/CartQuantity.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('public/frontend/js/HeaderSearch.js') }}"></script>

    <header class="Header">
        <input type="hidden" value="{{ $my_customer }}" id="this-customer">
        <input type="hidden" value="{{ $cart->count() }}" id="number_of_cart">

        @if ($my_customer)
            <script>
                window.onload = function() { countProductsInCart_Customer(); };
            </script>
        @else
            <script>
                window.onload = function() { countProductsInCart();};
            </script>
        @endif
        <div class="top-bar">
            <div class="logo">
                <img class="logo-img" src="{{ asset('public/frontend/image/Logo.jpg') }}">
                <p class="logo-blinkiy">BLINKIY</p>
                <p class="logo-phongthuy">PHONG THỦY</p>
            </div>
            <form id="search-form" method="get" action="{{ URL::to('/tim-kiem') }}">
                {{ csrf_field()}}
                <div class="search-bar">
                    <div class="search-bar-cover">
                        <i class="fas fa-search"id="search_icon"></i>
                        <input type="input" class="search-bar-input" id="search-bar-input" 
                            name="keywords_submit" placeholder="Tìm kiếm sản phẩm..."/>
                    </div>
                </div>
            </form>
           
            <div class="top-bar-options">
                <div class="top-bar-options-object">
                    <i class="fa-solid fa-user"></i>
                    <a class="top-bar-options-object-title" href="{{ URL::to('/personal_infor') }}">Tài khoản</a>
                </div>
                <div class="top-bar-options-object">
                    <a href="" class="icon_option">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <a class="top-bar-options-object-title" href="{{ URL::to('/favourite-product') }}">Yêu thích</a>
                </div>
                <div class="top-bar-options-object">
                    <a href="{{ URL::to('/gio-hang') }}" >
                        <div id="cart-shopping">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="cart-shopping-quantity">0</span>
                        </div>
                    </a>
                    <a class="top-bar-options-object-title" href="{{ URL::to('/gio-hang') }}">Giỏ hàng</a>
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
                        <?php
                            $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();          
                        ?>
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
                        <?php
                            $category_post = DB::table('tbl_category_post')->orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get
                        ?>
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
                    <a class="menu-bar-title" href="{{ URL::to('/contact/') }}">LIÊN HỆ</a>
                </li>
            </ul>
        </nav>
        <div class="bg-menu">
        <img class="bg-menu-img" alt="" src="{{asset('public/frontend/image/menu.jpg')}}">
        </div>

    </header>


