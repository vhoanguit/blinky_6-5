<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false; // thôgn báo rằn model này k sự dụng các cọt create_at và updated_at mà Laravel thường tự động quản ly
    protected $fillable =[
        'gallery_id','product_id'
    ]; 
    protected $primaryKey ='gallery_id';
    protected $table ='tbl_gallery';// định nghĩa tên bảng trong csdl mà model này tương tác
    
}
