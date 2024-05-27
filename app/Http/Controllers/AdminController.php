<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // sử dụng database


use App\Http\Requests;
use Session; // thu vien sdung session
use Illuminate\Support\Facades\Redirect; 
session_start();

class AdminController extends Controller
{
    public function AuthLogin()
    {
        $admin_id=Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('dashboard');

        }else
        {
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('pages.admin_login'); 
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard_login(Request $request){
        $admin_email = $request->admin_email ; // lấy trường name="admin_email" trong yêu cầu được gửi lên do ng dùng nhập
        $admin_password = $request->admin_password;
        $result  =DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password) //biến result ktra xem trong bảng tbl_admin có email và mkhau tương ứng l 
        ->first(); // hàm first ktra người dùng có vai trò tương ứng không, nếu k sdung thì tất cả ng dùng đều có quyền truy cập

        if(isset($result)){ // ktra dk nếu đúng mkhau và email thì dẫn đến trang admin
            // return view('admin.dashboard');
            Session::put('admin_name',$result->admin_name); // session::put('key',value) lưu dữ liệu vào session 
            Session::put('admin_id',$result->admin_id); //session::get('key') : lấy dữ liệu ra để sử dụng
            // session::forget('key') : xóa thông tin ra khỏi session
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message','Thông tin đăng nhập sai');
            // return view('pages.admin_login'); // sai thi quay lai trang dang nhap    
            return Redirect::to('/admin');
        }      
    }
    public function dashboard_logout(Request $request){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');     
    }
}
