<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; // sử dụng database


use App\Http\Requests;
use Session; // thu vien sdung session
use Illuminate\Support\Facades\Redirect; 
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
    	return view('admin.add_product')->with('cate_product',$cate_product);
    }
    public function all_product(){
        $this->AuthLogin();
    	$all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id') 
        //hàm join 2 bảng tbl_product và tbl_category_product với khóa ngoại là category_id
        ->orderby('tbl_product.product_id')->paginate(50); 
    	$manage_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manage_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        
       
    	$data = array();
    	$data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->category_id;
        // $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_number'] = $request->product_number;
        
        $get_image= $request->file('product_image');
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);   
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image']='';
    	DB::table('tbl_product')->insert($data);   
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('add-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manage_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product);

        return view('admin_layout')->with('admin.edit_product', $manage_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_number'] = $request->product_number;
        // $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;

        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_id;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    // chi tiet sp + hien thi
    public function show_product_details($product_id)
    {
        $this->AuthLogin();
        $product = DB::table('tbl_product')
        ->where('tbl_product.product_id',$product_id)
        ->join('tbl_product_details','tbl_product_details.product_id','=','tbl_product.product_id')
        ->join('tbl_size','tbl_size.size_id','=','tbl_product_details.size_id')
        ->get();

        $manager_product = view('admin.product.show_product_details')->with('product',$product );
        return view('admin_layout')->with('admin.product.show_product_details',$manager_product) ;
    }

    public function edit_product_details($product_id)
    {
        $this->AuthLogin();
        // $cate_product= DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $edit_product = DB::table('tbl_product')
        ->where('tbl_product.product_id',$product_id)
        ->join('tbl_product_details','tbl_product_details.product_id','=','tbl_product.product_id')
        ->join('tbl_size','tbl_size.size_id','=','tbl_product_details.size_id')
        ->get();

        $manager_product = view('admin.product.edit_product_details')->with('edit_product',$edit_product )->with('pro_id',$product_id);
        
        return view('admin_layout')->with('admin.product.edit_product_details',$manager_product) ;
    }

    public function update_product_details(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();

        $size_index=DB::table('tbl_size')->orderby('size_id','asc')
        ->join('tbl_product_details','tbl_product_details.size_id','=','tbl_size.size_id')
        ->where('tbl_product_details.product_id',$product_id)
        ->pluck('tbl_size.size_id');

        $sl_size=$request->product_size_sl;
        foreach ($sl_size as $key => $sl)
        {
            $size=$size_index[$key];
            $data['SL']=$sl;

            DB::table('tbl_product_details')->where('product_id',$product_id)->where('size_id',$size)->update($data);
        }

        // DB::table('tbl_product')->where('product_id',$product_id)->update($data);//cập nhật dữ liệu cho đối tượng có id giống
        
        Session::put('message','Cập nhật chi tiết sản phẩm thành công');
        return Redirect::to('show-product-details/'.$product_id);
    }
    

    //FE
    public function show_inside_product($product_id)
    {
        $product_by_id=DB::table('tbl_product')
        ->where('product_status','1')->where('product_id',$product_id)->get();

        $size_product=DB::table('tbl_size')
        ->join('tbl_product_details','tbl_product_details.size_id','=','tbl_size.size_id')
        ->where('tbl_product_details.product_id',$product_id)
        ->get();
        
        $category_of_product=DB::table('tbl_category_product')->join('tbl_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_product.product_id',$product_id)->get();

        foreach($product_by_id as $key => $pro)
        {
            $category_id=$pro->category_id;
        }

        $related_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('product_status','1')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])
        ->orderby('tbl_product.product_id','asc')->limit(12)->get();
        
        return view('pages.sanpham.inside_product')->with('product',$product_by_id)->with('related_product',$related_product)->with('cate_of_product',$category_of_product)->with('size',$size_product);
    }

    public function filter_products(Request $request )
    {
        echo"daasdas";
        //$product = DB::table('tbl_product');
        // $products = DB::table('tbl_product');
        
        // if ($request->has('filter_checked'))
        // {
        
        //     $colors = $request->input('filter_checked'); 

        //     if (!empty($colors)) {
        //         $products->whereIn('product_color', $colors);
        //     }

        // }
        // $products->where('product_status', 1)->orderBy('product_id')->get();
        //$filter_checked = $request->input('filter_checked', []);
        $products = DB::table('tbl_product')->get();


        return response()->json(['success' => true, 'data' => $products]);
    }
}
