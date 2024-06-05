<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'tbl_customer';

    // Khóa chính của bảng
    protected $primaryKey = 'customer_id';

    // Nếu khóa chính không tự động tăng
    public $incrementing = true;

    // Kiểu dữ liệu của khóa chính
    protected $keyType = 'bigint';

    // Nếu bảng có cột timestamps
    public $timestamps = true;

    // Các cột có thể điền vào
    protected $fillable = [
        'customer_email',
        'customer_password',
        'customer_date',
        'customer_name',
        'customer_phone',
        'customer_city',
        'customer_district',
        'customer_image',
    ];

    // Các cột có giá trị mặc định (nếu có)
    protected $attributes = [
        'customer_city' => null,
        'customer_district' => null,
        'customer_image' => null,
    ];
}