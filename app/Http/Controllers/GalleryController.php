<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // sử dụng database
use App\Http\Requests;
use App\Models\Gallery;

use Session; // thu vien sdung session
use Illuminate\Support\Facades\Redirect; 
session_start();

class GalleryController extends Controller
{
    public function AuthLogin()
    {
        $admin_id=Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('admin.dashboard');

        }else
        {
            return Redirect::to('admin')->send();
        }
    }
    public function add_Gallery($product_id)
    {
        $this->AuthLogin();

        //$gallery=DB::table();
        $images=Gallery::where('product_id',$product_id)->get();
        $product_info=DB::table('tbl_product')->where('product_id',$product_id)->get();

        return view('admin.gallery.add_gallery')->with('product_id',$product_id)->with('gallery',$images)->with('product_info',$product_info);
    }

    public function insert_Gallery(Request $request, $product_id)
    {
        $this->AuthLogin();
        
        $data = array();
        $data['product_id']=$product_id;

        $imagefile=$request->file('file');
        
        if(!$imagefile)
        {
            Session::put('message','Chưa chọn file');
            return Redirect::to('add-gallery/'.$product_id);
        }

        foreach ($imagefile as $key => $get_image)
        {
            //$get_image=file('$file');
            if($get_image)
            {
                
                $get_name_image=$get_image->getClientOriginalName();//khi dùng getClientOriginalName() nó sẽ lấy toàn bộ tên, bao gồm cả đuôi mở rộng(VD: lấy cả a.jpg)
                $name_image=current(explode('.',$get_name_image));//explode hàm để cắt tên tính từ dấu . để cắt đuôi mở rộng đi
                                                                  //hàm current để lấy chuỗi đầu tiên (VD: a.jpg được thách thành 2 đoạn là a vs jpg thì nó lấy a(chuỗi đầu tiên))
                $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();// getClientOriginalExtension(): hàm để lấy đuôi mở rộng (png, jpg,...)
                $get_image->move('public/uploads/gallery',$new_image);

                $data['gallery_image']=$new_image;

                DB::table('tbl_gallery')->insert($data);
                
            } 
            else
            {
                Session::put('message','Thêm hình ảnh không thành công');
                return Redirect::to('add-gallery/'.$product_id);
            }
        }

        Session::put('message','Thêm hình ảnh thành công');
        return Redirect::to('add-gallery/'.$product_id);

    }

    public function delete_Gallery($gallery_id)
    {
        $this->AuthLogin();

        $product_id=Gallery::where('gallery_id',$gallery_id)->value('product_id');
        $old_image_name=Gallery::where('gallery_id',$gallery_id)->value('gallery_image');
        $filePath = 'public/uploads/gallery/'.$old_image_name;
        if (file_exists($filePath))
        {
            unlink($filePath);
        }//để khi thay thế thì mình sẽ truy cập vào folder upadates xóa ảnh khi trước luôn
        
        Gallery::where('gallery_id',$gallery_id)->delete();

        Session::put('message','Xóa hình ảnh thành công');
        return Redirect::to('add-gallery/'.$product_id);
    }
}
