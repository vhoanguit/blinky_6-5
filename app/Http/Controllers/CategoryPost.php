<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use App\Models\Post;

// use CategoryProductModel;

// chua tao category_product_model
// use App\CategoryProductModel;
use Session;
use Auth;
use App\Models\CatePost; //sử dụng model CatePost
// Mối quan hệ giữa Model và Controller : khi nhận yêu cầu từ form, controller sẽ gọi đến model để thực hiện thao tác với dữ liệu
// VD : 1. Ng dùng nhập thông tin bài viết vào form thêm danh mục bài viết và nhấn 'submit'
//      2. Dữ liệu đc gửi đến COntroller (cụ thể là hàm save_category_post trong CategoryPost)
//      3. Trong hàm save_category_post, Controller gọi Model CatePost
//      4. Khi phương thức save() của CatePost đc gọi, Eloquent sẽ xử lý và lưu thông tin vào bảng tbl_category_post trong dtb
//      5. Sau khi lưu thành công, ng dùng sẽ đc thông báo và chuyển hướng trở lại form
// => Controller phụ trách nhận và xử lý dữ liệu gửi từ ng dùng, sau đó tương tác vs Model để thực hiện các hành dộng gửi lên csdl
// => Model làm việc trực tiếp vs csdl nhưng sẽ thông qua Controller
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryPost extends Controller
{
    public function AuthLogin(){ // hàm ktra xem người dùng đã đăng nhập và có quyền truy cập vào dashboard hay không
        $admin_id = Session::get('admin_id'); // lấy 'admin_id' từ session
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send(); // nếu k là admin -> điều hướng về trang đăng nhập
        }
    }
    public function add_category_post(){
        $this->AuthLogin();// ktra xác thực người dùng
    	return view('admin.category_post.add_category');
    }
    public function save_category_post(Request $request){ // lấy data từ bên form add_category_blade qua
        $this->AuthLogin();
    	$data = $request->all();//lấy toàn bộ dữ liệu gửi từ form
        $category_post = new CatePost();// khởi tạo đối tượng CatePost mới
        //gán du liệu request vào các thuộc tính của đổi tượng
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();// lưu đối tượng vào database
        Session::put('message','Thêm danh mục bài viết thành công');
    	return Redirect()->back();// chuyển hướng ng dùng trở lại trang trước 
    }
    public function edit_category_post($category_post_id){
        $this->AuthLogin();
        $category_post =  CatePost::find($category_post_id);// tim bai viet dua tren id 
        return view('admin.category_post.edit_category')->with(compact('category_post'));
        // hàm compact được sử dụng để truyền biến $category_post vào view, cho phép truy cập dữ liệu danh mục bài viết trong view và hiển thị chúng,
    }

    public function update_category_post(Request $request,$cate_id){
        $data = $request->all();//lấy toàn bộ dữ liệu gửi từ form
        $category_post =  CatePost::find($cate_id);// tim bai viet dua tren id

        //gán du liệu request vào các thuộc tính của đổi tượng
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();// lưu đối tượng vào database
        Session::put('message','Cập nhật danh mục bài viết thành công');
    	return Redirect('/all-category-post');// chuyển hướng ng dùng trở lại trang trước
    }
    public function all_category_post(){
        $this->AuthLogin();
        $category_post = CatePost::orderBy('cate_post_id','DESC')->paginate(5);
        //lấy tất cả các danh mục bài viết sắp xếp theo 'cate_post_id' giảm dần, phần thành 5 mục 1 trang
        return view('admin.category_post.list_category')->with(compact('category_post'));
    }
    
    public function delete_category_post($cate_id){
        $category_post =  CatePost::find($cate_id);// tim bai viet dua tren id
        $category_post->delete();
        Session::put('message','Xóa danh mục bài viết thành công');
        return Redirect::to('/all-category-post');
    }  

    public function unactive_catepost($cate_post_id){
        $this->AuthLogin();
        CatePost::where('cate_post_id',$cate_post_id)->update(['cate_post_status'=>0]);
        Session::put('message','Ẩn danh mục bài viết thành công');
        return Redirect::to('all-category-post');

    }
    public function active_catepost($cate_post_id){
        $this->AuthLogin();
        CatePost::where('cate_post_id',$cate_post_id)->update(['cate_post_status'=>1]);
        Session::put('message','Hiển thị danh mục bài viết thành công');
        return Redirect::to('all-category-post');

    }
    public function import_csv(){

    }
    public function export_csv(){
        
    }
    
}
