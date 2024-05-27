<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatePost extends Model
{
    public $timestamps = false; // thôgn báo rằn model này k sự dụng các cọt create_at và updated_at mà Laravel thường tự động quản ly
    protected $fillable =[
        'cate_post_name','cate_post_status','cate_post_slug','cate_post_desc'
    ]; // sử dụng fillable giúp ta có thể thêm hoặc cập nhật hàng loạt giá trị cho các trường này
    //qua việc gán $request->all() vào model
    protected $primaryKey ='cate_post_id';
    protected $table ='tbl_category_post';// định nghĩa tên bảng trong csdl mà model này tương tác
    
    public function post(){ // 1 danh muc co nhieu bai viet
        return $this->hasMany('App\Models\Post');
    }
}
