<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order_details extends Model
{
    use HasFactory;

    // Tên bảng tương ứng
    protected $table = 'tbl_order_details';

    // Bảng này không có khóa chính tự động tăng
    public $incrementing = false;

    // Các thuộc tính có thể gán giá trị
    protected $fillable = [
        'order_id',
        'product_id',
        'product_quantity',
        'product_price',
        'total_price',
        'size_id',
    ];

    // Nếu tên các cột created_at và updated_at không phải là mặc định
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Quan hệ với bảng tbl_customer_order
    public function order()
    {
        return $this->belongsTo(TblCustomerOrder::class, 'order_id', 'order_id');
    }

    // Quan hệ với bảng tbl_product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Boot method to add model event listeners
    protected static function boot()
    {
        parent::boot();

        // Event listener for creating event
        static::creating(function ($orderDetail) {
            $orderDetail->total_price = $orderDetail->product_price * $orderDetail->product_quantity;
        });

        // Event listener for updating event
        static::updating(function ($orderDetail) {
            $orderDetail->total_price = $orderDetail->product_price * $orderDetail->product_quantity;
        });
    }
}