<div style="width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 10px;">
    <div>
        <h2 style="margin-bottom: 20px;">Chào mừng đến với Blinkiy</h2>
        <p>Xin chào {{$customer->customer_name}},</p>
        <p>Địa chỉ email đã dùng để đăng ký tài khoản: {{$customer->customer_email}}</p>
        <p>Anh/chị vui lòng truy cập vào tài khoản theo địa chỉ <a href="{{URL::to('/login')}}" style="color: #007bff;">{{URL::to('/login')}}</a> để thực hiện đặt hàng và quản lý giao dịch nhanh chóng thuận tiện hơn.</p>
        <p>Truy cập vào cửa hàng để tiếp tục mua sắm với chúng tôi.</p>
        <hr style="margin-top: 20px;">
        <p style="text-align:right; font-style: italic; color: #888;">Nếu Anh/chị có bất kỳ câu hỏi nào, xin liên hệ với chúng tôi tại <a href="mailto:{{env('MAIL_FROM_ADDRESS')}}" style="color: #888;">{{env('MAIL_FROM_ADDRESS')}}</a></p>
    </div>
</div>