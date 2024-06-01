<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; // thôgn báo rằn model này k sự dụng các cọt create_at và updated_at mà Laravel thường tự động quản ly
    protected $fillable =[
        'post_title','post_desc','post_content','post_meta_keywords','post_status','post_image','cate_post_id','post_slug'
    ]; 
    protected $primaryKey ='post_id';
    protected $table ='tbl_posts';// định nghĩa tên bảng trong csdl mà model này tương tác
    
    public function cate_post(){
        return $this->belongsTo('App\Models\CatePost','cate_post_id'); //dem so sanh id cua danh muc o CatePost va id cua danh muc tai Post
    } // 1 bai viet thuoc ve 1 danh muc với cate_post_id là khóa ngoại
    // Giúp lấy thông tin của danh mục đó thông qua thuộc tính cate_post của một instance Post. Khi gọi $post->cate_post, 
    // Laravel tự động truy vấn cơ sở dữ liệu để tìm CatePost có id tương ứng với cate_post_id của $post đó.
}
