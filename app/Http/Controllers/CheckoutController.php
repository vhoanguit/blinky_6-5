<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ChangepassRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\console;


session_start();

class CheckoutController extends Controller
{
    // public function AuthLogin()
    // {
    //     if (Session::has("customer_id")) {
    //         return true; // Đã đăng nhập
    //     } else {
    //         return false; // Chưa đăng nhập
    //     }
    // }
    public function login()
    {
        return view('pages.khachhang.pages_child.checkout.login');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = $request->password_account;

        $customer = DB::table('tbl_customers')->where('customer_email', $email)->first();
        if ($customer && Hash::check($password, $customer->customer_password)) {
            Session::put('customer_id', $customer->customer_id);
            return Redirect::to('/personal_infor')->with('Login Successfully', 'Đăng nhập thành công!');
        } else {
            Session::put('message', 'Mật khẩu hoặc tài khoản không đúng. Làm ơn nhập lại!');
            return Redirect::to('/login');
        }
    }



    public function register()
    {
        return view('pages.khachhang.pages_child.checkout.register');
    }

    public function add_customer(CustomerRequest $request)
    {


        // Xác thực dữ liệu
        $data = $request->validated();

        $data = array();
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = bcrypt($request->customer_pass);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        // Tạo token ngẫu nhiên từ 0000 đến 9999
        // $token = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        // $data['token'] = $token; // Gán token vào dữ liệu khách hàng
        // $data['date_created'] = Carbon::now('Asia/Ho_Chi_Minh');
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        // Gửi email thông báo đăng ký thành công
        $customer = DB::table('tbl_customers')->where('customer_id', $customer_id)->first();
        $to_email = $customer->customer_email;
        $to_name = $customer->customer_name;
        Mail::send('emails.registration_confirmation', ['customer' => $customer], function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Thông tin đăng ký tài khoản tại Blinkiy');
        });
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        Session::flash('register success', 'Đăng ký tài khoản thành công');
        return Redirect::to('/personal_infor');
    }
    // Hiện tại hàm này chưa sài. Lúc tạo là vì tưởng đăng nhập mới cho checkout
    // public function checkout()
    // {
    //     // Lấy ID khách hàng từ Session
    //     $customer_id = Session::get('customer_id');

    //     // Truy vấn thông tin khách hàng từ cơ sở dữ liệu
    //     $customer = DB::table('tbl_customers')->where('customer_id', $customer_id)->first();

    //     // Trả về view với dữ liệu của khách hàng
    //     return view('pages.personal_infor', ['customer' => $customer]);
    // }
    public function Order_management()
    {
        $customer_id = Session::get('customer_id');

        // Truy vấn thông tin khách hàng từ cơ sở dữ liệu
        $customer = DB::table('tbl_customers')->where('customer_id', $customer_id)->first();

        // Trả về view 'pages.changepass' với cả thông tin khách hàng
        return view('pages.khachhang.pages_child.order_management', ['customer' => $customer]);
    }


    public function personal_infor()
    {
        $provinces = DB::table('province')->get();
        $districts = DB::table('district')->get(); 
        // Lấy ID khách hàng từ Session
        $customer_id = Session::get('customer_id');
        // Truy vấn thông tin khách hàng từ cơ sở dữ liệu
        $customer = DB::table('tbl_customers')->where('customer_id', $customer_id)->first();

        // Trả về view với dữ liệu của khách hàng
        return view('pages.khachhang.pages_child.personal_infor')->with('customer', $customer)->with('provinces', $provinces)->with('districts', $districts);
    }


    public function update_customer(Request $request, $customer_id)
    {
        $data = array();
        // $data['customer_email'] = $request->user_email;
        $data['customer_name'] = $request->user_name;
        $data['customer_phone'] = $request->user_tel;
        $data['customer_date'] = $request->user_date;
        $city_id = $request->input('user_city');
        $city_info = DB::table('province')->where('province_id', $city_id)->first();
        if ($city_info) {
            $data['customer_city'] = $city_info->province_name;
        }
        // dd($city_info);
        $district = $request->input('user_district');
        $distric_info = DB::table('district')->where('district_id', $district)->first();
        if($distric_info){
            $data['customer_district'] = $distric_info->district_name;
        }
        // $data['customer_district'] = $request->user_district;
        $email = DB::table('tbl_customers')->where('customer_id', $customer_id)->value('customer_email');
        $newEmail = $request->user_email;
        if ($email != $newEmail) {
            Session::flash('error_change_email', 'Bạn không được đổi email');
            return Redirect::to('/personal_infor');
        }
        DB::table('tbl_customers')->where('customer_id', $customer_id)->update($data);
        Session::flash('success-update', 'Cập nhật thông tin thành công');
        return Redirect::to('/personal_infor');
    }

    // Hàm để đăng xuất người dùng bằng cách xóa Session bằng flush
    public function logout()
    {
        Session::flush();
        return Redirect::to('/login');
    }
    public function forgot_password()
    {
        return view('pages.khachhang.pages_child.checkout.forgot_password');
    }
    public function check_forgot_password(Request $request)
    {
        $request->validate(
            [
                'recover_email' => 'required|exists:tbl_customers,customer_email',
            ],
            [
                'recover_email.required' => 'Bạn cần phải nhập email để đặt lại mật khẩu',
                'recover_email.exists' => 'Email không tồn tại trong hệ thống!',
            ]
        );
        $otp = mt_rand(100000, 999999);
        // Tính thời gian hết hạn (5 phút)

        $expiry = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(5);

        $customer = DB::table('tbl_customers')->where('customer_email', $request->recover_email)->first();
        $customer_id = $customer->customer_id;
        session()->put('email', $request->recover_email);
        $result = DB::table('password_reset')->updateOrInsert(
            ['email' => $request->recover_email],
            [
                'otp' => $otp,
                'expiry' => $expiry,
            ]
        );
        $sendOTP = Mail::to($request->recover_email)->send(new ForgotPassword($otp, $customer));
        if ($result && $sendOTP) {
            // Không có lỗi xảy ra, email gửi thành công
            return redirect('/verify_otp')->with('ok', 'Vui lòng kiểm tra email để xác nhận OTP');
        } else {
            // Có lỗi xảy ra khi gửi email
            return redirect('/forgot-password')->with('no', 'Có lỗi xảy ra trong quá trình gửi email');
        }
    }
    public function verify_otp()
    {
        return view('pages.khachhang.pages_child.checkout.verify_otp');
    }
    public function check_verify_otp(Request $request)
    {
        $request->validate(
            [
                'otp' => 'required|numeric',
            ],
            [
                'otp.required' => 'Bạn cần phải nhập đúng mã OTP đã được gửi đến email',
                'otp.numeric' => 'Mã otp phải là kiểu số',
            ]
        );

        $email = session::get('email'); //lấy cái email khách hàng vừa nhập bên chỗ lấy lại mật khẩu
        $otp = $request->otp;

        // Lấy cái email đã gửi OTP mà tồn tại trong bảng customer
        $email_reset = DB::table('password_reset')->where('email', $email)->first();
        // dd($request->all());
        if (!$email_reset) {
            return redirect()->back()->with('error', 'email không hợp lệ');
        }
        if ($email_reset->otp != $otp) {
            return redirect()->back()->with('error', 'OTP không chính xác');
        }
        // Kiểm tra xem OTP có hết hạn chưa
        if (Carbon::now('Asia/Ho_Chi_Minh') > $email_reset->expiry) {
            return redirect('/forgot-password')->with('error', 'OTP đã hết hạn, vui lòng yêu cầu lại');
        }
        return Redirect::to('/reset-password');
    }
    public function reset_password()
    {
        $data = DB::table('password_reset')->where('email', session::get('email'))->first();
        $customer = DB::table('tbl_customers')->where('customer_email', $data->email)->first();
        // dd($customer);
        // $customer = DB::table('password_reset')->where('email', session::get(
        return view('pages.khachhang.pages_child.checkout.reset_password');
    }
    public function check_reset_password(Request $request)
    {
        $request->validate(
            [
                'NewPass' => 'required|min:6',
                'ConfirmNewPass' => 'required|same:NewPass'
            ],
            [
                'NewPass.required' => 'Mật khẩu phải chứa ít nhất 6 kí tự',
                'ConfirmNewPass.required' => 'Mật khẩu phải chứa ít nhất 6 kí tự',
                'ConfirmNewPass.same' => 'Mật khẩu xác nhận phải không đúng!',
            ]
        );
        $data = DB::table('password_reset')->where('email', session::get('email'))->first();
        $customer = DB::table('tbl_customers')->where('customer_email', $data->email)->first();
        // $data['customer_password'] = $request->NewPass;
        if (!$customer) {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }

        // Cập nhật mật khẩu
        // DB::table('tbl_customers')->where('customer_email', session::get(
        DB::table('tbl_customers')->where('customer_email', $data->email)->update(
            [
                'customer_password' => bcrypt($request->NewPass)
            ]
        );
        // Xóa dữ liệu từ bảng password_reset sau khi đã cập nhật mật khẩu thành công
        DB::table('password_reset')->where('email', $data->email)->delete();

        return redirect('/login')->with('Reset Successfully', 'Cập nhật mật khẩu thành công');
    }

    public function Change_pass()
    {
        // Lấy ID khách hàng từ Session
        $customer_id = Session::get('customer_id');
        // dd($customer_id);

        // Truy vấn thông tin khách hàng từ cơ sở dữ liệu
        $customer = DB::table('tbl_customers')->where('customer_id', $customer_id)->first();
        // dd($customer);
        // Trả về view 'pages.changepass' với cả thông tin khách hàng
        return view('pages.khachhang.pages_child.changepass', ['customer' => $customer]);
    }
    public function check_change_pass(ChangepassRequest $request)
    {
        $customer_id = Session::get('customer_id');
        DB::table('tbl_customers')
            ->where('customer_id', $customer_id)
            ->update(['customer_password' => bcrypt($request->NewPass)]);

        return redirect('/login')->with('success', 'Mật khẩu đã được cập nhật thành công');
    }

    public function upload_avatar(Request $request)
    {
        $get_image = $request->file('avatar'); //nếu người dùng có chọn ảnh mới
        if ($get_image) {
            $customer_id = Session::get('customer_id');
            $old_image_name = DB::table('tbl_customers')->where('customer_id', $customer_id)->value('customer_image');
            if( $old_image_name)
            {
                $filePath = 'public/uploads/customers_avatar/' . $old_image_name;
            
            if (file_exists($filePath)) {
                unlink($filePath);
            } //để khi thay thế thì mình sẽ truy cập vào folder upadates xóa ảnh khi trước luôn
        }
            $get_name_image = $get_image->getClientOriginalName(); //khi dùng getClientOriginalName() nó sẽ lấy toàn bộ tên, bao gồm cả đuôi mở rộng(VD: lấy cả a.jpg)
            $name_image = current(explode('.', $get_name_image)); //explode hàm để cắt tên tính từ dấu . để cắt đuôi mở rộng đi

            //hàm current để lấy chuỗi đầu tiên (VD: a.jpg được thách thành 2 đoạn là a vs jpg thì nó lấy a(chuỗi đầu tiên))
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); // getClientOriginalExtension(): hàm để lấy đuôi mở rộng (png, jpg,...)
            // dd($new_image);
            $get_image->move('public/uploads/customers_avatar', $new_image);


            DB::table('tbl_customers')->where('customer_id', $customer_id)
                ->update(['customer_image' => $new_image]);

            return redirect('/personal_infor')->with('success-update-avatar', 'Tải ảnh đại diện thành công');
        } else {
            return redirect('/personal_infor')->with('error-update-avatar', 'Không tìm thấy tệp ảnh');
        }
    }

    public function fetchDistrict(Request $request)
    {
        // dd($cityId);

        // Kiểm tra nếu request là AJAX
        if ($request->ajax()) {
            // Lấy danh sách quận/huyện từ cơ sở dữ liệu dựa trên cityId
            $districts = DB::table('district')->where('province_id', $request->cityId)->get();
            // console.log($district);
            // Tạo response HTML chứa các option cho dropdown quận/huyện
            $data = '<option value="">Chọn quận/huyện</option>';

            foreach ($districts as $district) {
                $data .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
            }

            // Trả về response
            return response($data);
        }
    }
}