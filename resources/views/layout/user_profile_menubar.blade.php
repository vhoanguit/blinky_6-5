<link href="{{asset('public/frontend/css/user_format.css') }}" rel="stylesheet">
<div class="userProfile ">
    <div class="img_photo align ">
        <h5 class="title-account ">Trang tài khoản</h5>
        <img src="{{ URL::to('public/uploads/customers_avatar/' . $customer->customer_image) }}" alt="" style="width:100px; height: 100px;display: block; margin: 0 auto;  ; border-radius: 50%;
            object-fit: cover;">
        <p class="hello-account">Xin chào, <span style="color: #EF99A2; font-family: 'Paytone One', sans-serif; font-weight:500">{{$customer->customer_name}}</span></p>
    </div>
    <ul class="accountMenu">
        <li>
            <a href="" onclick="toggleSubMenu(event)">
                <div class="menu_user">
                    <span class="text_bar">
                        <i class="fa-solid fa-user" id="id_user"></i>
                        <p class="user_text">Tài khoản của bạn</p>
                    </span>
                </div>
            </a>
            <ul id="subMenu" class="submenu">
                <li><a href="{{URL::to('/personal_infor')}}">Thông tin cá nhân</a></li>
                <li><a href="{{URL::to('/change_pass')}}">Thay đổi mật khẩu</a></li>
            </ul>
        </li>

        <li>
            <a href="{{URL::to('/order_management')}}">
                <div class="menu_user">
                    <span class="text_bar"><i class="fa-solid fa-bag-shopping"></i>
                        <p class="user_text">Quản lý đơn hàng</p>
                    </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{URL::to('/logout')}}">
                <div class="menu_user">
                    <span class="text_bar">
                        <i class="fa-solid fa-angles-left"></i>
                        <p class="user_text">Đăng xuất</p>
                    </span>
                </div>
            </a>
        </li>
    </ul>
</div>