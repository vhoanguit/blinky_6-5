<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

use App\Models\CatePost;
class HomeController extends Controller
{
    // public function index(){
    //     return view('pages.home');
    // }
    public function index(Request $request){
        //category post
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get(); // k có phân trang nên mình lấy hết bằng hàm get
        
        return view('copy_layout')->with('category_post',$category_post); // trả về copy_layout và mang theo dữ liệu $category_post để sử dụng
    }
    // test 
    public function index2(Request $request)
    {
        $category_post = CatePost::orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get
        
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->limit(12)->get();

        return view('copy_layout')->with('category',$category_product)->with('product',$all_product)->with('category_post',$category_post);   
    }
    public function sanpham()
    {
        $category_post = CatePost::orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get

        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->get();
        
        $tatcasp = DB::table('tbl_product')->orderBy('product_id','DESC')->get();

        return view('sanpham')->with('category',$category_product)->with('product',$all_product)->with('tatcasp',$tatcasp)->with('category_post',$category_post);
    }
    public function search(Request $request){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('search_product',$search_product)->with('category_post',$category_post);
    }


}
