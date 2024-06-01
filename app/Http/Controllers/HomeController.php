<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

use App\Models\CatePost;
use App\Models\Post;

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
        $all_post = Post::where('post_status','1')->orderby('post_id','desc')->limit(4)->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $newest_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(8)->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->limit(12)->get();

        return view('home')->with('category',$category_product)->with('product',$all_product)->with('category_post',$category_post)->with('all_post',$all_post)->with('newest_product',$newest_product);   
    }
    public function sanpham()
    {
        $category_post = CatePost::orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get

        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        
        // $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','asc')->get();
        
        $tatcasp = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','DESC')->get();

        $min_price=DB::table('tbl_product')->min('product_price');
        $max_price=DB::table('tbl_product')->max('product_price');
        $min_price_range=$min_price-100000;
        $max_price_range=$max_price+100000;

        if(isset($_GET['filter']))
        {   
            $filter=$_GET['filter'];
            for($i=0; $i<count($filter); $i++)
            {
                if($i==0) $all_product=$all_product->where('product_color',$filter[$i]);
                else $all_product=$all_product->orWhere('product_color',$filter[$i]);
            }
            //$all_product=$all_product->orderby('product_id','asc')->get();

        }

        if(isset($_GET['price_from']) && ($_GET['price_from']) )
        {
            $min_price=$_GET['price_from'];
            $max_price=$_GET['price_to'];

            $all_product=$all_product->where('product_status','1')->whereBetween('product_price',[$min_price,$max_price]);
        }
        return view('sanpham')->with('category',$category_product)
        ->with('tatcasp',$tatcasp)->with('category_post',$category_post)
        ->with('min_price_value',$min_price)->with('max_price_value',$max_price)
        ->with('max_price_range',$max_price_range)->with('min_price_range',$max_price_range);
    }
    public function search(Request $request){

        $category_post = CatePost::orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->where('product_status','1')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('search_product',$search_product)->with('category_post',$category_post);
    }


}
