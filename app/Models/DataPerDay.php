<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerDay extends Model
{
    use HasFactory;
    protected $table = 'tbl_data_per_day';
    protected $primaryKey = 'data_id';
    protected $fillable = [
        'date', 'order_count', 'total_revenue'
    ];

    public $timestamps = true;
}
