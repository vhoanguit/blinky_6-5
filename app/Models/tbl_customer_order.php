<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_customer_order extends Model
{
    use HasFactory;

    // Tên bảng tương ứng
    protected $table = 'tbl_customer_order';

    // Tên của khóa chính
    protected $primaryKey = 'order_id';

    // Các thuộc tính có thể gán giá trị
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'order_total_price',
        'order_date',
        'order_status',
    ];

    // Tùy chọn nếu bạn không muốn sử dụng các trường timestamps mặc định
    public $timestamps = true;
    
    // Nếu tên các cột created_at và updated_at không phải là mặc định
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Quan hệ với bảng customers nếu có
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // Quan hệ với bảng order_details nếu có
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}