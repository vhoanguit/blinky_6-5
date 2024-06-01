<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; // sử dụng database
use App\Models\CatePost;


use App\Http\Requests;
use Session; // thu vien sdung session
use Illuminate\Support\Facades\Redirect; 
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.category_product.add_category_product');

    }
    public function all_category_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->paginate(10);
        $manage_category_product = view('admin.category_product.all_category_product')->with('cate_product',$cate_product);
        return view('admin_layout')->with('admin.category_product.all_category_product',$manage_category_product); // 
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        $data['category_status']=$request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    // public function unactive_category_product($category_pro_id){
    //     $this->AuthLogin();
    //     DB::table('tbl_category_product')->where('category_id',$category_pro_id)->update(['category_status'=>0]);
    //     Session::put('message','Ân danh mục sản phẩm thành công');
    //     return Redirect::to('all-category-product');
    // }
    // public function active_category_product($category_pro_id){
    //     $this->AuthLogin();
    //     DB::table('tbl_category_product')->where('category_id',$category_pro_id)->update(['category_status'=>1]);
    //     Session::put('message','Hiển thi danh mục sản phẩm thành công');
    //     return Redirect::to('all-category-product');
    // }
    public function edit_category_product($category_pro_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_pro_id)->get();
        $manage_category_product = view('admin.category_product.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.category_product.edit_category_product',$manage_category_product); // 
    }
    public function update_category_product(Request $request, $category_pro_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_pro_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_pro_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_pro_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function show_category_product_home($category_product_id)
    {
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        
        $product_by_category=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('category_status','1')->where('product_status','1')->where('tbl_product.category_id',$category_product_id);
        // them bien categroy_post vao de truyen vo trang 
        $category_post = CatePost::orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get();

        $min_price=DB::table('tbl_product')->min('product_price');
        $max_price=DB::table('tbl_product')->max('product_price');
        $min_price_range=$min_price-100000;
        $max_price_range=$max_price+100000;
        
        if(isset($_GET['price_from']) && ($_GET['price_from']) )
        {
            $min_price=$_GET['price_from'];
            $max_price=$_GET['price_to'];
            
            $product_by_category=$product_by_category->where('product_status','1')
            ->whereBetween('product_price',[$min_price,$max_price])
            ->orderby('product_price','asc')->get();
        }
        else {$product_by_category=$product_by_category->get();}

        return view('pages.sanpham.show_category_product')->with('category',$category_product)->with('product',$product_by_category)->with('category_post',$category_post)
        ->with('min_price_value',$min_price)->with('max_price_value',$max_price)
        ->with('max_price_range',$max_price_range)->with('min_price_range',$max_price_range);
        
    }
    public function update_cate_product_status(Request $request){
        $this->AuthLogin();
        $id = $request->category_id;
        $status = $request->category_status;   
        DB::table('tbl_category_product')->where('category_id', $id)->update(['category_status' => $status]);   
    }
    
}
